<?php
require __DIR__ . '/../vendor/autoload.php';
require_once ('../src/service/PostValidation.php');

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


$app->get('/', function ($request, $response, $args) {

    $sql = 'SELECT * FROM posts';
    $stmt = $this->db->query($sql);
    $posts = [];
    while ($row = $stmt->fetch()) {
        $posts[] = $row;
    }
    $data = ['message' => $posts];

    return $this->view->render($response, 'index.php', $data);
});


// 画像アップロード(POSTする時)
$app->post('/board/new', function ($request, $response) {

    $data = $request->getParsedBody();

    $username = $data['username'];
    $title = $data['title'];
    $description = $data['description'];

    // バリデーションチェック
    $postValidation = new \Service\PostValidation();
    $errors = $postValidation->addValidation($title, $description);

    // バリデーションエラーの場合
    if (count($errors) > 0) {

        $sql = 'SELECT * FROM posts';
        $stmt = $this->db->query($sql);
        $posts = [];
        while ($row = $stmt->fetch()) {
            $posts[] = $row;
        }
        $data = ['posts' => $posts,'errors' =>$errors];
        return $this->view->render($response, 'index.php', $data);
    }

    /* @var $request \Slim\Http\Request */
    $files = $request->getUploadedFiles();


    $uploadFile = $files['file'];

    $fileName = $uploadFile->getClientFilename();
    $targetPath = __DIR__ . '/img/' . $fileName;

    $uploadFile->moveTo($targetPath);

    $stmt = $this->db->prepare("INSERT INTO posts (title, description, username, filename) VALUES (:title, :description, :username, :filename)");
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

// Run app
$app->run();
