<?php

namespace App\Repositorys;
use  app\Contracts\CategoryRepositoryInterface;
use  App\Models\Category;
use  App\Http\Requests\CreateCategoryRequest;
use  App\Http\Requests\UpdateCategoryRequest;
class CategoryRepository implements CategoryRepositoryInterface
{
   
    public function getAllCategories()
    {
        return Category::all();
    }

   
    public function getCategoryById(Category $category)
    {
        return $category;
    }

  
    public function createCategory(CreateCategoryRequest $attributes)
    {
        return Category::create($attributes->all());
    }


    public function updateCategory(Category $category, UpdateCategoryRequest $attributes)
    {
       
    }


    public function deleteCategory(Category $category)
    {

    }

}
