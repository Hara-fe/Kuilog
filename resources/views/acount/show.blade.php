@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">アカウント情報</h1>

    <div class="space-y-3 text-gray-700 text-lg">
        <p><span class="font-semibold">ID:</span> {{ $user->id }}</p>
        <p><span class="font-semibold">名前:</span> {{ $user->name }}</p>
        <p><span class="font-semibold">メールアドレス:</span> {{ $user->email }}</p>
        <p><span class="font-semibold">ロール:</span> {{ $user->role }}</p>
        <p><span class="font-semibold">作成日時:</span> {{ $user->created_at->format('Y年m月d日 H:i') }}</p>
        <p><span class="font-semibold">更新日時:</span> {{ $user->updated_at->format('Y年m月d日 H:i') }}</p>
    </div>

    <div class="mt-8 flex space-x-4">
        <a href="{{ route('acount.edit', ['id' => $user->id]) }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            アカウント情報の変更
        </a>
        <a href="{{ route('main.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
            トップページへ戻る
        </a>
    </div>
</div>
@endsection
