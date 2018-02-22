<html>
<head>
    <title>問い合わせフォーム(セッション確認)</title>
</head>
<body>
<h1>問い合わせありがとうございます(セッション確認)</h1>
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
            <?=$_SESSION['name'] ?>
        </td>
        <td>
            <?=$_SESSION['email'] ?>
        </td>
        <td>
            <?=$_SESSION['description'] ?>
        </td>
    </tr>
</table>

<?php var_dump($_SESSION) ?>

</body>
</html>


