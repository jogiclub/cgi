

<div class="main-wrap">


    <div class="date-information wrap-1280">
        <div class="box-wrap">

            <div class="info-tit"><span class="material-symbols-rounded">지역별</span> 어캠 일정</div>
            <div class="info-text">
                <ul>
                    <?php
                    if (element('list', element('data', $view))) {
                        foreach (element('list', element('data', $view)) as $result) {
                            ?>
                            <li>
                                <strong><?php echo element('ch_location', $result); ?></strong>
                                <span>
                                    <?php
                                    $start_date = date('Y.m.d', strtotime(element('ch_start', $result)));
                                    $end_date = date('m.d', strtotime(element('ch_end', $result)));
                                    echo substr($start_date, 2) . '~' . $end_date;
                                    ?>
                                </span>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>



        </div>
    </div>

</div>

<div class="m-section1">
    <div class="wrap-1600 img-txt-wrap">
        <div class="camp-img-wrap">
            <div class="camp-img camp-item-img01" data-aos="fade-up" data-aos-duration="1000">
            </div>
            <div class="camp-img camp-item-img02" data-aos="fade-up" data-aos-duration="1400">
            </div>
            <div class="camp-img camp-item-img03" data-aos="fade-up" data-aos-duration="1800">
            </div>
            <div class="camp-img camp-item-img04" data-aos="fade-up" data-aos-duration="2200">
            </div>

            <div class="center">
                <p class="top-txt">

                    <img src="<?php echo element('view_skin_url', $layout); ?>/images/icon_question.png" />

                    <span class="gray-100">왜</span> 어캠일까요?
                </p>
                <p class="txt-tit">
                    1996년부터 사역시작
                </p>
                <p class="sub-txt">
                    구원의 본질, 은혜를 고집하는 순간부터 하나님은 &lt;어캠&gt;을 30년을 사용하셨습니다.
                </p>
                <a href="/document/why" class="black-btn m-btn">어캠소개 바로가기</a>
            </div>
        </div>


    </div>
</div>

<div class="m-section2 width-all">
    <!--<div class="main-box-wrap">
        <div class="center">
            <p class="top-txt"><span class="weight-300">눈썰매</span> 스케치</p>
            <p class="sub-txt">여름은 겨울은 눈썰매죠. 교사와 아이들과 맘껏 행복한 추억을 만들어요!</p>
            <a href="" class="flower-btn m-btn">더보기  <img src="<?php echo element('view_skin_url', $layout); ?>/images/flower_arr.png"></a>
        </div>

        <div class="wrap-1400">
            <div class="link-wrap">
                <a href="/camp">
                    <span> <img src="<?php echo element('view_skin_url', $layout); ?>/images/icon_reservation.png"></span>
                    <span class="tit">어캠 예약하기</span>
                    <span class="txt">빠른 예약을 도와드립니다.</span>
                    <span class="more">바로가기</span>
                </a>

                <a href="/board/calendar">
                    <span> <img src="<?php echo element('view_skin_url', $layout); ?>/images/icon_schedule.png"></span>
                    <span class="tit">어캠 일정보기</span>
                    <span class="txt">일정을 간편하게 확인하세요.</span>
                    <span class="more">바로가기</span>
                </a>

                <a href="/board/timetable">
                    <span> <img src="<?php echo element('view_skin_url', $layout); ?>/images/icon_timetable.png"></span>
                    <span class="tit">어캠 시간표</span>
                    <span class="txt">상세한 시간표를 다운받으세요.</span>
                    <span class="more">바로가기</span>
                </a>

            </div>
        </div>
    </div>-->
    <div class="main-box-wrap">
        <div class="center">
            <p class="top-txt"><span class="weight-300">물놀이</span> 스케치</p>
            <p class="sub-txt">여름은 물놀이죠. 교사와 아이들과 맘껏 행복한 추억을 만들어요!</p>
            <a href="" class="flower-btn m-btn">더보기  <img src="<?php echo element('view_skin_url', $layout); ?>/images/flower_arr.png"></a>
        </div>

        <div class="wrap-1400">
            <div class="link-wrap">
                <a href="/camp">
                    <span> <img src="<?php echo element('view_skin_url', $layout); ?>/images/icon_reservation.png"></span>
                    <span class="tit">어캠 예약하기</span>
                    <span class="txt">빠른 예약을 도와드립니다.</span>
                    <span class="more">바로가기</span>
                </a>

                <a href="/board/calendar">
                    <span> <img src="<?php echo element('view_skin_url', $layout); ?>/images/icon_schedule.png"></span>
                    <span class="tit">어캠 일정보기</span>
                    <span class="txt">일정을 간편하게 확인하세요.</span>
                    <span class="more">바로가기</span>
                </a>

                <a href="/board/timetable">
                    <span> <img src="<?php echo element('view_skin_url', $layout); ?>/images/icon_timetable.png"></span>
                    <span class="tit">어캠 시간표</span>
                    <span class="txt">상세한 시간표를 다운받으세요.</span>
                    <span class="more">바로가기</span>
                </a>

            </div>
        </div>
    </div>
</div>

<div class="m-section3 width-all">
    <div class="top-txt section-btit">
        <p class="weight-300">올해 뜨거웠던,</p>
        <p><span class="weight-300">어캠 현장을</span> <span class="primary-color">확인해보세요.</span></p>
    </div>


    <?php
    $config = array(
        'skin' => 'main_img_carousel',
        'brd_key' => 'photo',
        'limit' => 10,
        'is_gallery' => '1',
        'length' => 40,
        'cache_minute' => 1,
        'image_width' => '350',
        'image_height' => '200'
    );
    echo $this->board->latest($config);
    ?>

</div>


<div class="m-section4 wrap-1400">
    <div class="m-list-wrap">
        <div class="titlearea">
            <div class="top-txt">
                <span class="weight-300 b-100">다양한 최신 정보를 빠르게</span> <span class="primary-color">만나보세요.</span>
            </div>
            <!--<a href="" class="flower-btn m-btn">더보기  <img src="<?php echo element('view_skin_url', $layout); ?>/images/flower_arr_black.png"></a>-->
            <a href="https://www.ihappynanum.com/Nanum/B/PUI1X1HXU1" target="_blank"><img src="<?php echo element('view_skin_url', $layout); ?>/images/notice_img.jpg"></a>
        </div>

        <div class="m-board">
            <?php
            echo '<ul>';
            $config = array(
                'skin' => 'main_calendar',
                'brd_key' => 'calendar',
                'limit' => 5,
                'length' => 40,
                'cache_minute' => 1

            );
            echo $this->board->latest($config);
            echo '</ul>';
            ?>




        </div>
    </div>
</div>





