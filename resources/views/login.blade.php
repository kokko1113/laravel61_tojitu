@extends('app')
@section('title')
    ログイン画面
@endsection
@section('content')
    <form action="{{route("check")}}" method="POST">
        @csrf
        ID: <input type="text" name="email">
        password: <input type="text" name="password">
        <button>送信</button>
    </form>

    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
@endsection