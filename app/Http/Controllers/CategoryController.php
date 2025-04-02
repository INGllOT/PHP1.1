<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function createCategory(Request $request)
    {
        $incomingFields = $request->validate([
            'category' => 'required'
        ]);

        Category::create($incomingFields);

        return redirect('/');
    }


    public function deleteCategory(Category $category)
    {
        $category->delete();
        return redirect('/');
    }
}
