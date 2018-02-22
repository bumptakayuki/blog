<html>
<head>
    <title>問い合わせフォーム</title>
</head>
<body>
<h1>問い合わせフォーム</h1>

<form class="pure-form" method="post" action="/question_session/result">
    <label for="name">名前</label>
    <input name="name" id="name" type="text" size="60" /><br />

    <label for="email">メールアドレス</label>
    <input name="email" id="email" type="email" size="60" /><br />

    <label for="description">問い合わせ内容</label>
    <textarea name="description" id="description" rows="6" cols="80"></textarea><br />

    <input type="submit" class="pure-button" value="送信" />
</form>

</body>
</html>


