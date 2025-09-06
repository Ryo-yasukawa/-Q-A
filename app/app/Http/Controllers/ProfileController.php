<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // 画像アップロードフォーム表示
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // 画像保存処理
    public function update(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048', // 画像必須・最大2MB
        ]);

        $user = Auth::user();

        // ファイル名をオリジナル名で保存
        $file = $request->file('file');
        $file_name = time().'_'.$file->getClientOriginalName(); // 重複回避に time() を付与
        $file->storeAs('public', $file_name);

        // DB更新
        $user->update(['image_path' => '/storage/'.$file_name]);

        return redirect()->route('profile.edit')->with('status', 'プロフィール画像を更新しました');
    }
}
