<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">회원 가입</h5>
                </div>
                <div class="card-body">
                    <?php
                    echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
                    echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-info alert-dismissible fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>', '</div>');
                    $attributes = array('class' => 'needs-validation', 'name' => 'fregisterform', 'id' => 'fregisterform', 'novalidate' => 'true');
                    echo form_open_multipart(current_full_url(), $attributes);
                    ?>

                    <?php foreach (element('html_content', $view) as $key => $value) { ?>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label" for="<?php echo element('field_name', $value); ?>"><?php echo element('display_name', $value); ?></label>
                            <div class="col-lg-9">
                                <?php echo element('input', $value); ?>
                                <?php if (element('description', $value)) { ?>
                                    <div class="form-text"><?php echo element('description', $value); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($this->cbconfig->item('use_member_photo') && $this->cbconfig->item('member_photo_width') > 0 && $this->cbconfig->item('member_photo_height') > 0) { ?>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label" for="mem_photo">프로필사진</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="mem_photo" id="mem_photo" />
                                <div class="form-text">가로길이 : <?php echo number_format($this->cbconfig->item('member_photo_width')); ?>px, 세로길이 : <?php echo number_format($this->cbconfig->item('member_photo_height')); ?>px 에 최적화되어있습니다, gif, jpg, png 파일 업로드가 가능합니다</div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($this->cbconfig->item('use_member_icon') && $this->cbconfig->item('member_icon_width') > 0 && $this->cbconfig->item('member_icon_height') > 0) { ?>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label" for="mem_icon">회원아이콘</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="mem_icon" id="mem_icon" />
                                <div class="form-text">가로길이 : <?php echo number_format($this->cbconfig->item('member_icon_width')); ?>px, 세로길이 : <?php echo number_format($this->cbconfig->item('member_icon_height')); ?>px 에 최적화되어있습니다, gif, jpg, png 파일 업로드가 가능합니다</div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label" for="mem_open_profile">정보공개</label>
                        <div class="col-lg-9">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="mem_open_profile" id="mem_open_profile" value="1" <?php echo set_checkbox('mem_open_profile', '1', true); ?> />
                                <label class="form-check-label" for="mem_open_profile">
                                    다른분들이 나의 정보를 볼 수 있도록 합니다.
                                </label>
                                <?php if (element('open_profile_description', $view)) { ?>
                                    <div class="form-text"><?php echo element('open_profile_description', $view); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php if ($this->cbconfig->item('use_note')) { ?>
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">쪽지기능사용</label>
                            <div class="col-lg-9">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="mem_use_note" id="mem_use_note" value="1" <?php echo set_checkbox('mem_use_note', '1', true); ?> />
                                    <label class="form-check-label" for="mem_use_note">
                                        쪽지를 주고 받을 수 있습니다.
                                    </label>
                                    <?php if (element('use_note_description', $view)) { ?>
                                        <div class="form-text"><?php echo element('use_note_description', $view); ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">이메일 수신여부</label>
                        <div class="col-lg-9">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="mem_receive_email" id="mem_receive_email" value="1" <?php echo set_checkbox('mem_receive_email', '1', true); ?> />
                                <label class="form-check-label" for="mem_receive_email">수신</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">SMS 문자 수신</label>
                        <div class="col-lg-9">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="mem_receive_sms" id="mem_receive_sms" value="1" <?php echo set_checkbox('mem_receive_sms', '1', true); ?> />
                                <label class="form-check-label" for="mem_receive_sms">수신</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <?php if ($this->cbconfig->item('use_recaptcha')) { ?>
                            <label class="col-lg-3 col-form-label"></label>
                            <div class="col-lg-9 captcha" id="recaptcha">
                                <button type="button" id="captcha" class="btn btn-secondary"></button>
                            </div>
                            <input type="hidden" name="recaptcha" />
                        <?php } else { ?>
                            <label class="col-lg-3 col-form-label">
                                <img src="<?php echo base_url('assets/images/preload.png'); ?>" width="160" height="40" id="captcha" alt="captcha" title="captcha" />
                            </label>
                            <div class="col-lg-9">
                                <input type="text" name="captcha_key" id="captcha_key" class="form-control w-25" value="" />
                                <div class="form-text">좌측에 보이는 문자를 입력해주세요!</div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="row">
                        <div class="col-lg-9 offset-lg-3">
                            <button type="submit" class="btn btn-success">회원가입</button>
                            <a href="<?php echo site_url(); ?>" class="btn btn-secondary">취소</a>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->managelayout->add_css(base_url('assets/css/datepicker3.css'));
$this->managelayout->add_js('http://dmaps.daum.net/map_js_init/postcode.v2.js');
$this->managelayout->add_js(base_url('assets/js/bootstrap-datepicker.js'));
$this->managelayout->add_js(base_url('assets/js/bootstrap-datepicker.kr.js'));
$this->managelayout->add_js(base_url('assets/js/member_register.js'));
if ($this->cbconfig->item('use_recaptcha')) {
    $this->managelayout->add_js(base_url('assets/js/recaptcha.js'));
} else {
    $this->managelayout->add_js(base_url('assets/js/captcha.js'));
}
?>

<script type="text/javascript">
    //<![CDATA[
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'kr',
        autoclose: true,
        todayHighlight: true
    });

    $(function() {
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

        // jQuery Validation
        $('#fregisterform').validate({
            onkeyup: false,
            onclick: false,
            rules: {
                mem_userid: {required: true, minlength:3, maxlength:20, is_userid_available:true},
                mem_email: {required: true, email:true, is_email_available:true},
                mem_password: {required: true, is_password_available:true},
                mem_password_re: {required: true, equalTo: '#mem_password'},
                mem_nickname: {required: true, is_nickname_available:true}
                <?php if ($this->cbconfig->item('use_recaptcha')) { ?>
                , recaptcha: {recaptchaKey:true}
                <?php } else { ?>
                , captcha_key: {required: true, captchaKey:true}
                <?php } ?>
            },
            messages: {
                recaptcha: '',
                captcha_key: '자동등록방지용 코드가 올바르지 않습니다.'
            }
        });
    });
    //]]>
</script>