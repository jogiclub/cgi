<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<?php	$this->managelayout->add_js(base_url('plugin/zeroclipboard/ZeroClipboard.js')); ?>

<?php
if (element('syntax_highlighter', element('board', $view)) OR element('comment_syntax_highlighter', element('board', $view))) {
	$this->managelayout->add_css(base_url('assets/js/syntaxhighlighter/styles/shCore.css'));
	$this->managelayout->add_css(base_url('assets/js/syntaxhighlighter/styles/shThemeMidnight.css'));
	$this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shCore.js'));
	$this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shBrushJScript.js'));
	$this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shBrushPhp.js'));
	$this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shBrushCss.js'));
	$this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shBrushXml.js'));
?>
	<script type="text/javascript">
	SyntaxHighlighter.config.clipboardSwf = '<?php echo base_url('assets/js/syntaxhighlighter/scripts/clipboard.swf'); ?>';
	var is_SyntaxHighlighter = true;
	SyntaxHighlighter.all();
	</script>
<?php } ?>

<?php echo element('headercontent', element('board', $view)); ?>

<div class="board">
	<?php echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>'); ?>
    <h3 class="mb-3">
		<?php if (element('category', element('post', $view))) { ?>[<?php echo html_escape(element('bca_value', element('category', element('post', $view)))); ?>] <?php } ?>
		<?php echo html_escape(element('post_title', element('post', $view))); ?>
	</h3>
	<ul class="info">
		<li><span class="badge text-bg-secondary">작성자</span> <?php echo element('display_name', element('post', $view)); ?></li>
		<li><span class="badge text-bg-secondary">코멘트</span> <?php echo number_format(element('post_comment_count', element('post', $view))); ?></li>
		<li><span class="badge text-bg-secondary">뷰</span> <?php echo number_format(element('post_hit', element('post', $view))); ?></li>
		<?php if (element('use_post_like', element('board', $view))) { ?>
			<li><li><span class="badge text-bg-secondary">추천</span> <span class="post-like"><?php echo number_format(element('post_like', element('post', $view))); ?></span></li>
		<?php } ?>
		<?php if (element('use_post_dislike', element('board', $view))) { ?>
			<li><li><span class="badge text-bg-secondary">비추천</span> <i class="bi bi-thumbs-down"></i> <span class="post-dislike"><?php echo number_format(element('post_dislike', element('post', $view))); ?></span></li>
		<?php } ?>

		<li class="copy_post_url" data-clipboard-text="<?php echo element('short_url', $view); ?>"><span class="badge text-bg-secondary">글주소</span></li>
		<?php if (element('show_url_qrcode', element('board', $view))) { ?>
			<li class="url-qrcode" data-qrcode-url="<?php echo urlencode(element('short_url', $view)); ?>"><i class="bi bi-qrcode"></i></li>
		<?php } ?>
		<li class=" time"><span class="badge text-bg-secondary">작성일</span> <?php echo element('display_datetime', element('post', $view)); ?></li>
		<?php if (element('display_ip', element('post', $view))) { ?>
			<li class=" time"><span class="badge text-bg-secondary">IP</span> <?php echo element('display_ip', element('post', $view)); ?></li>
		<?php } ?>
		<?php if (element('is_mobile', element('post', $view))) { ?>
			<li class=" time"><i class="bi bi-wifi"></i></li>
		<?php } ?>
	</ul>
	<?php if (element('link_count', $view) > 0 OR element('file_download_count', $view) > 0) { ?>
		<ul class="list-group">
			<?php if (element('file_download_count', $view) > 0) { ?>
				<li class="list-group-item list-group-item-info">Download</li>
					<?php	foreach (element('file_download', $view) as $key => $value) { ?>
						<li class="list-group-item"><i class="bi bi-download"></i> <a href="javascript:file_download('<?php echo element('download_link', $value); ?>')"><?php echo html_escape(element('pfi_originname', $value)); ?>(<?php echo byte_format(element('pfi_filesize', $value)); ?>)</a> <span class="time"><i class="bi bi-clock-o"></i> <?php echo display_datetime(element('pfi_datetime', $value), 'full'); ?></span><span class="badge"><?php echo number_format(element('pfi_download', $value)); ?></span></li>
			<?php
				}
			}
			if (element('link_count', $view) > 0) { ?>
				<li class="list-group-item list-group-item-info">Link</li>
			<?php
			foreach (element('link', $view) as $key => $value) {
			?>
				<li class="list-group-item"><i class="bi bi-link"></i> <a href="<?php echo element('link_link', $value); ?>" target="_blank"><?php echo html_escape(element('pln_url', $value)); ?></a><span class="badge"><?php echo number_format(element('pln_hit', $value)); ?></span>
					<?php if (element('show_url_qrcode', element('board', $view))) { ?>
						<span class="url-qrcode" data-qrcode-url="<?php echo urlencode(element('pln_url', $value)); ?>"><i class="bi bi-qrcode"></i></span>
					<?php } ?>
				</li>
			<?php
					}
				}
			?>
		</ul>
	<?php
	}
	?>
	<script type="text/javascript">
	//<![CDATA[
	function file_download(link) {
		<?php if (element('point_filedownload', element('board', $view)) < 0) { ?>if ( ! confirm("파일을 다운로드 하시면 포인트가 차감(<?php echo number_format(element('point_filedownload', element('board', $view))); ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?")) { return; }<?php }?>
		document.location.href = link;
	}
	//]]>
	</script>
	<?php if (element('extra_content', $view)) { ?>
		<div class="mt-3 mb-3">
            <div class="row">
			<?php foreach (element('extra_content', $view) as $key => $value) { ?>

            <div class="col-sm-4 mb-3 mb-sm-0">
				<div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3"><?php echo html_escape(element('display_name', $value)); ?></div>
                            <div class="col-sm-9" style="min-height:20px;"><strong><?php echo nl2br(html_escape(element('output', $value))); ?></strong></div>
                        </div>
                    </div>
                </div>
            </div>

			<?php } ?>
            </div>
		</div>
	<?php } ?>
	<div class="contents-view">
		<div class="contents-view-img">
			<?php
			if (element('file_image', $view)) {
				foreach (element('file_image', $view) as $key => $value) {
			?>
				<img src="<?php echo element('thumb_image_url', $value); ?>" alt="<?php echo html_escape(element('pfi_originname', $value)); ?>" title="<?php echo html_escape(element('pfi_originname', $value)); ?>" class="view_full_image" data-origin-image-url="<?php echo element('origin_image_url', $value); ?>" style="max-width:100%;" />
			<?php
				}
			}
			?>
		</div>

		<!-- 본문 내용 시작 -->
		<div id="post-content"><?php echo element('content', element('post', $view)); ?></div>
		<!-- 본문 내용 끝 -->

	</div>



	<?php
	if (element('poll', $view)) {
	$poll = element('poll', $view);
	$poll_item = element('poll_item', $view);
	?>
		<div class="poll mb30 mt-2">
			<div class="headline">
				<h5>[설문조사] <?php echo html_escape(element('ppo_title', $poll)); ?></h5>
			</div>
			<?php
			if (element('attended', $poll) OR element('ended_poll', $poll)) {
				if ($poll_item) {
					$i = 1;
					foreach ($poll_item as $pkey => $pval) {
			?>
				<div class="poll-result"><?php echo $i;?>. <?php echo html_escape(element('ppi_item', $pval)); ?> <div class=""><?php echo number_format(element('ppi_count', $pval)); ?>표, <?php echo element('s_rate', $pval); ?>%</div></div>
				<div class="progress" style="height:5px;">
					<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo element('s_rate', $pval); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo element('bar', $pval); ?>%;">
						<span class="sr-only"><?php echo element('s_rate', $pval); ?>% Complete</span>
					</div>
				</div>
			<?php
					$i++;
					}
				}
			} else {
			?>
			<div id="poll_write_form">
				<?php
				$attributes = array('name' => 'fpostpoll', 'id' => 'fpostpoll');
				echo form_open('', $attributes);
					if ($poll_item) {
						foreach ($poll_item as $pkey => $pval) {
				?>
					<div class="checkbox">
						<label for="ppi_item_<?php echo html_escape(element('ppi_id', $pval)); ?>">
							<input type="checkbox" name="ppi_item[]" class="poll_item_chk" id="ppi_item_<?php echo html_escape(element('ppi_id', $pval)); ?>" value="<?php echo html_escape(element('ppi_id', $pval)); ?>" />
							<?php echo html_escape(element('ppi_item', $pval)); ?>
						</label>
					</div>
				<?php
					}
				}
				?>
					<div class="input-group mt10">
						<button type="button" class="btn btn-secondary btn-xs" onClick="post_poll('<?php echo element('post_id', element('post', $view)); ?>', '<?php echo element('ppo_id', element('poll', $view)); ?>');">투표하기</button>
						<button type="button" class="btn btn-secondary btn-xs" onClick="post_poll_result('<?php echo element('post_id', element('post', $view)); ?>', '<?php echo element('ppo_id', element('poll', $view)); ?>');">결과보기</button>
						<span class="help-block">
							답변 <?php echo element('ppo_choose_count', $poll); ?> 개 선택 가능, 현재 <?php echo element('ppo_count', $poll); ?>명이 참여함, 설문기간 : <?php echo html_escape(element('poll_period', $poll)); ?>
							<?php if (element('ppo_point', $poll)) { echo '참여시' . number_format(element('ppo_point', $poll)) . '포인트 지급'; } ?>
						</span>
					</div>
				<?php echo form_close(); ?>
			</div>
			<?php
			}
			?>

			<div id="poll_result_ajax"></div>

			<script type="text/javascript">
			//<![CDATA[
			var chklimit = <?php echo element('ppo_choose_count', $poll); ?>;
			$('input.poll_item_chk').on('change', function(evt) {
			if ($('input.poll_item_chk:checked').length > chklimit) {
				this.checked = false;
				alert('답변은 ' + chklimit + '개까지만 선택이 가능합니다.');
			}
			});
			function post_poll(post_id, ppo_id) {
				var href;
				href = cb_url + '/poll/post_poll/' + post_id + '/' + ppo_id;
				var $that = $(this);
				$.ajax({
					url : href,
					type : 'post',
					data : $('#fpostpoll').serialize() + '&csrf_test_name=' + cb_csrf_hash,
					dataType : 'json',
					success : function(data) {
						if (data.error) {
							alert(data.error);
							return false;
						} else if (data.success) {
							post_poll_result(post_id, ppo_id);
							$('#poll_write_form').hide();

						}

					}
				});
			}

			function post_poll_result(post_id, ppo_id) {
				var href;
				var result = '';
				href = cb_url + '/poll/post_poll_result/' + post_id + '/' + ppo_id;
				var $that = $(this);
				$.ajax({
					url : href,
					type : 'post',
					data : {csrf_test_name : cb_csrf_hash},
					dataType : 'json',
					success : function(data) {
						if (data.error) {
							alert(data.error);
							return false;
						} else if (data.success) {
							var i = 1;
							for (var key in data.poll_item) {
								obj = data.poll_item[key];
								result += '<div class="poll-result">' + i + '. ' + obj.ppi_item + '<div class="">' + obj.ppi_count + '표, ' + obj.s_rate + '%</div></div><div class="progress" style="height:5px;"><div class="progress-bar" role="progressbar" aria-valuenow="' + obj.s_rate + '" aria-valuemin="0" aria-valuemax="100" style="width: ' + obj.bar + '%;"></div></div>';
								i++;
							}
							$('#poll_result_ajax').html(result);
						}

					}
				});
			}
			//]]>
			</script>
		</div>
	<?php
	}
	?>

    <?php
    if (element('use_sns_button', $view)) {
        $this->managelayout->add_js(base_url('assets/js/sns.js'));
    if ($this->cbconfig->item('kakao_apikey')) {
        $this->managelayout->add_js('https://developers.kakao.com/sdk/js/kakao.min.js');
        ?>
        <script type="text/javascript">Kakao.init('<?php echo $this->cbconfig->item('kakao_apikey'); ?>');</script>
    <?php } ?>
        <div class="sns-button mt-2 mb-2">
            <a href="javascript:;" onClick="sendSns('facebook', '<?php echo element('short_url', $view); ?>', '<?php echo html_escape(html_escape(element('post_title', element('post', $view))));?>');" title="이 글을 페이스북으로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_facebook.png" width="22" height="22" alt="이 글을 페이스북으로 퍼가기" title="이 글을 페이스북으로 퍼가기" /></a>
            <a href="javascript:;" onClick="sendSns('twitter', '<?php echo element('short_url', $view); ?>', '<?php echo html_escape(html_escape(element('post_title', element('post', $view))));?>');" title="이 글을 트위터로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_twitter.png" width="22" height="22" alt="이 글을 트위터로 퍼가기" title="이 글을 트위터로 퍼가기" /></a>
            <?php if ($this->cbconfig->item('kakao_apikey')) { ?>
                <a href="javascript:;" onClick="kakaolink_send('<?php echo html_escape(html_escape(element('post_title', element('post', $view))));?>', '<?php echo element('short_url', $view); ?>');" title="이 글을 카카오톡으로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_kakaotalk.png" width="22" height="22" alt="이 글을 카카오톡으로 퍼가기" title="이 글을 카카오톡으로 퍼가기" /></a>
            <?php } ?>
            <a href="javascript:;" onClick="sendSns('kakaostory', '<?php echo element('short_url', $view); ?>', '<?php echo html_escape(html_escape(element('post_title', element('post', $view))));?>');" title="이 글을 카카오스토리로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_kakaostory.png" width="22" height="22" alt="이 글을 카카오스토리로 퍼가기" title="이 글을 카카오스토리로 퍼가기" /></a>
            <a href="javascript:;" onClick="sendSns('band', '<?php echo element('short_url', $view); ?>', '<?php echo html_escape(html_escape(element('post_title', element('post', $view))));?>');" title="이 글을 밴드로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_band.png" width="22" height="22" alt="이 글을 밴드로 퍼가기" title="이 글을 밴드로 퍼가기" /></a>
        </div>
    <?php } ?>


    <div class="row">
    <div class="col-sm-6">
        <div class="input-group">
        <?php if ( ! element('post_del', element('post', $view)) && (element('use_post_like', element('board', $view)) OR element('use_post_dislike', element('board', $view)))) { ?>

                <?php if (element('use_post_like', element('board', $view))) { ?>
                    <a class="btn btn-secondary" href="javascript:;" id="btn-post-like" onClick="post_like('<?php echo element('post_id', element('post', $view)); ?>', '1', 'post-like');" title="추천하기">
                        <i class="bi bi-hand-thumbs-up"></i> 추천    <span class="post-like"><?php echo number_format(element('post_like', element('post', $view))); ?></span>
                    </a>
                <?php } ?>
                <?php if (element('use_post_dislike', element('board', $view))) { ?>
                    <a class="btn btn-secondary" href="javascript:;" id="btn-post-dislike" onClick="post_like('<?php echo element('post_id', element('post', $view)); ?>', '2', 'post-dislike');" title="비추하기">
                        <i class="bi bi-hand-thumbs-down"></i> 비추천 <span class="post-dislike"><?php echo number_format(element('post_dislike', element('post', $view))); ?></span>
                    </a>
                <?php } ?>

        <?php } ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="input-group justify-content-end">
            <?php if (element('use_print', element('board', $view))) { ?>
                <button type="button" class="btn btn-secondary" href="javascript:;" id="btn-print" onClick="post_print('<?php echo element('post_id', element('post', $view)); ?>', 'post-print');" title="이 글을 프린트하기"><i class="bi bi-printer"></i> 인쇄</button>
            <?php } ?>
            <?php if ( ! element('post_del', element('post', $view)) && element('use_scrap', element('board', $view))) { ?>
                <button type="button" class="btn btn-success btn-sm" id="btn-scrap" onClick="post_scrap('<?php echo element('post_id', element('post', $view)); ?>', 'post-scrap');"><i class="bi bi-bookmark-check"></i> 스크랩 <span class="post-scrap"><?php echo element('scrap_count', element('post', $view)) ? '+' . number_format(element('scrap_count', element('post', $view))) : ''; ?></span></button>
            <?php } ?>
            <?php if ( ! element('post_del', element('post', $view)) && element('use_blame', element('board', $view)) && ( ! element('blame_blind_count', element('board', $view)) OR element('post_blame', element('post', $view)) < element('blame_blind_count', element('board', $view)))) { ?>
                <button type="button" class="btn btn-danger btn-sm" id="btn-blame" onClick="post_blame('<?php echo element('post_id', element('post', $view)); ?>', 'post-blame');"><i class="bi bi-exclamation-octagon"></i> 신고 <span class="post-blame"><?php echo element('post_blame', element('post', $view)) ? '+' . number_format(element('post_blame', element('post', $view))) : ''; ?></span></button>
            <?php } ?>

            <?php if ( ! element('post_del', element('post', $view)) && element('is_admin', $view)) { ?>
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-gear"></i> 관리</button>
                <ul class="dropdown-menu">
                <?php if (element('is_admin', $view) === 'super') { ?>
                    <li class="dropdown-item" onClick="post_copy('copy', '<?php echo element('post_id', element('post', $view)); ?>');"><i class="bi bi-copy"></i> 복사하기</li>
                    <li class="dropdown-item" onClick="post_copy('move', '<?php echo element('post_id', element('post', $view)); ?>');"><i class="bi bi-box-arrow-right"></i> 이동하기</li>
                    <?php if (element('use_category', element('board', $view))) { ?>
                        <li class="dropdown-item" onClick="post_change_category('<?php echo element('post_id', element('post', $view)); ?>');"><i class="bi bi-tags"></i> 카테고리변경</li>
                    <?php
                        }
                    }
                    if (element('use_post_secret', element('board', $view))) {
                        if (element('post_secret', element('post', $view))) {
                    ?>
                        <li class="dropdown-item" onClick="post_action('post_secret', '<?php echo element('post_id', element('post', $view)); ?>', '0');"><i class="bi bi-unlock"></i> 비밀글해제</li>
                    <?php } else { ?>
                        <li class="dropdown-item" onClick="post_action('post_secret', '<?php echo element('post_id', element('post', $view)); ?>', '1');"><i class="bi bi-lock"></i> 비밀글로</li>
                    <?php
                        }
                    }
                    if (element('post_hide_comment', element('post', $view))) {
                    ?>
                        <li class="dropdown-item" onClick="post_action('post_hide_comment', '<?php echo element('post_id', element('post', $view)); ?>', '0');"><i class="bi bi-exclamation-circle"></i> 댓글감춤해제</li>
                    <?php } else { ?>
                        <li class="dropdown-item" onClick="post_action('post_hide_comment', '<?php echo element('post_id', element('post', $view)); ?>', '1');"><i class="bi bi-eye"></i> 댓글감춤</li>
                    <?php } ?>
                    <?php if (element('post_notice', element('post', $view))) { ?>
                        <li class="dropdown-item" onClick="post_action('post_notice', '<?php echo element('post_id', element('post', $view)); ?>', '0');"><i class="bi bi-box-arrow-in-up"></i> 공지내림</li>
                    <?php } else { ?>
                        <li class="dropdown-item" onClick="post_action('post_notice', '<?php echo element('post_id', element('post', $view)); ?>', '1');"><i class="bi bi-box-arrow-in-down"></i> 공지올림</li>
                    <?php } ?>
                    <?php if (element('post_blame', element('post', $view)) >= element('blame_blind_count', element('board', $view))) { ?>
                        <li class="dropdown-item" onClick="post_action('post_blame_blind', '<?php echo element('post_id', element('post', $view)); ?>', '0');"><i class="bi bi-eye"></i> 블라인드해제</li>
                    <?php } else { ?>
                        <li class="dropdown-item" onClick="post_action('post_blame_blind', '<?php echo element('post_id', element('post', $view)); ?>', '1');"><i class="bi bi-exclamation-circle"></i> 블라인드처리</li>
                    <?php } ?>
                    <?php if (element('use_posthistory', element('board', $view))) { ?>
                        <li class="dropdown-item" onClick="post_history('<?php echo element('post_id', element('post', $view)); ?>');" ><i class="bi bi-card-list"></i> 글변경로그</li>
                    <?php } ?>
                    <?php if (element('use_download_log', element('board', $view))) { ?>
                        <li class="dropdown-item" onClick="download_log('<?php echo element('post_id', element('post', $view)); ?>');" ><i class="bi bi-card-list"></i> 다운로드로그</li>
                    <?php } ?>
                    <?php	if (element('use_link_click_log', element('board', $view))) { ?>
                        <li class="dropdown-item" onClick="link_click_log('<?php echo element('post_id', element('post', $view)); ?>');"><i class="bi bi-card-list"></i> 링크클릭로그</li>
                    <?php } ?>
                    <li class="dropdown-item" onClick="post_action('post_trash', '<?php echo element('post_id', element('post', $view)); ?>', '', '이 글을 휴지통으로 이동하시겠습니까?');"><i class="bi bi-trash"></i> 휴지통으로</li>
                </div>
            <?php } ?>
        </div>
    </div>



	<div class="clearfix"></div>
	<?php if (element('tag', element('post', $view))) { ?>
		<div class="tags mt-2">
			<i class="bi bi-tags"></i>
			<?php
			foreach (element('tag', element('post', $view)) as $key => $value) {
			?>
				<a href="<?php echo site_url('tags/?tag=' . html_escape(element('pta_tag', $value))); ?>" title="<?php echo html_escape(element('pta_tag', $value)); ?> 태그 목록"><?php echo html_escape(element('pta_tag', $value)); ?></a>,
			<?php	} ?>
		</div>
	<?php } ?>

	<?php
	if ( ! element('post_hide_comment', element('post', $view))) {
	?>
		<div id="viewcomment" class="view-comment"></div>
	<?php
		$this->load->view(element('view_skin_path', $layout) . '/comment_write');
	}
	?>

	<div class="input-group mt-2 mb-2 justify-content-end">


			<?php	if (element('delete_url', $view)) { ?>
				<button type="button" class="btn btn-danger  btn-one-delete" data-one-delete-url="<?php echo element('delete_url', $view); ?>"><i class="bi bi-trash"></i> 삭제</button>
			<?php } ?>

			<?php if (element('search_list_url', $view)) { ?>
					<a href="<?php echo element('search_list_url', $view); ?>" class="btn btn-secondary "><i class="bi bi-search"></i> 검색목록</a>
			<?php } ?>
			<?php if (element('reply_url', $view)) { ?>
				<a href="<?php echo element('reply_url', $view); ?>" class="btn btn-secondary "><i class="bi bi-arrow-return-right"></i> 답변</a>
			<?php } ?>
			<?php if (element('prev_post', $view)) { ?>
				<a href="<?php echo element('url', element('prev_post', $view)); ?>" class="btn btn-secondary "><i class="bi bi-arrow-bar-left"></i> 이전글</a>
			<?php } ?>
			<?php if (element('next_post', $view)) { ?>
				<a href="<?php echo element('url', element('next_post', $view)); ?>" class="btn btn-secondary "><i class="bi bi-arrow-bar-right"></i> 다음글</a>
			<?php } ?>
        <a href="<?php echo element('list_url', $view); ?>" class="btn btn-secondary "><i class="bi bi-list"></i> 목록</a>
        <?php if (element('modify_url', $view)) { ?>
            <a href="<?php echo element('modify_url', $view); ?>" class="btn btn-secondary"><i class="bi bi-pencil-square"></i> 수정</a>
        <?php } ?>
		<?php if (element('write_url', $view)) { ?>
				<a href="<?php echo element('write_url', $view); ?>" class="btn btn-success">글쓰기</a>
		<?php } ?>

</div>
<?php echo element('footercontent', element('board', $view)); ?>

<?php if (element('target_blank', element('board', $view))) { ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$("#post-content a[href^='http']").attr('target', '_blank');
});
//]]>
</script>
<?php } ?>

<script type="text/javascript">
//<![CDATA[
var client = new ZeroClipboard($('.copy_post_url'));
client.on('ready', function( readyEvent ) {
	client.on('aftercopy', function( event ) {
		alert('게시글 주소가 복사되었습니다. \'Ctrl+V\'를 눌러 붙여넣기 해주세요.');
	});
});
//]]>
</script>
<?php
if (element('highlight_keyword', $view)) {
	$this->managelayout->add_js(base_url('assets/js/jquery.highlight.js'));
?>
	<script type="text/javascript">
	//<![CDATA[
		$('#post-content').highlight([<?php echo element('highlight_keyword', $view);?>]);
	//]]>
	</script>
<?php } ?>
