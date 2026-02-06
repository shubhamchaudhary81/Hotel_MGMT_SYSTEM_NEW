<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Display a listing of menu items.
     */
    public function index(Request $request)
    {
        $menuItems = MenuItem::with('category')
            ->when($request->search, function ($query) use ($request) {
                $query->where('item_name', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate(10);

        $categories = MenuCategory::orderBy('sort_order')->get();

        return view('admin.menu-items.index', compact('menuItems', 'categories'));
    }



    /**
     * Show create form
     */
    public function create()
    {
        $categories = MenuCategory::orderBy('sort_order')->get();
        return view('admin.menu-items.create', compact('categories'));
    }



    /**
     * Store a new menu item
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_description' => 'nullable|string',
            'category_id' => 'required|exists:menu_categories,id',
            'price' => 'required|numeric|min:0',
            'is_available' => 'required|boolean',
            'menu_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        // IMAGE UPLOAD
        if ($request->hasFile('menu_image')) {

            // Create folder if not exists
            $folder = public_path('images/menuitems');
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $filename = time() . '-' . uniqid() . '.' . $request->menu_image->extension();
            $request->menu_image->move($folder, $filename);

            $data['menu_image'] = 'images/menuitems/' . $filename;
        }

        MenuItem::create($data);

        return redirect()->route('admin.menu-items.index')
            ->with('success', 'Menu item added successfully');
    }



    /**
     * Update an existing menu item
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'item_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^(?=.*[A-Za-z]).+$/'
            ],
            'item_description' => 'nullable|string',
            'category_id' => 'required|exists:menu_categories,id',
            'price' => 'required|numeric|min:0',
            'is_available' => 'required|boolean',
            'menu_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $data = $request->all();

        // UPDATE IMAGE
        if ($request->hasFile('menu_image')) {

            // Delete old image if exists
            if ($menuItem->menu_image && file_exists(public_path($menuItem->menu_image))) {
                unlink(public_path($menuItem->menu_image));
            }

            // Ensure folder exists
            $folder = public_path('images/menuitems');
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $filename = time() . '-' . uniqid() . '.' . $request->menu_image->extension();
            $request->menu_image->move($folder, $filename);

            $data['menu_image'] = 'images/menuitems/' . $filename;
        }

        $menuItem->update($data);

        return redirect()->back()->with('success', 'Menu item updated successfully');
    }




    /**
     * Delete a menu item
     */
    public function destroy(MenuItem $menuItem)
    {
        // Delete image if exists
        if ($menuItem->menu_image && file_exists(public_path($menuItem->menu_image))) {
            unlink(public_path($menuItem->menu_image));
        }

        $menuItem->delete();

        return redirect()->back()->with('success', 'Menu item deleted successfully');
    }
}
