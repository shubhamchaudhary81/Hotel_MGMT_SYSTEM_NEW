<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|unique:menu_categories,name',
            'item_type' => 'required|in:1,2,3',
        ]);

        $category = MenuCategory::create([
            'name'      => $request->name,
            'item_type' => $request->item_type,
            'is_active' => 1,
        ]);

        return back()->with('success', 'Category added successfully');
    }

    public function update(Request $request, MenuCategory $category)
    {
        $request->validate([
            'name'      => 'required|string|unique:menu_categories,name,' . $category->id,
            'item_type' => 'required|in:1,2,3',
        ]);

        $category->update($request->only('name', 'item_type'));

        return back()->with('success', 'Category updated successfully');
    }

    public function destroy(MenuCategory $category)
    {
        $category->delete();

        return back()->with('success', 'Category deleted successfully');
    }
}
