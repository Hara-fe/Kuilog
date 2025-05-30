@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">編集画面</h1>
    <p class="text-gray-600 mb-6">変更内容を入力してください</p>

    <form action="{{ route('admin.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-semibold text-gray-700">名前</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" required
                   class="w-full border border-gray-300 p-2 rounded">
        </div>

        <div>
            <label for="email" class="block font-semibold text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" required
                   class="w-full border border-gray-300 p-2 rounded">
        </div>

        <div>
            <label for="password" class="block font-semibold text-gray-700">新しいパスワード（空欄で変更なし）</label>
            <input type="password" name="password" id="password"
                   class="w-full border border-gray-300 p-2 rounded">
        </div>

        <div>
            <label for="role" class="block font-semibold text-gray-700">ロール</label>
            <select name="role" id="role" required
                    class="w-full border border-gray-300 p-2 rounded">
                <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>一般</option>
                <option value="5" {{ $user->role == 5 ? 'selected' : '' }}>管理者</option>
            </select>
        </div>

        <div class="flex justify-between mt-6">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                更新
            </button>
        </div>
    </form>

    <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="mt-6">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('本当に削除しますか？')"
                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
            削除
        </button>
    </form>
</div>
@endsection
