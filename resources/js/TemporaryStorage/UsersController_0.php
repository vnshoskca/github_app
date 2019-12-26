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

class UsersController extends Controller
{
      public function prof_edit(){//ユーザー登録の変更画面表示
        $user = Auth::user();
        return response()->json($user);
      }
      public function image_edit(){//ユーザー登録の変更画面表示
        $user = Auth::user();
        return response()->json($user);
      }
  
      public function prof_update(Request $request){//ユーザー登録の変更処理
        if(!Auth::check()){
          return redirect('login');
        }else{
          $request->validate([
            'email' => 'required|email|unique:users',
          ]);
        //ファイルが送信されたか確認
        //if($request->hasFile('image')){//バリデーションでチェックするなら、ここは無くてもいいかも
          //アップロードに成功しているか確認
          //if($request->file('image')->isValid()){
            //storeを行うならここまで来ないとだめだと思います

        //$uploadfile = $request->file('image');
          //if(!empty($uploadfile)){
              //$image_name = $request->file('image')->hashName();
              
              //$image = $request->image->store('user_image');

              //ファイル名取得
              $image_name = $request->file->getClientOriginalName();
              //storage\app\image に画像が保存されました
              //$request->image->storeAs('image',date("Ymd").'_'.$image_name);
              //DBに登録するパス
              //$user->image = date("Ymd").'_'.$image_name;

              request()->file->storeAs('public/user_image', $image_name);
              //$image_name = $image_name->storeAs('public/user_image', $time.'_'.Auth::user()->id . '.jpg');
              //$image_name = $request->image->storeAs('public/user_image', $time.'_'.Auth::user()->id . '.jpg');
              
              //'image' => str_replace('public/', 'storage/', $user->image), //今回追加
              //$image_name = str_replace('public/', 'storage/', $image_name); //今回追加
              $param = [
                  'name'=>$request['name'],
                  'image'=>'/storage/'.$image_name,
                  'email' => $request['email'],
                  'introduction' => $request['introduction']
              ];
              /*
          }else{
              $param = [
                  'name'=>$request['name'],
                  'email' => $request['email'],
                  'introduction' => $request['introduction']
              ];
          }*/
        //$user = User::where('id',Auth::user()->id)->update($param);
        $user = Auth::user()->where('id',Auth::user()->id)->update($param);
        //$user->fill($request->all())->save();//$fillableを使っているから安心して使える
        //$user->update($request->all());
        return response()->json($user);
        //return redirect('/')->with('flash_message',__('Registered.'));
        //}
      //}
        }
      }
      public function image_update(Request $request){//ユーザーImageの変更処理

        //ファイルが送信されたか確認
        //if($request->hasFile('image')){//バリデーションでチェックするなら、ここは無くてもいいかも
          //アップロードに成功しているか確認
          //if($request->file('image')->isValid()){

        //$uploadfile = $request->file('image');
          //if(!empty($uploadfile)){
              //$image_name = $request->file('image')->hashName();

              //ファイル名取得
              $image_name = request()->file->getClientOriginalName();
              //storage\app\image に画像が保存されました
              //$request->file->storeAs('image',date("Ymd").'_'.$image_name);

              //request()->file->storeAs('public/', $image_name);
              request()->file->storeAs('public/user_image', $image_name);
              //DBに登録するパス
              //$user->image = date("Ymd").'_'.$image_name;
              //$image_name = $image_name->storeAs('public/user_image', $time.'_'.Auth::user()->id . '.jpg');
              //$image_name = $request->image->storeAs('public/user_image', $time.'_'.Auth::user()->id . '.jpg');
              $user = Auth::user();
              $user->update(['image' => '/storage/'.$image_name]);
              return response()->json($user);
              
        //return redirect('/')->with('flash_message',__('Registered.'));

      //}
      //}

      }
}
