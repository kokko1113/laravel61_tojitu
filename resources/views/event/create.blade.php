@extends('app')
@section('title')
    イベント登録画面
@endsection
@section('content')
    <form action="{{route("event_store")}}" method="post">
        @csrf
        name: <input type="text" name="name">
        place: <input type="text" name="place">
        date: <input type="date" name="event_date">
        <button>登録</button>
    </form>
    <a href="{{route("event_index")}}"><button>戻る</button></a>
    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
    @if (session("message"))
        <p style="color: orange">{{session("message")}}</p>
    @endif
@endsection