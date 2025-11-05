<?php // echo html_escape(element('board_name', element('board', $view))); ?>
<div class="view-all">
    <a href="<?php echo board_url(element('brd_key', element('board', $view))); ?>" title="<?php echo html_escape(element('board_name', element('board', $view))); ?>">더보기 <i class="bi bi-plus-lg"></i></a>
</div>
<?php $i = 0;
if (element('latest', $view)) {
    foreach (element('latest', $view) as $key => $value) { ?>
        <li>
            <a href="<?php echo element('url', $value); ?>"
               title="<?php echo html_escape(element('title', $value)); ?>">
                <?php
                // extra_vars에서 extra_date 가져오기
                $extra_date = element('extra_date', element('extra_vars', $value));
                //var_dump($extra_date);
                if ($extra_date) {
                    $datetime = new DateTime($extra_date);
                } else {
                    // extra_date가 없을 경우 기존 post_datetime 사용
                    $datetime = new DateTime(element('post_datetime', $value));
                }
                $ym = $datetime->format('Y.m');
                $day = $datetime->format('d');
                ?>
            <div class="date">
                <div class="day"><?php echo $day; ?></div>
                <div class="ym"><?php echo $ym; ?></div>
            </div>
            <div class="tit"><?php echo html_escape(element('title', $value)); ?> <?php if (element('post_comment_count', $value)) { ?>
                    <span class="latest_comment_count">
                    +<?php echo element('post_comment_count', $value); ?></span><?php } ?>
            </div>
            </a>
        </li>
        <?php $i++;
    }
}
while ($i < element('latest_limit', $view)) { ?>
    <li>게시물이 없습니다</li><?php $i++;
} ?>
