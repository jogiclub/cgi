
<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="container">
    <h3>캠프 목록</h3>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>번호</th>
                <th>캠프번호</th>
                <th>시작일</th>
                <th>종료일</th>
                <th>장소</th>
                <th>주소</th>
                <th>연락처</th>
                <th>링크</th>
                <th>마감여부</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (element('list', element('data', $view))) {
                foreach (element('data', $view) as $result) {
                    ?>
                    <tr>
                        <td><?php echo element('idx', $result); ?></td>
                        <td><?php echo element('ch_num', $result); ?></td>
                        <td><?php echo element('ch_start', $result); ?></td>
                        <td><?php echo element('ch_end', $result); ?></td>
                        <td><?php echo element('ch_place', $result); ?></td>
                        <td><?php echo element('ch_addr', $result); ?></td>
                        <td><?php echo element('ch_tel', $result); ?></td>
                        <td>
                            <?php if(element('ch_link', $result)): ?>
                                <a href="<?php echo element('ch_link', $result); ?>" target="_blank" class="btn btn-sm btn-primary">링크</a>
                            <?php endif; ?>
                        </td>
                        <td><?php echo element('ch_close', $result); ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="9" class="text-center">등록된 캠프가 없습니다.</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="text-center">
        <?php echo element('paging', $view); ?>
    </div>
</div>