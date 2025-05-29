@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    <h2 class="text-xl font-bold mb-6">新しい店舗を登録</h2>

    <form method="POST" action="{{ route('main.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">店名</label>
            <input type="text" name="name" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">情報</label>
            <textarea name="information" class="w-full border p-2" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">カテゴリID</label>
            <input type="number" name="category_id" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">エリアID</label>
            <input type="number" name="area_id" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">所在地</label>
            <input type="text" name="local" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">公開設定（on_off）</label>
            <select name="on_off" class="w-full border p-2" required>
                <option value="1">公開</option>
                <option value="0">非公開</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">アクティブ（営業状態）</label>
            <select name="active" class="w-full border p-2" required>
                <option value="1">営業中</option>
                <option value="0">閉店中</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">画像（任意）</label>
            <input type="file" name="filename" class="w-full border">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">登録</button>
    </form>
</div>
@endsection
