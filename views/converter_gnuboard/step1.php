<?php
	$attributes = array('name' => 'fconverter', 'id' => 'fconverter');
	echo form_open(site_url('converter_gnuboard/step2'), $attributes);
?>
		<div class="contents">
			<h2>기본환경설정체크</h2>
			<div class="cont">
    			<p><i class="glyphicon glyphicon-record"></i><span class="title"><?php echo $title1;?></span> : <?php echo  $content1;?></p>
			</div>
			<div class="cont">
    			<p><i class="glyphicon glyphicon-record"></i><span class="title"><?php echo $title2;?></span> : <?php echo  $content2;?></p>
			</div>
			<div class="cont">
    			<p><i class="glyphicon glyphicon-record"></i><span class="title"><?php echo $title3;?></span> : <?php echo  $content3;?></p>
			</div>
			<div class="cont">
    			<p><i class="glyphicon glyphicon-record"></i><span class="title"><?php echo $title4;?></span> : <?php echo  $content4;?></p>
			</div>
			<?php
				if ($message) {
					echo '<div class="alert alert-danger">' . $message . '</div>';
				}
			?>
		</div>
		<?php if ( ! $message) {?>
		<!-- footer start -->
		<div class="footer">
			<button type="submit" class="btn btn-default btn-xs pull-right">Next <i class="glyphicon glyphicon-chevron-right"></i></button>
		</div>
		<!-- footer end -->
		<?php } ?>
<?php echo form_close(); ?>
<?php if ($message) {?>
<?php
	$attributes = array('name' => 'fcheck', 'id' => 'fcheck');
	echo form_open(site_url('converter_gnuboard/step1'), $attributes);
?>
		<!-- footer start -->
		<div class="footer">
			<button type="submit" class="btn btn-default btn-xs pull-right">Check Again <i class="glyphicon glyphicon-chevron-right"></i></button>
		</div>
<?php echo form_close(); ?>
		<!-- footer end -->
		<?php } ?>
