<?php
$version = date("YmdHis", time());
$this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css?'.$version); ?>

<?php echo element('headercontent', element('board', element('list', $view))); ?>

    <div class="board">
        <h3 class="mb-3"><?php echo html_escape(element('board_name', element('board', element('list', $view)))); ?></h3>

        <style>
            .calendar-cell {
                height: 120px;
                overflow-y: auto;
            }
            .calendar-cell:hover {
                background-color: rgba(0,0,0,0.05);
            }
            .post-item {
                font-size: 0.8rem;
                margin-bottom: 2px;
                padding: 2px 4px;
                border-radius: 3px;
                background-color: #e3f2fd;
                cursor: pointer;
            }
            .post-item:hover {
                background-color: #bbdefb;
            }
            .date-number {
                font-weight: bold;
                margin-bottom: 5px;
            }
            .calendar-header {
                background-color: #f8f9fa;
            }
            .today {
                background-color: #fff3cd;
            }
            .other-month {
                background-color: #f8f9fa;
                color: #6c757d;
            }
        </style>

        <div class="row mb-3">
            <div class="col">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <button class="btn btn-outline-secondary me-2" id="prevYear">
                            <i class="bi bi-chevron-double-left"></i>
                        </button>
                        <button class="btn btn-outline-secondary" id="prevMonth">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                    </div>
                    <h2 class="mb-0" id="currentMonth"></h2>
                    <div>
                        <button class="btn btn-outline-secondary me-2" id="nextMonth">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                        <button class="btn btn-outline-secondary" id="nextYear">
                            <i class="bi bi-chevron-double-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                    <tr class="text-center calendar-header">
                        <th class="text-danger">일</th>
                        <th>월</th>
                        <th>화</th>
                        <th>수</th>
                        <th>목</th>
                        <th>금</th>
                        <th class="text-primary">토</th>
                    </tr>
                    </thead>
                    <tbody id="calendarBody">
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-4">
                <?php if (element('is_admin', $view)) { ?>
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-gear"></i> 관리
                    </button>
                    <ul class="dropdown-menu">
                        <?php if (element('is_admin', $view) === 'super') { ?>
                            <li class="dropdown-item" onClick="document.location.href='<?php echo admin_url('board/boards/write/' . element('brd_id', element('board', element('list', $view)))); ?>';"><i class="bi bi-sliders2-vertical"></i> 게시판설정</li>
                            <li class="dropdown-item" onClick="post_multi_copy('copy');"><i class="bi bi-copy"></i> 복사하기</li>
                            <li class="dropdown-item" onClick="post_multi_copy('move');"><i class="bi bi-box-arrow-right"></i> 이동하기</li>
                            <li class="dropdown-item" onClick="post_multi_change_category();"><i class="bi bi-tags"></i> 카테고리변경</li>
                        <?php } ?>
                        <li class="dropdown-item" onClick="post_multi_action('multi_delete', '0', '선택하신 글들을 완전삭제하시겠습니까?');"><i class="bi bi-trash"></i> 선택삭제하기</li>
                    </ul>
                <?php } ?>
            </div>
            <div class="col-sm-4">
                <form class="input-group" action="<?php echo board_url(element('brd_key', element('board', element('list', $view)))); ?>" onSubmit="return postSearch(this);">
                    <input type="hidden" name="findex" value="<?php echo html_escape($this->input->get('findex')); ?>" />
                    <input type="hidden" name="category_id" value="<?php echo html_escape($this->input->get('category_id')); ?>" />
                    <select class="form-select" name="sfield">
                        <option value="post_both" <?php echo ($this->input->get('sfield') === 'post_both') ? ' selected="selected" ' : ''; ?>>제목+내용</option>
                        <option value="post_title" <?php echo ($this->input->get('sfield') === 'post_title') ? ' selected="selected" ' : ''; ?>>제목</option>
                        <option value="post_content" <?php echo ($this->input->get('sfield') === 'post_content') ? ' selected="selected" ' : ''; ?>>내용</option>
                        <option value="post_nickname" <?php echo ($this->input->get('sfield') === 'post_nickname') ? ' selected="selected" ' : ''; ?>>회원명</option>
                    </select>
                    <input type="text" class="form-control" placeholder="Search" name="skeyword" value="<?php echo html_escape($this->input->get('skeyword')); ?>" />
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="col-sm-4 text-end">
                <?php if (element('write_url', element('list', $view))) { ?>
                    <a href="<?php echo element('write_url', element('list', $view)); ?>" class="btn btn-success">글쓰기</a>
                <?php } ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            let currentDate = new Date();

            // PHP에서 게시글 데이터 가져오기
            const posts = <?php
                $post_list = array();
                if (element('list', element('data', element('list', $view)))) {
                    foreach (element('list', element('data', element('list', $view))) as $result) {
                        $post_list[] = array(
                            'id' => element('post_id', $result),
                            'date' => element('extra_date', element('extra_vars', $result)), // date 필드
                            'title' => html_escape(element('title', $result)),
                            'url' => element('post_url', $result)
                        );
                    }
                }
                echo json_encode($post_list);
                ?>;

            function updateCalendar() {
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();

                // 현재 월 표시 업데이트
                $('#currentMonth').text(`${year}년 ${month + 1}월`);

                // 달력 본문 생성
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const firstDayWeek = firstDay.getDay();
                const totalDays = lastDay.getDate();

                let calendarHtml = '';
                let day = 1;

                // 주 단위로 행 생성
                for (let i = 0; i < 6; i++) {
                    if (day > totalDays) break;

                    calendarHtml += '<tr>';

                    // 요일 단위로 열 생성
                    for (let j = 0; j < 7; j++) {
                        if ((i === 0 && j < firstDayWeek) || day > totalDays) {
                            calendarHtml += '<td class="calendar-cell other-month"></td>';
                        } else {
                            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                            const dayPosts = posts.filter(post => post.date === dateStr);

                            const today = new Date();
                            const isToday = today.getDate() === day &&
                                today.getMonth() === month &&
                                today.getFullYear() === year;

                            calendarHtml += `
                        <td class="calendar-cell ${isToday ? 'today' : ''}">
                            <div class="date-number ${j === 0 ? 'text-danger' : j === 6 ? 'text-primary' : ''}">${day}</div>
                            ${dayPosts.map(post => `
                                <div class="post-item" onclick="location.href='${post.url}'">
                                    ${post.title}
                                </div>
                            `).join('')}
                        </td>
                    `;
                            day++;
                        }
                    }
                    calendarHtml += '</tr>';
                }

                $('#calendarBody').html(calendarHtml);
            }

            // 이전/다음 월 버튼 이벤트
            $('#prevMonth').click(() => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                updateCalendar();
            });

            $('#nextMonth').click(() => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                updateCalendar();
            });

            // 이전/다음 년 버튼 이벤트
            $('#prevYear').click(() => {
                currentDate.setFullYear(currentDate.getFullYear() - 1);
                updateCalendar();
            });

            $('#nextYear').click(() => {
                currentDate.setFullYear(currentDate.getFullYear() + 1);
                updateCalendar();
            });

            // 초기 달력 생성
            updateCalendar();
        });
    </script>

<?php echo element('footercontent', element('board', element('list', $view))); ?>

<?php
if (element('highlight_keyword', element('list', $view))) {
    $this->managelayout->add_js(base_url('assets/js/jquery.highlight.js')); ?>
    <script type="text/javascript">
        //<![CDATA[
        $('#fboardlist').highlight([<?php echo element('highlight_keyword', element('list', $view));?>]);
        //]]>
    </script>
<?php } ?>