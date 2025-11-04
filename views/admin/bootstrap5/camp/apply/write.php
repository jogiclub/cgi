<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">캠프 신청 정보 수정</h3>
    </div>

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

    <form id="applyForm" action="<?php echo admin_url($this->campdir . '/write_update'); ?>" method="post" class="form-horizontal">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <input type="hidden" name="idx" value="<?php echo element('idx', element('data', $view)); ?>">
        <input type="hidden" name="refkey" value="<?php echo element('refkey', element('data', $view)); ?>">

        <div class="box-body">

            <!-- 교회/교단 정보 -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">상태</label>
                <div class="col-sm-4">
                    <select class="form-select" name="status">
                        <option value="가등록" <?php echo element('status', element('data', $view, array())) === '가등록' ? 'selected' : ''; ?>>가등록</option>
                        <option value="예약완료" <?php echo element('status', element('data', $view, array())) === '예약완료' ? 'selected' : ''; ?>>예약완료</option>
                        <option value="완납등록" <?php echo element('status', element('data', $view, array())) === '완납등록' ? 'selected' : ''; ?>>완납등록</option>
                        <option value="등록종료" <?php echo element('status', element('data', $view, array())) === '등록종료' ? 'selected' : ''; ?>>등록종료</option>
                        <option value="환불요청" <?php echo element('status', element('data', $view, array())) === '환불요청' ? 'selected' : ''; ?>>환불요청</option>
                        <option value="환불" <?php echo element('status', element('data', $view, array())) === '환불' ? 'selected' : ''; ?>>환불</option>
                        <option value="취소" <?php echo element('status', element('data', $view, array())) === '취소' ? 'selected' : ''; ?>>취소</option>
                    </select>
                </div>

                <label class="col-sm-2 col-form-label">메모</label>
                <div class="col-sm-4">
                    <textarea class="form-control" name="memo" rows="3"><?php echo element('memo', element('data', $view, array())); ?></textarea>
                </div>
            </div>


            <!-- 교회 정보 섹션 -->

            <!-- 교회/교단 정보 -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">교회명 *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="church_nm" required
                           value="<?php echo element('church_nm', element('data', $view, array())); ?>">
                </div>

                <label class="col-sm-2 col-form-label">교단</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="kyodan"
                           value="<?php echo element('kyodan', element('data', $view, array())); ?>">
                </div>
            </div>

            <!-- 주소 정보 -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">우편번호</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="zip" id="zip"
                               value="<?php echo element('zip', element('data', $view, array())); ?>" readonly>
                        <button type="button" class="btn btn-secondary" onclick="execDaumPostcode()">주소검색</button>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">주소</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control mb-2" name="addr1" id="addr1"
                           value="<?php echo element('addr1', element('data', $view, array())); ?>" readonly>
                    <input type="text" class="form-control" name="addr2" id="addr2"
                           value="<?php echo element('addr2', element('data', $view, array())); ?>" placeholder="상세주소">
                </div>
            </div>

            <!-- 담당자 정보 -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">담당자명 *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="resp_nm" required
                           value="<?php echo element('resp_nm', element('data', $view, array())); ?>">
                </div>

                <label class="col-sm-2 col-form-label">직분</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="position"
                           value="<?php echo element('position', element('data', $view, array())); ?>">
                </div>
            </div>

            <!-- 연락처 정보 -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">연락처 *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="mobile" required
                           value="<?php echo element('mobile', element('data', $view, array())); ?>">
                </div>

                <label class="col-sm-2 col-form-label">이메일</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" name="email"
                           value="<?php echo element('email', element('data', $view, array())); ?>">
                </div>
            </div>

            <!-- 참가자 정보 -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">목회자</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-text">남</span>
                        <input type="number" class="form-control" name="pastor_male"
                               value="<?php echo element('pastor_male', element('data', $view, array())); ?>">
                        <span class="input-group-text">여</span>
                        <input type="number" class="form-control" name="pastor_female"
                               value="<?php echo element('pastor_female', element('data', $view, array())); ?>">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">교사</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-text">남</span>
                        <input type="number" class="form-control" name="teacher_male"
                               value="<?php echo element('teacher_male', element('data', $view, array())); ?>">
                        <span class="input-group-text">여</span>
                        <input type="number" class="form-control" name="teacher_female"
                               value="<?php echo element('teacher_female', element('data', $view, array())); ?>">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">학생</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-text">남</span>
                        <input type="number" class="form-control" name="student_male"
                               value="<?php echo element('student_male', element('data', $view, array())); ?>">
                        <span class="input-group-text">여</span>
                        <input type="number" class="form-control" name="student_female"
                               value="<?php echo element('student_female', element('data', $view, array())); ?>">
                    </div>
                </div>
            </div>

            <!-- 결제 정보 -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">1인당 금액</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="sale_price" id="sale_price"
                           value="<?php echo element('sale_price', element('data', $view, array())); ?>">
                </div>

                <label class="col-sm-2 col-form-label">총 금액</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="sale_total" id="sale_total"
                           value="<?php echo element('sale_total', element('data', $view, array())); ?>" readonly>
                </div>

                <label class="col-sm-2 col-form-label">입금액</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="deposit" id="deposit"
                           value="<?php echo element('deposit', element('data', $view, array())); ?>" readonly>
                </div>

                <label class="col-sm-2 col-form-label">잔고</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="balance" id="balance"
                           value="<?php echo element('balance', element('data', $view, array())); ?>" readonly>
                </div>
            </div>






            <!-- 그 외 정보들 -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">입금자명</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="deposit_nm"
                           value="<?php echo element('deposit_nm', element('data', $view, array())); ?>">
                </div>

                <label class="col-sm-2 col-form-label">입금일자</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control datepicker" name="deposit_dt"
                           value="<?php echo element('deposit_dt', element('data', $view, array())); ?>">
                </div>

                <label class="col-sm-2 col-form-label">추천자</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control datepicker" name="recommend"
                           value="<?php echo element('recommend', element('data', $view, array())); ?>">
                </div>
            </div>

        </div>

        <div class="box-footer text-center">
            <button type="submit" class="btn btn-primary">저장하기</button>
            <a href="<?php echo admin_url($this->campdir); ?>" class="btn btn-secondary">목록으로</a>
        </div>
    </form>
</div>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    $(document).ready(function() {
        // Datepicker 초기화
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            language: 'kr'
        });

        // 금액 계산 함수
        function calculateTotalAndBalance() {
            let total_people =
                parseInt($('input[name="pastor_male"]').val() || 0) +
                parseInt($('input[name="pastor_female"]').val() || 0) +
                parseInt($('input[name="teacher_male"]').val() || 0) +
                parseInt($('input[name="teacher_female"]').val() || 0) +
                parseInt($('input[name="student_male"]').val() || 0) +
                parseInt($('input[name="student_female"]').val() || 0);

            let price_per_person = parseInt($('#sale_price').val() || 0);
            let deposit = parseInt($('#deposit').val() || 0);

            let total = total_people * price_per_person;
            let balance = total - deposit;

            $('#sale_total').val(total);
            $('#balance').val(balance);
        }

        // 인원수나 금액 변경 시 자동 계산
        $('input[name^="pastor_"], input[name^="teacher_"], input[name^="student_"], #sale_price, #deposit').on('change', function() {
            calculateTotalAndBalance();
        });

        // 초기 로드 시 계산
        calculateTotalAndBalance();

        // 다음 우편번호 검색
        window.execDaumPostcode = function() {
            new daum.Postcode({
                oncomplete: function(data) {
                    var addr = '';
                    var extraAddr = '';

                    if (data.userSelectedType === 'R') {
                        addr = data.roadAddress;
                    } else {
                        addr = data.jibunAddress;
                    }

                    if(data.userSelectedType === 'R'){
                        if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                            extraAddr += data.bname;
                        }
                        if(data.buildingName !== '' && data.apartment === 'Y'){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        if(extraAddr !== ''){
                            extraAddr = ' (' + extraAddr + ')';
                        }
                    }

                    document.getElementById('zip').value = data.zonecode;
                    document.getElementById('addr1').value = addr + extraAddr;
                    document.getElementById('addr2').focus();
                }
            }).open();
        }

        // 폼 제출 전 검증
        $('#applyForm').on('submit', function(e) {
            // 필수 필드 검증
            /*
            if (!$('input[name="church_nm"]').val()) {
                alert('교회명을 입력해주세요.');
                $('input[name="church_nm"]').focus();
                e.preventDefault();
                return false;
            }

            if (!$('input[name="resp_nm"]').val()) {
                alert('담당자명을 입력해주세요.');
                $('input[name="resp_nm"]').focus();
                e.preventDefault();
                return false;
            }

            if (!$('input[name="mobile"]').val()) {
                alert('연락처를 입력해주세요.');
                $('input[name="mobile"]').focus();
                e.preventDefault();
                return false;
            }

            // 전화번호 형식 검증
            var mobileRegex = /^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/;
            var mobile = $('input[name="mobile"]').val();
            if (!mobileRegex.test(mobile)) {
                alert('올바른 전화번호 형식이 아닙니다.\n예: 010-1234-5678');
                $('input[name="mobile"]').focus();
                e.preventDefault();
                return false;
            }

            // 이메일 형식 검증 (이메일이 입력된 경우에만)
            var email = $('input[name="email"]').val();
            if (email) {
                var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                if (!emailRegex.test(email)) {
                    alert('올바른 이메일 형식이 아닙니다.');
                    $('input[name="email"]').focus();
                    e.preventDefault();
                    return false;
                }
            }*/

            // 숫자 필드들의 음수 값 체크
            var numberFields = ['pastor_male', 'pastor_female', 'teacher_male', 'teacher_female',
                'student_male', 'student_female', 'sale_price', 'deposit'];

            for (var i = 0; i < numberFields.length; i++) {
                var value = parseInt($('input[name="' + numberFields[i] + '"]').val() || 0);
                if (value < 0) {
                    alert('음수 값은 입력할 수 없습니다.');
                    $('input[name="' + numberFields[i] + '"]').focus();
                    e.preventDefault();
                    return false;
                }
            }

            return true;
        });
    });
</script>