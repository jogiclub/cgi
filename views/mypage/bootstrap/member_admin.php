<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<h3>관리자회원</h3>
<div class="mypage">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('mypage'); ?>" title="마이페이지">마이페이지</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('mypage/mycamp'); ?>" title="나의 작성글">나의 예약</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('mypage/post'); ?>" title="나의 작성글">나의 작성글</a></li>
        <?php if ($this->cbconfig->item('use_point')) { ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('mypage/point'); ?>" title="포인트">포인트</a></li>
        <?php } ?>
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('membermodify'); ?>" title="정보수정">정보수정</a></li>
        <li class="nav-item"><a class="nav-link active" href="<?php echo site_url('membermodify/memberleave'); ?>" title="탈퇴하기">탈퇴하기</a></li>
        <!--
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('mypage/scrap'); ?>" title="나의 스크랩">스크랩</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('mypage/followinglist'); ?>" title="팔로우">팔로우</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('mypage/like_post'); ?>" title="내가 추천한 글">추천</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('mypage/loginlog'); ?>" title="나의 로그인기록">로그인기록</a></li>-->
    </ul>
	<div class="page-header">
		<h4>관리자회원</h4>
	</div>
	<div class="alert alert-dismissible alert-info infoalert">
		<span id="return_message">
		관리자회원정보는 관리자페이지에서만 수정이 가능합니다.
		</span>
	</div>
</div>
