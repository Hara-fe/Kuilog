@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4">店舗情報を編集</h2>

    <form action="{{ route('shop.update', $shop->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">店名</label>
            <input type="text" name="name" value="{{ old('name', $shop->name) }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">説明</label>
            <textarea name="information" class="w-full border px-3 py-2 rounded">{{ old('information', $shop->information) }}</textarea>
        </div>

       <div class="mb-4">
            <label for="active" class="block text-gray-700 font-medium mb-1">公開状態</label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="active" id="active" value="1"
                    class="form-checkbox h-5 w-5 text-blue-600"
                    {{ $shop->active ? 'checked' : '' }}>
                <span>{{ $shop->active ? '公開中' : '非公開' }}</span>
            </label>
        </div>

    <button type="submit"
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">更新する</button>
</form>
@endsection
