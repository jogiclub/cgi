<div class="box">
    <div class="box-table">
        <?php
        if ($this->session->flashdata('message')) {
            echo '<div class="alert alert-success">' . $this->session->flashdata('message') . '</div>';
        }
        ?>

        <?php if (element('camp_info', $view)) { ?>
            <div class="alert alert-info">
                캠프명: <?php echo html_escape(element('ch_num', element('camp_info', $view))); ?><br>
                기간: <?php echo html_escape(element('ch_start', element('camp_info', $view))); ?> ~
                <?php echo html_escape(element('ch_end', element('camp_info', $view))); ?>
            </div>
        <?php } ?>

        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>번호</th>
                    <th>교회명</th>
                    <th>담임목사</th>
                    <th>담당자</th>
                    <th>연락처</th>
                    <th>총인원</th>
                    <th>등록상태</th>
                    <th>등록일</th>
                    <th>관리</th>  <!-- New column -->
                </tr>
                </thead>
                <tbody>
                <?


                if (element('list', element('data', $view))) {
                    foreach (element('list', element('data', $view)) as $result) {
                        ?>
                        <tr>
                            <td><?php echo number_format(element('num', $result)); ?></td>
                            <td><?php echo html_escape(element('church_nm', $result)); ?></td>
                            <td><?php echo html_escape(element('damim_nm', $result)); ?></td>
                            <td><?php echo html_escape(element('resp_nm', $result)); ?></td>
                            <td><?php echo html_escape(element('mobile', $result)); ?></td>
                            <td><?php
                                $total = element('pastor_male', $result) +
                                    element('pastor_female', $result) +
                                    element('teacher_male', $result) +
                                    element('teacher_female', $result) +
                                    element('student_male', $result) +
                                    element('student_female', $result);
                                echo number_format($total);
                                ?></td>
                            <td><span class="badge bg-<?php echo element('status', $result) === '완납등록' ? 'success' : 'warning'; ?>"><?php echo element('status', $result); ?></span></td>
                            <td><?php echo element('regdt', $result); ?></td>
                            <td>
                                <a href="<?php echo admin_url($this->campdir . '/write/' . element('idx', $result)); ?>"
                                   class="btn  btn-outline-primary">수정</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                if (!element('list', element('data', $view))) {
                    ?>
                    <tr>
                        <td colspan="8" class="text-center">등록된 신청자가 없습니다</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="box-info">
            <?php echo element('paging', $view); ?>
            <div class="pull-left ml-3"><?php echo admin_listnum_selectbox();?></div>
        </div>
    </div>

    <form name="fsearch" id="fsearch" action="<?php echo current_full_url(); ?>" method="get" class="mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group">
                    <select class="form-select" name="sfield" style="width: auto;">
                        <?php echo element('search_option', $view); ?>
                    </select>
                    <input type="text" class="form-control" name="skeyword" value="<?php echo html_escape(element('skeyword', $view)); ?>" placeholder="검색어를 입력해주세요" />
                    <button class="btn btn-secondary" type="submit">검색</button>
                </div>
            </div>
        </div>
    </form>
</div>