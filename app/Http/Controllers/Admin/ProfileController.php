<?php
//PHP-Laravel-08 課題4
//php artisan make:controller Admin/ProfileController

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;
// 以下の1行を追加することで、Profile_History Modelを扱える
use App\Models\ProfileHistory;
// 以下の1行を追加することで時刻を扱える
use Carbon\Carbon;

class ProfileController extends Controller
{
    //PHP-Laravel-08 課題5
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);
        
        $profile = new Profile;
        $form = $request->all();
        
        unset($form['_token']);
        
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/create');
    }
    
    public function edit(Request $request)
    {   // id=8
        // Profile Modelからデータを取得
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Profile::$rules);
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();
        
        unset($profile_form['remove']);
        unset($profile_form['_token']);
        
        // 該当するデータを上書きして保存する
        $profile->fill($profile_form)->save();
        
        // ProfileHistory Modelに編集履歴を追加
        $profile_history = new ProfileHistory();
        $profile_history->profile_id = $profile->id;
        $profile_history->edited_at = Carbon::now();
        $profile_history->save();
        
        return redirect('admin/news');
    }
    
    public function delete(Request $request)
    {
        // 該当するprofile Modelを取得
        $profile = Profile::find($request->id);
        
        // 削除する
        $profile->delete();
        
        return redirect('admin/news');
    }
}
