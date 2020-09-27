<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profiles;
use App\ProfileHistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
      $this->validate($request, Profiles::$rules);
      
      $profiles = new Profiles;
      $form = $request->all();
      
      $profiles->fill($form)->save();// Laravel 16　課題2
        return redirect('admin/profile/create'); //Laravel 13 課題2
    }
    
    
    
    
    public function index(Request $request) {
    $cond_title = $request->cond_title;
    if ($cond_title != '') {
      // 検索されたら検索結果を取得する
      $posts = Profiles::where('name', $cond_title) ->get();
    }else {
      // それ以外はすべてのニュースを取得する
      $posts=Profiles::all();
    }
    return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    
    

    public function edit(Request $request)
    {
      // News Modelからデータを取得する
      $profiles = Profiles::find($request->id);
      if (empty($profiles)) {
        abort(404);    
      }
      return view('admin.profile.edit', ['profile_form' => $profiles]);
    }


    public function update(Request $request)
    {
      $this->validate($request, Profiles::$rules);
      $profiles = Profiles::find($request->id);
      $profile_form = $request->all();
      
      unset($profile_form['_token']);
      
      // 該当するデータを上書きして保存する
      $profiles->fill($profile_form)->save();
      
      
      $history = new ProfileHistory;
      $history->profiles_id = $profiles->id;
      $history->edited_at = Carbon::now();
      $history->save();

      return redirect('admin/profile/');
    }
    
    
    public function delete(Request $request)
    {
      $profiles = Profiles::find($request->id);
    
      $profiles -> delete();
      return redirect('admin/profile/');
    }
}
