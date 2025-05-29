<h1>ユーザー一覧</h1>

<table border=1>
    <tr>
        <th>ID</th>
        <th>名前</th>
        <th>Email</th>
        <th>Role</th>
        <th>作成日時</th>
        <th>更新日時</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td><a href="{{ route('admin.edit', $user->id) }}">{{ $user->name }}</a></td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role }}</td>
        <td>{{ $user->created_at }}</td>
        <td>{{ $user->updated_at }}</td>
    </tr>
    @endforeach
</table>

<a href="{{ route('main.index') }}">トップページへ戻る</a>
