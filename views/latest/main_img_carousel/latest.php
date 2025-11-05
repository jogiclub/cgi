<style>
    .main-img-carousel{height: 280px; position: relative;margin-top: 50px;}
    .main-img-carousel .card .img{width: 100%; height: 200px; border-radius: 3px 3px 0 0; }
    .main-img-carousel .card p{line-height: 20px; font-size: 16px; padding: 10px; width: 100%;}
    .main-img-carousel button{border: 0; font-size: 35px; color:#F60F8F; position: absolute; top: 44%; background: transparent;z-index: 5}
    .main-img-carousel button.slick-prev{left: 30px; }
    .main-img-carousel button.slick-next{right: 30px; }
    .slick-slide {margin: 0 10px;}




</style>

<div class="d-flex justify-content-end">
<a href="<?php echo board_url(element('brd_key', element('board', $view))); ?>" title="<?php echo html_escape(element('board_name', element('board', $view))); ?>">더보기 <i class="bi bi-plus-lg"></i></a>
</div>
<div class="main-img-carousel">
    <?php
    $i = 0;
    if (element('latest', $view)) {
        foreach (element('latest', $view) as $key => $value) {
            ?>
            <div class="card">
                    <a href="<?php echo element('url', $value); ?>" title="<?php echo html_escape(element('title', $value)); ?>">
                        <div class="img" style="background: url(<?php echo element('thumb_url', $value); ?>) center center/cover #eee"></div>
                        <p class="text-truncate"><?php echo html_escape(element('title', $value)); ?>
                                <?php if (element('post_comment_count', $value)) { ?> <span class="latest_comment_count"> +<?php echo element('post_comment_count', $value); ?></span><?php } ?>
                        </p>
                    </a>

            </div>
            <?php
        }
    }
    ?>
</div>




<script>
    $('.main-img-carousel').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        prevArrow:'<button type="button" class="slick-prev"></button>',
        nextArrow:'<button type="button" class="slick-next"></button>',
        responsive: [
            {
                breakpoint: 1190,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
           },

        ]
    });
</script>




