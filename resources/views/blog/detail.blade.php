@extends('layout')
@section('title', 'ブログ詳細')
@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-2">
      <h2 style="margin-top: 100px;">{{ $blog->title }}</h2>
      <br>
      <!-- <span>作成日：{{ $blog->created_at }}</span>
      <span>更新日：{{ $blog->update_at }}</span> -->
      <p class="content">{!!nl2br(e($blog->content))!!}</p>
      <p><button type="button" class="btn btn-primary" onclick="location.href='/blog/edit/{{ $blog->id }}'">編集</button></p>
       <form method="POST" action="{{ route('delete',$blog->id) }}" onSubmit="return checkDelete()">
      @csrf
      <p><button type="submit" class="btn btn-primary" onclick=>削除</button></p>
      </form>
  </div>

  <div class="col-md-4 col-md-offset-2">
    <div class="member-box">
      <div class="profile">
        <img src="/images/kao.png" alt="" class="one">
      </div>
      <div class="text-area">
        <p>エンジニア（見習い）</p>
        <p>NAME：T.SASAKI</p>
        <p>趣味：温泉・飲み・ラーメン（二郎系にハマり中）</p>
        <p class="left">エンジニアを志して、RubyやPHP,WordPress,web制作等を学習。折角なのでLaravelでブログを作ってみているところ（日々継続中🔥）。プログラミングやグルメなどを中心にブログを投稿してます。</p>
      </div>
    </div>
    <br>
    <div class="">
      <h2>カテゴリー</h2>
      （作成中です🙏）
    </div>
    <br>
    <div class="">
      <h2>アーカイブ</h2>
      （作成中です🙏）
    </div>
  </div>

</div>



@endsection
