<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>오륜교회 안수집사회</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
    <meta name="author" content="FREEHTML5.CO" />


    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" />

    <!-- Animate.css -->
    <link rel="stylesheet" href="/views/_layout/crew/css/animate.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">






    <!-- Bootstrap  -->
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>


    <?php $version = date("YmdHis", time()); ?>
    <link rel="stylesheet" href="/views/_layout/crew/css/style.css?<?php echo $version; ?>">



    <!-- Modernizr JS -->
    <script src="/views/_layout/crew/js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="/views/_layout/crew/js/respond.min.js"></script>
    <![endif]-->

</head>

<?php if( element('view_skin_path', $layout) !== 'main/crew' ){
    if(element('doc_key', $view)) {
        $sub = 'subpage subpage-' . element('doc_key', $view);
    } else if(element('board_key', $view)){
        $sub = 'subpage subpage-' . element('board_key', $view);
    } else {
        $sub = 'subpage';
    }
}
?>

<body>
<header role="banner" id="fh5co-header" class="<?php echo $sub; ?>">
    <div class="container">
        <!-- <div class="row"> -->
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <!-- Mobile Toggle Menu Button -->
                <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
                <a class="navbar-brand" href="/"><img src="/views/_layout/crew/images/logo.png?1" class="logo-black"><img src="/views/_layout/crew/images/logo_w.png?1" class="logo-white"></a>
            </div>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav navbar-right">
                    <?php
                    $menuhtml = '';
                    if (element('menu', $layout)) {
                        $menu = element('menu', $layout);
                        if (element(0, $menu)) {
                            foreach (element(0, $menu) as $mkey => $mval) {
                                if (element(element('men_id', $mval), $menu)) {
                                    $mlink = element('men_link', $mval) ? element('men_link', $mval) : 'javascript:;';
                                    $menuhtml .= '<li class="dropdown">
                                        <a class="nav-link dropdown-toggle" href="' . $mlink . '" ' . element('men_custom', $mval);
                                    if (element('men_target', $mval)) {
                                        $menuhtml .= ' target="' . element('men_target', $mval) . '"';
                                    }
                                    $menuhtml .= ' title="' . html_escape(element('men_name', $mval)) . '" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . html_escape(element('men_name', $mval)) . '</a>
                                        <ul class="dropdown-menu">';

                                    foreach (element(element('men_id', $mval), $menu) as $skey => $sval) {
                                        $slink = element('men_link', $sval) ? element('men_link', $sval) : 'javascript:;';
                                        $menuhtml .= '<li><a class="dropdown-item" href="' . $slink . '" ' . element('men_custom', $sval);
                                        if (element('men_target', $sval)) {
                                            $menuhtml .= ' target="' . element('men_target', $sval) . '"';
                                        }
                                        $menuhtml .= ' title="' . html_escape(element('men_name', $sval)) . '">' . html_escape(element('men_name', $sval)) . '</a></li>';
                                    }
                                    $menuhtml .= '</ul></li>';

                                } else {
                                    $mlink = element('men_link', $mval) ? element('men_link', $mval) : 'javascript:;';
                                    $menuhtml .= '<li><a href="' . $mlink . '" ' . element('men_custom', $mval);
                                    if (element('men_target', $mval)) {
                                        $menuhtml .= ' target="' . element('men_target', $mval) . '"';
                                    }
                                    $menuhtml .= ' title="' . html_escape(element('men_name', $mval)) . '">' . html_escape(element('men_name', $mval)) . '</a></li>';
                                }
                            }
                        }
                    }
                    echo $menuhtml;
                    ?>
                </ul>
            </div>


            <div class="btn-login-wrapper">
                <button class="btn btn-default dropdown-toggle btn-login" type="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <?php if ($this->member->is_admin() === 'super') { ?>
                        <li>
                            <a href="<?php echo site_url(config_item('uri_segment_admin')); ?>" title="관리자 페이지로 이동"><i class="bi bi-gear"></i> 관리자</a>
                        </li>
                    <?php } ?>

                    <?php
                    if ($this->member->is_member()) {
                         ?>
                        <li><i class="bi bi-user"></i><a href="<?php echo site_url('mypage'); ?>" title="마이페이지"><i class="bi bi-person-vcard"></i> 마이페이지</a></li>
                        <li><i class="bi bi-sign-out"></i><a href="<?php echo site_url('login/logout?url=' . urlencode(current_full_url())); ?>" title="로그아웃"><i class="bi bi-box-arrow-right"></i> 로그아웃</a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo site_url('login?url=' . urlencode(current_full_url())); ?>" title="로그인"><i class="bi bi-box-arrow-in-right"></i> 로그인</a></li>
                        <li><a href="<?php echo site_url('register'); ?>" title="회원가입"><i class="bi bi-person-plus"></i> 회원가입</a></li>
                        <li><a href="<?php echo site_url('findaccount'); ?>" title="회원가입"><i class="bi bi-person-check"></i> 아이디/비번 찾기</a></li>
                    <?php } ?>
                </ul>
            </div>

        </nav>
        <!-- </div> -->
    </div>
</header>



<main class="<?php echo $sub; ?>">

<!-- 본문 시작 -->
<?php if (isset($yield))echo $yield; ?>
<!-- 본문 끝 -->

</main>


<footer id="footer" role="contentinfo" class="<?php echo $sub; ?>">
    <div class="container">
        <div class="row row-bottom-padded-sm">
            <div class="col-md-12">
                <p class="copyright text-center">&copy; 2024 <a href="index.html">오륜교회 안수집사회</a>. All Rights Reserved. <br>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <ul class="social social-circle">
                    <li><a href="#"><i class="bi bi-twitter"></i></a></li>
                    <li><a href="#"><i class="icon-facebook"></i></a></li>
                    <li><a href="#"><i class="icon-youtube"></i></a></li>
                    <li><a href="#"><i class="icon-pinterest"></i></a></li>
                    <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                    <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                    <li><a href="#"><i class="icon-dribbble"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>


<!-- jQuery -->
<script src="/views/_layout/crew/js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="/views/_layout/crew/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!-- Waypoints -->
<script src="/views/_layout/crew/js/jquery.waypoints.min.js"></script>
<!-- Owl Carousel -->
<script src="/views/_layout/crew/js/owl.carousel.min.js"></script>

<!-- For demo purposes only styleswitcher ( You may delete this anytime ) -->
<script src="/views/_layout/crew/js/jquery.style.switcher.js"></script>
<script>
    $(function(){
        $('#colour-variations ul').styleSwitcher({
            defaultThemeId: 'theme-switch',
            hasPreview: false,
            cookie: {
                expires: 30,
                isManagingLoad: true
            }
        });
        $('.option-toggle').click(function() {
            $('#colour-variations').toggleClass('sleep');
        });
    });
</script>
<!-- End demo purposes only -->

<!-- Main JS (Do not remove) -->
<script src="/views/_layout/crew/js/main.js"></script>

</body>
</html>
