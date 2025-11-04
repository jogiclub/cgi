<div class="box">
    <div class="box-table">
        <?php
        if ($this->session->flashdata('message')) {
            echo '<div class="alert alert-success">' . $this->session->flashdata('message') . '</div>';
        }
        ?>

        <?php if (element('camp_info', $view)) { ?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                캠프명: <?php echo html_escape(element('ch_num', element('camp_info', $view))); ?><br>
                기간: <?php echo html_escape(element('ch_start', element('camp_info', $view))); ?> ~
                <?php echo html_escape(element('ch_end', element('camp_info', $view))); ?>
            </div>
        <?php } ?>

        <form id="fadminwrite" action="<?php echo admin_url($this->campdir . '/write_update'); ?>" method="post" class="form-horizontal">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="idx" value="<?php echo element('idx', element('data', $view)); ?>">
            <input type="hidden" name="refkey" value="<?php echo element('refkey', element('data', $view)); ?>">

            <div class="form-group">
                <label class="col-sm-2 control-label">상태</label>
                <div class="col-sm-8">
                    <select class="form-control" name="status">
                        <option value="가등록" <?php echo element('status', element('data', $view)) === '가등록' ? 'selected' : ''; ?>>가등록</option>
                        <option value="예약완료" <?php echo element('status', element('data', $view)) === '예약완료' ? 'selected' : ''; ?>>예약완료</option>
                        <option value="완납등록" <?php echo element('status', element('data', $view)) === '완납등록' ? 'selected' : ''; ?>>완납등록</option>
                        <option value="등록종료" <?php echo element('status', element('data', $view)) === '등록종료' ? 'selected' : ''; ?>>등록종료</option>
                        <option value="환불요청" <?php echo element('status', element('data', $view)) === '환불요청' ? 'selected' : ''; ?>>환불요청</option>
                        <option value="환불" <?php echo element('status', element('data', $view)) === '환불' ? 'selected' : ''; ?>>환불</option>
                        <option value="취소" <?php echo element('status', element('data', $view)) === '취소' ? 'selected' : ''; ?>>취소</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">메모</label>
                <div class="col-sm-8">
                    <textarea class="form-control" name="memo" rows="3"><?php echo element('memo', element('data', $view)); ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">교회명 *</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="church_nm" value="<?php echo element('church_nm', element('data', $view)); ?>" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">교단</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="kyodan" value="<?php echo element('kyodan', element('data', $view)); ?>" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">주소</label>
                <div class="col-sm-8">
                    <label for="zip">우편번호</label>
                    <div class="input-group" style="margin-bottom: 10px;">
                        <input type="text" name="zip" value="<?php echo element('zip', element('data', $view)); ?>" id="zip" class="form-control" size="7" maxlength="7" readonly />
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-sm" onclick="execDaumPostcode();">주소 검색</button>
                        </span>
                    </div>
                    <input type="text" name="addr1" value="<?php echo element('addr1', element('data', $view)); ?>" id="addr1" class="form-control" placeholder="기본주소" readonly style="margin-bottom: 10px;" />
                    <input type="text" name="addr2" value="<?php echo element('addr2', element('data', $view)); ?>" id="addr2" class="form-control" placeholder="상세주소" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">담당자명 *</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="resp_nm" value="<?php echo element('resp_nm', element('data', $view)); ?>" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">직분</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="position" value="<?php echo element('position', element('data', $view)); ?>" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">연락처 *</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="mobile" value="<?php echo element('mobile', element('data', $view)); ?>" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">이메일</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" name="email" value="<?php echo element('email', element('data', $view)); ?>" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">목회자</label>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">남</span>
                                <input type="number" class="form-control" name="pastor_male" value="<?php echo element('pastor_male', element('data', $view)); ?>" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">여</span>
                                <input type="number" class="form-control" name="pastor_female" value="<?php echo element('pastor_female', element('data', $view)); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">교사</label>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">남</span>
                                <input type="number" class="form-control" name="teacher_male" value="<?php echo element('teacher_male', element('data', $view)); ?>" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">여</span>
                                <input type="number" class="form-control" name="teacher_female" value="<?php echo element('teacher_female', element('data', $view)); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">학생</label>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">남</span>
                                <input type="number" class="form-control" name="student_male" value="<?php echo element('student_male', element('data', $view)); ?>" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">여</span>
                                <input type="number" class="form-control" name="student_female" value="<?php echo element('student_female', element('data', $view)); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">1인당 금액</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="sale_price" id="sale_price" value="<?php echo element('sale_price', element('data', $view)); ?>" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">총 금액</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="sale_total" id="sale_total" value="<?php echo element('sale_total', element('data', $view)); ?>" readonly />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">가등록 입금액</label>
                <div class="col-sm-1">
                    <input type="number" class="form-control" name="deposit" id="deposit" value="<?php echo element('deposit', element('data', $view)); ?>" />
                </div>

                <label class="col-sm-1 control-label">입금자명</label>
                <div class="col-sm-1">
                    <input type="text" class="form-control" name="deposit_nm" value="<?php echo element('deposit_nm', element('data', $view)); ?>" />
                </div>



                <label class="col-sm-1 control-label">입금일자</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control datepicker" name="deposit_dt" value="<?php echo element('deposit_dt', element('data', $view)); ?>" />
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">잔고</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="balance" id="balance" value="<?php echo element('balance', element('data', $view)); ?>" readonly />
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-2 control-label">추천자</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="recommend" value="<?php echo element('recommend', element('data', $view)); ?>" />
                </div>
            </div>

            <div class="btn-group pull-right" role="group" aria-label="...">
                <button type="button" class="btn btn-default btn-sm btn-history-back">취소하기</button>
                <button type="submit" class="btn btn-success btn-sm">저장하기</button>
            </div>
        </form>
    </div>
</div>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    $(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            language: 'kr'
        });

        function calculateTotalAndBalance() {
            var pastorMale = parseInt($('input[name="pastor_male"]').val() || 0);
            var pastorFemale = parseInt($('input[name="pastor_female"]').val() || 0);
            var teacherMale = parseInt($('input[name="teacher_male"]').val() || 0);
            var teacherFemale = parseInt($('input[name="teacher_female"]').val() || 0);
            var studentMale = parseInt($('input[name="student_male"]').val() || 0);
            var studentFemale = parseInt($('input[name="student_female"]').val() || 0);

            var totalPeople = pastorMale + pastorFemale + teacherMale + teacherFemale + studentMale + studentFemale;
            var pricePerPerson = parseInt($('#sale_price').val() || 0);
            var deposit = parseInt($('#deposit').val() || 0);

            var totalAmount = totalPeople * pricePerPerson;
            var balance = totalAmount - deposit;

            $('#sale_total').val(totalAmount);
            $('#balance').val(balance);
        }

        $('input[name^="pastor_"], input[name^="teacher_"], input[name^="student_"], #sale_price, #deposit').on('change keyup', calculateTotalAndBalance);
        calculateTotalAndBalance();

        $('#fadminwrite').validate({
            rules: {
                church_nm: { required: true },
                resp_nm: { required: true },
                mobile: { required: true }
            },
            messages: {
                church_nm: { required: '교회명을 입력해주세요.' },
                resp_nm: { required: '담당자명을 입력해주세요.' },
                mobile: { required: '연락처를 입력해주세요.' }
            }
        });

        $('.btn-history-back').click(function(){
            history.back();
        });
    });
    function execDaumPostcode() {
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
</script>