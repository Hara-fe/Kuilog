<h1>編集画面</h1>
<p>変更内容を入力してください</p>

<form action="{{ route('acount.update',$user)}}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">名前</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" required>
        <label for="email">email</label>
        <input type="text" name="email" id="email" value="{{ $user->email }}" required>
        <label for="password">新しいパスワード（空欄の場合は変更なし）</label>
        <input type="password" name="password" id="password">
        <label for="password_confirmation">パスワード確認</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
    </div>
    <button type="submit">送信</button>
</form>
<form 
    action="{{route('acount.destroy', $user) }}" method="post">
        @csrf
        @method('DELETE')
       <input type="submit" name="delete" value="削除">
</form>