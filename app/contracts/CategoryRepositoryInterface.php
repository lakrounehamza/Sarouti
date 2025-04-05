<?php

namespace App\Contracts;
use App\Models\Category;
use  App\Http\Requests\CreateCategoryRequest;
use  App\Http\Requests\UpdateCategoryRequest;
interface CategoryRepositoryInterface
{
    public function getAllCategories();
    public function getCategoryById(Category $category);
    public function createCategory(CreateCategoryRequest $attributes);
    public function updateCategory(Category $category, UpdateCategoryRequest $attributes);
    public function deleteCategory(Category $category);
}
