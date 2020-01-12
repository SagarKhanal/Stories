<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Exception;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function pages(){

        $pages = Pages::all();
        return view('admin.pages')->with('pages',$pages);
    }

    public function addStory(Request $request){

        $story = new Pages();

        $story->name = $request->input('name');
        $story->profile = $request->input('profile');
        $story->url = $request->input('url');
        $story->type = $request->input('type');
        $story->description = "Default Description For Story";
        $story->save();
        return redirect('/pages')->with('status','Story Addded Successfully');
    }

    public function editStory($id){
        try{
            $pages = Pages::findOrFail($id);
            return view('admin.pages-edit')->with('pages',$pages);
        }catch(Exception $e){

            report($e);
            return redirect('/pages')->with('warning','Story Not Found!');
        }
    }
    public function updateStory(Request $request, $id){
        try{
            $pages = Pages::findOrFail($id);
            $pages->name = $request->input('name');
            $pages->profile = $request->input('profile');
            $pages->url = $request->input('url');
            $pages->type = $request->input('type');
            $pages->description = "Default Description For Story";
            $pages->update();
            return redirect('/pages')->with('status','Story Updated');
        }catch(Exception $e){

            report($e);
            return redirect('/pages')->with('warning','Story Not Found!');
        }
    }

    public function deleteStory(Request $request, $id){
        try{
            $pages = Pages::findOrFail($id);
            $pages->delete();
            return redirect('/pages')->with('status','Story Deleted');
        }catch(Exception $e){

            report($e);
            return redirect('/pages')->with('warning','Story Not Found!');
        }
    }
}
