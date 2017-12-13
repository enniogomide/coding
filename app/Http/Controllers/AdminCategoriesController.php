<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CategoriesCreateRequest;
use App\Http\Requests\CategoriesUpdateRequest;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
	
        return view('admin.categories.index', compact('categories'));		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesCreateRequest $request)
    {
        //
		$input = $request->all();
		$category = Category::create($input);
		$msg = "Categoria: " . $category->id . " - " . $category->name . " foi Incluída";
		Session::flash('Categoria Incluída',$msg);
		return redirect('admin/categories');		
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		$category = Category::findOrFail($id);
	
		return view('admin.categories.show', compact('category'));		

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$category = Category::findOrFail($id);
		
		return view('admin.categories.edit', compact('category'));		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesUpdateRequest $request, $id)
    {
        //
		$input = $request->all();
		$category = Category::findOrFail($id);
		$category->update($input);
		$msg = "Categoria: " . $id . " - " . $category['name'] . " foi Atualizada";
		Session::flash('Categoria Atualizada',$msg);
        return redirect('/admin/categories');		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		$category = Category::findOrFail($id);
		$msg = "Categoria: " . $category->id . " - " . $category->name . " foi excluída";
		Session::flash('Categoria Excluída',$msg);
		$category->delete();
		return redirect('/admin/categories');		
    }
}
