		<div class="contents">
			<h2>게시글, 댓글, 첨부파일 등 이전</h2>
			<?php
				if ($message) {
					echo '<div class="alert alert-success">' . $message . '</div>';
				} else {
			?>
			<div class="form-group">
    			<p>게시글, 댓글, 첨부파일, 추천, 스크랩 등을 이전합니다</p>
    			<p>이전을 원하는 그누보드 게시판명과 씨아이보드 게시판명을 선택해주세요</p>
    			<p class="form-group form-inline">그누보드 : 
					<select class="form-control input-sm" name="bo_table" id="bo_table"><option value="">선택</option>
					<?php if($gnuboard) { foreach($gnuboard as $key => $value) { ?>
							<option value="<?php echo element('bo_table', $value);?>"><?php echo html_escape(element('bo_subject', $value));?> (<?php echo element('bo_table', $value);?>) 총 <?php echo number_format(element('bo_count_write', $value));?>건</option>
					<?php }} ?>
					</select>
					=> 씨아이보드 : 
					<select class="form-control input-sm" name="brd_id" id="brd_id"><option value="">선택</option>
					<?php if($ciboard) { foreach($ciboard as $key => $value) { ?>
							<option value="<?php echo element('brd_id', $value);?>"><?php echo html_escape(element('brd_name', $value));?> (<?php echo element('brd_key', $value);?>)</option>
					<?php }} ?>
					</select>
				</p>
    			<p>디비 부하를 방지하기 위해 <?php echo  $limit; ?>건 단위로 이전을 합니다.</p>
    			<p>디비 이전이 되면 '이전하기' 버튼을 눌러주시면 다음 <?php echo  $limit; ?>건의 데이터가 이전됩니다.</p>
			</div>
			<?php } ?>
		</div>
		<div class="footer">
<?php
	if($end) {
?>
			<div><button type="button" class="btn btn-danger btn-xs pull-right"  style="margin-left:10px;">현재게시판 이전완료됨<i class="glyphicon glyphicon-chevron-right"></i></button></div>
<?php 
	} else {
		if($next) {
			echo form_open(site_url('converter_gnuboard/step3/' . $gnutable . '/' . $brd_id . '/' . $next));
?>
				<div><button type="submit" class="btn btn-danger btn-xs pull-right"  style="margin-left:10px;">이전하기<i class="glyphicon glyphicon-chevron-right"></i></button></div>
<?php 
			echo form_close(); 
		} else {
?>	
			<form method="get" onSubmit="return Check(this);">
			<div><button type="submit" class="btn btn-danger btn-xs pull-right"  style="margin-left:10px;">이전하기<i class="glyphicon glyphicon-chevron-right"></i></button></div>
			</form>
<?php 
		}
	}
?>
<script>
function Check(f) {
	if($("#bo_table").val() == '') {
		alert('그누보드 게시판을 선택해주세요');
		return false;
	}
	if($("#brd_id").val() == '') {
		alert('씨아이보드 게시판을 선택해주세요');
		return false;
	}
	f.action = "<?php echo site_url('converter_gnuboard/step3'); ?>/" + $("#bo_table").val() + "/" + $("#brd_id").val() +"/0";
	return true;
}
</script>
		
<?php
	echo form_open(site_url('converter_gnuboard/step3'));
?>
			<div><button type="submit" class="btn btn-default btn-xs pull-right">새로운 게시판 이전하기<i class="glyphicon glyphicon-chevron-right"></i></button></div>
<?php echo form_close(); ?>
		</div>
