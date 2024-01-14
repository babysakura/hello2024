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
                <div class="input-group mb-3">
                    <input type="text" class="form-control" type="search" placeholder="フリーワード検索" name="search"
                        aria-label="検索" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">検索</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="mb-2">
    <!-- ここに何件表示されているかを表示する行を追加 -->
    <span style="font-weight: bold;">全{{ $items->count() }}件</span>
</div>
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
@stop

@section('css')
<style>
    /* 追加のCSSスタイルが必要な場合はここに記述できます */
</style>
@stop

@section('js')
@stop