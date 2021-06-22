<?php

namespace App\Http\Controllers;

use App\Character;
use App\Penciler;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class AdminPostController extends Controller
{
    public function add()
    {
        $pencilers = Penciler::all();
        $characters = Character::all();

        return view('Admin.admin_add_post',
            [
                'pencilers'=>$pencilers,
                'characters'=>$characters
            ]);
    }

    public function save(Request $request){
        if (Auth::check()){

            if ($request->method() == 'POST'){
                /*$this->validate($request,[
                    'penciler_id' => 'required, | numeric' ,
                    'cover' => 'image' ,
                    'series' => 'string' | 'required' | "max:100" | 'min:5',
                    'issue' => 'required, | numeric' ,
                    'story_arc' => 'string',
                    'story_arc-part' => 'numeric',
                    'event' => 'string',
                    'synopsis' => 'string',
                ]);*/
                $post = new Post();

                $post->penciler_id = $request->input('penciler_id');
                $post->series = $request->input('series');
                $image = $request->image;

                if ($image) {
                    $imageName = $image->getClientOriginalName();
                    $image->move('titles/' . $post->series, $imageName);
                    $post->cover =  $imageName;
                }
                $post->issue = $request->input('issue');
                $post->story_arc = $request->input('story_arc');
                //$post->story_arc-part = $request->input('story_arc-part');
                $post->event = $request->input('event');
                $post->synopsis = $request->input('synopsis');
                $post->save();

                $post->character()->sync($request->input('character_id'), false);
                $post->character()->getRelated();


                //Логирование создания поста
                $log = new Logger('log_add');
                $log->pushHandler(new StreamHandler(__DIR__ . '/.../../../Logs/new_posts_log.log', Logger::INFO));
                $log->info('Пользователь ' . Auth::user()->name . ' добавил описание выпуска ' . $post->series . ' # ' . $post->issue);

                \Session::flash('flash', 'Страница выпуска ' . $post->series . ' #' . $post->issue . ' добавлен');

                return redirect()->route('single_post', $post->id);
            }
        } else
            return redirect()->route('news');
    }

    public function edit($id){ // Переход  на страницу редактирования поста
        if (Auth::check()){
            $post = Post::where('id', '=', $id)->first();
            $pencilers = Penciler::all();
            $characters = Character::all();

            return view('Admin.edit_post',
                [
                'post'=>$post,
                'pencilers'=>$pencilers,
                'characters'=>$characters,
            ]);
        }else {
            return redirect('404');
        }
    }

    public function edit_save(Request $request){
        if (Auth::check()){

            if ($request->method() == 'POST'){
                /*$this->validate($request,[
                    'penciler_id' => 'required, | numeric' ,
                    'cover' => 'image' ,
                    'series' => 'string' | 'required' | "max:100" | 'min:5',
                    'issue' => 'required, | numeric' ,
                    'story_arc' => 'string',
                    'story_arc-part' => 'numeric',
                    'event' => 'string',
                    'synopsis' => 'string',
                ]);*/
                $post = Post::where('id', '=', $request->input('id'))->first();

                $post->penciler_id = $request->input('penciler_id');
                $post->series = $request->input('series');
                $image = $request->image;

                if ($image) {
                    $imageName = $image->getClientOriginalName();
                    $image->move('titles/' . $post->series, $imageName);
                    $post->cover =  $imageName;
                }
                $post->issue = $request->input('issue');
                $post->story_arc = $request->input('story_arc');
                //$post->story_arc-part = $request->input('story_arc-part');
                $post->event = $request->input('event');
                $post->synopsis = $request->input('synopsis');
                $post->save();

                $post->character()->getRelated();
                $post->character()->sync($request->input('character_id'));
                $post->character()->getRelated();

                \Session::flash('flash', 'Страница выпуска ' . $post->series . ' #' . $post->issue . ' была обновлена');

                //Логирование редактирования поста
                $log = new Logger('log_add');
                $log->pushHandler(new StreamHandler(__DIR__ . '/.../../../Logs/new_posts_log.log', Logger::INFO));
                $log->info('Пользователь ' . Auth::user()->name . ' редактировал описание выпуска ' . $post->series . ' # ' . $post->issue);


                return redirect()->route('admin_post_get');
            }
        } else
            return redirect()->route('news');
    }

    public function delete(Request $request){
        if ($request->method()=='DELETE'){
            $post = Post::find($request->input('id'));
            $post->delete();

            //Логирование удаления поста
            $log = new Logger('log_add');
            $log->pushHandler(new StreamHandler(__DIR__ . '/.../../../Logs/new_posts_log.log', Logger::INFO));
            $log->info('Пользователь ' . Auth::user()->name . ' удалил выпуск из списка ' . $post->series . ' # ' . $post->issue);

            return back();
        }else{
            return view('Admin.admin_post', ['posts'=>Post::orderBy('updated_at', 'DESC')->get()]);
        }
    }

}
