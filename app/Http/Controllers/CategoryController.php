<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\Log; // Import the Log facade

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function createCategory(Request $request)
    {
        $incomingFields = $request->validate([
            'category' => 'required'
        ]);

        $incomingFields['color'] = '#'.substr(md5(rand()), 0, 6);
        Category::create($incomingFields);

        return redirect('/');
    }


    public function deleteCategory(Category $category)
    {
        $category->delete();
        return redirect('/');
    }
}
