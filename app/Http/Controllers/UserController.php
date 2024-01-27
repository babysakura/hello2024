<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));

        if (Gate::allows('isAdmin')) {
            // ユーザ一覧を表示する処理
            $users = User::all();
            return view('users.index', compact('users'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    // 編集画面
    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'ユーザーが見つかりませんでした');
        }

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        
        // リクエストデータの検証などが必要であればここで行う

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'ユーザーが見つかりませんでした');
        }

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'ユーザーが更新されました');
    }

    // 削除機能
    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'アイテムが見つかりませんでした');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'アイテムが削除されました');
    }
}
