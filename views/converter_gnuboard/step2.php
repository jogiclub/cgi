		<div class="contents">
			<h2>회원테이블 이전</h2>
			<?php
				if ($message) {
					echo '<div class="alert alert-success">' . $message . '</div>';
				} else {
			?>
			<div class="cont">
    			<p>총 <strong><?php echo  number_format($total_count); ?></strong> 건의 회원정보가 그누보드 회원 테이블에서 발견되었습니다. 이 회원정보를 씨아이보드 회원 테이블로 이전하시겠습니까? </p>
    			<p>중복되는 회원 아이디, 이메일, 닉네임을 발견하는 경우, 해당 회원 정보는 이전되지 않습니다.</p>
    			<p>패스워드는 기존 그누보드 회원테이블에 저장된, 암호화된 패스워드를 그대로 가져옵니다. 암호화방식이 그누보드와 씨아이보드가 다르므로 기존 암호화된 그누보드 패스워드로는  씨아이보드에 로그인할 수 없습니다.</p>
    			<p>디비 부하를 방지하기 위해 <?php echo  $limit; ?>건 단위로 이전을 합니다.</p>
    			<p>디비 이전이 되면 '이전하기' 버튼을 눌러주시면 다음 <?php echo  $limit; ?>건의 데이터가 이전됩니다.</p>
			</div>
			<?php } ?>
		</div>
		<div class="footer">
<?php
	if($end) {
		echo form_open(site_url('converter_gnuboard/step3'));
?>
			<div><button type="submit" class="btn btn-danger btn-xs pull-right"  style="margin-left:10px;">다음단계로<i class="glyphicon glyphicon-chevron-right"></i></button></div>
<?php 
		echo form_close(); 
	} else {
		echo form_open(site_url('converter_gnuboard/step2/conv/' . $next));
?>
			<div><button type="submit" class="btn btn-danger btn-xs pull-right"  style="margin-left:10px;">이전하기<i class="glyphicon glyphicon-chevron-right"></i></button></div>
<?php 
		echo form_close(); 
	}
?>
		
<?php
	echo form_open(site_url('converter_gnuboard/step3'));
?>
			<div><button type="submit" class="btn btn-default btn-xs pull-right">회원테이블 이전 스킵하기<i class="glyphicon glyphicon-chevron-right"></i></button></div>
<?php echo form_close(); ?>
		</div>
