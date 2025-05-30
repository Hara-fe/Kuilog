@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-bold mb-4">店舗検索</h2>

   <form method="GET" action="{{ route('search.index') }}" class="mb-6 space-y-4">
    <select name="area_id" class="w-full border p-2 rounded">
        <option value="">エリアを選択</option>
        @foreach($areas as $area)
            <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                {{ $area->prefecture }}
            </option>
        @endforeach
    </select>

    <select name="category_id" class="w-full border p-2 rounded">
        <option value="">ジャンル・食べ物を選択</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->type }} - {{ $category->label }}
            </option>
        @endforeach
    </select>

    <input type="number" name="rating" placeholder="評価（例：3.5）" step="0.1" min="0" max="5" value="{{ request('rating') }}" class="w-full border p-2 rounded">

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">検索</button>
</form>


    @if($shops->isEmpty())
        <p class="text-gray-600">条件に一致する店舗が見つかりませんでした。</p>
    @else
        @foreach($shops as $shop)
            <div class="border rounded p-4 mb-4">
                <h3 class="text-lg font-bold">{{ $shop->name }}</h3>
                <p>{{ $shop->information }}</p>
                <p class="text-sm text-gray-600">
                    エリア: {{ $shop->area->prefecture ?? '不明' }} /
                    カテゴリー: {{ $shop->category->type ?? '' }} - {{ $shop->category->label ?? '' }} /
                    平均評価: {{ $shop->reviews_avg_review ?? $shop->reviews->avg('review') ?? '未評価' }}
                </p>
                <a href="{{ route('shop.show', $shop->id) }}" class="text-blue-500 underline">詳細を見る</a>
            </div>
        @endforeach
    @endif
</div>
@endsection
