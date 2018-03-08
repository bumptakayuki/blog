<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta charset="utf-8">
    <!-- Description, Keywords and Author -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tech Blog</title>

    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">

    <!-- style -->
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <!-- style -->
    <!-- bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- responsive -->
    <link href="/css/responsive.css" rel="stylesheet" type="text/css">
    <!-- font-awesome -->
    <link href="/css/fonts.css" rel="stylesheet" type="text/css">
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- font-awesome -->
    <link href="/css/effects/normalize.css" rel="stylesheet" type="text/css">
    <link href="/css/effects/component.css" rel="stylesheet" type="text/css">
</head>
<body>


<!-- header -->
<header role="header">
    <div class="container">
        <!-- nav -->
        <nav role="header-nav" class="navy">
            <h1>CODEBASE</h1>
        </nav>
        <span style="float: right"><?= $_SESSION['user']['username']?>さん</span><br>
        <a style="float: right" href="logout">ログアウト</a>
        <!-- nav -->
    </div>
</header>
<!-- header -->

<!-- main -->


<main role="main-inner-wrapper" class="container">
    <div class="row">
        <div class="col-xs-12 ">
            <article role="pge-title-content" class="blog-header">
                <header>
                    <h2><span>Tech Blog</span> 技術情報を投稿しようぜ</h2>
                </header>
            </article>
        </div>
        <div class="contat-from-wrapper">
            <div id="message" style="color: red ;">
                <?php if (count($errors) > 0) { ?>
                    <?php foreach ($errors as $error) { ?>
                        <p class="error-message"><?php echo $error ?></p>
                    <?php } ?>
                <?php } ?>
            </div>

            <form method="post" enctype="multipart/form-data" action="article/new" name="cform" id="cform">
                <div class="row">

                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                        <input name="username" id="username" type="text" placeholder="Whats your name">
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                        <input name="title" id="title" type="text" placeholder="Whats your Title">
                    </div>
                </div>
                <div class="clearfix"></div>
                <textarea name="description" id="description" cols="" rows="" placeholder="description"></textarea>
                <div class="clearfix"></div>

                <div class="clearfix"></div>
                <h3>Image</h3>
                <input type="file" name="file"/>
                <div class="preview" ></div>
                <div class="clearfix"></div>

                <br><br><br><br>
                <input name="" type="submit" value="Submit">
                <div id="simple-msg"></div>
            </form>
        </div>
        <div class="clearfix"></div>
        <br><br><br><br>


        <?php foreach ($posts as $post): ?>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                <ul class="grid-lod effect-2" id="grid">
                    <li>
                        <section class="blog-content">
                            <a href="article/show/<?= $post['id'] ?>">
                                <figure>
                                    <div class="post-date">

                                        <span style="font-size: 18px"><?= date_format(new DateTime($post['created_at']), 'd/m');?></span>
                                        <span style="font-size: 18px"><?= date_format(new DateTime($post['created_at']), 'H:i:s');?></span>
                                    </div>
                                    <img src="/img/<?= $post['filename'] ?>" class="img-responsive">
                                </figure>
                            </a>
                            <article>
                                User: <?= htmlspecialchars($post['username'], ENT_QUOTES, 'UTF-8', false) ?><br>
                                Title: <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8', false) ?><br>
                                description: <?= htmlspecialchars($post['description'], ENT_QUOTES, 'UTF-8', false) ?>
                            </article>
                        </section>
                    </li>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<!-- main -->

<!-- footer -->
<footer role="footer">
    <!-- logo -->
    <h1>
Tech
    </h1>
    <!-- logo -->

    <!-- nav -->
    <nav role="footer-nav">
        <ul>
            <li><a href="index.html" title="Work">Work</a></li>
            <li><a href="about.html" title="About">About</a></li>
            <li><a href="blog.html" title="Blog">Blog</a></li>
            <li><a href="contact.html" title="Contact">Contact</a></li>
        </ul>
    </nav>

    <!-- nav -->

    <ul role="social-icons">
        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>
    </ul>
    <p class="copy-right">&copy; 2015 avana LLC.. All rights Resved</p>
</footer>
<!-- footer -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/js/jquery.min.js" type="text/javascript"></script>
<!-- custom -->
<script src="/js/nav.js" type="text/javascript"></script>
<script src="/js/custom.js" type="text/javascript"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/effects/masonry.pkgd.min.js" type="text/javascript"></script>
<script src="/js/effects/imagesloaded.js" type="text/javascript"></script>
<script src="/js/effects/classie.js" type="text/javascript"></script>
<script src="/js/effects/AnimOnScroll.js" type="text/javascript"></script>
<script src="/js/effects/modernizr.custom.js"></script>

<!-- jquery.countdown -->

<script src="/js/html5shiv.js" type="text/javascript"></script>

<script>
    $(function(){
        //画像ファイルプレビュー表示のイベント追加 fileを選択時に発火するイベントを登録
        $('form').on('change', 'input[type="file"]', function(e) {
            var file = e.target.files[0],
                reader = new FileReader(),
                $preview = $(".preview");
            t = this;

            // 画像ファイル以外の場合は何もしない
            if(file.type.indexOf("image") < 0){
                return false;
            }

            // ファイル読み込みが完了した際のイベント登録
            reader.onload = (function(file) {
                return function(e) {
                    //既存のプレビューを削除
                    $preview.empty();
                    // .prevewの領域の中にロードした画像を表示するimageタグを追加
                    $preview.append($('<img>').attr({
                        src: e.target.result,
                        width: "300px",
                        class: "preview",
                        title: file.name
                    }));
                };
            })(file);

            reader.readAsDataURL(file);
        });
    });
    </script>

</body>

</html>