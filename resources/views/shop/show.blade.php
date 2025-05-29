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
        </div>

        <div class="mt-6">
            <a href="{{ route('review.create', ['shop' => $shop->id]) }}"
            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
            口コミ投稿
            </a>

        </div>
    </div>
</div>
@endsection
