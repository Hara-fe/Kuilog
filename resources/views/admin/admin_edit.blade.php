<h1>編集画面</h1>
<p>変更内容を入力してください</p>

<form action="{{ route('admin.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">名前</label>
    <input type="text" name="name" value="{{ $user->name }}" required>
    <label for="email">Email</label>
    <input type="email" name="email" value="{{ $user->email }}" required>
    <label for="password">新しいパスワード（空欄で変更なし）</label>
    <input type="password" name="password">
    <label for="password_confirmation">パスワード確認</label>
    <label for="role">ロール</label>
    <select name="role" id="role" required>
        <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>一般</option>
        <option value="5" {{ $user->role == 5 ? 'selected' : '' }}>管理者</option>
    </select>

    <input type="password" name="password_confirmation">
    <button type="submit">更新</button>
</form>

<form action="{{ route('admin.destroy', $user->id) }}" method="POST" style="margin-top: 20px;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
</form>
