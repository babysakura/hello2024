@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
<h1>商品編集</h1>
@stop

@section('content')
<div class="container">
    <h1>アイテム編集</h1>

    <form action="{{ route('items.update', $item->id) }}" method="post">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="name">名前</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
        </div>

        <div class="form-group">
            <label for="type">種別</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ $item->type }}">
        </div>

        <div class="form-group">
            <label for="detail">詳細</label>
            <input type="text" class="form-control" id="detail" name="detail" value="{{ $item->detail }}">
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection