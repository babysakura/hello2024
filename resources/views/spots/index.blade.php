@extends('adminlte::page')

@section('title', 'スポット一覧')

@section('content_header')
<h1>スポット一覧</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <form action="{{ route('items.index') }}" method="get">
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            @if (isset($items) && $items->isNotEmpty())
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
                    <!-- $itemsが存在し、かつ空でない場合の処理 -->
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
            @else
            <!-- スポットが登録されていない場合のメッセージ表示 -->
            <p>{{ $message }}</p>
            @endif

        </div>
    </div>
</div>


<div class="row">
    <div class="col-12 text-left">
        <a href="{{ url('/') }}" class="btn btn-primary">戻る</a>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop