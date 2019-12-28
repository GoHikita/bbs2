@extends('layout')

@section('content')


    <div class="container mt-4">
        <div class="border p-4">
        @can('edit', $post)
          <div class="mb-4 text-right">
            <a class="btn btn-primary" href="{{route('posts.edit',['post'=>$post])}}">
              編集する
            </a>
          <form
          style="display: inline-block;"
          method="POST"
          action="{{route('posts.destroy',['post'=>$post])}}"
          >
          @csrf
          @method('DELETE')

          <button class="btn btn-danger">削除する</button>
        </form>
        </div>
       @endcan
            <h1 class="h5 mb-4">
                {{$post->title}}
            </h1>

            <p class="mb-5">
              {!! nl2br(e($post->body))!!}
            </p>

            <section>
              <h2 class="h5 mb-4">
                アドバイス
            　</h2>

            @forelse($post->comments as $comment)
                     <div class="border-top p-4">
                         <time class="text-secondary">
                             {{ $comment->created_at->format('Y.m.d H:i') }}
                         </time>
                         <p class="mt-2">
                             {!! nl2br(e($comment->body)) !!}
                         </p>
                     </div>
                 @empty
                     <p>アドバイスはまだありません。</p>
                 @endforelse
        </section>
        </div>
    </div>

    <form class="form-inline mt-5 mx-auto " style="width: 600px;" method="POST" action="{{ route('comments.store') }}">
        @csrf

        <input
            name="post_id"
            type="hidden"
            value="{{ $post->id }}"
        >

        <div class="form-group p-5" >
          <button type="submit" class="btn btn-primary">
              10文字以内でアドバイスを送る
          </button>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <textarea
                id="body"
                name="body"
                class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                rows="1"
            >{{ old('body') }}</textarea>
            @if ($errors->has('body'))
                <div class="invalid-feedback">
                    {{ $errors->first('body') }}
                </div>
            @endif
        <!--</div>-->

      <!--  <div class="w-auto p-5"> -->

        </div>
    </form>

@endsection
