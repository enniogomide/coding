<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Comment;
use App\CommentReply;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //

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
            'comment_id'=> $request->comment_id,
            'author'    => $user->name,
            'email'     => $user->email,
            'photo'     => $user->photo->file,
            'body'      => $request->body
        ];
 
        $commentReply = CommentReply::create($data);
        $msg = "Reposta: " . $commentReply->id . " - de: " . $user->name . " foi Incluída. Aguarda moderação.";
        Session::flash('Resposta a comentário Incluída',$msg);
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
        $comments = Comment::findOrFail($id);
        
        $commentreplies = $comments->replies;
        if (count($commentreplies) == 0){
            $msg = "Não tem respostas para o comentário: " . $id;
            Session::flash('Sem respostas',$msg);            
            return redirect()->back();
        }
        return view('admin.comments.replies.show', compact('commentreplies'));        
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
        $comment_id = $request->comment_id;

        CommentReply::findOrFail($id)->update($request->all());
        
		$msg = "Resposta Comentário: " . $id . " - do comentário: " . $comment_id . " foi Atualizada";
        Session::flash('Resposta Comentário Atualizada',$msg);
       
        return redirect()->back();       
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
        $commentreply = CommentReply::findOrFail($id)->delete();

		$msg = "Resposta Comentário: " . $id . " - do comentário: " . $commentreply['comment_id'] . " foi Excluida";
        Session::flash('Resposta Comentário Excluída',$msg);
       
        return redirect()->back();  
    }
}