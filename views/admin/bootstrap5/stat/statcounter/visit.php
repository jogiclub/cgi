<div class="box">
	<div class="box-table">
		<div class="box-table-header">
			<ul class="nav nav-tabs mb-3">
				<li class="nav-item"><a class="nav-link" href="<?php echo admin_url($this->pagedir); ?>">방문자로그 </a></li>
				<li class="nav-item"><a class="nav-link active" href="<?php echo admin_url($this->pagedir . '/visit'); ?>">기간별 그래프</a></li>
				<li class="nav-item"><a class="nav-link" href="<?php echo admin_url($this->pagedir . '/cleanlog'); ?>">오래된 로그삭제</a></li>
			</ul>
			<form class="mt-3" name="flist" method="get" >
				<div class="row">

                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-text">기간</span>
                            <input type="text" class="form-control datepicker " name="start_date" value="<?php echo element('start_date', $view); ?>" readonly="readonly" />
                            <span class="input-group-text">~</span>
                            <input type="text" class="form-control datepicker" name="end_date" value="<?php echo element('end_date', $view); ?>" readonly="readonly" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group justify-content-end">
                            <button data-page-url="<?php echo admin_url($this->pagedir . '/visit'); ?>" class="btn btn-warning  statsubmit">방문자</button>
                            <button data-page-url="<?php echo admin_url($this->pagedir . '/domain'); ?>" class="btn btn-secondary  statsubmit">도메인</button>
                            <button data-page-url="<?php echo admin_url($this->pagedir . '/browser'); ?>" class="btn btn-secondary  statsubmit">브라우저</button>
                            <button data-page-url="<?php echo admin_url($this->pagedir . '/os'); ?>" class="btn btn-secondary  statsubmit">운영체제</button>
                            <button data-page-url="<?php echo admin_url($this->pagedir . '/hour'); ?>" class="btn btn-secondary  statsubmit">시간</button>
                            <button data-page-url="<?php echo admin_url($this->pagedir . '/week'); ?>" class="btn btn-secondary  statsubmit">요일</button>
                            <button data-page-url="<?php echo admin_url($this->pagedir . '/day'); ?>" class="btn btn-secondary  statsubmit">일</button>
                            <button data-page-url="<?php echo admin_url($this->pagedir . '/month'); ?>" class="btn btn-secondary  statsubmit">월</button>
                            <button data-page-url="<?php echo admin_url($this->pagedir . '/year'); ?>" class="btn btn-secondary  statsubmit">년</button>
                        </div>
					</div>
				</div>
			</form>
			<script type="text/javascript">
			//<![CDATA[
			$(document).on('click', '.statsubmit', function() {
				var f = document.flist;
				f.action= $(this).attr('data-page-url');
				f.submit();
			});
			//]]>
			</script>
		</div>
		<div class="table-responsive">
			<table class="table table-hover table-striped table-bordered">
				<thead>
					<tr>
						<th>날짜</th>
						<th>IP</th>
						<th>OS</th>
						<th>Browser</th>
						<th>현재주소</th>
						<th>이전주소</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if (element('list', element('data', $view))) {
					foreach (element('list', element('data', $view)) as $result) {
				?>
					<tr>
						<td><?php echo element('sco_date', $result); ?> <?php echo element('sco_time', $result); ?></td>
						<td><?php echo display_admin_ip(element('sco_ip', $result)); ?></td>
						<td><?php echo element('os', $result); ?></td>
						<td><?php echo element('browsername', $result); ?> <?php echo element('browserversion', $result); ?> <?php echo element('engine', $result); ?></td>
						<td><?php echo element('sco_current', $result); ?></td>
						<td><?php echo element('sco_referer', $result); ?></td>
					</tr>
				<?php
					}
				}
				if ( ! element('list', element('data', $view))) {
				?>
					<tr>
						<td colspan="6" class="nopost">자료가 없습니다</td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
			<div class="box-info">
				<?php echo element('paging', $view); ?>
				<div class="pull-left ml20"><?php echo admin_listnum_selectbox();?></div>
				<div class="col-md-6"><div class="btn-group pull-right" role="group" aria-label="...">
					<a href="<?php echo element('listall_url', $view); ?>" class="btn btn-outline btn-secondary ">전체목록</a>
				</div>
			</div>
		</div>
	</div>
</div>
