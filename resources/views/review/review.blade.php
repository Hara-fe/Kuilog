@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">「{{ $shop->name }}」への口コミを投稿</h2>

    <form method="POST" action="{{ route('review.store') }}">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">

        <div class="mb-4">
            <label for="review" class="block text-gray-700">評価（0.0～5.0）</label>
            <input type="number" name="review" id="review" step="0.1" min="0" max="5"
                class="w-full border p-2 rounded" required>
        </div>


        <div class="mb-4">
            <label for="comment" class="block text-gray-700">コメント</label>
            <textarea name="comment" id="comment" rows="4" class="w-full border p-2 rounded"></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            投稿する
        </button>
    </form>
</div>
@endsection
