@extends('app')
@section('title')
    管理画面
@endsection
@section('content')
    <a href="{{route("logout")}}"><button>ログアウト</button></a>
    <a href="{{route("event_index")}}"><button>イベント一覧</button></a>
    <a href="{{route("worker_index")}}"><button>人材一覧</button></a>
    <a href="{{route("dispatch_index")}}"><button>派遣一覧</button></a>
@endsection