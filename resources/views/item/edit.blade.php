@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
<h1 class="text-center font-weight-bold">スポット編集</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('items.update', $item->id) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('put')

                <div class="card card-primary">
                    {{--<!-- <form method="POST"> -->--}}
                    @csrf
                    <div class="card-body">
                    {{$item->image}}
                        <div class="form-group">
                            <label for="image">画像</label>
                            <input type="file" name="image">
                        </div>

                        <div class="form-group">
                            <label for="name">名称</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
                        </div>

                        <div class="form-group">
                            <label for="prefecture_id">都道府県</label>
                            <input type="text" class="form-control" id="prefecture_id" name="prefecture_id" value="{{ $item->prefecture_id }}">
                        </div>

                        <div class="form-group">
                            <label for="city">市区町村</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $item->city }}">
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
                            <label for="address">住所</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $item->address }}">
                        </div>

                        <div class="form-group">
                            <label for="tel">TEL</label>
                            <input type="text" class="form-control" id="tel" name="tel" value="{{ $item->tel }}">
                        </div>

                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="url" class="form-control" id="url" name="url" value="{{ $item->url }}">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" value="{{ $item->detail }}">
                        </div>

                        <button type="submit" class="btn btn-primary">更新</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">削除</button>
            </form>
        </div>
        <!-- 削除モーダル -->
        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">削除の確認</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        本当に削除してもよろしいですか？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                        <form action="{{ route('items.delete', $item->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection