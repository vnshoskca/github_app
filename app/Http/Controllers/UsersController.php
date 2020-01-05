<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Step;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;

class UsersController extends Controller {

    public function prof_edit(){//ユーザー登録の変更画面表示
        if(!Auth::check()){
            return redirect('login'); 
        }else{
            $user = Auth::user();
            return response()->json($user);
        }
    }
  
    public function prof_update(Request $request){//ユーザー登録の変更処理
        if(!Auth::check()){
            return redirect('login'); 
        }else{
            $request->validate([
              'email' => 'required|email',
            ]);
            $param = [
              'name'=>$request['name'],
              'email' => $request['email'],
              'introduction' => $request['introduction']
            ];
            $user = Auth::user()->where('id',Auth::user()->id)->update($param);
            return response()->json($user);
        }    
    }

    public function image_update(Request $request){//ユーザーImageの変更処理
        if(!Auth::check()){
            return redirect('login'); 
        }else{
            /*
            $request->validate([//空でない|アップロードに成功したfile|mines指定|サイズ制限
                'image' => 'filled|file|image|dimensions:min_width=20,min_height=20,max_width=1500,max_height=1500',
            ]);
            $image_name = request()->file->getClientOriginalName();//ファイル名取得
            request()->file->storeAs('public/user_image', $image_name);
            $user = Auth::user();
            $user->update(['image' => '/storage/'.$image_name]);
            return response()->json($user);
            */

            //POSTされた画像ファイルデータ取得しbase64でエンコードする
            $image = base64_encode(file_get_contents($request->image->getRealPath()));
            // base64エンコードしたバイナリデータを格納
            Model::insert([
                "image" => $image
            ]);
        }
    }

    public function upload(Request $request){
        $post = new User;
        $form = $request->all();
        //s3アップロード開始
        $image = $request->file('image');
        // バケットの`myprefix`フォルダへアップロード
        $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        // アップロードした画像のフルパスを取得
        $post->image_path = Storage::disk('s3')->url($path);
        $post->save();
        return redirect('/');
    }

}
