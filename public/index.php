<?php
require __DIR__ . '/../vendor/autoload.php';


// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

////////////////////////////////////
// 1.Routingを覚える
///////////////////////////////////
// 固定path “/hello” でページを表示する
$app->get('/hello', function ($request, $response, $args) {
    echo "Hello, World";
});

// pathで引数取る “/books/{id}”
$app->get('/books/{id}', function ($request, $response, $args) {
    // Show book identified by $args['id']
    echo "Book, ID:" . $args['id'];
});

//可変引数 “/date/[year/[month]]”
$app->get('/news[/{year}[/{month}]]', function ($request, $response, $args) {
    // reponds to `/news`, `/news/2016` and `/news/2016/03`

    echo "Book, ID:" . $args['year']. $args['month'];
});

////////////////////////////////////
// 2. GET Requestを扱う
///////////////////////////////////
// 可変引数を画面に表示させる
$app->get('/news_get[/{year}[/{month}]]', function ($request, $response, $args) {
    // reponds to `/news`, `/news/2016` and `/news/2016/03`
    $uri = $request->getUri();
    $queryParams = $request->getQueryParams();

    print_r($args);
    print_r($queryParams);
});

////////////////////////////////////
// 3. POST Requestを扱う
///////////////////////////////////
// DIコンテナを取得
$container = $app->getContainer();

// viewのコンテナを宣言
$container['view'] = new \Slim\Views\PhpRenderer("../templates/");


// 問い合わせ(初期表示)
$app->get('/question/new', function ($request, $response) {
    $response = $this->view->render($response, "question.php");
    return $response;
});

// 問い合わせ(POSTする時)
$app->post('/question/result', function ($request, $response) {
    $data = $request->getParsedBody();

    $response = $this->view->render($response, "question_result.php", ["data" => $data]);

    return $response;
});

////////////////////////////////////
// 4.画像アップロード
///////////////////////////////////
// 画像アップロード(初期表示)
$app->get('/upload/new', function ($request, $response) {
    $response = $this->view->render($response, "upload.php");
    return $response;
});

// 画像アップロード(POSTする時)
$app->post('/upload/result', function ($request, $response) {

    /* @var $request \Slim\Http\Request  */
    $files = $request->getUploadedFiles();
    $uploadFile = $files['file'];
    $fileName = $uploadFile->getClientFilename();
    $targetPath = __DIR__ . '/img/'. $fileName;

    $uploadFile->moveTo($targetPath);

    $response = $this->view->render($response, "upload_result.php", ["fileName" => $fileName]);

    return $response;
});

////////////////////////////////////
// 5. Sessionを扱う
///////////////////////////////////
// 問い合わせ(初期表示)
$app->get('/question_session/new', function ($request, $response) {
    $response = $this->view->render($response, "question_session.php");
    return $response;
});

// 問い合わせ(POSTする時)
$app->post('/question_session/result', function ($request, $response) {
    $data = $request->getParsedBody();
    $_SESSION['name'] = $data['name'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['description'] = $data['description'];

    $response = $this->view->render($response, "question_session_result.php");

    return $response;
});

////////////////////////////////////
// 6. Twigでテンプレートを効率的に書く
///////////////////////////////////
// Register component on container
$container['view'] = function ($container) {
//    $view = new \Slim\Views\Twig('../templates', []);
//
//    // Instantiate and add Slim specific extension
//    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
//    var_dump($basePath);
//    die;
//    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
//
//    return $view;

    $view = new \Slim\Views\Twig('../templates', []);
//    // Add extensions
//    $extensions = $settings['view']['extension'];
//    foreach ($extensions as $extension_class) {
//        $view->addExtension(new $extension_class);
//    }
    return $view;
};

$app->get('/twig/{name}', function ($request, $response, $args) {

    return $this->view->render($response, 'profile.html', [
        'name' => $args['name']
    ]);

})->setName('profile');

// Run app
$app->run();
