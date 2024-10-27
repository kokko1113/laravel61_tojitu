@extends('app')
@section('title')
    人材一覧
@endsection
@section('content')
    <a href="{{route("worker_create")}}"><button>新規登録</button></a>
    <a href="{{route("dash")}}"><button>戻る</button></a>

    <table border="1">
        <tr>
            <th>指名</th>
            <th>メールアドレス</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($workers as $worker)
            <tr>
                <th>{{$worker->name}}</th>
                <th>{{$worker->email}}</th>
                <th><a href="{{route("worker_index")}}"><button>編集</button></a></th>
                <th>
                    <form action="{{route("worker_destroy",$worker->id)}}" method="post">
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