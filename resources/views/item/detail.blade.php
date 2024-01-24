<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="search.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">スポット詳細</h1>
    <div class="container">
        <div class="row align-items-start">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img class="w-100" src="data:image/png;base64,{{ $item->image }}" alt="">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body d-flex justify-content-between align-items-start">
                            <div>
                                <h1 class="m-4">{{ $item->name }}</h1>
                                <h4 class="m-4 my-1"> {{ $item->detail }}</h4>
                                <h6 class="m-4 my-3">住所　　 {{ $item->address }}</h6>
                                <h6 class="m-4 my-3">TEL　　 {{ $item->tel }}</h6>
                                <h6 class="m-4 my-3">URL　　 {{ $item->url }}</h6>
                                <p class="m-4">{{ $item->product_detail }}</p>
                            </div>

                            <form action="{{ route('toggle-favorite', $item->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    @if($item->isFavoritedBy(auth()->user()->id))
                                    お気に入り解除
                                    @else
                                    お気に入りに追加
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="/items" class="btn btn-outline-primary mr-1">戻る</a>
        <td class="text-right">
            @if(auth()->user()->isAdmin == 1)
            <a href="{{ url('items/edit/'.$item->id) }}" class="btn btn-outline-secondary">このスポットを編集</a>
            @endif
        </td>
    </div>
</body>

</html>