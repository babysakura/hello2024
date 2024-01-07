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
            ->orWhere('type', 'like', "%$search%");
        }
        $items = $query->get();
        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

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

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'アイテムが更新されました');
    }

    // 削除機能
    public function delete($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('items.index')->with('error', 'アイテムが見つかりませんでした');
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'アイテムが削除されました');
    }
}
