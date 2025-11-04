<?php
$version = date("YmdHis", time());
$this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css?'.$version); ?>

<?php echo element('headercontent', element('board', element('list', $view))); ?>

<div class="board">
	<h3 class="mb-3"><?php echo html_escape(element('board_name', element('board', element('list', $view)))); ?></h3>
	<div class="row">
		<div class="col-sm-2 offset-sm-10">
			<?php if ( ! element('access_list', element('board', element('list', $view))) && element('use_rss_feed', element('board', element('list', $view)))) { ?>
				<a href="<?php echo rss_url(element('brd_key', element('board', element('list', $view)))); ?>" class="btn btn-danger" title="<?php echo html_escape(element('board_name', element('board', element('list', $view)))); ?> RSS 보기"><i class="bi bi-rss"></i></a>
			<?php } ?>
			<select class="form-select" onchange="location.href='<?php echo board_url(element('brd_key', element('board', element('list', $view)))); ?>?category_id=<?php echo html_escape($this->input->get('categroy_id')); ?>&amp;findex=' + this.value;">
				<option value="">정렬하기</option>
				<option value="post_datetime desc" <?php echo $this->input->get('findex') === 'post_datetime desc' ? 'selected="selected"' : '';?>>날짜순</option>
				<option value="post_hit desc" <?php echo $this->input->get('findex') === 'post_hit desc' ? 'selected="selected"' : '';?>>조회수</option>
				<option value="post_comment_count desc" <?php echo $this->input->get('findex') === 'post_comment_count desc' ? 'selected="selected"' : '';?>>댓글수</option>
				<?php if (element('use_post_like', element('board', element('list', $view)))) { ?>
					<option value="post_like desc" <?php echo $this->input->get('findex') === 'post_like desc' ? 'selected="selected"' : '';?>>추천순</option>
				<?php } ?>
			</select>
			<?php if (element('use_category', element('board', element('list', $view))) && ! element('cat_display_style', element('board', element('list', $view)))) { ?>
				<select class="form-select" onchange="location.href='<?php echo board_url(element('brd_key', element('board', element('list', $view)))); ?>?findex=<?php echo html_escape($this->input->get('findex')); ?>&category_id=' + this.value;">
					<option value="">카테고리선택</option>
					<?php
					$category = element('category', element('board', element('list', $view)));
					function ca_select($p = '', $category = '', $category_id = '')
					{
						$return = '';
						if ($p && is_array($p)) {
							foreach ($p as $result) {
								$exp = explode('.', element('bca_key', $result));
								$len = (element(1, $exp)) ? strlen(element(1, $exp)) : 0;
								$space = str_repeat('-', $len);
								$return .= '<option value="' . html_escape(element('bca_key', $result)) . '"';
								if (element('bca_key', $result) === $category_id) {
									$return .= 'selected="selected"';
								}
								$return .= '>' . $space . html_escape(element('bca_value', $result)) . '</option>';
								$parent = element('bca_key', $result);
								$return .= ca_select(element($parent, $category), $category, $category_id);
							}
						}
						return $return;
					}

					echo ca_select(element(0, $category), $category, $this->input->get('category_id'));
					?>
				</select>
			<?php } ?>
		</div>

		<script type="text/javascript">
		//<![CDATA[
		function postSearch(f) {
			var skeyword = f.skeyword.value.replace(/(^\s*)|(\s*$)/g,'');
			if (skeyword.length < 2) {
				alert('2글자 이상으로 검색해 주세요');
				f.skeyword.focus();
				return false;
			}
			return true;
		}
		function toggleSearchbox() {
			$('.searchbox').show();
			$('.searchbuttonbox').hide();
		}
		<?php
		if ($this->input->get('skeyword')) {
			echo 'toggleSearchbox();';
		}
		?>
		$('.btn-point-info').popover({
			template: '<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-title"></div><div class="popover-content"></div></div>',
			html : true
		});
		//]]>
		</script>
	</div>

	<?php
	if (element('use_category', element('board', element('list', $view))) && element('cat_display_style', element('board', element('list', $view))) === 'tab') {
		$category = element('category', element('board', element('list', $view)));
	?>
		<ul class="nav nav-tabs clearfix">
			<li role="presentation" <?php if ( ! $this->input->get('category_id')) { ?>class="active" <?php } ?>><a href="<?php echo board_url(element('brd_key', element('board', element('list', $view)))); ?>?findex=<?php echo html_escape($this->input->get('findex')); ?>&category_id=">전체</a></li>
			<?php
			if (element(0, $category)) {
				foreach (element(0, $category) as $ckey => $cval) {
			?>
				<li role="presentation" <?php if ($this->input->get('category_id') === element('bca_key', $cval)) { ?>class="active" <?php } ?>><a href="<?php echo board_url(element('brd_key', element('board', element('list', $view)))); ?>?findex=<?php echo html_escape($this->input->get('findex')); ?>&category_id=<?php echo element('bca_key', $cval); ?>"><?php echo html_escape(element('bca_value', $cval)); ?></a></li>
			<?php
				}
			}
			?>
		</ul>
	<?php
	}
	?>

	<?php
	$attributes = array('name' => 'fboardlist', 'id' => 'fboardlist');
	echo form_open('', $attributes);
	?>
		<table class="table table-hover">
			<thead>
				<tr>
					<?php if (element('is_admin', $view)) { ?><th><input onclick="if (this.checked) all_boardlist_checked(true); else all_boardlist_checked(false);" type="checkbox" /></th><?php } ?>
					<th>번호</th>
					<th>날짜</th>
                    <th>제목</th>
					<th>글쓴이</th>
					<th>날짜</th>
					<th>조회수</th>
				</tr>
			</thead>
			<tbody>
			<?php
			if (element('notice_list', element('list', $view))) {
				foreach (element('notice_list', element('list', $view)) as $result) {
			?>
				<tr>
					<?php if (element('is_admin', $view)) { ?><td><input type="checkbox" name="chk_post_id[]" value="<?php echo element('post_id', $result); ?>" /></td><?php } ?>
					<td><span class="badge text-bg-primary">공지</span></td>
                    <td><?php echo element('extra_date', element('extra_vars', $result)); ?></td>
					<td class="text-start">
						<?php if (element('post_reply', $result)) { ?><span class="badge text-bg-primary" style="margin-left:<?php echo strlen(element('post_reply', $result)) * 10; ?>px">Re</span><?php } ?>
						<a href="<?php echo element('post_url', $result); ?>" style="
							<?php
							if (element('title_color', $result)) {
								echo 'color:' . element('title_color', $result) . ';';
							}
							if (element('title_font', $result)) {
								echo 'font-family:' . element('title_font', $result) . ';';
							}
							if (element('title_bold', $result)) {
								echo 'font-weight:bold;';
							}
							if (element('post_id', element('post', $view)) === element('post_id', $result)) {
								echo 'font-weight:bold;';
							}
							?>
						" title="<?php echo html_escape(element('title', $result)); ?>">
                            <?php echo html_escape(element('title', $result)); ?>
                        </a>
						<?php if (element('is_mobile', $result)) { ?><span class="bi bi-wifi"></span><?php } ?>
						<?php if (element('post_file', $result)) { ?><span class="bi bi-download"></span><?php } ?>
						<?php if (element('post_secret', $result)) { ?><span class="bi bi-lock"></span><?php } ?>
						<?php if (element('ppo_id', $result)) { ?><i class="bi bi-bar-chart"></i><?php } ?>
						<?php if (element('post_comment_count', $result)) { ?>
                            <span class="badge text-bg-warning">+<?php echo element('post_comment_count', $result); ?>
                            </span><?php } ?>
					<td><?php echo element('display_name', $result); ?></td>
					<td><?php echo element('display_datetime', $result); ?></td>
					<td><?php echo number_format(element('post_hit', $result)); ?></td>
				</tr>
			<?php
				}
			}
			if (element('list', element('data', element('list', $view)))) {
				foreach (element('list', element('data', element('list', $view))) as $result) {
			?>
				<tr>
					<?php if (element('is_admin', $view)) { ?><td><input type="checkbox" name="chk_post_id[]" value="<?php echo element('post_id', $result); ?>" /></td><?php } ?>
					<td><?php echo element('num', $result); ?></td>
                    <td><?php echo element('extra_date', element('extra_vars', $result)); ?></td>
                    <td class="text-start">
						<?php if (element('category', $result)) { ?><a href="<?php echo board_url(element('brd_key', element('board', element('list', $view)))); ?>?category_id=<?php echo html_escape(element('bca_key', element('category', $result))); ?>"><span class="badge text-bg-default"><?php echo html_escape(element('bca_value', element('category', $result))); ?></span></a><?php } ?>
						<?php if (element('post_reply', $result)) { ?><span class="badge text-bg-primary" style="margin-left:<?php echo strlen(element('post_reply', $result)) * 10; ?>px">Re</span><?php } ?>
						<a href="<?php echo element('post_url', $result); ?>" style="
							<?php
							if (element('title_color', $result)) {
								echo 'color:' . element('title_color', $result) . ';';
							}
							if (element('title_font', $result)) {
								echo 'font-family:' . element('title_font', $result) . ';';
							}
							if (element('title_bold', $result)) {
								echo 'font-weight:bold;';
							}
							if (element('post_id', element('post', $view)) === element('post_id', $result)) {
								echo 'font-weight:bold;';
							}
							?>
						" title="<?php echo html_escape(element('title', $result)); ?>"><?php echo html_escape(element('title', $result)); ?></a>
						<?php if (element('is_mobile', $result)) { ?><span class="bi bi-wifi"></span><?php } ?>
						<?php if (element('post_file', $result)) { ?><span class="bi bi-download"></span><?php } ?>
						<?php if (element('post_secret', $result)) { ?><span class="bi bi-lock"></span><?php } ?>
						<?php if (element('is_hot', $result)) { ?><span class="badge text-bg-danger">인기글</span><?php } ?>
						<?php if (element('is_new', $result)) { ?><span class="badge text-bg-warning">새글</span><?php } ?>
						<?php if (element('ppo_id', $result)) { ?><i class="bi bi-bar-chart"></i><?php } ?>
						<?php if (element('post_comment_count', $result)) { ?>
                            <span class="badge text-bg-success"><?php echo element('post_comment_count', $result); ?>개 댓글</span>
                        <?php } ?>
					<td><?php echo element('display_name', $result); ?></td>
					<td><?php echo element('display_datetime', $result); ?></td>
					<td><?php echo number_format(element('post_hit', $result)); ?></td>
				</tr>
			<?php
				}
			}
			if ( ! element('notice_list', element('list', $view)) && ! element('list', element('data', element('list', $view)))) {
			?>
				<tr>
					<td colspan="6" class="nopost">게시물이 없습니다</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>


        <div class="row">

            <?php echo element('paging', element('list', $view)); ?>

            <div class="col-sm-4">
                <?php if (element('is_admin', $view)) { ?>
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-gear"></i> 관리</button>
                    <ul class="dropdown-menu">
                        <?php if (element('is_admin', $view) === 'super') { ?>
                            <li class="dropdown-item" onClick="document.location.href='<?php echo admin_url('board/boards/write/' . element('brd_id', element('board', element('list', $view)))); ?>';"><i class="bi bi-sliders2-vertical"></i> 게시판설정</li>
                            <li class="dropdown-item" onClick="post_multi_copy('copy');"><i class="bi bi-copy"></i> 복사하기</li>
                            <li class="dropdown-item" onClick="post_multi_copy('move');"><i class="bi bi-box-arrow-right"></i> 이동하기</li>
                            <li class="dropdown-item" onClick="post_multi_change_category();"><i class="bi bi-tags"></i> 카테고리변경</li>
                        <?php } ?>
                        <li class="dropdown-item" onClick="post_multi_action('multi_delete', '0', '선택하신 글들을 완전삭제하시겠습니까?');"><i class="bi bi-trash"></i> 선택삭제하기</li>
                        <li class="dropdown-item" onClick="post_multi_action('post_multi_secret', '0', '선택하신 글들을 비밀글을 해제하시겠습니까?');"><i class="bi bi-unlock"></i> 비밀글해제</li>
                        <li class="dropdown-item" onClick="post_multi_action('post_multi_secret', '1', '선택하신 글들을 비밀글로 설정하시겠습니까?');"><i class="bi bi-lock"></i> 비밀글로</li>
                        <li class="dropdown-item" onClick="post_multi_action('post_multi_notice', '0', '선택하신 글들을 공지를 내리시겠습니까?');"><i class="bi bi-box-arrow-in-up"></i> 공지내림</li>
                        <li class="dropdown-item" onClick="post_multi_action('post_multi_notice', '1', '선택하신 글들을 공지로 등록 하시겠습니까?');"><i class="bi bi-box-arrow-in-down"></i> 공지올림</li>
                        <li class="dropdown-item" onClick="post_multi_action('post_multi_blame_blind', '0', '선택하신 글들을 블라인드 해제 하시겠습니까?');"><i class="bi bi-eye"></i> 블라인드해제</li>
                        <li class="dropdown-item" onClick="post_multi_action('post_multi_blame_blind', '1', '선택하신 글들을 블라인드 처리 하시겠습니까?');"><i class="bi bi-exclamation-circle"></i> 블라인드처리</li>
                        <li class="dropdown-item" onClick="post_multi_action('post_multi_trash', '', '선택하신 글들을 휴지통으로 이동하시겠습니까?');"><i class="bi bi-trash"></i> 휴지통으로</li>
                    </ul>
                <?php } ?>
            </div>
            <div class="col-sm-4">
                <div class=" searchbox">
                    <form class="navbar-form navbar-right " action="<?php echo board_url(element('brd_key', element('board', element('list', $view)))); ?>" onSubmit="return postSearch(this);">
                        <input type="hidden" name="findex" value="<?php echo html_escape($this->input->get('findex')); ?>" />
                        <input type="hidden" name="category_id" value="<?php echo html_escape($this->input->get('category_id')); ?>" />
                        <div class="input-group">
                            <select class="form-select" name="sfield">
                                <option value="post_both" <?php echo ($this->input->get('sfield') === 'post_both') ? ' selected="selected" ' : ''; ?>>제목+내용</option>
                                <option value="post_title" <?php echo ($this->input->get('sfield') === 'post_title') ? ' selected="selected" ' : ''; ?>>제목</option>
                                <option value="post_content" <?php echo ($this->input->get('sfield') === 'post_content') ? ' selected="selected" ' : ''; ?>>내용</option>
                                <option value="post_nickname" <?php echo ($this->input->get('sfield') === 'post_nickname') ? ' selected="selected" ' : ''; ?>>회원명</option>
                                <option value="post_userid" <?php echo ($this->input->get('sfield') === 'post_userid') ? ' selected="selected" ' : ''; ?>>회원아이디</option>
                            </select>
                            <input type="text" class="form-control px150" placeholder="Search" name="skeyword" value="<?php echo html_escape($this->input->get('skeyword')); ?>" />
                            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> 검색</button>
                        </div>
                    </form>
                </div>

                <?php if (element('point_info', element('list', $view))) { ?>
                    <div class="point-info  ">
                        <button class="btn-point-info btn-link" data-toggle="popover" data-trigger="focus" data-placement="left" title="포인트안내" data-content="<?php echo element('point_info', element('list', $view)); ?>"
                        ><i class="bi bi-info-circle fa-lg"></i></button>
                    </div>
                <?php } ?>
            </div>
            <div class="col-sm-4">
            <div class="input-group justify-content-end">
                <?php if (element('write_url', element('list', $view))) { ?>
                        <a href="<?php echo element('list_url', element('list', $view)); ?>" class="btn btn-secondary"><i class="bi bi-list"></i> 목록</a>
                        <?php if (element('search_list_url', element('list', $view))) { ?>
                            <a href="<?php echo element('search_list_url', element('list', $view)); ?>" class="btn btn-secondary">검색목록</a>
                        <?php } ?>
                        <a href="<?php echo element('write_url', element('list', $view)); ?>" class="btn btn-success">글쓰기</a>
                <?php } ?>
            </div>
            </div>
        </div>
    </div>



<?php echo element('footercontent', element('board', element('list', $view))); ?>

<?php
if (element('highlight_keyword', element('list', $view))) {
	$this->managelayout->add_js(base_url('assets/js/jquery.highlight.js')); ?>
<script type="text/javascript">
//<![CDATA[
$('#fboardlist').highlight([<?php echo element('highlight_keyword', element('list', $view));?>]);
//]]>
</script>
<?php } ?>
