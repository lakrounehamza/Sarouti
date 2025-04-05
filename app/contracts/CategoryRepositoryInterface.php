<?php

namespace App\Contracts;
use App\Models\Category;
use  App\Http\Requests\CreateCategoryRequest;
use  App\Http\Requests\UpdateCategoryRequest;
interface CategoryRepositoryInterface
{
    public function getAllCategories();
    public function getCategoryById( $categoryId);
    public function createCategory(CreateCategoryRequest $attributes);
    public function updateCategory($categoryId, UpdateCategoryRequest $attributes);
    public function deleteCategory($categoryId);
}
