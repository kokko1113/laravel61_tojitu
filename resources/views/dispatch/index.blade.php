@extends('app')
@section('title')
    派遣一覧
@endsection
@section('content')
    <a href="{{route("dispatch_create")}}"><button>新規登録</button></a>
    <a href="{{route("dash")}}"><button>戻る</button></a>

    <table border="1">
        <tr>
            <th>イベント名</th>
            <th>人材の氏名</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($dispatchs as $dispatch)
            <tr>
                <th>{{$dispatch->event->name}}</th>
                <th>{{$dispatch->worker->name}}</th>
                <th><a href="{{route("dispatch_index")}}"><button>編集</button></a></th>
                <th>
                    <form action="{{route("dispatch_destroy",$dispatch->id)}}" method="post">
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