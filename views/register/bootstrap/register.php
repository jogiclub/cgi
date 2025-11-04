<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <?php
            echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
            echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-info alert-dismissible fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>', '</div>');
            $attributes = array('class' => 'needs-validation', 'name' => 'fregisterform', 'id' => 'fregisterform', 'novalidate' => 'true');
            echo form_open(current_full_url(), $attributes);
            ?>
            <input type="hidden" name="register" value="1" />
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">회원가입</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold">회원가입약관</h6>
                        <div class="mb-3">
                            <textarea class="form-control" rows="3" readonly="readonly"><?php echo html_escape(element('member_register_policy1', $view)); ?></textarea>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="agree" id="agree" value="1" required />
                            <label class="form-check-label" for="agree">
                                회원가입약관의 내용에 동의합니다.
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold">개인정보취급방침안내</h6>
                        <div class="mb-3">
                            <textarea class="form-control" rows="3" readonly="readonly"><?php echo html_escape(element('member_register_policy2', $view)); ?></textarea>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="agree2" id="agree2" value="1" required />
                            <label class="form-check-label" for="agree2">
                                개인정보취급방침안내의 내용에 동의합니다.
                            </label>
                        </div>
                    </div>

                    <?php if ($this->cbconfig->item('use_selfcert') && ($this->cbconfig->item('use_selfcert_phone') OR $this->cbconfig->item('use_selfcert_ipin'))) { ?>
                        <div class="mb-4">
                            <h6 class="fw-bold">본인인증 선택</h6>
                            <input type="hidden" name="selfcert_type" id="selfcert_type" value="" />
                            <div class="d-flex gap-2">
                                <?php if ($this->cbconfig->item('use_selfcert_phone')) { ?>
                                    <button type="button" class="btn btn-warning" name="mem_selfcert" id="btn_mem_selfcert_phone">휴대폰인증</button>
                                <?php } ?>
                                <?php if ($this->cbconfig->item('use_selfcert_ipin')) { ?>
                                    <button type="button" class="btn btn-primary" name="mem_selfcert" id="btn_mem_selfcert_ipin">아이핀인증</button>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">회원가입</button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php if ($this->cbconfig->item('use_selfcert') && ($this->cbconfig->item('use_selfcert_phone') OR $this->cbconfig->item('use_selfcert_ipin'))) {
    $this->managelayout->add_js(base_url('assets/js/member_selfcert.js'));
} ?>

<script type="text/javascript">
    //<![CDATA[
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
            rules: {
                agree: {required: true},
                agree2: {required: true}
                <?php if ($this->cbconfig->item('use_selfcert') && ($this->cbconfig->item('use_selfcert_phone') OR $this->cbconfig->item('use_selfcert_ipin')) && $this->cbconfig->item('use_selfcert_required')) { ?>
                , selfcert_type: {required: true}
            },
            messages: {
                selfcert_type: "본인인증 후 회원가입이 가능합니다"
                <?php } ?>
            }
        });
    });
    //]]>
</script>