<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * 显示用户上传文件的页面
     */
    public function index()
    {
        // 获取当前用户的上传记录
        $uploads = Upload::where('user_id', auth()->id())->get();

        return view('uploads.index', compact('uploads'));
    }

    /**
     * 处理文件上传
     */
    public function store(Request $request)
    {
        // 验证文件
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,xlsx,png,jpg,jpeg|max:2048', // 限制文件类型和大小
        ]);

        // 存储文件
        $file = $request->file('file');
        $path = $file->store('uploads', 'public'); // 存储到 public/uploads 目录

        // 保存数据库记录
        Upload::create([
            'user_id' => auth()->id(),
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully！');
    }

    /**
     * 显示所有用户上传的文件（管理员视图）
     */
    public function adminIndex()
    {
        // 获取所有上传记录，并加载用户信息
        $uploads = Upload::with('user')->get();

        return view('uploads.admin', compact('uploads'));
    }


    /**
     * 管理员下载文件
     */
    public function download(Upload $upload)
    {
        // 检查文件是否存在
        if (!Storage::disk('public')->exists($upload->file_path)) {
            return redirect()->back()->with('error', 'File does not exist！');
        }

        // 返回文件下载响应
        return Storage::disk('public')->download($upload->file_path, $upload->file_name);
    }
}

