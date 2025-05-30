@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-6 bg-white shadow rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">アカウント編集</h1>
    <p class="text-gray-600 mb-6">変更内容を入力してください</p>

    <form action="{{ route('acount.update', ['id' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">名前</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">新しいパスワード（空欄の場合は変更なし）</label>
            <input type="password" name="password" id="password"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <div class="text-right">
            <button type="submit"
                    class="bg-blue-500 text-white font-semibold px-6 py-2 rounded hover:bg-blue-600 transition">
                更新する
            </button>
        </div>
    </form>
</div>
@endsection
