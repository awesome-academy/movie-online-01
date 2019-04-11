<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MenuFormRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::where('parent_id', '=', 0)->get();
        $cmenus = Menu::where('parent_id', '!=', 0)->get();

        return view('backend.menu.showmenu', compact('menus', 'cmenus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::where('parent_id', '=', 0)->get();   

        return view('backend.menu.create', compact('menus'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuFormRequest $request)
    {
        if ($request->input('valuemenu')) {
             $menu = new Menu(array(
                'name' => $request->get('name'),
                'slug' => Str::slug($request->get('name'), '-'),
                'parent_id' => $request->get('valuemenu')
            ));
         } else {
            $menu = new Menu(array(
                'name' => $request->get('name'),
                'slug' => Str::slug($request->get('name'), '-')
            ));
        }
        $menu->save();

       return redirect()->back()->with('status', trans('message.success'));
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $menu = Menu::whereSlug($slug)->firstOrFail();
        if (!$menu->parent_id) {
            $dmenus = Menu::where('parent_id', '=', $menu->id)->get();
        } else {
            $dmenus = Menu::where('id', '=', $menu->parent_id)->get();
        }

        return view('backend.menu.show', compact('menu', 'dmenus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::whereId($id)->firstOrFail();
        $menus = Menu::where('parent_id', '=', 0)->get();   

        return view('backend.menu.edit', compact('menu', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuFormRequest $request, $id)
    {
        $menu = Menu::whereId($id)->firstOrFail();
        $menu->name = $request->get('name');
        $menu->slug = Str::slug($request->get('name'), '-');
        $menu->parent_id = $request->get('valuemenu');
        $menu->save();

        return redirect()->back()->with('status', trans('message.edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illumina    te\Http\Response
     */
    public function destroy($slug)
    {
        $menu = Menu::whereSlug($slug)->firstOrFail();
        if ($menu->parent_id == 0) {
            $menus = Menu::where('parent_id', '=', $menu->id);
            $menus->delete();
        }
        $menu->delete();

        return redirect()->back()->with('status', trans('message.delete'));
    }
}
