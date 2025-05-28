{{-- resources/views/components/app-layout.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>My Cafe App</title>
</head>
<body>
    <header>
        <h1>カフェ管理システム</h1>
        <nav>
            <a href="/dashboard">ダッシュボード</a> |
            <a href="/cafes">カフェ一覧</a>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer>
        <p>&copy; 2025 カフェApp</p>
    </footer>
</body>
</html>
