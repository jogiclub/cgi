<div class="box">
    <div class="box-table">
        <?php
        echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
        $attributes = array('class' => 'form-inline', 'name' => 'flist', 'id' => 'flist');
        echo form_open(current_full_url(), $attributes);
        ?>
        <div class="box-table-header">
            <div class="btn-group float-end" role="group">
                <!-- 전체목록 버튼 제거 -->
                <a href="<?php echo element('write_url', $view); ?>" class="btn btn-primary">캠프등록</a>
            </div>
            <div class="btn-group btn-group-sm me-2" role="group">
                <!-- 전체캠프 버튼 제거 -->
                <a href="?ch_close=N" class="btn <?php echo ($this->input->get('ch_close') === 'N') ? 'btn-success' : 'btn-secondary'; ?>">진행중</a>
                <a href="?ch_close=Y" class="btn <?php echo ($this->input->get('ch_close') === 'Y') ? 'btn-success' : 'btn-secondary'; ?>">마감</a>
            </div>
        </div>
        <div class="row mb-2">전체 : <?php echo element('total_rows', element('data', $view), 0); ?>건</div>
        <div class="table table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th><a href="<?php echo element('idx', element('sort', $view)); ?>">번호</a></th>
                        <th><a href="<?php echo element('ch_num', element('sort', $view)); ?>">캠프명</a></th>
                        <th><a href="<?php echo element('ch_location', element('sort', $view)); ?>">지역</a></th>
                        <th><a href="<?php echo element('ch_place', element('sort', $view)); ?>">장소</a></th>
                        <th><a href="<?php echo element('ch_start', element('sort', $view)); ?>">시작일</a></th>
                        <th><a href="<?php echo element('ch_end', element('sort', $view)); ?>">종료일</a></th>
                        <th>참가비</th>
                        <th>신청현황</th>
                        <th><a href="<?php echo element('icon', element('sort', $view)); ?>">아이콘</a></th>
                        <th>관리</th>
                        <th><input type="checkbox" name="chkall" id="chkall" /></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (element('list', element('data', $view))) {
                        foreach (element('list', element('data', $view)) as $result) {
                    ?>
                        <tr>
                            <td><?php echo number_format(element('num', $result)); ?></td>
                            <td><?php echo html_escape(element('ch_num', $result)); ?></td>
                            <td><?php echo html_escape(element('ch_location', $result)); ?></td>
                            <td><?php echo html_escape(element('ch_place', $result)); ?></td>
                            <td><?php echo element('ch_start', $result); ?></td>
                            <td><?php echo element('ch_end', $result); ?></td>
                            <td class="text-end"><?php echo number_format(element('ch_pay', $result)); ?>원</td>
                            <td class="text-center">
                                <a href="<?php echo admin_url('camp/apply/index/' . element(element('primary_key', $view), $result)); ?>" class="btn btn-link">
                                    <?php
                                    $total = element('ch_to', $result);
                                    $current = element('ch_cur_num', $result);
                                    echo $current . '/' . $total;
                                    ?>
                                </a>
                            </td>
                            <td>
                                <?php
                                if (element('icon', $result) == '1') {
                                    echo '<span class="badge bg-danger">절찬접수</span>';
                                } else if (element('icon', $result) == '2') {
                                    echo '<span class="badge bg-danger">인기</span>';
                                } else if (element('icon', $result) == '3') {
                                    echo '<span class="badge bg-danger">마감임박</span>';
                                } else {
                                    echo '<span class="badge bg-success">마감</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo admin_url($this->pagedir); ?>/camp/camp_list/write/<?php echo element(element('primary_key', $view), $result); ?>?<?php echo $this->input->server('QUERY_STRING', null, ''); ?>" class="btn btn-sm btn-secondary ">수정</a>
                                <button type="button" class="btn btn-info btn-sm copy-btn" data-camp-id="<?php echo element(element('primary_key', $view), $result); ?>">복사</button>
                            </td>
                            <td><input type="checkbox" name="chk[]" class="list-chkbox" value="<?php echo element(element('primary_key', $view), $result); ?>" /></td>
                        </tr>
                            <?php
                        }
                    }
                    if ( ! element('list', element('data', $view))) {
                        ?>
                        <tr>
                            <td colspan="11" class="text-center">등록된 캠프가 없습니다</td>
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
    <?php echo form_close(); ?>

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



<script>

        $(function() {
        $('.copy-btn').click(function() {
            if (confirm('해당 캠프를 복사하시겠습니까?')) {
                $.ajax({
                    url: '<?php echo admin_url($this->campdir); ?>/copy/' + $(this).data('camp-id'),
                    type: 'POST',
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            alert('복사되었습니다.');
                            location.reload();
                        }
                    }
                });
            }
        });
    });

</script>