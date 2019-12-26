<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Step;
use App\Kostep;
use App\Category;
use App\Challenge;
use App\Clear;

use App\Mail\SampleNotification;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class StepController extends Controller
{
  
  public function SampleNotification()//メール送信
  {
      $name = 'ララベル太郎';
      $text = 'これからもよろしくお願いいたします。';
      $to = 'test@gmail.com';
      Mail::to($to)->send(new SampleNotification($name, $text));
  }
  /*
    public function __construct()
    {
        // 認証が必要
        $this->middleware('auth');
        //$this->middleware('auth')->except(['index']);
    }
*/
    public function mypage(){//マイページ
        if(!Auth::check()){
          return redirect('login');
        }else{
          return response()->json('Mypage!');
        } 
    }

    public function mypage_registed(){//マイページ：自分の作成したSTEPを表示
        if(!Auth::check()){
          return redirect('login');
        }else{
          $category = Category::with(['steps.kosteps.clear',//ひ孫まで
                                      'steps.challenge',//孫まで
                                      'steps'=> function($q) { $q->where('user_id', Auth::user()->id);}//stepは制限をかけて取得
                                      ])->get();
          return response()->json($category);
        }
    }

    public function mypage_challenged(){//マイページ：自分のチャレンジしたSTEP
        if(!Auth::check()){
          return redirect('login');
        }else{
          $category = Category::with(['steps.kosteps.clear',//ひ孫まで
                                      'steps.challenge'=> function($q) { $q->where('user_id', Auth::user()->id)->where('challenge_flg', 1);}
                                      ])->get();//challenge済みのものを取得
          return response()->json($category);
        }
    }

    public function index(){//STEP一覧
        $category = Category::with(['steps.kosteps.clear', 'steps.challenge'])->get();
        return response()->json($category);
    }

    public function new(){//STEP新規作成画面表示
        if(!Auth::check()){
          return redirect('login');
        }else{
          $category = Category::all();
          return response()->json($category);
        }
    }
    
    public function create(Request $request){//STEP新規作成処理
        if(!Auth::check()){
            return redirect('login');
        }else{
          $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|integer|max:255',//中身はnameではなくid
            'achievement_time' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'detail_content' => 'required|string|max:255',
          ]);    
          $step = Step::create([
            'user_id' => Auth::user()->id,//作成者のid
            'title' => $request['title'],
            'category_id' => $request['category'],
            'achievement_time' => $request['achievement_time']
          ]);
          $kostep = Kostep::create([
            'step_id' => $step->id,
            'user_id' => Auth::user()->id,//作成者のid
            'content' => $request['content'],
            'detail_content' => $request['detail_content']
          ]);
          return response()->json($step);
        }
    }

    public function edit($id){//STEP編集画面表示
        if(!Auth::check()){
          return redirect('login');
        }else{
          $step = Step::where('id', $id)->where('user_id', Auth::user()->id)->first();/////getだと[{}]になる。firstなら{}となり取得できる
          return response()->json($step);
        }
    }
    public function update(Request $request, $id){//STEP編集処理
        if(!Auth::check()){
          return redirect('login');
        }else{          
          $request->validate([
            'title' => 'required|string|max:255',
            'achievement_time' => 'required|string|max:255',
          ]);
          Step::where('id', $id)->where('user_id', Auth::user()->id)->update([
            'title' => $request['title'],
            'achievement_time' => $request['achievement_time']
          ]);
          return response()->json($id);
        }
    }

    public function edit_category($id){//Category編集画面表示
      if(!Auth::check()){
        return redirect('login');
      }else{
        $category = Category::with(['steps.kosteps'=> function($q) use($id){ $q->where('step_id', $id)->where('user_id', Auth::user()->id);}
                                    ])->get();             
        return response()->json($category);
      }
  }
  public function update_category(Request $request, $id){//Category編集処理
      if(!Auth::check()){
        return redirect('login');
      }else{          
        $request->validate([
          'category_id' => 'required|integer|max:255',
        ]);
        $step = Step::where('id', $id)->where('user_id', Auth::user()->id)->update([
          'category_id' => $request['category_id']
        ]);
        return response()->json('successfully updated');
      }
  }

    public function challenge_step($id){//STEPチャレンジ
        if(!Auth::check()){
          return redirect('login');
        }else{
          $challenge = Challenge::where('step_id', $id)->where('user_id', Auth::user()->id)->first();
          if(empty($challenge)){
            $challenge = Challenge::create([
                'user_id' => Auth::user()->id,//Challengeした人。作成者ではない
                'step_id' => $id,
                'challenge_flg' => true
            ]);
          }else{
            $challenge_flg = Challenge::where('step_id', $id)->where('user_id', Auth::user()->id)->value('challenge_flg');
            $challenge_flg = !$challenge_flg;  
            $challenge = Challenge::where('step_id', $id)->where('user_id', Auth::user()->id)->update(['challenge_flg' => $challenge_flg]);
          }    
          return response()->json($challenge);
        }
    }

    public function twitter($id){//Twitterのシェア
        if(!Auth::check()){
          return redirect('login');
        }else{
          $twitter = Twitter::where('step_id', $id)->where('user_id', Auth::user()->id)->first();
          if(empty($twitter)){
            $twitter = Twitter::create([
                'user_id' => Auth::user()->id,//Twittした人。作成者ではない
                'step_id' => $id,
                'twitter_flg' => true
            ]);
          }else{
            $twitter_flg = Twitter::where('step_id', $id)->where('user_id', Auth::user()->id)->value('twitter_flg');
            $twitter_flg = !$twitter_flg;  
            $twitter = Twitter::where('step_id', $id)->where('user_id', Auth::user()->id)->update(['twitter_flg' => $twitter_flg]);
          }    
          return response()->json($twitter);
        }
    } 

    public function clear_ko_step($id, $id2){//子STEPクリア申請
        if(!Auth::check()){
          return redirect('login');
        }else{
          $clear = Clear::where('kostep_id', $id2)->where('user_id', Auth::user()->id)->first();
          if(empty($clear)){
            $clear = Clear::create([
                'user_id' => Auth::user()->id,//クリアした人。作成者ではない
                'kostep_id' => $id2,
                'step_id' => $id,
                'clear_flg' => true
            ]);
          }else{
            $clear_flg = Clear::where('kostep_id', $id2)->where('user_id', Auth::user()->id)->value('clear_flg');
            $clear_flg = !$clear_flg;  
            $clear = Clear::where('kostep_id', $id2)->where('user_id', Auth::user()->id)->update(['clear_flg' => $clear_flg]);
          }    
          return response()->json($clear);
        }
    }

    public function progress_ko_step($id, $id2){//子STEPクリア進捗のカウント
        if(!Auth::check()){
          return redirect('login');
        }else{
          $progress = Clear::where('step_id', $id)->where('user_id', Auth::user()->id)->where('clear_flg', 1)->count();//クリア済みがいくつあるか
          return response()->json($progress);
        } 
    }

    public function detail($id){//STEP詳細表示
      if(!Auth::check()){
        return redirect('login');
      }else{
        $category = Category::with(['steps.kosteps.clear', 
                                    'steps.challenge'=> function($q) use($id){ $q->where('step_id', $id)->where('user_id', Auth::user()->id);},
                                    'steps.kosteps'=> function($q) use($id){ $q->where('step_id', $id);}
                                    ])->get();
        return response()->json($category);
      }
  }
    public function ko_detail($id, $id2){//子STEP詳細表示
        if(!Auth::check()){
          return redirect('login');
        }else{
          $category = Category::with([
                                      'steps.challenge'=> function($q) use($id){ $q->where('step_id', $id)->where('user_id', Auth::user()->id);},
                                      'steps.kosteps'=> function($q) use($id, $id2){ $q->where('step_id', $id)->where('id', $id2);},
                                      'steps.kosteps.clear'=> function($q) use($id, $id2){ $q->where('kostep_id', $id2)->where('user_id', Auth::user()->id);}
                                      ])->get();
          return response()->json($category);
        }
    }

    public function ko_detail_new($id){//子STEP新規登録画面表示
        if(!Auth::check()){
          return redirect('login');
        }else{
          $category = Category::with(['steps.kosteps'=> function($q) use($id){ $q->where('step_id', $id);}
                                      ])->get();
          return response()->json($category);
        }
    }

    public function ko_detail_create(Request $request, $id){//子STEP新規登録処理
        if(!Auth::check()){
            return redirect('login');
        }else{
          $request->validate([
            'content' => 'required|string|max:255',
            'detail_content' => 'required|string|max:255',
          ]);
          $user_id = Step::where('id', $id)->where('user_id', Auth::user()->id)->value('user_id');
          if($user_id == Auth::user()->id){//作成者じゃないと子STEPの追加不可
              $kostep = Kostep::create([
                'step_id' => $id,
                'user_id' => Auth::user()->id,
                'content' => $request['content'],
                'detail_content' => $request['detail_content']
              ]);
              return response()->json($kostep);
          } 
        }
    }

    public function edit_ko_step($id, $id2){//子STEP編集画面表示
        if(!Auth::check()){
          return redirect('login');
        }else{
          $kostep = Kostep::where('step_id', $id)->where('id', $id2)->where('user_id', Auth::user()->id)->first();/////本来はこちら。getだと[{}]になる
          return response()->json($kostep);
        }
    }

    public function update_ko_step(Request $request, $id, $id2){//子STEP編集処理
        if(!Auth::check()){
          return redirect('login');
        }else{
          $request->validate([
            'content' => 'required|string|max:255',
            'detail_content' => 'required|string|max:255',
          ]);
          Kostep::where('step_id', $id)->where('id', $id2)->where('user_id', Auth::user()->id)->update([
            'content' => $request['content'],
            'detail_content' => $request['detail_content']
          ]); 
          return response()->json($id);
        }
    }

    public function destroy_ko_step($id, $id2){//子STEPの削除
        if(!Auth::check()){
          return redirect('login');
        }else{
          $count = Kostep::where('step_id', $id)->count();
          if($count >= 2){//子STEPが１つだけの時は削除不可とする
            Kostep::where('user_id', Auth::user()->id)->find($id2)->delete();
            return response()->json('successfully deleted');
          }
        }
    }

    public function destroy($id){//STEPの削除
        if(!Auth::check()){
          return redirect('login');
        }else{  
            Step::where('id', $id)->where('user_id', Auth::user()->id)->find($id)->delete();
            return response()->json('successfully deleted');
        }
    }

}
