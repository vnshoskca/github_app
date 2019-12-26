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
                                      ])->get();//challenge済みのを取得
          return response()->json($category);
        }
    }

    public function index(){//STEP一覧
        $category = Category::with(['steps.kosteps.clear', 'steps.challenge'])->get();
        //$category = Category::with(['steps.kosteps.clear', 'steps.challenge'])->paginate(3);
        return response()->json($category);
        //return new StepCollection(Step::all()); //出来なかった
        //$steps = Step::with(['user'])->orderBy(Step::CREATED_AT, 'desc')->paginate();
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
            'category' => 'required|integer|max:255',
            'achievement_time' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'detail_content' => 'required|string|max:255',
          ]);
          //$user = Auth::user();
          //$category = Category::where('name', $request['name'])->get();      
          $step = Step::create([
            'user_id' => Auth::user()->id,
            'title' => $request['title'],
            'category_id' => $request['category'],
            'achievement_time' => $request['achievement_time']
          ]);
          $kostep = Kostep::create([
            'step_id' => $step->id,
            'user_id' => Auth::user()->id,
            'content' => $request['content'],
            'detail_content' => $request['detail_content']
          ]);
          return response()->json($step);
        }
        //Auth::user()->steps()->save($step->fill($request->all()));
        //Auth::user()->kosteps()->save($kostep->fill($request->all()));
        
        //steps()->save($step->fill($request->all())); //出来なかった
        //$step->save(); //出来なかった
    }

    public function edit($id){//STEP編集画面表示
        if(!Auth::check()){
          return redirect('login');
        }else{
          /*
          $category = Category::with(['steps.kosteps.clear', 
                                      'steps.challenge'=> function($q) use($id){ $q->where('step_id', $id);},
                                      'steps.kosteps'=> function($q) use($id){ $q->where('step_id', $id);}
                                      ])->get();
          return response()->json($category);
          */
          //return response()->json($category);
          $step = Step::where('id', $id)->where('user_id', Auth::user()->id)->first();/////getだと[{}]になる
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
        $category = Category::with([//'steps.kosteps.clear', 
                                    //'steps.challenge'=> function($q) use($id){ $q->where('step_id', $id);},
                                    'steps.kosteps'=> function($q) use($id){ $q->where('step_id', $id)->where('user_id', Auth::user()->id);}
                                    //'steps'=> function($q) use($id){ $q->where('id', $id)->where('user_id', Auth::user()->id);}
                                    ])->get();
                                    //])->first();
        return response()->json($category);
/*
        $step = Step::where('id', $id)->where('user_id', Auth::user()->id)->first();/////本来はこちら。getだと[{}]になる
        //$step = Step::where('id', $id)->first();
        return response()->json($step);
        */
      }
  }
  public function update_category(Request $request, $id){//Category編集処理
      if(!Auth::check()){
        return redirect('login');
      }else{          
        $request->validate([
          //'title' => 'required|string|max:255',
          //'category' => 'required|integer|max:255',
          'category_id' => 'required|integer|max:255',
          //'achievement_time' => 'required|string|max:255',
        ]);
        $step = Step::where('id', $id)->where('user_id', Auth::user()->id)->update([
          //'title' => $request['title'],
          //'category_id' => $request['category'],
          'category_id' => $request['category_id'],
          //'achievement_time' => $request['achievement_time']
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
                'user_id' => Auth::user()->id,
                'step_id' => $id,
                'challenge_flg' => true
            ]);
          }else{////あとで消す
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
                'user_id' => Auth::user()->id,
                'step_id' => $id,
                'twitter_flg' => true
            ]);
          }else{////あとで消す？
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
                'user_id' => Auth::user()->id,
                'kostep_id' => $id2,
                'step_id' => $id,
                'clear_flg' => true
            ]);
          }else{////あとで消す
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
          $progress = Clear::where('step_id', $id)->where('user_id', Auth::user()->id)->where('clear_flg', 1)->count();
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
                                      //'steps.kosteps'=> function($q) use($id, $id2){ $q->where('step_id', $id);},//子の総数合うが、子が全件表示
                                      'steps.kosteps'=> function($q) use($id, $id2){ $q->where('step_id', $id)->where('id', $id2);},
                                      //'steps.kosteps.clear',別のユーザーがログインした場合、区別してくれない
                                      'steps.kosteps.clear'=> function($q) use($id, $id2){ $q->where('kostep_id', $id2)->where('user_id', Auth::user()->id);}
                                      ])->get();
          return response()->json($category);
        }
    }

    public function ko_detail_new($id){//子STEP新規登録画面表示
        if(!Auth::check()){
          return redirect('login');
        }else{
          $category = Category::with([ 
                                      'steps.kosteps'=> function($q) use($id){ $q->where('step_id', $id);}
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
          if($user_id == Auth::user()->id){
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
          /*
          $category = Category::with([//'steps.kosteps.clear',//不要
                                      //'steps.challenge'=> function($q) use($id, $id2){ $q->where('step_id', $id)->where('id', $id2);},//不要
                                      'steps.kosteps'=> function($q) use($id, $id2){ $q->where('step_id', $id)->where('id', $id2);}
                                      ])->get();
          return response()->json($category);
          */
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
          if($count >= 2){
            Kostep::where('user_id', Auth::user()->id)->find($id2)->delete();
            //return response()->json($id);
            return response()->json('successfully deleted');
            //return redirect('/step')->with('flash_message',__('Deleted.'));
          }
        }
    }

    public function delete_search($id){//削除STEPの検索
        if(!Auth::check()){
          return redirect('login');
        }else{  
          Step::find($id)->get();
          return response()->json($id);
        }
    }

    public function destroy($id){//STEPの削除
        if(!Auth::check()){
          return redirect('login');
        }else{  
          //$user_id = Step::where('id', $id)->where('user_id', Auth::user()->id)->value('user_id');
          //if($user_id == Auth::user()->id){
            Step::where('id', $id)->where('user_id', Auth::user()->id)->find($id)->delete();
              //Step::find($id)->delete();
              //return response()->json($id);
              return response()->json('successfully deleted');
              //return redirect('/step')->with('flash_message',__('Deleted.'));
          //}
        }
    }

}
