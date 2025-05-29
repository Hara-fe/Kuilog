<h1>aアカウント情報</h1>

<p>ID:{{$user ->id}}</p>
<p>名前:{{$user ->name}}</p>
<p>email:{{$user ->email}}</p>
<p>role:{{$user ->role}}</p>
<p>作成日時:{{$user ->created_at}}</p>
<p>更新日時:{{$user ->created_at}}</p>

<a href="{{ route('acount.edit', ['acount' => $user->id]) }}">アカウント情報の変更</a>
<a href="{{route('main.index')">トップページへ戻る</a>