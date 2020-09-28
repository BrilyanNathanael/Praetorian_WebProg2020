<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category');
    }

    public function store(Request $request)
    {
        Category::create([
            'category' => $request->category,
        ]);
        return redirect('/admin/items');
    }
}
