<html>
<head>
    <title>問い合わせフォーム</title>
</head>
<body>
<h1>問い合わせありがとうございます</h1>
<p>以下の内容で問い合わせを受け付けました</p>

<table border="1">
    <tr>
        <th>
            名前
        </th>
        <th>
            メールアドレス
        </th>
        <th>
            問い合わせ内容
        </th>
    </tr>
    <tr>
        <td>
            <?=$data['name'] ?>
        </td>
        <td>
            <?=$data['email'] ?>
        </td>
        <td>
            <?=$data['description'] ?>
        </td>
    </tr>
</table>
</body>
</html>


