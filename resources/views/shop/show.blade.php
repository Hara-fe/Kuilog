@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="bg-white rounded-xl shadow-md p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4 border-b pb-2">{{ $shop->name }}</h1>

        <div class="mb-6">
            <p class="text-gray-700 text-lg leading-relaxed">{{ $shop->information }}</p>
        </div>

        <div class="mb-4 space-y-2">
            <p>
                <span class="inline-block bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded-full">
                    ジャンル: {{ $shop->category?->type ?? '未分類' }}
                </span>
            </p>
            <p>
                <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">
                    メニュー: {{ $shop->category?->label ?? '未分類' }}
                </span>
            </p>
             @can('admin')
                <a href="{{ route('shop.edit', $shop->id) }}"
                class="inline-block bg-yellow-500 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-yellow-600 transition">
                    編集する
                </a>
            @endcan
        </div>  

        <div class="mt-6 flex items-center justify-between">
    <!-- 口コミ投稿ボタン（左） -->
    <a href="{{ route('review.create', ['shop' => $shop->id]) }}"
       class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
       口コミ投稿
    </a>

    @if($shop->images->isNotEmpty())
        <div class="flex space-x-4 max-w-xl">
            @foreach($shop->images as $image)
                <img src="{{ asset('storage/' . $image->filename) }}" alt="ショップ画像"
                     class="h-32 w-auto object-cover rounded">
            @endforeach
        </div>
    @else
        <p class="text-gray-500">画像は登録されていません。</p>
    @endif
</div>
            
            <h2 class="text-xl font-bold mt-6 mb-2">口コミ</h2>

            @if($shop->reviews->isEmpty())
                <p class="text-gray-600">まだ口コミはありません。</p>
            @else
                @foreach($shop->reviews as $review)
                    <div class="border rounded p-4 mb-4">
                        <p class="text-sm text-gray-700">評価: {{ $review->review }} / 5</p>
                        <p class="text-gray-800">{{ $review->comment }}</p>
                        <p class="text-xs text-gray-500 mt-2">投稿者: {{ $review->user->name ?? '不明' }} / 投稿日: {{ $review->created_at->format('Y-m-d') }}</p>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</div>
@endsection
