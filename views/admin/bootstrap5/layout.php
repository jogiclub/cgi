<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CIBoard Admin</title>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
<link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/datepicker3.css'); ?>" />
<?php $version = date("YmdHis", time()); ?>
<link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/style.css?<?php echo $version; ?>" />
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<?php if (element('favicon', $layout)) { ?><link rel="shortcut icon" type="image/x-icon" href="<?php echo element('favicon', $layout); ?>" /><?php } ?>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.kr.js'); ?>"></script>



<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.extension.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/common.js'); ?>"></script>

<script type="text/javascript">
// 자바스크립트에서 사용하는 전역변수 선언
var cb_url = "<?php echo trim(site_url(), '/'); ?>";
var cb_admin_url = "<?php echo admin_url(); ?>";
var cb_charset = "<?php echo config_item('charset'); ?>";
var cb_time_ymd = "<?php echo cdate('Y-m-d'); ?>";
var cb_time_ymdhis = "<?php echo cdate('Y-m-d H:i:s'); ?>";
var admin_skin_path = "<?php echo element('layout_skin_path', $layout); ?>";
var admin_skin_url = "<?php echo element('layout_skin_url', $layout); ?>";
var is_member = "<?php echo $this->member->is_member() ? '1' : ''; ?>";
var is_admin = "<?php echo $this->member->is_admin(); ?>";
var cb_admin_url = <?php echo $this->member->is_admin() === 'super' ? 'cb_url + "/' . config_item('uri_segment_admin') . '"' : '""'; ?>;
var cb_board = "";
var cb_csrf_hash = "<?php echo $this->security->get_csrf_hash(); ?>";
var cookie_prefix = "<?php echo config_item('cookie_prefix'); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/sideview.js'); ?>"></script>
</head>
<body>
<!-- start wrapper -->
<div class="wrapper">
	<!-- start nav -->
	<nav class="nav-default">
		<h1 class="nav-header"><a href="<?php echo admin_url(); ?>"><?php echo $this->cbconfig->item('admin_logo'); ?></a></h1>
        <div class="accordion" id="accordionNav">

                <?php
                foreach (element('admin_page_menu', $layout) as $__akey => $__aval) {
                ?>
                <div class="accordion-item">
                        <div class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo $__akey; ?>">
                                <i class="bi <?php echo element(1, element('__config', $__aval)); ?>"></i> <?php echo element(0, element('__config', $__aval)); ?>
                            </button>

                        </div>

                        <div id="collapse_<?php echo $__akey; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionNav">
                            <div class="accordion-body">
                                <?php
                                foreach (element('menu', $__aval) as $menukey => $menuvalue) {
                                    if (element(2, $menuvalue) === 'hide') {
                                        continue;
                                    }
                                    ?>
                                    <div <?php echo (element('menu_dir1', $layout) === $__akey && element('menu_dir2', $layout) === $menukey) ? 'class="active"' : ''; ?>>
                                        <a href="<?php echo admin_url($__akey . '/' . $menukey); ?>" <?php echo element(1, $menuvalue); ?> ><?php echo element(0, $menuvalue); ?></a>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

		</div>




	</nav>


	<!-- start content_wrapper -->
	<div class="content_wrapper">
		<!-- start header -->
		<div class="row header">
			<div class="navbar-minimalize"><a href="#" class="btn btn-primary btn-mini"><i class="bi bi-list"></i></a></div>
			<script type="text/javascript">
			//<![CDATA[
			$(document).on('click', '.navbar-minimalize>a', function() {
				if ($('.nav-default').is(':visible') === true) {
					$('.nav-default').hide();
					$('.content_wrapper').css('margin-left', '0px');
				} else {
					$('.nav-default').show();
					$('.content_wrapper').css('margin-left', '220px');
				}
			});
			//]]>
			</script>
			<ul class="nav-top">
				<li><a href="<?php echo site_url(); ?>" target="_blank">홈페이지로 이동</a></li>
				<li><a href="<?php echo site_url('login/logout'); ?>"><i class="bi bi-box-arrow-right"></i> Log out</a></li>
			</ul>
		</div>
		<!-- end header -->
		<div class="contents">
			<?php echo element('menu_title', $layout) ? '<h3>' . element('menu_title', $layout) . '</h3>' : ''; ?>

			<!-- 여기까지 레이아웃 상단입니다 -->

			<?php echo $yield; ?>

			<!-- 여기부터 레이아웃 하단입니다 -->

		</div>
	</div>
	<!-- end content_wrapper -->
</div>
<!-- end wrapper -->
<footer class="footer">
	Powered by <a href="<?php echo config_item('ciboard_website'); ?>" target="_blank">CIBoard</a>,
	Your Version <?php echo CB_VERSION; ?>,
    Latest Version <?php echo element('latest_version_name', element('version_latest', $layout)); ?> <a href="<?php echo element('latest_download_url', element('version_latest', $layout)); ?>" target="_blank"><i class="bi bi-0-square"></i></a>
	<span class="btn_top"><a href="#">Top <i class="bi bi-arrow-up-square"></i></a></span>
</footer>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$(function() {
		$('#fsearch').validate({
			rules: {
				skeyword: { required:true, minlength:2}
			}
		});
	});
});
//]]>
</script>
</body>
</html>
