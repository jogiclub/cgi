<div class="container">
    <?php
    echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
    ?>

    <h3>빠른예약</h3>

    <div class="panel panel-default">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>번호</th>
                    <th>캠프번호</th>
                    <th>시작일</th>
                    <th>종료일</th>
                    <th>지역</th>
                    <th>장소</th>
                    <th>주소</th>
<!--                    <th>연락처</th>-->
                    <th>참가비</th>
                    <th>빠른예약</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (element('list', element('data', $view))) {
                    foreach (element('list', element('data', $view)) as $result) {
                        ?>
                        <tr>
                            <td>
                                <?php echo number_format(element('num', $result)); ?>
                            </td>
                            <td>
                                <?php
                                if (element('icon', $result) == '1') {
                                    echo '<span class="badge bg-warning">절찬접수</span>';
                                } else if (element('icon', $result) == '2') {
                                    echo '<span class="badge bg-success">인기</span>';
                                } else if (element('icon', $result) == '3') {
                                    echo '<span class="badge bg-danger">마감임박</span>';
                                } else {
                                    echo '<span class="badge bg-secondary">마감</span>';
                                }
                                ?>
                                <?php echo html_escape(element('ch_num', $result)); ?>
                            </td>
                            <td><?php echo element('ch_start', $result); ?></td>
                            <td><?php echo element('ch_end', $result); ?></td>
                            <td><?php echo element('ch_location', $result); ?></td>
                            <td>
                                <?php if(element('ch_link', $result)){ ?>
                                    <a href="<?php echo element('ch_link', $result); ?>" target="_blank">
                                        <?php echo html_escape(element('ch_place', $result)); ?>
                                    </a>
                                <?php } else {?>
                                    <?php echo html_escape(element('ch_place', $result)); ?>
                                <?php } ?>
                            </td>
                            <td><?php echo html_escape(element('ch_addr', $result)); ?></td>
<!--                            <td>--><?php //echo html_escape(element('ch_tel', $result)); ?><!--</td>-->
                            <td style="text-align: right"><?php echo number_format(element('ch_pay', $result)); ?></td>
                            <td>
                                <a href="#" class="btn-reserve btn btn-sm btn-primary"
                                   data-camp-id="<?php echo element('idx', $result); ?>"
                                   data-camp-name="<?php echo html_escape(element('ch_num', $result)) . ' - ' . html_escape(element('ch_place', $result)); ?>">
                                    빠른예약
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                if ( ! element('list', element('data', $view))) {
                    ?>
                    <tr>
                        <td colspan="9" class="text-center">등록된 캠프가 없습니다</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<script>
    $(document).ready(function () {
        // 빠른예약 버튼 클릭 시
        $('.btn-reserve').click(function (e) {
            e.preventDefault();

            // 선택한 캠프 정보 설정
            var campId = $(this).data('camp-id');
            var campName = $(this).data('camp-name');

            console.log('Selected camp ID:', campId);
            console.log('Selected camp name:', campName);

            // 전역 변수로 선택된 캠프 정보 저장
            window.selectedCampId = campId;
            window.selectedCampName = campName;

            // 모달 표시
            $('#reserveModal').modal('show');
        });
    });
</script>