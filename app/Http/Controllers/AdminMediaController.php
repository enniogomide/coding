<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Photo;
use Storage;

class AdminMediaController extends Controller
{
    //
    public function index(){
        $photos = Photo::all();

        return view('admin.medias.index', compact('photos'));
    }
    public function create(){
        //  
        return view('admin.medias.create');  
        }
    public function store(Request $request){
    //    
        $file = $request->file('file');

		if ($file = $request->file('file')){
			$name = time() . $file->getClientOriginalName();
			$file->move('images', $name);
			$photo = Photo::create(['file'=>$name]);
			$input['photo_id'] = $photo->id;
		}
        
    }
    public function destroy($id){
        //    
	/*	$photo = Photo::findOrFail($id);
        if (trim($photo->file) <> '') {
            if (Storage::has(public_path() . $photo->file)){
                unlink(public_path() . $photo->file);
            }
        }	
		$msg = "Mídia: " . $photo->id . " - " . $photo->file. " foi excluída";
		Session::flash('Mídia Excluída',$msg);
		$photo->delete();
		return redirect('/admin/medias');
    */        
    }
    
    public function deleteMedia(Request $request){
        /*
        ***********************************************************************************************
        * Exclusão individual de registro
        ***********************************************************************************************
        */
        if (isset($request->delete_single)){
            $photo = Photo::findOrFail($request->idDaPhoto);
            
            if (trim($photo->file) <> '') {
                if (Storage::has(public_path() . $photo->file)){
                    unlink(public_path() . $photo->file);
                }
            }           

                $photo->delete();

                $msg = "Exluída foto: " . $request->idDaPhoto . " diretorio: " . $request->diretorioPhoto;
                Session::flash('Mídia Excluída',$msg);   
                return redirect()->back();
            }
        /*
        ***********************************************************************************************
        * Exclusão em grupo (seleção pelo check box)
        ***********************************************************************************************
        */

        if (isset($request->delete_grupo) && !empty($request->checkBoxArray)){
    
            $ação = "'" . $request->checkBox . "'";

            $medias = "";

            for($i = 0; $i < count($request->checkBoxArray); ++$i){
                $medias = $medias . $request->checkBoxArray[$i] . ", ";
            }
            
            $photos = Photo::findOrFail($request->checkBoxArray);

            foreach($photos as $photo){
                if (trim($photo->file) <> '') {
                    if (Storage::has(public_path() . $photo->file)){
                        unlink(public_path() . $photo->file);
                    }
                }                
                    $photo->delete();
                }

            $msg = "Ação: " . $ação . " - para IDs " . $medias . " foi realizada";
            Session::flash('Ação em Grupo',$msg);

            return redirect()->back();
        }
        $msg = "Nenhuma opção selecionada. Faça uma escolha";
        Session::flash('Sem opção',$msg);        
        return redirect()->back();    
    }
}
