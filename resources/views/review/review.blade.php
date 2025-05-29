<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>口コミ投稿</title>
</head>
<body>
    <form action="{{ route('/review/complete')}}" method="POST">
        @csrf
    <label for="review">評価</label>
    <input type="number" name="review" id="review" min="0" max="5" step="0.1" required>
    <label for="comment">コメント</label>
    <input type="textarea" name="comment" id="comment" required>
    <button type="submit">送信</button>
    </form>
</body>
</html>