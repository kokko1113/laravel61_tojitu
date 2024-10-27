@extends('app')
@section('title')
    人材登録画面
@endsection
@section('content')
    <form action="{{route("dispatch_store")}}" method="post">
        @csrf
        event_name: 
        <select name="event_name">
            @foreach ($events as $event)
                <option value="{{$event->name}}">{{$event->name}}</option>
            @endforeach
        </select>
        worker_name: 
        <select name="worker_name[]" multiple>
            @foreach ($workers as $worker)
                <option value="{{$worker->name}}">{{$worker->name}}</option>
            @endforeach
        </select>
        memo: <input type="text" name="memo">
        <button>登録</button>
    </form>
    <a href="{{route("dispatch_index")}}"><button>戻る</button></a>
    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
    @if (session("message"))
        <p style="color: orange">{{session("message")}}</p>
    @endif
@endsection