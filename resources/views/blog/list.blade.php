@extends('layout')
@section('title', 'ブログ一覧')
@section('content')
<div class="row">
  <div class="col-md8 col-md-offset-2">
      <h2>ブログ記事一覧</h2>
      @if (session('err_msg'))
      <p class="text-danger">
        {{ session('err_msg') }}
      </p>
      @endif

      <div class="blog-icon">
        @foreach($blogs as $blog)
          <div class="blog-detail">
          <a href="/blog/{{ $blog->id }}">
          <p> <img class="img" src="{{ Storage::url($blog->img) }}" alt="" width="250px" height="200px"></p>
    <p>{{ $blog->title }}</p>
    <p>{{ $blog->updated_at }}</p>
    </a>
  </div>
        @endforeach
      </div>

  </div>


 @include('side')


</div>
<script>
function checkDelete(){
if(window.confirm('削除してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection
