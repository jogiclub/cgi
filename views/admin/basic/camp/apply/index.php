<div class="box">
    <div class="box-table">


        <?php
        $attributes = array('class' => 'form-inline', 'name' => 'flist', 'id' => 'flist');
        echo form_open(current_full_url(), $attributes);
        ?>


        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

        <?php if (element('camp_info', $view)) { ?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                캠프명: <?php echo html_escape(element('ch_num', element('camp_info', $view))); ?><br>
                기간: <?php echo html_escape(element('ch_start', element('camp_info', $view))); ?> ~
                <?php echo html_escape(element('ch_end', element('camp_info', $view))); ?><br>
                참가비: <?php echo html_escape(element('ch_pay', element('camp_info', $view))); ?><br>
                모집인원: <?php echo html_escape(element('ch_to', element('camp_info', $view))); ?>

            </div>
        <?php } ?>


        <div class="box-table-header">
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group">
                        <!-- 캠프 상태 선택 -->
                        <select name="ch_close" id="ch_close" class="form-control" style="width: 120px;">
                            <option value="">전체 상태</option>
                            <option value="마감" <?php echo ($this->input->get('ch_close') === '마감') ? 'selected' : ''; ?>>마감</option>
                            <option value="접수중" <?php echo ($this->input->get('ch_close') === '접수중') ? 'selected' : ''; ?>>접수중</option>
                        </select>


                        <!-- 년도 선택 -->
                        <select name="ch_year" id="ch_year" class="form-control" style="width: 120px; margin-left: 10px;">
                            <option value="">전체 년도</option>
                            <?php
                            if (element('years', $view)) {
                                foreach (element('years', $view) as $year) {
                                    ?>
                                    <option value="<?php echo $year['ch_year']; ?>"
                                        <?php echo ($this->input->get('ch_year') == $year['ch_year']) ? 'selected' : ''; ?>>
                                        <?php echo $year['ch_year']; ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>

                        <!-- 계절 선택 -->
                        <select name="ch_season" id="ch_season" class="form-control" style="width: 120px; margin-left: 10px;">
                            <option value="">전체 계절</option>
                            <option value="여름" <?php echo ($this->input->get('ch_season') === '여름') ? 'selected' : ''; ?>>여름</option>
                            <option value="겨울" <?php echo ($this->input->get('ch_season') === '겨울') ? 'selected' : ''; ?>>겨울</option>
                            <option value="상시" <?php echo ($this->input->get('ch_season') === '상시') ? 'selected' : ''; ?>>상시</option>
                        </select>

                        <!-- 캠프 선택 -->
                        <select name="camp_idx" id="camp_select" class="form-control" style="width:200px;margin-left: 10px;">
                            <option value="all" <?php echo (element('selected_camp_idx', $view) == 'all') ? 'selected' : ''; ?>>전체</option>
                            <?php
                            if (element('camp_list', $view)) {
                                foreach (element('camp_list', $view) as $camp) {
                                    $campStatus = element('ch_close', $camp) === '마감' ? '[마감]' : '';
                                    $campDateRange = $camp['ch_start'] . ' ~ ' . $camp['ch_end'];
                                    ?>
                                    <option value="<?php echo $camp['idx']; ?>"
                                        <?php echo (element('selected_camp_idx', $view) == $camp['idx']) ? 'selected' : ''; ?>>
                                        <?php echo $campStatus . ' ' . html_escape($camp['ch_num']) . ' (' . $campDateRange . ')'; ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="input-group-btn">
                    <button type="button" class="btn btn-primary btn-sm" id="camp-search-btn">검색</button>
                </span>
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="btn-group pull-right" role="group" aria-label="...">
                        <button type="button" class="btn btn-default btn-sm btn-list-delete btn-list-selected disabled"
                                data-list-delete-url="<?php echo admin_url($this->campdir . '/delete'); ?>">선택삭제</button>
                        <button type="button" class="btn btn-primary btn-sm" id="btn-print">
                            <i class="fa fa-print"></i> 인쇄
                        </button>
                    </div>
                </div>

            </div>
        </div>


        <div class="row">전체 : <?php echo element('total_rows', element('data', $view), 0); ?>건</div>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th rowspan="2"><a href="<?php echo element('num', element('sort', $view)); ?>">번호</a></th>
                    <th rowspan="2">캠프명</th>
                    <th rowspan="2"><a href="<?php echo element('church_nm', element('sort', $view)); ?>">교회명</a></th>
                    <th rowspan="2"><a href="<?php echo element('resp_nm', element('sort', $view)); ?>">담당자</a></th>
                    <th rowspan="2"><a href="<?php echo element('position', element('sort', $view)); ?>">직분</a></th>
                    <th rowspan="2"><a href="<?php echo element('mobile', element('sort', $view)); ?>">연락처</a></th>
                    <th class="text-center"><a href="<?php echo element('total', element('sort', $view)); ?>">총인원</a></th>
                    <th class="text-center" colspan="2">목회자</th>
                    <th class="text-center" colspan="2">교사</th>
                    <th class="text-center" colspan="2">학생</th>
                    <th class="text-center">총비용</th>
                    <th class="text-center">가등록<br>입금액</th>
                    <th class="text-center">잔액</th>
                    <th rowspan="2"><a href="<?php echo element('status', element('sort', $view)); ?>">등록상태</a></th>
                    <th rowspan="2"><a href="<?php echo element('regdt', element('sort', $view)); ?>">등록일</a></th>
                    <th rowspan="2">관리</th>
                    <th rowspan="2"><input type="checkbox" name="chkall" id="chkall" /></th>
                </tr>

                <tr>
                    <?php
                    $total_all = 0;
                    $total_pastor_male = 0;
                    $total_pastor_female = 0;
                    $total_teacher_male = 0;
                    $total_teacher_female = 0;
                    $total_student_male = 0;
                    $total_student_female = 0;
                    $total_cost = 0;
                    $total_deposit = 0;

                    if (element('list', element('data', $view))) {
                        foreach (element('list', element('data', $view)) as $result) {
                            $total_pastor_male += element('pastor_male', $result);
                            $total_pastor_female += element('pastor_female', $result);
                            $total_teacher_male += element('teacher_male', $result);
                            $total_teacher_female += element('teacher_female', $result);
                            $total_student_male += element('student_male', $result);
                            $total_student_female += element('student_female', $result);

                            // 입금액 합산
                            $total_deposit += element('deposit', $result);

                            // 해당 신청의 총인원 계산
                            $person_count = element('pastor_male', $result) + element('pastor_female', $result) +
                                element('teacher_male', $result) + element('teacher_female', $result) +
                                element('student_male', $result) + element('student_female', $result);

                            // 각 신청별 캠프의 참가비를 사용하여 비용 계산
                            $total_cost += ($person_count * element('ch_pay', $result));
                        }
                    }
                        $total_all = $total_pastor_male + $total_pastor_female + $total_teacher_male +
                        $total_teacher_female + $total_student_male + $total_student_female;
                        $total_balance = $total_cost - $total_deposit; // 전체 잔액 계산
                    ?>
                    <th class="text-right"><?php echo number_format($total_all); ?></th>
                    <th class="text-right" style="width: 50px"><?php echo number_format($total_pastor_male); ?></th>
                    <th class="text-right" style="width: 50px"><?php echo number_format($total_pastor_female); ?></th>
                    <th class="text-right" style="width: 50px"><?php echo number_format($total_teacher_male); ?></th>
                    <th class="text-right" style="width: 50px"><?php echo number_format($total_teacher_female); ?></th>
                    <th class="text-right" style="width: 50px"><?php echo number_format($total_student_male); ?></th>
                    <th class="text-right" style="width: 50px"><?php echo number_format($total_student_female); ?></th>
                    <th class="text-right"><?php echo number_format($total_cost); ?></th>
                    <th class="text-right"><?php echo number_format($total_deposit); ?></th>
                    <th class="text-right"><?php echo number_format($total_balance); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (element('list', element('data', $view))) {
                    foreach (element('list', element('data', $view)) as $result) {
                        $person_count = element('pastor_male', $result) + element('pastor_female', $result) +
                            element('teacher_male', $result) + element('teacher_female', $result) +
                            element('student_male', $result) + element('student_female', $result);
                        $cost = $person_count * element('ch_pay', $result);
                        $balance = $cost - element('deposit', $result); // 개별 잔액 계산
                        ?>
                        <tr>
                            <td><?php echo number_format(element('num', $result)); ?></td>
                            <td><?php
                                // 해당 캠프 정보 가져오기
                                $camp_info = $this->Camp_model->get_one(element('refkey', $result));
                                echo html_escape(element('ch_num', $camp_info));
                                ?></td>
                            <td><?php echo html_escape(element('church_nm', $result)); ?></td>
                            <td><?php echo html_escape(element('resp_nm', $result)); ?></td>
                            <td><?php echo html_escape(element('position', $result)); ?></td>
                            <td><?php echo html_escape(element('mobile', $result)); ?></td>
                            <td class="text-right"><?php echo number_format($person_count); ?></td>
                            <td class="text-right"><?php echo number_format(element('pastor_male', $result)); ?></td>
                            <td class="text-right"><?php echo number_format(element('pastor_female', $result)); ?></td>
                            <td class="text-right"><?php echo number_format(element('teacher_male', $result)); ?></td>
                            <td class="text-right"><?php echo number_format(element('teacher_female', $result)); ?></td>
                            <td class="text-right"><?php echo number_format(element('student_male', $result)); ?></td>
                            <td class="text-right"><?php echo number_format(element('student_female', $result)); ?></td>
                            <td class="text-right"><?php echo number_format($cost); ?></td>
                            <td class="text-right"><?php echo number_format(element('deposit', $result)); ?></td>
                            <td class="text-right"><?php echo number_format($balance); ?></td>
                            <td>
                                <?php if (element('status', $result) === '완납등록') { ?>
                                    <span class="label label-success">완납등록</span>
                                <?php } else { ?>
                                    <span class="label label-warning"><?php echo element('status', $result); ?></span>
                                <?php } ?>
                            </td>
                            <td><?php echo element('regdt', $result); ?></td>

                            <td>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a href="<?php echo admin_url($this->campdir . '/write/' . element('idx', $result)); ?>" class="btn btn-outline btn-default btn-xs">수정</a>
                                        <a href="<?php echo admin_url($this->campdir . '/print/' . element('idx', $result)); ?>" class="btn btn-info btn-xs" target="_blank">인쇄</a>
                                    </span>
                                </div>
                            </td>
                            <td><input type="checkbox" name="chk[]" class="list-chkbox" value="<?php echo element('idx', $result); ?>" /></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="box-info">
            <?php echo element('paging', $view); ?>
            <div class="pull-left ml20"><?php echo admin_listnum_selectbox();?></div>
        </div>
    </div>

    <form name="fsearch" id="fsearch" action="<?php echo current_full_url(); ?>" method="get">
        <div class="box-search">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <select class="form-control" name="sfield">
                        <?php echo element('search_option', $view); ?>
                    </select>
                    <div class="input-group">
                        <input type="text" class="form-control" name="skeyword" value="<?php echo html_escape(element('skeyword', $view)); ?>" placeholder="검색어를 입력해주세요" />
                        <span class="input-group-btn">
                            <button class="btn btn-default btn-sm" name="search_submit" type="submit">검색</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>




<!-- JavaScript 코드 추가 -->
<script type="text/javascript">

    $(document).on('click', '#chkall', function() {
        if ($(this).is(':checked')) {
            $('.list-chkbox').prop('checked', true);
        } else {
            $('.list-chkbox').prop('checked', false);
        }
    });

    $(document).on('click', '.list-chkbox', function() {
        var checkCount = $('.list-chkbox:checked').length;
        if (checkCount > 0) {
            $('.btn-list-selected').removeClass('disabled');
        } else {
            $('.btn-list-selected').addClass('disabled');
        }
    });
    $(document).ready(function() {

        // 페이지 로드 시 기본값 설정

        /*
        if (!$('#ch_close').val()) {
            $('#ch_close').val('접수중');
        }*/



        // 검색 버튼 클릭 이벤트
        $('#camp-search-btn').click(function() {
            var selectedCamp = $('#camp_select').val();
            var selectedStatus = $('#ch_close').val();
            var selectedYear = $('#ch_year').val();
            var selectedSeason = $('#ch_season').val();
            var url = '<?php echo admin_url($this->campdir); ?>?';

            if (selectedStatus) {
                //params.push('ch_close=' + encodeURIComponent(selectedStatus));
                url += 'ch_close=' + selectedStatus;
            }

            // 년도 조건 추가
            if (selectedYear) {
                url += '&ch_year=' + selectedYear;
            }

            // 계절 조건 추가
            if (selectedSeason) {
                url += '&ch_season=' + encodeURIComponent(selectedSeason);
            }

            // 캠프 선택 조건 추가
            if (selectedCamp && selectedCamp !== 'all') {
                url += '&camp_idx=' + selectedCamp;
            }

            if (selectedCamp === 'all') {
                $('.alert-info').hide();
            } else {
                $('.alert-info').show();
            }

            window.location.href = url;
        });


        // 페이지 로드 시 전체 선택 상태면 alert-info 숨김
        if ($('#camp_select').val() === 'all') {
            $('.alert-info').hide();
        }

        // 체크박스 관련 스크립트
        $(document).on('click', '#chkall', function() {
            if ($(this).is(':checked')) {
                $('.list-chkbox').prop('checked', true);
            } else {
                $('.list-chkbox').prop('checked', false);
            }
        });

        $(document).on('click', '.list-chkbox', function() {
            var checkCount = $('.list-chkbox:checked').length;
            if (checkCount > 0) {
                $('.btn-list-selected').removeClass('disabled');
            } else {
                $('.btn-list-selected').addClass('disabled');
            }
        });




        // 인쇄 버튼 클릭 이벤트
        $('#btn-print').click(function() {
            var printContents = $('.table-responsive').clone();

            // 인쇄 스타일 정의
            var printStyles = `
            <style>
                @media print {
                    @page {
                        size: landscape;
                        margin: 10mm;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        font-size: 12px;
                    }
                    th, td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f5f5f5;
                    }
       /* 목회자, 교사, 학생 열의 너비 설정 */
       th[width="30"], td[width="30"] {
           width: 30px !important;
           max-width: 30px !important;
           min-width: 30px !important;
       }
       /* 번호 열 너비 */
       th:first-child, td:first-child {
           width: 50px;
       }
      /* 캠프명 열 너비 */
       th:nth-child(2), td:nth-child(2) {
           width: 120px;
       }
       /* 교회명 열 너비 */
       th:nth-child(3), td:nth-child(3) {
           width: 120px;
       }
                    .btn-outline {
                        display: none;
                    }
                    .list-chkbox {
                        display: none;
                    }
                    input[type="checkbox"] {
                        display: none;
                    }
                    .label {
                        padding: 2px 5px;
                        border-radius: 3px;
                    }
                    .label-success {
                        background-color: #5cb85c;
                        color: white;
                    }
                    .label-warning {
                        background-color: #f0ad4e;
                        color: white;
                    }
                    .text-right {
                        text-align: right;
                    }
                }
            </style>
        `;

            // 새 창에서 인쇄
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>인쇄</title>');
            printWindow.document.write(printStyles);
            printWindow.document.write('</head><body>');

            // 현재 선택된 캠프 정보 추가
            var selectedCamp = $('#camp_select option:selected').text();
            if (selectedCamp && selectedCamp !== '전체') {
                printWindow.document.write('<h3>캠프: ' + selectedCamp + '</h3>');
            }

            // 테이블 내용 추가
            printWindow.document.write(printContents.html());
            printWindow.document.write('</body></html>');

            printWindow.document.close();

            // 잠시 대기 후 인쇄 실행 (컨텐츠가 모두 로드되도록)
            setTimeout(function() {
                printWindow.print();
                // 인쇄 후 창 닫기
                printWindow.close();
            }, 500);
        });


    });

</script>