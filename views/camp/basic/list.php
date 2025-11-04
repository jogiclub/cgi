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
                    <th>참가비</th>
                    <th>프로그램</th>
                    <th>시간표</th>
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
                                <div class="d-flex align-items-center gap-2">
                                    <?php if(element('ch_link', $result)){ ?>
                                        <a href="<?php echo element('ch_link', $result); ?>" target="_blank">
                                            <?php echo html_escape(element('ch_place', $result)); ?>
                                        </a>
                                    <?php } else {?>
                                        <?php echo html_escape(element('ch_place', $result)); ?>
                                    <?php } ?>

                                    <?php if(element('ch_addr', $result)){ ?>
                                        <a href="#" class="btn btn-sm btn-outline-secondary btn-map"
                                           data-address="<?php echo html_escape(element('ch_addr', $result)); ?>"
                                           title="<?php echo html_escape(element('ch_addr', $result)); ?>">
                                            지도
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                            <td style="text-align: right"><?php echo number_format(element('ch_pay', $result)); ?></td>
                            <td>
                                <?php if(element('ch_etc_pro', $result)){ ?>
                                    <button type="button" class="btn btn-sm btn-info btn-program"
                                            data-program="<?php echo htmlspecialchars(element('ch_etc_pro', $result), ENT_QUOTES, 'UTF-8'); ?>"
                                            data-camp-name="<?php echo html_escape(element('ch_num', $result)); ?>">
                                        프로그램
                                    </button>
                                <?php } else { ?>
                                    <span class="text-muted">-</span>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if(element('ch_schedule', $result)){ ?>
                                    <button type="button" class="btn btn-sm btn-success btn-schedule"
                                            data-schedule="<?php echo base_url('uploads/camp/'.element('ch_schedule', $result)); ?>"
                                            data-camp-name="<?php echo html_escape(element('ch_num', $result)); ?>">
                                        시간표
                                    </button>
                                <?php } else { ?>
                                    <span class="text-muted">-</span>
                                <?php } ?>
                            </td>
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
                        <td colspan="10" class="text-center">등록된 캠프가 없습니다</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 안내 사항 -->
    <div class="card mt-4 mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">겨울부터 크게 달라지는 세 가지</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="info-section">
                        <h6 class="fw-bold text-primary">첫째, 뉴주일학교 운동 선포</h6>

                        <div class="text-center">
                            <img src="<?php echo base_url('./assets/images/2026_winter/sub_03.jpg'); ?>"
                                 alt="뉴주일학교 운동"
                                 class="img-fluid rounded"
                                 style="max-height: 200px; object-fit: cover;">
                        </div>

                        <p class="mb-3">
                            2026년을 주일학교 재 부흥의 원년으로 하나님께서 선포하라 하셨고 이를 위해
                            1월 17일 수도권, 24일 경주, 31일 뉴선데이스쿨 세미나를 무료로 개최합니다.
                        </p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="info-section">
                        <h6 class="fw-bold text-success">둘째, 문닫는 주일학교 재건</h6>
                        <div class="text-center">
                            <img src="<?php echo base_url('./assets/images/2026_winter/sub_02.jpg'); ?>"
                                 alt="주일학교 재건"
                                 class="img-fluid rounded"
                                 style="max-height: 200px; object-fit: cover;">
                        </div>
                        <p class="mb-3">
                            작은교회(미자립교회에 대한 섬김)가 어캠에 참여할 시
                            참가비에서 50%를 지원하고 그 지원금은 후원이사, 그리고
                            대구침산동부를 비롯한 일천반사님들의 후원금으로 합니다.
                        </p>

                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="info-section">
                        <h6 class="fw-bold text-info">셋째, 한끼 금식기도 비용은 태국어캠 개최</h6>
                        <div class="text-center">
                            <img src="<?php echo base_url('./assets/images/2026_winter/sub_01.jpg'); ?>"
                                 alt="태국어캠"
                                 class="img-fluid rounded"
                                 style="max-height: 200px; object-fit: cover;">
                        </div>
                        <p class="mb-3">
                            또한 금식기도의 한끼 금액은(8,000~12,000원)
                            태국어캠에 사용됨을 명시합니다.
                        </p>

                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="thailand-camp-info">
                <h6 class="fw-bold text-danger mb-3">태국어캠 제2회는 2025년 3월 22일~27일간 진행 됩니다.</h6>

                <div class="contact-info mb-4">
                    <p class="mb-2"><strong>키즈처치리바이벌</strong></p>
                    <p class="mb-0">대표 박연훈 목사 <a href="tel:010-2281-8000">010-2281-8000</a></p>
                </div>

                <div class="past-event-info bg-light p-3 rounded">
                    <h6 class="fw-bold mb-3">제1회 태국어캠 살펴 보기</h6>
                    <ul class="list-unstyled mb-3">
                        <li><strong>일시:</strong> 2024년 3월 16일(주일)~21일(금)</li>
                        <li><strong>장소:</strong> 태국 치앙라이</li>
                    </ul>

                    <div class="video-links">
                        <p class="mb-2"><strong>영상 보기</strong></p>
                        <ul class="list-unstyled d-flex justify-content-start">
                            <li class="mb-2">
                                <a href="https://www.youtube.com/shorts/NOVZtZP3VRY" target="_blank" class="btn btn-sm btn-outline-danger">
                                    <i class="fab fa-youtube"></i> 영상워십 공연
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="https://www.youtube.com/shorts/qCnnvB0oxBQ" target="_blank" class="btn btn-sm btn-outline-danger">
                                    <i class="fab fa-youtube"></i> 몸찬양 경연대회
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="https://www.youtube.com/shorts/FwR9ja7qcys" target="_blank" class="btn btn-sm btn-outline-danger">
                                    <i class="fab fa-youtube"></i> 인형극
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="alert alert-info mt-3" role="alert">
                    <strong>제2회 태국어캠</strong><br>
                    일시: 2025년 3월 22일~27일<br>
                    동참 문의: 박연훈 목사 <a href="tel:010-2281-8000" class="alert-link">010-2281-8000</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 프로그램 소개 모달 -->
<div class="modal fade" id="programModal" tabindex="-1" role="dialog" aria-labelledby="programModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="programModalLabel">프로그램 소개</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="programContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>

<!-- 시간표 모달 -->
<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">시간표</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="scheduleImage" src="" alt="시간표" class="img-fluid" style="max-width: 100%;">
            </div>
            <div class="modal-footer">
                <a id="scheduleDownload" href="" download class="btn btn-primary">
                    <i class="fas fa-download"></i> 다운로드
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>

<style>
    #programContent {
        padding: 20px;
        line-height: 1.8;
    }

    #programContent h2 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #dee2e6;
    }

    #programContent h3 {
        font-size: 1.3rem;
        font-weight: bold;
        margin-top: 15px;
        margin-bottom: 10px;
    }

    #programContent h4 {
        font-size: 1.1rem;
        font-weight: bold;
        margin-top: 10px;
        margin-bottom: 8px;
    }

    #programContent ul,
    #programContent ol {
        margin-left: 20px;
        margin-bottom: 15px;
    }

    #programContent li {
        margin-bottom: 8px;
        list-style: circle;
    }

    #programContent p {
        margin-bottom: 15px;
    }

    #programContent blockquote {
        border-left: 4px solid #0d6efd;
        padding-left: 15px;
        margin: 20px 0;
        color: #6c757d;
        font-style: italic;
    }

    #programContent table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    #programContent table th,
    #programContent table td {
        border: 1px solid #dee2e6;
        padding: 10px;
        text-align: left;
    }

    #programContent table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    #programContent hr {
        margin: 30px 0;
        border: 0;
        border-top: 1px solid #dee2e6;
    }

    .d-flex {
        display: flex;
    }

    .align-items-center {
        align-items: center;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    .btn-map {
        white-space: nowrap;
    }

    .info-section {
        height: 100%;
        padding: 15px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        background-color: #f8f9fa;
    }

    .info-section h6 {
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #dee2e6;
    }

    .thailand-camp-info {
        margin-top: 20px;
    }

    .video-links .btn {
        margin-right: 10px;
    }

    .contact-info {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        border-left: 4px solid #0d6efd;
    }

    .past-event-info {
        border-left: 4px solid #ffc107;
    }
</style>

<script>
    $(document).ready(function () {
        // 지도 버튼 클릭
        $('.btn-map').click(function (e) {
            e.preventDefault();

            var address = $(this).data('address');

            if (address) {
                var naverMapUrl = 'https://map.naver.com/p/search/' + encodeURIComponent(address);
                window.open(naverMapUrl, '_blank');
            }
        });

        // 프로그램 버튼 클릭
        $('.btn-program').click(function () {
            var programDataString = $(this).data('program');
            var campName = $(this).data('camp-name');

            $('#programModalLabel').text(campName + ' - 프로그램 소개');

            try {
                var editorData;
                if (typeof programDataString === 'string') {
                    editorData = JSON.parse(programDataString);
                } else {
                    editorData = programDataString;
                }

                var htmlContent = renderEditorJsToHtml(editorData);
                $('#programContent').html(htmlContent);
            } catch (e) {
                console.error('프로그램 데이터 파싱 오류:', e);
                console.log('원본 데이터:', programDataString);
                $('#programContent').html('<p class="text-danger">프로그램 정보를 불러올 수 없습니다.</p>');
            }

            $('#programModal').modal('show');
        });

        // 시간표 버튼 클릭
        $('.btn-schedule').click(function () {
            var scheduleUrl = $(this).data('schedule');
            var campName = $(this).data('camp-name');

            $('#scheduleModalLabel').text(campName + ' - 시간표');
            $('#scheduleImage').attr('src', scheduleUrl);
            $('#scheduleDownload').attr('href', scheduleUrl);

            $('#scheduleModal').modal('show');
        });

        // 빠른예약 버튼 클릭
        $('.btn-reserve').click(function (e) {
            e.preventDefault();

            var campId = $(this).data('camp-id');
            var campName = $(this).data('camp-name');

            console.log('Selected camp ID:', campId);
            console.log('Selected camp name:', campName);

            window.selectedCampId = campId;
            window.selectedCampName = campName;

            $('#reserveModal').modal('show');
        });

        // Editor.js 데이터를 HTML로 변환하는 함수
        function renderEditorJsToHtml(data) {
            if (!data || !data.blocks) {
                return '<p class="text-muted">프로그램 소개가 없습니다.</p>';
            }

            var html = '';

            data.blocks.forEach(function(block) {
                switch(block.type) {
                    case 'header':
                        var level = block.data.level || 2;
                        html += '<h' + level + '>' + decodeHtmlEntities(block.data.text) + '</h' + level + '>';
                        break;

                    case 'paragraph':
                        var text = block.data.text || '';
                        text = text.replace(/&nbsp;/g, ' ');
                        if (text.trim()) {
                            html += '<p>' + decodeHtmlEntities(text) + '</p>';
                        }
                        break;

                    case 'list':
                        var listTag = block.data.style === 'ordered' ? 'ol' : 'ul';
                        html += '<' + listTag + '>';
                        block.data.items.forEach(function(item) {
                            var itemText = item.replace(/&nbsp;/g, ' ');
                            html += '<li>' + decodeHtmlEntities(itemText) + '</li>';
                        });
                        html += '</' + listTag + '>';
                        break;

                    case 'quote':
                        html += '<blockquote>';
                        html += '<p>' + decodeHtmlEntities(block.data.text) + '</p>';
                        if (block.data.caption) {
                            html += '<footer>' + decodeHtmlEntities(block.data.caption) + '</footer>';
                        }
                        html += '</blockquote>';
                        break;

                    case 'delimiter':
                        html += '<hr>';
                        break;

                    case 'table':
                        html += '<table class="table table-bordered">';
                        block.data.content.forEach(function(row, rowIndex) {
                            var tag = rowIndex === 0 && block.data.withHeadings ? 'th' : 'td';
                            html += '<tr>';
                            row.forEach(function(cell) {
                                html += '<' + tag + '>' + decodeHtmlEntities(cell) + '</' + tag + '>';
                            });
                            html += '</tr>';
                        });
                        html += '</table>';
                        break;

                    default:
                        console.warn('Unknown block type:', block.type);
                }
            });

            return html;
        }

        // HTML 엔티티 디코딩 함수
        function decodeHtmlEntities(text) {
            if (!text) return '';
            var textArea = document.createElement('textarea');
            textArea.innerHTML = text;
            return textArea.value;
        }
    });
</script>