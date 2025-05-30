@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">喰いログへようこそ</h1>

    <form method="GET" action="{{ route('main.index') }}" class="flex justify-center mb-4">
        <input type="text" name="keyword" placeholder="店名で検索" value="{{ request('keyword') }}"
               class="w-2/3 md:w-1/2 p-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring focus:border-blue-300">
        <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-r-lg hover:bg-orange-600">
            検索
        </button>
    </form>
<div class="text-center mt-6">
    <a href="{{ route('search.index') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
        店舗を検索する
    </a>
</div>

        @can('admin')
        <div class="flex justify-end mb-6">
            <a href="{{ route('main.create') }}"
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                店舗登録へ
            </a>
        </div>
        @endcan

        @auth
        <div class="flex justify-end mb-6">
            <a href="{{ route('acount.edit', ['id' => Auth::id()]) }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    アカウント編集
            </a>
        </div>
        @endauth

        @can('admin')
        <div class="flex justify-end mb-6">
            <a href="{{ route('admin.index') }}"
            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                管理者画面へ
            </a>
        </div>
        @endcan


    @if ($shops->count() === 0)
        <p class="text-center text-gray-500">該当する店舗が見つかりませんでした。</p>
    @endif

    <div class="space-y-6">
        @foreach($shops as $shop)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <a href="{{ route('shop.show', $shop->id) }}" class="text-xl font-semibold text-blue-600 hover:underline">
                    {{ $shop->name }}
                </a>

                {{-- 画像差し込み --}}
        @if($shop->images->isNotEmpty())
            <img src="{{ asset('storage/' . $shop->images->first()->filename) }}" alt="店舗画像" class="mt-4 w-16 h-16 object-cover rounded">
        @else
            <div class="mt-4 w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-sm">
                画像なし
            </div>
        @endif
                <p class="text-gray-700 mt-2">{{ $shop->information }}</p>
                <p class="mt-4">
                    <span class="inline-block bg-gray-200 text-sm text-gray-800 px-3 py-1 rounded-full">
                        ジャンル: {{ $shop->category?->type ?? '未分類' }}
                    </span>
                </p>
                <p class="text-sm text-gray-600">エリア: {{ $shop->area?->prefecture ?? '未登録' }}</p>

            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $shops->links() }}
    </div>
</div>
@endsection
