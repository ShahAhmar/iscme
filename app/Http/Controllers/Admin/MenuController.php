<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $location = $request->query('location', 'header');
        if (!in_array($location, ['header', 'footer'])) {
            $location = 'header';
        }

        return Inertia::render('Admin/Menus/Index', [
            'items' => MenuItem::where('location', $location)->orderBy('sort_order')->get(),
            'currentLocation' => $location,
        ]);
    }

    public function store(Request $request)
    {
        MenuItem::create($this->validatedData($request));
        return back()->with('success', 'Menu item added.');
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $menuItem->update($this->validatedData($request));
        return back()->with('success', 'Menu item updated.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return back()->with('success', 'Menu item deleted.');
    }

    private function validatedData(Request $request)
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:100'],
            'url' => ['required', 'string', 'max:2048'],
            'location' => ['required', 'in:header,footer'],
            'target' => ['required', 'in:_self,_blank'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        return $data;
    }
}
