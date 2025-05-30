@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">ユーザー一覧</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full text-sm text-gray-800">
            <thead class="bg-gray-100 text-gray-700 font-semibold">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">名前</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Role</th>
                    <th class="px-4 py-2 border">作成日時</th>
                    <th class="px-4 py-2 border">更新日時</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border text-center">{{ $user->id }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('admin.edit', $user->id) }}" class="text-blue-600 hover:underline">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td class="px-4 py-2 border">{{ $user->email }}</td>
                    <td class="px-4 py-2 border text-center">{{ $user->role == 5 ? '管理者' : '一般' }}</td>
                   <td class="px-4 py-2 border">
                        {{ $user->created_at ? $user->created_at->format('Y-m-d H:i') : '未登録' }}
                    </td>
                    <td class="px-4 py-2 border">
                        {{ $user->updated_at ? $user->updated_at->format('Y-m-d H:i') : '未更新' }}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center mt-6">
        <a href="{{ route('main.index') }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">
            トップページへ戻る
        </a>
    </div>
</div>
@endsection
