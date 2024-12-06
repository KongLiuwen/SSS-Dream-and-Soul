<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 显示所有分类
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    // 显示创建分类的表单
    public function create()
    {
        return view('categories.create');
    }

    // 保存新分类
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', ' Category created successfully！');
    }

    // 显示编辑分类的表单
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // 更新分类
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully！');
    }

    // 删除分类
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully！');
    }
}
