<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="container py-5">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">계정 찾기</h5>
            </div>
            <div class="card-body">
                <?php
                echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
                echo show_alert_message(element('message', $view), '<div class="alert alert-info alert-dismissible fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>', '</div>');
                ?>

                <div class="mb-4">
                    <!-- Find Type Selection -->
                    <div class="btn-group w-100 mb-4" role="group">
                        <input type="radio" class="btn-check" name="find_type" id="email_find" value="email" checked>
                        <label class="btn btn-outline-primary" for="email_find">이메일로 찾기</label>

                        <input type="radio" class="btn-check" name="find_type" id="sms_find" value="sms">
                        <label class="btn btn-outline-primary" for="sms_find">SMS로 찾기</label>
                    </div>

                    <!-- Email Find Form -->
                    <div id="email_form">
                        <?php
                        $attributes = array('class' => 'needs-validation', 'name' => 'findidpwform', 'id' => 'findidpwform', 'novalidate' => 'true');
                        echo form_open(current_full_url(), $attributes);
                        ?>
                        <input type="hidden" name="findtype" value="findidpw" />
                        <h5 class="card-title">이메일 주소로 계정 찾기</h5>
                        <p class="card-text">아이디/비밀번호는 가입시 등록한 메일 주소로 알려드립니다.</p>
                        <div class="input-group">
                            <input type="email" name="idpw_email" id="idpw_email" class="form-control" placeholder="이메일 주소" required />
                            <button class="btn btn-primary" type="submit">계정 찾기</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>

                    <!-- SMS Find Form -->
                    <div id="sms_form" style="display:none;">
                        <?php
                        $attributes = array('class' => 'needs-validation', 'name' => 'findsmsform', 'id' => 'findsmsform', 'novalidate' => 'true');
                        echo form_open(current_full_url(), $attributes);
                        ?>
                        <input type="hidden" name="findtype" value="findsms" />
                        <h5 class="card-title">휴대폰 번호로 계정 찾기</h5>
                        <p class="card-text">아이디/비밀번호는 가입시 등록한 휴대폰 번호로 알려드립니다.</p>
                        <div class="input-group">
                            <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="휴대폰 번호 (-없이 입력)" required pattern="[0-9]{10,11}" />
                            <button class="btn btn-primary" type="submit">계정 찾기</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>

                <?php if ($this->cbconfig->item('use_register_email_auth')) {
                    // ... 기존 이메일 인증 관련 코드는 그대로 유지
                } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //<![CDATA[
    $(function() {
        // Form type toggle
        $('input[name="find_type"]').change(function() {
            if ($(this).val() === 'email') {
                $('#email_form').show();
                $('#sms_form').hide();
            } else {
                $('#email_form').hide();
                $('#sms_form').show();
            }
        });

        // Bootstrap 5 Form Validation
        const forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });

        // Additional jQuery Validation
        $('#findidpwform').validate({
            rules: {
                idpw_email: { required: true, email: true }
            }
        });

        $('#findsmsform').validate({
            rules: {
                phone_number: {
                    required: true,
                    minlength: 10,
                    maxlength: 11,
                    digits: true
                }
            },
            messages: {
                phone_number: {
                    required: "휴대폰 번호를 입력해주세요",
                    minlength: "올바른 휴대폰 번호를 입력해주세요",
                    maxlength: "올바른 휴대폰 번호를 입력해주세요",
                    digits: "숫자만 입력해주세요"
                }
            }
        });
    });
    //]]>
</script>