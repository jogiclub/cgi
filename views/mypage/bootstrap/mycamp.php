<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="mypage">
    <!-- 이전 네비게이션 코드는 동일 -->

    <div class="page-header">
        <h4>나의 캠프 신청내역</h4>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>캠프이름</th>
            <th>시작일</th>
            <th>종료일</th>
            <th>장소</th>
            <th>남목회자</th>
            <th>여목회자</th>
            <th>남교사</th>
            <th>여교사</th>
            <th>남학생</th>
            <th>여학생</th>
            <th>가등록 입금액</th>
            <th>얼리버드</th>
            <th>상태</th>
            <th>저장</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (element('list', element('data', $view))) {
            foreach (element('list', element('data', $view)) as $result) {
                ?>
                <tr>
                    <form class="camp-update-form" method="post">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        <input type="hidden" name="idx" value="<?php echo element('idx', $result); ?>">
                        <td><?php echo element('ch_num', $result); ?></td>
                        <td><?php echo element('ch_start', $result); ?></td>
                        <td><?php echo element('ch_end', $result); ?></td>
                        <td><?php echo element('ch_place', $result); ?></td>
                        <td><input type="number" class="form-control form-control-sm" name="pastor_male" value="<?php echo element('pastor_male', $result); ?>" min="0"></td>
                        <td><input type="number" class="form-control form-control-sm" name="pastor_female" value="<?php echo element('pastor_female', $result); ?>" min="0"></td>
                        <td><input type="number" class="form-control form-control-sm" name="teacher_male" value="<?php echo element('teacher_male', $result); ?>" min="0"></td>
                        <td><input type="number" class="form-control form-control-sm" name="teacher_female" value="<?php echo element('teacher_female', $result); ?>" min="0"></td>
                        <td><input type="number" class="form-control form-control-sm" name="student_male" value="<?php echo element('student_male', $result); ?>" min="0"></td>
                        <td><input type="number" class="form-control form-control-sm" name="student_female" value="<?php echo element('student_female', $result); ?>" min="0"></td>
                        <td><?php echo element('deposit', $result); ?></td>
                        <td></td>
                        <td><?php echo element('status', $result); ?></td>
                        <td><button type="submit" class="btn btn-sm btn-primary">저장</button></td>
                    </form>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="14" class="text-center nopost">신청하신 캠프가 없습니다</td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <nav><?php echo element('paging', $view); ?></nav>
</div>

<script>
    $(document).ready(function() {
        $('.camp-update-form').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var data = form.serialize();

            $.ajax({
                url: '<?php echo site_url('mypage/update_camp'); ?>',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        alert('저장되었습니다.');
                    } else {
                        alert(response.message || '저장에 실패했습니다.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('저장 중 오류가 발생했습니다.');
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>