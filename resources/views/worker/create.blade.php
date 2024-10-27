@extends('app')
@section('title')
    人材登録画面
@endsection
@section('content')
    <form action="{{route("worker_store")}}" method="post">
        @csrf
        name: <input type="text" name="name">
        email: <input type="text" name="email">
        password: <input type="text" name="password">
        memo: <input type="text" name="memo">
        <button>登録</button>
    </form>
    <a href="{{route("worker_index")}}"><button>戻る</button></a>
    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
    @if (session("message"))
        <p style="color: orange">{{session("message")}}</p>
    @endif
@endsection