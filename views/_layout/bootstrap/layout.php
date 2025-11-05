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
    <?php if (element('meta_description', $layout)) { ?>
        <meta name="description" content="<?php echo html_escape(element('meta_description', $layout)); ?>"><?php } ?>
    <?php if (element('meta_keywords', $layout)) { ?>
        <meta name="keywords" content="<?php echo html_escape(element('meta_keywords', $layout)); ?>"><?php } ?>
    <?php if (element('meta_author', $layout)) { ?>
        <meta name="author" content="<?php echo html_escape(element('meta_author', $layout)); ?>"><?php } ?>
    <?php if (element('favicon', $layout)) { ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo element('favicon', $layout); ?>" /><?php } ?>
    <?php if (element('canonical', $view)) { ?>
        <link rel="canonical" href="<?php echo element('canonical', $view); ?>" /><?php } ?>

    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

    <?php $version = date("YmdHis", time()); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/style.css?<?php echo $version; ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/main.css?<?php echo $version; ?>"/>


    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400..700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

    <?php echo $this->managelayout->display_css(); ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


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
        var cb_board_url = <?php echo (isset($view) && element('board_key', $view)) ? 'cb_url + "/' . config_item('uri_segment_board') . '/' . element('board_key', $view) . '"' : '""'; ?>;
        var cb_document = "<?php echo isset($view) ? element('doc_key', $view) : ''; ?>";
        var cb_document_url = <?php echo (isset($view) && element('doc_key', $view)) ? 'cb_url + "/' . config_item('uri_segment_document') . '/' . element('doc_key', $view) . '"' : '""'; ?>;
        var cb_device_type = "<?php echo $this->cbconfig->get_device_type() === 'mobile' ? 'mobile' : 'desktop' ?>";
        var cb_csrf_hash = "<?php echo $this->security->get_csrf_hash(); ?>";
        var cookie_prefix = "<?php echo config_item('cookie_prefix'); ?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/common.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.extension.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/sideview.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/js.cookie.js'); ?>"></script>
    <?php echo $this->managelayout->display_js(); ?>
</head>
<body <?php echo isset($view) ? element('body_script', $view) : ''; ?>>

<?php
if (element('doc_key', $view)) {
    $sub = 'subpage subpage-' . element('doc_key', $view);
} else if (element('board_key', $view)) {
    $sub = 'subpage subpage-' . element('board_key', $view);
} else if ($this->uri->segment(1) === 'login') {
    $sub = 'subpage subpage-login';
} else if ($this->uri->segment(1) === 'register') {
    $sub = 'subpage subpage-register';
} else if ($this->uri->segment(1) === 'mypage') {
    $sub = 'subpage subpage-mypage';
} else if ($this->uri->segment(1) === 'membermodify') {
    $sub = 'subpage subpage-membermodify';
} else if ($this->uri->segment(1) === 'camp') {
    $sub = 'subpage subpage-camp';
} else {
    $sub = 'mainpage';
}
?>


<div class="wrapper">

    <header class="header <?php echo $sub; ?>" style="background:url('../assets/images/2026_winter/main_0<?php echo rand(1, 9); ?>.jpg') center center/cover ">
        <div class="back-drop opacity-50" style="background: linear-gradient(to left, #000, #000); position: absolute; left: 0; width: 100%;top: 0; height: 530px;"></div>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <h1>
                    <a href="<?php echo site_url(); ?>" class="navbar-brand"
                       title="<?php echo html_escape($this->cbconfig->item('site_title')); ?>">
                        <img src="/views/main/bootstrap/images/logo.png">
                        <?php // echo $this->cbconfig->item('site_logo'); ?>
                    </a>
                </h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-button"><i class="bi bi-list"></i></span>
                </button>


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
                    <button class="btn-login dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="bi bi-person"></i>
                    </button>
                    <ul class="dropdown-menu">

                        <?php if ($this->member->is_admin() === 'super') { ?>
                            <li>
                                <a href="<?php echo site_url(config_item('uri_segment_admin')); ?>" title="관리자 페이지로 이동"><i
                                            class="bi bi-gear"></i> 관리자</a>
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
                            <li><i class="bi bi-user"></i><a href="<?php echo site_url('mypage'); ?>" title="마이페이지"><i
                                            class="bi bi-person-vcard"></i> 마이페이지</a></li>
                            <li><i class="bi bi-sign-out"></i><a
                                        href="<?php echo site_url('login/logout?url=' . urlencode(current_full_url())); ?>"
                                        title="로그아웃"><i class="bi bi-box-arrow-right"></i> 로그아웃</a></li>
                        <?php } else { ?>
                            <li><a href="<?php echo site_url('login?url=' . urlencode(current_full_url())); ?>"
                                   title="로그인"><i class="bi bi-box-arrow-in-right"></i> 로그인</a></li>
                            <li><a href="<?php echo site_url('register'); ?>" title="회원가입"><i
                                            class="bi bi-person-plus"></i> 회원가입</a></li>
                            <li><a href="<?php echo site_url('findaccount'); ?>" title="회원가입"><i
                                            class="bi bi-person-check"></i> 아이디/비번 찾기</a></li>
                        <?php } ?>
                    </ul>
                </div>

            </div>
        </nav>
    </header>




    <div class="main <?php echo $sub; ?>">

        <?php if (isset($yield)) echo $yield; ?>
    </div>
    <footer class="footer-wrap <?php echo $sub; ?>">
        <div class="wrap-1600">
            <div class="logo-area">
                <img src="/views/main/bootstrap/images/footer_logo.png">
            </div>
            <div class="ft-sns-area">
                <ul>
                    <li><a href="https://www.facebook.com/ppwinjesus/?locale=ko_KR" target="_blank"> <img
                                    src="/views/main/bootstrap/images/icon_facebook.png" title="어캠페이스북 바로가기"></a></li>
                    <li>
                        <a href="https://www.youtube.com/@%EB%8B%A4%EC%9D%8C%EC%84%B8%EB%8C%80%EB%B6%80%ED%9D%A5%EB%B3%B8%EB%B6%80/featured"
                           target="_blank"> <img src="/views/main/bootstrap/images/icon_youtube.png" title="어캠유튜브 바로가기"></a>
                    </li>
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
                    <span>주소<strong>서울시 동작구 상도로398</strong></span>
                    <span>고유번호<strong>613-82-79901</strong></span>
                    <span>다부본 대표회장<strong>신상범</strong></span>
                    <br>
                    <span>공동회장<strong>길성권 김학중 신재국 강헌식 이호진</strong></span>
                    <span>키즈처치리바이벌 공동대표<strong>박연훈 탁명옥</strong></span><br>
                    <span>평신도 대표<strong> 전기형</strong></span>
                    <span>후원이사장 <strong> 박명복 </strong></span>
                    <span>후원이사  <strong> 조원미 이영미 </strong></span>
                    <br>
                </p>

                <p class="copy">copyright 어캠 all rights reserved.</p>
            </div>
        </div>
    </footer>


    <div class="conlab-widget"></div>
    <script src="https://conlab.visitkorea.or.kr/api/widget/dist/widget.js?1&conlabkey=b16773ed-3d1e-4fe3-b4db-76cecc0f598a&kakaomapkey=3ccbc3225b866eeb6422a2d52af41baa?1257"></script>
    <script>
        ConlabWidget.init({
            title: '한국관광공사 힐링여행지', // 위젯의 제목
            imgurl: 'https://cgi.co.kr/assets/images/conlab.png', // 위젯의 아이콘
            introurl: 'https://conlab.visitkorea.or.kr/api/widget/dist/conlab_intro.png', // 메인에 표시되는 소개 이미지
            category: '',
            lang: 'ko',
            defaultkeyword: '', // 설정 시 검색됨
            introThemes: true,
            viewMode: 'drawer',
            themeId: '584c82e5-2e3e-4aab-8e2d-a323985423ac' // 기본 테마 ID
        });
    </script>
    <style>
        .conlab-widget-button {
            bottom: 120px;
            width: 80px !important;
            height: 100px !important;
            right: 30px !important;
        }

    </style>


    <div class="floating-menu">
        <ul>
            <li class="fast-booking">
                <i class="bi bi-calendar2-week"></i>빠른예약
            </li>
        </ul>
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="resultToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">알림</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                감사합니다. 신청이 완료되었습니다.
            </div>
        </div>
    </div>


    <div class="modal fade" id="reserveModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">캠프 예약하기</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reserveForm">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                               value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                        <input type="hidden" name="refkey" id="refkey">
                        <input type="hidden" name="wr_id" value="<?php echo $this->member->item('mem_userid'); ?>">

                        <div class="form-floating mb-3">
                            <select class="form-select" id="campSelect" aria-label="Floating label select example"
                                    name="camp_id">
                                <option value="">캠프를 불러오는 중...</option>
                            </select>
                            <label for="campSelect">캠프 선택</label>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="church_nm" placeholder="교회명"
                                           name="church_nm" value="<?php echo $this->member->item('mem_church'); ?>">
                                    <label for="church_nm">교회명</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="kyodan" placeholder="교단" name="kyodan">
                                    <label for="kyodan">교단</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="damim_nm" placeholder="담임목사명"
                                           name="damim_nm">
                                    <label for="damim_nm">담임목사명</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="resp_nm" placeholder="담당자"
                                           name="resp_nm" value="<?php echo $this->member->item('mem_username'); ?>">
                                    <label for="resp_nm">담당자</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="position" aria-label="Floating label select example"
                                            name="position">
                                        <option value="목사">목사</option>
                                        <option value="전도사">전도사</option>
                                        <option value="집사">집사</option>
                                        <option value="교사">교사</option>
                                    </select>
                                    <label for="position">직분</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="이메일" name="email">
                                    <label for="email">이메일</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="mobile" placeholder="010-0000-0000"
                                           name="mobile">
                                    <label for="mobile">휴대폰</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="addr1" placeholder="주소를 간단하게 입력해주세요!"
                                           name="addr1">
                                    <label for="addr1">주소</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="pastor_male" name="pastor_male"
                                           min="0" value="0" placeholder="남자 목회자의 수를 입력하세요!">
                                    <label for="pastor_male">남목회자</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="teacher_male" name="teacher_male"
                                           min="0" value="0" placeholder="남자 교사의 수를 입력하세요!">
                                    <label for="teacher_male">남교사</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="student_male" name="student_male"
                                           min="0" value="0" placeholder="남학생의 수를 입력하세요!">
                                    <label for="student_male">남학생</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="pastor_female" name="pastor_female"
                                           min="0" value="0" placeholder="여자 목회자의 수를 입력하세요!">
                                    <label for="pastor_female">여목회자</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="teacher_female" name="teacher_female"
                                           min="0" value="0" placeholder="여자 교사의 수를 입력하세요!">
                                    <label for="teacher_female">여교사</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="student_female" name="student_female"
                                           min="0" value="0" placeholder="여학생의 수를 입력하세요!">
                                    <label for="student_female">여학생</label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h6>예약 및 환불 안내</h6>
                            <div class="border p-3 mb-3 mt-1"
                                 style="max-height: 200px; overflow-y: auto; background-color: #f8f9fa; font-size: 13px;">
                                <div class="mb-3">
                                    <strong>○ 예약금 환불 불가합니다.</strong><br>
                                    - 가등록하기 위해 참가인원 수만큼 입금한 예약금은 차수 변동이 아닌 캠프 취소는 환불이 불가합니다.<br>
                                    - 대신, 다음 회차에 사용할 수 있도록 예치금 증서를 발급해 드립니다.
                                </div>

                                <div class="mb-3">
                                    <strong>○ 완납금은 남은 기간에 따라 환불금이 달라집니다.</strong><br>
                                    - 캠프 개최일 1주 전(7일)까지 환불요청할 시 전액환불 (참가인원의 10% 이내)<br>
                                    - 캠프 개최일 하루 전까지 50%가 환불 가능하며, 당일 환불은 불가합니다.
                                </div>

                                <div class="mb-3">
                                    <strong>○ 저작권 동의 안내</strong><br>
                                    캠프 중 본부에서 촬영된 유튜브 영상과 사진에 대한 저작권 동의안내<br>
                                    어캠 진행 중 본부에서 촬영한 사진과 동영상이 어캠 전단과 관련 행사 전단지와 유튜브 영상으로 사용될 수 있습니다. 전단 표지로 선정된 아이는 캠프
                                    참가시 무료입니다.<br>
                                    <어캠> 자체가 모 캠프처럼 사업적인 캠프가 아니고 무너져 가는 교회학교의 새로운 부흥을 위한 선교적인 차원이므로 저작권을 키즈처치리바이벌에
                                        일임해 주시길 바랍니다.<br>
                                        개인적 용도로 유출하거나 사용하지 않습니다. 상업적으로 사용하지 않습니다.
                                </div>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agreeTerms" name="agreeTerms">
                                <label class="form-check-label" for="agreeTerms">
                                    <strong>위 내용을 모두 확인하였으며 동의합니다.</strong>
                                </label>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnSubmit" disabled>예약하기</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                </div>
            </div>
        </div>
    </div>

</div>


<script type="text/javascript">
    $(document).on('click', '.viewpcversion', function () {
        Cookies.set('device_view_type', 'desktop', {expires: 1});
    });
    $(document).on('click', '.viewmobileversion', function () {
        Cookies.set('device_view_type', 'mobile', {expires: 1});
    });
    $(document).mouseup(function (e) {
        var noticontainer = $('.notifications-menu');
        if (!noticontainer.is(e.target) && noticontainer.has(e.target).length === 0) noticontainer.hide();
    });

    $(document).ready(function () {
        $(".datepicker").datepicker("option", "dateFormat", 'yy-mm-dd');
        $(window).scroll(function () {
            var header = $('.header .navbar');
            if ($(window).scrollTop() >= 300) {
                header.addClass('scroll-header');
            } else {
                header.removeClass('scroll-header');
            }
        });

        // 캠프 목록 로드 함수
        function loadCampList() {
            // console.log('loadCampList function called');
            // console.log('AJAX URL:', cb_url + '/camp/get_camp_list');

            $.ajax({
                url: cb_url + '/camp/get_camp_list',
                type: 'GET',
                dataType: 'json',
                cache: false,
                beforeSend: function () {
                    // console.log('AJAX request starting...');
                    $('#campSelect').html('<option value="">캠프를 불러오는 중...</option>');
                },
                success: function (response) {
                    // console.log('AJAX success response:', response);

                    if (response.success && response.data) {
                        // console.log('Processing camp data, count:', response.data.length);

                        var options = '<option value="">캠프를 선택하세요</option>';

                        $.each(response.data, function (index, camp) {
                            // console.log('Processing camp:', camp);
                            var displayText = camp.ch_num + ' - ' + camp.ch_place;
                            if (camp.ch_start && camp.ch_end) {
                                displayText += ' (' + camp.ch_start + ' ~ ' + camp.ch_end + ') - ' + number_format(camp.ch_pay) + '원';
                            }
                            options += '<option value="' + camp.idx + '">' + displayText + '</option>';
                        });

                        console.log('Generated options HTML:', options);
                        $('#campSelect').html(options);

                        // 빠른예약에서 선택된 캠프가 있으면 해당 캠프 선택
                        if (window.selectedCampId) {
                            $('#campSelect').val(window.selectedCampId);
                            $('#refkey').val(window.selectedCampId);
                            // console.log('Pre-selected camp ID:', window.selectedCampId);
                            // 사용 후 초기화
                            window.selectedCampId = null;
                        } else if (response.data.length > 0) {
                            // 빠른예약이 아닌 경우 첫 번째 캠프 선택
                            $('#campSelect option:eq(1)').prop('selected', true);
                            $('#refkey').val($('#campSelect').val());
                            // console.log('Auto-selected first camp ID:', $('#campSelect').val());
                        }
                    } else {
                        console.log('No camp data or success=false:', response);
                        $('#campSelect').html('<option value="">진행중인 캠프가 없습니다</option>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error - Status:', status);
                    console.error('AJAX error - Error:', error);
                    console.error('AJAX error - Response:', xhr.responseText);
                    console.error('AJAX error - Status Code:', xhr.status);
                    $('#campSelect').html('<option value="">캠프 목록을 불러올 수 없습니다</option>');
                },
                complete: function () {
                    console.log('AJAX request completed');
                }
            });
        }

        // 페이지 로드시 캠프 목록 불러오기
        // loadCampList();

        // 모달이 열릴 때마다 캠프 목록 새로고침
        $('#reserveModal').on('show.bs.modal', function () {
            loadCampList();
        });

        // 플로팅 메뉴의 빠른예약 클릭 이벤트
        $('.floating-menu .fast-booking').click(function (e) {
            e.preventDefault();

            // 회원인지 확인
            if (is_member !== '1') {
                alert('회원가입 후 이용 부탁드립니다.');
                window.location.href = 'https://cgi.co.kr/register';
            } else {
                // 전역 변수 초기화 (플로팅 메뉴는 특정 캠프 선택 아님)
                window.selectedCampId = null;
                // 모달 표시
                $('#reserveModal').modal('show');
            }
        });

        // 캠프 선택 변경 시 refkey도 같이 업데이트
        $('#campSelect').change(function () {
            $('#refkey').val($(this).val());
        });

        // 동의 체크박스 상태에 따른 예약하기 버튼 활성화/비활성화
        $('#agreeTerms').change(function () {
            if ($(this).is(':checked')) {
                $('#btnSubmit').prop('disabled', false);
            } else {
                $('#btnSubmit').prop('disabled', true);
            }
        });

        // 예약하기 버튼 클릭 이벤트
        $('#btnSubmit').click(function (e) {
            e.preventDefault();

            // 동의 체크박스 확인
            if (!$('#agreeTerms').is(':checked')) {
                alert('약관에 동의해주세요.');
                return false;
            }

            // 필수값 체크
            var required = {
                'church_nm': '교회명',
                'resp_nm': '담당자명',
                'mobile': '휴대폰번호'
            };

            for (var field in required) {
                if (!$('#' + field).val()) {
                    alert(required[field] + '을(를) 입력해주세요.');
                    $('#' + field).focus();
                    return false;
                }
            }

            // Ajax 요청
            $.ajax({
                url: cb_url + '/camp/apply',
                type: 'POST',
                data: {
                    csrf_test_name: cb_csrf_hash,
                    refkey: $('#campSelect').val(),
                    wr_id: $('input[name="wr_id"]').val(),
                    camp_id: $('#campSelect').val(),
                    church_nm: $('#church_nm').val(),
                    kyodan: $('#kyodan').val(),
                    damim_nm: $('#damim_nm').val(),
                    resp_nm: $('#resp_nm').val(),
                    position: $('#position').val(),
                    email: $('#email').val(),
                    mobile: $('#mobile').val(),
                    addr1: $('#addr1').val(),
                    pastor_male: $('#pastor_male').val(),
                    teacher_male: $('#teacher_male').val(),
                    student_male: $('#student_male').val(),
                    pastor_female: $('#pastor_female').val(),
                    teacher_female: $('#teacher_female').val(),
                    student_female: $('#student_female').val(),
                    agreeTerms: $('#agreeTerms').is(':checked') ? 'Y' : 'N'
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#btnSubmit').prop('disabled', true);
                },
                success: function (response) {
                    if (response.error) {
                        alert(response.message || '오류가 발생했습니다.');
                        return false;
                    }
                    if (response.success) {
                        const toast = new bootstrap.Toast(document.getElementById('resultToast'));
                        toast.show();

                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.status === 403) {
                        alert('로그인이 필요하거나 세션이 만료되었습니다.');
                    } else {
                        console.error('Error:', error);
                        console.error('Status:', status);
                        console.error('Response:', xhr.responseText);
                        alert('서버 오류가 발생했습니다. 관리자에게 문의해주세요.');
                    }
                },
                complete: function () {
                    // 동의 체크박스가 체크되어 있으면 버튼 활성화, 아니면 비활성화
                    if ($('#agreeTerms').is(':checked')) {
                        $('#btnSubmit').prop('disabled', false);
                    } else {
                        $('#btnSubmit').prop('disabled', true);
                    }
                }
            });
        });
    });


    AOS.init();
</script>


<?php echo element('popup', $layout); ?>
<?php echo $this->cbconfig->item('footer_script'); ?>
</body>
</html>