
@extends('adminlte::page')

@section('title', 'スポット登録')

@section('content_header')
<h1>スポット登録</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card card-primary">
            <form method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">名称</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="名前">
                    </div>

                    <div class="form-group">
                        <label for="prefecture_id">都道府県</label>
                        <input type="text" class="form-control" id="prefecture_id" name="prefecture_id"
                            placeholder="都道府県">
                    </div>

                    <div class="form-group">
                        <label for="city">市区町村</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="市区町村">
                    </div>

                    <div class="form-group">
                        <label for="address">住所</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="住所">
                    </div>

                    <div class="form-group">
                        <label for="tel">TEL</label>
                        <input type="text" class="form-control" id="tel" name="tel" placeholder="TEL">
                    </div>

                    <div class="form-group">
                        <label for="type">カテゴリ</label>
                        <select class="form-control" id="type" name="type">
                            @foreach(config('categories.categories') as $category)
                            <option value="{{$category}}">{{$category}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="URL">
                    </div>

                    <div class="form-group">
                        <label for="detail">詳細</label>
                        <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop