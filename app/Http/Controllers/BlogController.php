<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // 一覧表示
    public function showList()
    {
        $blogs = Blog::all();


        return view('blog.list',['blogs' => $blogs]);
    }
    // 詳細ページ
    public function showDetail($id)
    {
        $blog = Blog::find($id);

        if(is_null($blog)) {
          \Session::flash('err_msg','データがありません！');
          return redirect(route('blogs'));
        }

        return view('blog.detail',['blog' => $blog]);
    }

    // ブログ登録画面表示
    public function showCreate() {
      return view('blog.form');
    }

    // ブログ登録する
    public function exeStore(BlogRequest $request) {

      $Image = $request->img;
          if ($Image) {

              //一意のファイル名を自動生成しつつ保存し、かつファイルパス（$productImagePath）を生成
              //ここでstore()メソッドを使っているが、これは画像データをstorageに保存している
              $ImagePath = $Image->store('public/uploads');

          } else {
              $ImagePath = "";
          }

      $blog = new Blog;
      $blog->title = $request->title;
      $blog->content = $request->content;
      $blog->img = $ImagePath;
      $blog->save();

        \Session::flash('err_msg','ブログを登録しました');
        return redirect(route('blogs'));
    }

    // 編集
    public function showEdit($id)
    {
        $blog = Blog::find($id);

        if(is_null($blog)) {
          \Session::flash('err_msg','データがありません！');
          return redirect(route('blogs'));
        }

        return view('blog.edit',['blog' => $blog]);
    }

    // ブログ編集の動き
    public function exeUpdate(BlogRequest $request) {


      $Image = $request->img;
          if ($Image) {
              //一意のファイル名を自動生成しつつ保存し、かつファイルパス（$productImagePath）を生成
              //ここでstore()メソッドを使っているが、これは画像データをstorageに保存している
              $ImagePath = $Image->store('public/uploads');

          } else {
              $ImagePath = "";
          }

      $inputs = $request->all();
      \DB::beginTransaction();
      try {
        // ブログを更新
        $blog = Blog::find($inputs['id']);
        $blog->img = $ImagePath;
        $blog->fill([
          'title' => $inputs{'title'},
          'content' => $inputs{'content'},
        ]);
        $blog->save();
        \DB::commit();
      } catch(\Throwable $e) {
        \DB::rollback();
        abort(500);
      }

//       if($request->hasFile('image')) {
//     Storage::delete('public/uploads' . $blog->image); //元の画像を削除☆
//     $path = $request->file('image')->store('public/uploads');
//     $blog->image = basename($path);
//     $blog->save();
// }

        \Session::flash('err_msg','ブログを更新しました');
        return redirect(route('blogs'));
    }

    // 削除
    public function exeDelete($id)
    {
      if(empty($id)) {
        \Session::flash('err_msg','データがありません！');
        return redirect(route('blogs'));
      }


        try {
          // ブログを削除
          Blog::destroy($id);
        } catch(\Throwable $e) {
          abort(500);
        }
        \Session::flash('err_msg','ブログを削除しました');
        return redirect(route('blogs'));
    }
}
