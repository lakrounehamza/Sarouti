<?php

namespace App\Repositorys;

use  App\Contracts\CategoryRepositoryInterface;
use  App\Models\Category;
use  App\Http\Requests\CreateCategoryRequest;
use  App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\DB;
class CategoryRepository implements CategoryRepositoryInterface
{

    public function getAllCategories()
    {
        return DB::table('categories')
        ->select('categories.id', 'categories.name', 'categories.description', DB::raw('COUNT(annonces.id) as numbre_annonces'))
        ->join('annonces', 'categories.id', '=', 'annonces.category_id', 'full outer')  
        ->groupBy('categories.id', 'categories.name', 'categories.description')
        ->get();   
    }


    public function getCategoryById($categoryId)
    {
        $category = Category::find($categoryId);
        if ($category)
            return $category;
    }


    public function createCategory(CreateCategoryRequest $attributes)
    {
        return Category::create($attributes->all());
    }


    public function updateCategory($categoryId, UpdateCategoryRequest $attributes)
    {
        $category = Category::find($categoryId);
        if ($category)
            $category->update($attributes->all());
        return $category;
    }


    public function deleteCategory( $categoryId)
    {
        $category = Category::find($categoryId);
        if($category)
            $category->delete();
    }
}
