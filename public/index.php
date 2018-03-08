<?php
require __DIR__ . '/../vendor/autoload.php';
require_once('../src/service/PostValidation.php');

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);
$container = $app->getContainer();

// viewのコンテナを宣言
$container['view'] = new \Slim\Views\PhpRenderer("../templates/");

// dbのコンテナを宣言
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'] . ";port=" . $settings['port'],
        $settings['user'], $settings['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

// 投稿一覧表示
$app->get('/', function ($request, $response, $args) {

    // ログインチェック
    checkLogin();

    $sql = 'SELECT * FROM posts';
    $stmt = $this->db->query($sql);
    $posts = [];
    while ($row = $stmt->fetch()) {
        $posts[] = $row;
    }
    $data = ['posts' => $posts];

    return $this->view->render($response, 'index.php', $data);
});

// ログイン
$app->get('/login', function ($request, $response, $args) {

    return $this->view->render($response, 'login.php');
});

// ログイン
$app->post('/login', function ($request, $response, $args) {

    $data = $request->getParsedBody();

    $email = $data['email'];
    $password = $data['password'];

    $stmt = $this->db->prepare('SELECT username,email, password
                FROM users
                WHERE  email= :email');

    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    try {
        $stmt->execute();
        $user = $stmt->fetch();

    } catch (PDOException $e) {

        exit('登録失敗' . $e->getMessage());
    }

    // ハッシュ化されたパスワードがマッチするかどうかを確認
    if (password_verify($password, $user['password'])) {
        $_SESSION['user']['username'] = $user['username'];
        header('Location: /');
        exit();

    } else {
        $errors[] = 'パスワードが違います';
        $data = ['errors' => $errors];
        return $this->view->render($response, 'login.php', $data);
    }
});

// ログアウト
$app->get('/logout', function ($request, $response, $args) {

    session_destroy();
    unset($_SESSION['user']);
    header("Location: /login");
    exit;
});

// ユーザ登録
$app->get('/user/new', function ($request, $response, $args) {
    return $this->view->render($response, 'user_new.php');
});

// ユーザ登録
$app->post('/user/new', function ($request, $response, $args) {

    $data = $request->getParsedBody();

    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];

    $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $password = password_hash($password, PASSWORD_DEFAULT);

    $stmt->bindParam(':password', $password, PDO::PARAM_STR);

    try {
        $stmt->execute();

    } catch (PDOException $e) {

        exit('登録失敗' . $e->getMessage());
    }

    header('Location: /login');
    exit();
});

// ユーザ表示
$app->get('/article/show/{id}', function ($request, $response, $args) {

    checkLogin();

    $stmt = $this->db->prepare("SELECT * FROM posts WHERE id=:id");

    $stmt->execute(['id' => $args['id']]);
    $post = $stmt->fetch();

    $data = ['post' => $post];

    return $this->view->render($response, 'show.php', $data);
});


// 記事投稿
$app->post('/article/new', function ($request, $response) {

    checkLogin();

    $data = $request->getParsedBody();

    $username = $data['username'];
    $title = $data['title'];
    $description = $data['description'];

    /* @var $request \Slim\Http\Request */
    $files = $request->getUploadedFiles();
    $uploadFile = $files['file'];
    $fileName = $uploadFile->getClientFilename();

    // バリデーションチェック
    $postValidation = new \Service\PostValidation();
    $errors = $postValidation->addValidation($title, $description, $fileName);

    // バリデーションエラーの場合
    if (count($errors) > 0) {

        $sql = 'SELECT * FROM posts';
        $stmt = $this->db->query($sql);
        $posts = [];
        while ($row = $stmt->fetch()) {
            $posts[] = $row;
        }
        $data = ['posts' => $posts, 'errors' => $errors];
        return $this->view->render($response, 'index.php', $data);
    }


    $targetPath = __DIR__ . '/img/' . $fileName;

    $uploadFile->moveTo($targetPath);

    $stmt = $this->db->prepare("
    INSERT INTO posts (title, description, username, filename) 
      VALUES 
    (:title, :description, :username, :filename)"
    );

    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->bindValue(':username', $username, PDO::PARAM_INT);
    $stmt->bindValue(':filename', $fileName, PDO::PARAM_STR);

    try {
        $stmt->execute();

    } catch (PDOException $e) {

        exit('登録失敗' . $e->getMessage());
    }

    header('Location: /');
    exit();
});

/**
 *　ログインのチェックを行う
 */
function checkLogin()
{
    if (!isset($_SESSION['user'])) {
        header("Location: /login");
        exit;
    }
}

// Run app
$app->run();
