<?php

namespace App\Http\Views;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer
{

    protected $category;

    public function __construct(Category $category){
        $this->category = $category;
    }

    public function compose(View $views){
        $categories = $this->category->getNavCategories();
        $views->with('categories', $categories);
    }
}
