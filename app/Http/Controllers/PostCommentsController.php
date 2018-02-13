<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Redirector;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = auth()->user();

        $data = [
            'post_id'   => $request->post_id,
            'author'    => $user->name,
            'email'     => $user->email,
            'photo'     => $user->photo->file,
            'body'      => $request->body
        ];

        $comment = Comment::create($data);
		$msg = "Comentário: " . $comment->id . " - de: " . $user->name . " foi Incluído. Aguarda moderação";
		Session::flash('Comentário Incluído',$msg);
		return redirect()->back();		        
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $comment =Comment::findOrFail($id)->update($request->all());

		$msg = "Comentário: " . $id . " - do post: " . $comment['post_id'] . " foi Atualizado";
		Session::flash('Comentário Atualizado',$msg);
        return redirect('/admin/comments');
	        
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
        $comment = Comment::findOrFail($id)->delete();

		$msg = "Comentário: " . $id . " - do post: " . $comment['post_id'] . " foi Excluido";
		Session::flash('Comentário Excluído',$msg);
        return redirect('/admin/comments');	           
    }
}
