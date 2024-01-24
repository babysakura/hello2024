@extends('layouts.app')

@section('content')
    <h1>お気に入りリスト</h1>

    @if($items->isEmpty())
        <p>お気に入りがありません。</p>
    @else
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>名称</th>
                                <th>都道府県</th>
                                <th>市区町村</th>
                                <th>カテゴリ</th>
                                <th>登録日</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->prefecture_id }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->signup_at }}</td>
                                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td class="text-right">
                                        <a href="{{ url('items/detail/'.$item->id) }}" class="btn btn-secondary">詳細</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection