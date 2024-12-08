<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * 
     */
    public function index()
    {
       
        $uploads = Upload::where('user_id', auth()->id())->get();

        return view('uploads.index', compact('uploads'));
    }

    /**
     * 
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,xlsx,png,jpg,jpeg|max:2048', // 限制文件类型和大小
        ]);

      
        $file = $request->file('file');
        $path = $file->store('uploads', 'public'); 

        
        Upload::create([
            'user_id' => auth()->id(),
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully！');
    }

    /**
     * 
     */
    public function adminIndex()
    {
        
        $uploads = Upload::with('user')->get();

        return view('uploads.admin', compact('uploads'));
    }


    /**
     * 
     */
    public function download(Upload $upload)
    {
        
        if (!Storage::disk('public')->exists($upload->file_path)) {
            return redirect()->back()->with('error', 'File does not exist！');
        }

        
        return Storage::disk('public')->download($upload->file_path, $upload->file_name);
    }
}

