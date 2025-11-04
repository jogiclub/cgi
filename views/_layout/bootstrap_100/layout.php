
</head>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if ($this->cbconfig->get_device_view_type() === 'desktop' && $this->cbconfig->get_device_type() === 'mobile') { ?>
<meta name="viewport" content="width=1000">
<?php } else { ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php } ?>
<title><?php echo html_escape(element('page_title', $layout)); ?></title>
<?php if (element('meta_description', $layout)) { ?><meta name="description" content="<?php echo html_escape(element('meta_description', $layout)); ?>"><?php } ?>
<?php if (element('meta_keywords', $layout)) { ?><meta name="keywords" content="<?php echo html_escape(element('meta_keywords', $layout)); ?>"><?php } ?>
<?php if (element('meta_author', $layout)) { ?><meta name="author" content="<?php echo html_escape(element('meta_author', $layout)); ?>"><?php } ?>
<?php if (element('favicon', $layout)) { ?><link rel="shortcut icon" type="image/x-icon" href="<?php echo element('favicon', $layout); ?>" /><?php } ?>
<?php if (element('canonical', $view)) { ?><link rel="canonical" href="<?php echo element('canonical', $view); ?>" /><?php } ?>

<link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
<!--<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" />-->
<!--<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />-->
<?php $version = date("YmdHis", time()); ?>
<link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/style.css?<?php echo $version; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/main.css?<?php echo $version; ?>" />
<!--<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/earlyaccess/nanumgothic.css" />-->

<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400..700&display=swap" rel="stylesheet">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!--<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css" />-->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>



<?php echo $this->managelayout->display_css(); ?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>



<!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
<!--<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<script type="text/javascript">
// 자바스크립트에서 사용하는 전역변수 선언
var cb_url = "<?php echo trim(site_url(), '/'); ?>";
var cb_cookie_domain = "<?php echo config_item('cookie_domain'); ?>";
var cb_charset = "<?php echo config_item('charset'); ?>";
var cb_time_ymd = "<?php echo cdate('Y-m-d'); ?>";
var cb_time_ymdhis = "<?php echo cdate('Y-m-d H:i:s'); ?>";
var layout_skin_path = "<?php echo element('layout_skin_path', $layout); ?>";
var view_skin_path = "<?php echo element('view_skin_path', $layout); ?>";
var is_member = "<?php echo $this->member->is_member() ? '1' : ''; ?>";
var is_admin = "<?php echo $this->member->is_admin(); ?>";
var cb_admin_url = <?php echo $this->member->is_admin() === 'super' ? 'cb_url + "/' . config_item('uri_segment_admin') . '"' : '""'; ?>;
var cb_board = "<?php echo isset($view) ? element('board_key', $view) : ''; ?>";
var cb_board_url = <?php echo ( isset($view) && element('board_key', $view)) ? 'cb_url + "/' . config_item('uri_segment_board') . '/' . element('board_key', $view) . '"' : '""'; ?>;
var cb_document = "<?php echo isset($view) ? element('doc_key', $view) : ''; ?>";
var cb_document_url = <?php echo ( isset($view) && element('doc_key', $view)) ? 'cb_url + "/' . config_item('uri_segment_document') . '/' . element('doc_key', $view) . '"' : '""'; ?>;
var cb_device_type = "<?php echo $this->cbconfig->get_device_type() === 'mobile' ? 'mobile' : 'desktop' ?>";
var cb_csrf_hash = "<?php echo $this->security->get_csrf_hash(); ?>";
var cookie_prefix = "<?php echo config_item('cookie_prefix'); ?>";
</script>
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo base_url('assets/js/html5shiv.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/respond.min.js'); ?>"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo base_url('assets/js/common.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.extension.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/sideview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/js.cookie.js'); ?>"></script>
<?php echo $this->managelayout->display_js(); ?>
</head>
<body <?php echo isset($view) ? element('body_script', $view) : ''; ?>>

<?php if( element('view_skin_path', $layout) !== 'main/bootstrap' ){
    if(element('doc_key', $view)) {
        $sub = 'subpage subpage-' . element('doc_key', $view);
    } else if(element('board_key', $view)){
        $sub = 'subpage subpage-' . element('board_key', $view);
    } else {
        $sub = 'subpage';
    }
}
?>


<div class="wrapper">
    <header class="header <?php echo $sub; ?>">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <h1>
                    <a href="<?php echo site_url(); ?>" class="navbar-brand" title="<?php echo html_escape($this->cbconfig->item('site_title')); ?>">
                        <img src="/views/main/bootstrap/images/logo.png">
                        <? php// echo $this->cbconfig->item('site_logo'); ?>
                    </a>
                </h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse position-relative" id="topmenu-navbar-collapse">
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
                    <div class="btn-login-wrapper">
                        <button class="btn-login dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i>
                        </button>
                        <ul class="dropdown-menu">

                                <?php if ($this->member->is_admin() === 'super') { ?>
                            <li>
                                <a href="<?php echo site_url(config_item('uri_segment_admin')); ?>" title="관리자 페이지로 이동"><i class="bi bi-gear"></i> 관리자</a>
                            </li>
                                <?php } ?>

                            <?php
                                if ($this->member->is_member()) {
                                if ($this->cbconfig->item('use_notification')) { ?>
                                    <li>
                                        <i class="bi bi-bell"></i> 알림
                                        <span class="badge notification_num"><?php echo number_format((int)element('notification_num', $layout)); ?></span>
                                        <div class="notifications-menu"></div>
                                    </li>
                                <?php } ?>
                            <li><i class="bi bi-user"></i><a href="<?php echo site_url('mypage'); ?>" title="마이페이지"><i class="bi bi-person-vcard"></i> 마이페이지</a></li>
                            <li><i class="bi bi-sign-out"></i><a href="<?php echo site_url('login/logout?url=' . urlencode(current_full_url())); ?>" title="로그아웃"><i class="bi bi-box-arrow-right"></i> 로그아웃</a></li>
                        <?php } else { ?>
                            <li><a href="<?php echo site_url('login?url=' . urlencode(current_full_url())); ?>" title="로그인"><i class="bi bi-box-arrow-in-right"></i> 로그인</a></li>
                            <li><a href="<?php echo site_url('register'); ?>" title="회원가입"><i class="bi bi-person-plus"></i> 회원가입</a></li>
                        <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>



	<!-- main start -->
	<div class="main <?php echo $sub; ?>">




				<!-- 본문 시작 -->
				<?php if (isset($yield))echo $yield; ?>
				<!-- 본문 끝 -->



	</div>
	<!-- main end -->


    <footer class="footer-wrap <?php echo $sub; ?>">
        <div class="wrap-1600">
            <div class="logo-area">
                <img src="/views/main/bootstrap/images/footer_logo.png">
            </div>
            <div class="ft-sns-area">
                <ul>
                    <li><a href="https://www.facebook.com/ppwinjesus/?locale=ko_KR" target="_blank"> <img src="/views/main/bootstrap/images/icon_facebook.png" title="어캠페이스북 바로가기"></a></li>
                    <li><a href="https://www.youtube.com/@%EB%8B%A4%EC%9D%8C%EC%84%B8%EB%8C%80%EB%B6%80%ED%9D%A5%EB%B3%B8%EB%B6%80/featured" target="_blank"> <img src="/views/main/bootstrap/images/icon_youtube.png" title="어캠유튜브 바로가기"></a></li>
                </ul>
            </div>
            <div class="ft-customer">
                <div class="tel-box">
                    <span>상담안내</span>
                    <strong>02.815.5291</strong>
                </div>
                <div class="time-notice">
                    <p>평일 (월 ~ 금) <strong>AM 09:00 ~ PM 06:00</strong></p>
                    <p>주말 (토 ~ 일) <strong>AM 10:00 ~ PM 03:00</strong></p>
                </div>
                <div class="cell-box">
                    <span>그 외 시간은 문자 주세요.</span>
                    <strong>010.9090.7750</strong>
                </div>
            </div>

            <div class="ft-list">
                <ul>
                    <li><a href="">개인정보처리방침</a></li>
                    <li><a href="">이메일무단수집거부</a></li>
                    <li><a href="">이용약관</a></li>
                </ul>

                <p>
                    <span>
                        주소
                        <strong>서울시 동작구 상도로398</strong>
                    </span>
                    <span>
                        고유번호
                        <strong>613-82-79901</strong>
                    </span>
                    <span>
                        다부본 대표회장
                        <strong>신상범</strong>
                    </span>
                    <br>
                    <span>
                        공동회장
                        <strong>길성권 김학중 신재국 강헌식 이호진</strong>
                    </span>
                    <span>
                        키즈처치리바이벌 공동대표
                        <strong>박연훈 탁명옥 평신도 대표 전기형</strong>
                    </span>
                    <br>
                </p>

                <p class="copy">copyright 어캠 all rights reserved.</p>
            </div>
        </div>
    </footer>


</div>



<script type="text/javascript">
$(document).on('click', '.viewpcversion', function(){
	Cookies.set('device_view_type', 'desktop', { expires: 1 });
});
$(document).on('click', '.viewmobileversion', function(){
	Cookies.set('device_view_type', 'mobile', { expires: 1 });
});
$(document).mouseup(function (e) {
    var noticontainer = $('.notifications-menu');
    if (!noticontainer.is(e.target) && noticontainer.has(e.target).length === 0) noticontainer.hide();
});




$(document).ready(function() {

    $(".datepicker").datepicker("option", "dateFormat", 'yy-mm-dd');


    $(window).scroll(function() {
        var header = $('.header');

        if ($(window).scrollTop() >= 300) {
            header.addClass('scroll-header');
        } else {
            header.removeClass('scroll-header');
        }
    });








});



AOS.init();


</script>
<?php echo element('popup', $layout); ?>
<?php echo $this->cbconfig->item('footer_script'); ?>
<!--
Layout Directory : <?php echo element('layout_skin_path', $layout); ?>,
Layout URL : <?php echo element('layout_skin_url', $layout); ?>,
Skin Directory : <?php echo element('view_skin_path', $layout); ?>,
Skin URL : /view