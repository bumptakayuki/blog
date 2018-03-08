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
        <!-- logo -->
        <h1>
            <a href="/">
            CODEBASE
        </h1>
        <!-- logo -->

        <!-- nav -->
        <nav role="header-nav" class="navy">
            <ul>
                <li><a href="index.html" title="Work">Work</a></li>
                <li><a href="about.html" title="About">About</a></li>
                <li class="nav-active"><a href="blog.html" title="Blog">Blog</a></li>
                <li><a href="contact.html" title="Contact">Contact</a></li>
            </ul>
        </nav>
        <!-- nav -->
    </div>
</header>
<!-- header -->

<!-- main -->
<main role="main-inner-wrapper" class="container">
    <div class="blog-details">
        <article class="post-details" id="post-details">
            <header role="bog-header" class="bog-header text-center">
<!--                <h3><span>20</span> July 2016</h3>-->
                <h3><span style="font-size: 25px"><?= date_format(new DateTime($post['created_at']), 'd/m');?></span>
                <?= date_format(new DateTime($post['created_at']), 'H:i:s');?>
                </h3>
                <h2> <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8', false) ?></h2>
            </header>
            <figure>
                <img src="/img/<?= $post['filename'] ?>" class="img-responsive" style="width: 100%">
            </figure>
            <div class="enter-content">
                <p><?= htmlspecialchars($post['description'], ENT_QUOTES, 'UTF-8', false) ?></p>
            </div>
        </article>

        <!-- Comments -->
        <div class="comments-pan">
            <h3>3 Comments</h3>
            <ul class="comments-reply">
                <li>
                    <figure>
                        <img src="/images/blog-images/image-1.jpg" alt="" class="img-responsive"/>
                    </figure>
                    <section>
                        <h4>Anna Greenfield      <a href="#">Reply</a></h4>
                        <div class="date-pan">January 26, 2016</div>
                        あああああああああああ
                    </section>
                    <ol class="reply-pan">
                        <li>
                            <figure>
                                <img src="/images/blog-images/image-2.jpg" alt="" class="img-responsive"/>
                            </figure>
                            <section>
                                <h4>Johnathan Doe  <a href="#">Reply</a></h4>
                                <div class="date-pan">January 26, 2016</div>
                                あああああああああああ
                            </section>
                        </li>
                    </ol>
                </li>
                <li>
                    <figure>
                        <img src="/images/blog-images/image-3.jpg" alt="" class="img-responsive"/>
                    </figure>
                    <section>
                        <h4>Anna Greenfield  <a href="#">Reply</a></h4>
                        <div class="date-pan">January 26, 2016</div>

                        あああああああああああ

                    </section>
                </li>
            </ul>
            <div class="commentys-form">
                <h4>Leave a comment</h4>
                <div class="row">
                    <form action="" method="get">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <input name="" type="text" placeholder="Whats your name *">
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <input name="" type="email" placeholder="Whats your email *">
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <input name="" type="url" placeholder="Runing a Website">
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <textarea name="" cols="" rows="" placeholder="Whats in your mind"></textarea>
                        </div>
                        <div class="text-center">
                            <input name="" type="button" value="Post Comment">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>

<!-- main -->

<!-- footer -->

<footer role="footer">

    <!-- logo -->

    <h1>

        <a href="index.html" title="avana LLC"><img src="images/logo.png" title="avana LLC" alt="avana LLC"/></a>

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

    <p class="copy-right">&copy; 2015  avana LLC.. All rights Resved</p>

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

</body>

</html>