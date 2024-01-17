<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index(Request $request)
    {
        // 商品一覧取得
        $search = $request->input('search');
        $query = Item::query();

        if ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('type', 'like', "%$search%")
                ->orWhere('prefecture_id', 'like', "%$search%");
        }
        $items = $query->paginate(10);
        // dd($items);
        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function spots(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);
            $data = [
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'prefecture_id' => $request->prefecture_id,
                'city' => $request->city,
                'type' => $request->type,
                'detail' => $request->detail,
                'address' => $request->address,
                'url' => $request->url,
                'tel' => $request->tel,
            ];
            // 画像取得
            $image_path = '';
            if ($request->hasFile('image')) {
                $image_path    = $request->file('image')->store('image', 'public');
                $data['image'] = $image_path;
            }

            // スポット登録
            Item::create($data);

            return redirect('/items');
        }

        return view('item.add');
    }


    // 編集画面
    public function edit($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('items.index')->with('error', 'アイテムが見つかりませんでした');
        }

        return view('item.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        // リクエストデータの検証などが必要であればここで行う

        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('items.index')->with('error', 'アイテムが見つかりませんでした');
        }
        $data = [
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'prefecture_id' => $request->prefecture_id,
            'city' => $request->city,
            'type' => $request->type,
            'detail' => $request->detail,
            'address' => $request->address,
            'url' => $request->url,
            'tel' => $request->tel,
            'image'=>$item->image,
        ];
        // 画像取得
        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path    = $request->file('image')->store('image', 'public');
            $data['image'] = $image_path;
        }

        // $item->update($request->all());
                $item->update($data);

        return redirect()->route('items.index')->with('success', 'アイテムが更新されました');
    }

    // 削除機能
    public function delete($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('items.edit')->with('error', 'アイテムが見つかりませんでした');
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'アイテムが削除されました');
    }

    /**
     * 詳細画面の表示
     */
    public function detail($id)
    {
        $item = Item::find($id);
        return view("item.detail", [
            'item' => $item,
        ]);
    }

    public function spot(Request $request)
    {
        $area = $request->input('area');
        // $areaに基づいて特定のエリアのスポットを取得するクエリを構築
        $items = Item::where('prefecture_id', $area)->get();

        if ($items->isEmpty()) {
            // スポットが登録されていない場合の処理
            return view('spots.index', ['message' => 'スポットが登録されていません。']);
        }

        return view('spots.index', ['items' => $items]);
    }
}
