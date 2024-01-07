@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
<h1>ユーザー編集</h1>
@stop

@section('content')
<div class="container">

    <form action="{{ route('users.update', $user->id) }}" method="post">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="name">名前</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection