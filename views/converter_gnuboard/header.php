<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>그누보드 - 씨아이보드 컨버터</title>
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css" />
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
<link href="<?php echo base_url(VIEW_DIR . 'converter_gnuboard/css/common.css'); ?>" rel="stylesheet" type="text/css">
<link href="//fonts.googleapis.com/earlyaccess/nanumgothic.css">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<!-- start javascript -->
<!-- end javascript -->
<div class="wrapper">
	<!-- header start -->
	<div class="header">
		<h1>Converter</h1>
		<span class="version">그누보드 -&gt; 씨아이보드</span>
	</div>
	<!-- header end -->
    <!-- main start -->
    <div class="main">
    	<ul class="menu">
    		<li <?php echo ($converter_step == 1)?'class="active"':'';?>>기본환경체크</li>
    		<li <?php echo ($converter_step == 2)?'class="active"':'';?>>회원테이블이전</li>
    		<li <?php echo ($converter_step == 3)?'class="active"':'';?>>게시판테이블이전</li>
    	</ul>
