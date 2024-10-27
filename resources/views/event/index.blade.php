@extends('app')
@section('title')
    イベント一覧
@endsection
@section('content')
    <a href="{{route("event_create")}}"><button>新規登録</button></a>
    <a href="{{route("dash")}}"><button>戻る</button></a>

    <table border="1">
        <tr>
            <th>イベント名</th>
            <th>開催場所</th>
            <th>開催日時</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($events as $event)
            <tr>
                <th>{{$event->name}}</th>
                <th>{{$event->place}}</th>
                <th>{{$event->event_date}}</th>
                <th><a href="{{route("event_edit",$event->id)}}"><button>編集</button></a></th>
                <th>
                    <form action="{{route("event_destroy",$event->id)}}" method="post">
                        @csrf
                        @method("delete")
                        <button onclick="confirmDelete(event)">削除</button>
                    </form>
                </th>
            </tr>
        @endforeach
    </table>

    <script>
        function confirmDelete(event){
            event.preventDefault()
            if(confirm('削除してよろしいですか？')){
                event.target.closest('form').submit()
            }
        }
    </script>
@endsection