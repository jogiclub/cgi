<?php
$version = date("YmdHis", time());

$this->managelayout->add_css(element('view_skin_url', $layout) . '/css/sub.css?' . $version);
$this->managelayout->add_css(element('view_skin_url', $layout) . '/css/sub_layout.css?' . $version);


?>

<h3><?php echo html_escape(element('doc_title', element('data', $view))); ?></h3>


<?php echo element('content', element('data', $view)); ?>

<?php if ($this->member->is_admin() === 'super') { ?>
    <div class="pull-right">
        <a href="<?php echo admin_url('page/document/write/' . element('doc_id', element('data', $view))); ?>"
           class="btn btn-danger btn-sm" target="_blank">내용수정</a>
    </div>
<?php } ?>


<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>


<script charset="UTF-8">
    new daum.roughmap.Lander({
        "timestamp" : "1743817335818",
        "key" : "2nkny",
        "mapWidth" : "640",
        "mapHeight" : "360"
    }).render();
</script>
<script>
    $('.swiper-wrapper').slick({
        // dots: true,
        infinite: true,
        arrows: false,
        speed: 500,
        fade: true,
        cssEase: 'linear'
    });

    $(".que").click(function () {
        $(this).next(".anw").stop().slideToggle(300);
        $(this).toggleClass('on').siblings().removeClass('on');
        $(this).next(".anw").siblings(".anw").slideUp(300); // 1개씩 펼치기
    });


    $(document).ready(function () {
        // 각 슬라이더 초기화
        $('.slider-gapyeong, .slider-gamrim, .slider-gyeongju, .slider-chungju, .slider-kumho').slick({
            dots: false,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false
                    }
                }
            ]
        });

        // Magnific Popup 초기화
        $('.image-popup').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            mainClass: 'mfp-no-margins mfp-with-zoom',
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: true,
                duration: 300
            }
        });
    });
</script>