<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
    * Get all data from categories
    * @return Object List of all registered categories
    */
    public function index(){
        $categories = Category::all();
        return response()->json($categories, 200);
    }
}
