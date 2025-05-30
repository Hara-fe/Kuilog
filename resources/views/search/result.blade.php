@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">検索結果</h2>

    @forelse($shops as $shop)
        <div class="border rounded p-4 mb-4">
            <h3 class="text-lg font-bold">{{ $shop->name }}</h3>
            <p>{{ $shop->information }}</p>
            <p>平均評価: {{ round($shop->reviews_avg_review, 1) }}</p>
            <p>カテゴリー: {{ $shop->category?->type }} / {{ $shop->category?->label }}</p>
            <a href="{{ route('shop.show', $shop->id) }}" class="text-blue-500 underline">詳細へ</a>
        </div>
    @empty
        <p>該当する店舗が見つかりませんでした。</p>
    @endforelse
</div>
@endsection
