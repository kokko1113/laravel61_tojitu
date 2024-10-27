@extends('app')
@section('title')
    イベント編集画面
@endsection
@section('content')
<form action="{{route("event_update",$event->id)}}" method="post">
    @csrf
    @method("patch")
    name: <input type="text" name="name" value="{{$event->name}}">
    place: <input type="text" name="place" value="{{$event->place}}">
    date: <input type="date" name="event_date" value="{{$event->event_date}}">
    <button>保存</button>
</form>
<a href="{{route("event_index")}}"><button>戻る</button></a>
@if ($errors->any())
    <p style="color: red">{{$errors->first()}}</p>
@endif
@if (session("message"))
    <p style="color: orange">{{session("message")}}</p>
@endif
@endsection