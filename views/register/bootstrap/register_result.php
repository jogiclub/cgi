<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">회원가입을 축하합니다.</h5>
                </div>
                <div class="card-body text-center">
                    <p class="mb-4">
                        <span class="text-primary fw-bold"><?php echo html_escape($this->session->flashdata('nickname')); ?></span>님의 회원가입을 진심으로 축하드립니다.
                    </p>
                    <p class="mb-4"><?php echo $this->session->flashdata('email_auth_message'); ?></p>
                    <div>
                        <a href="<?php echo site_url(); ?>" class="btn btn-primary" title="<?php echo html_escape($this->cbconfig->item('site_title'));?>">
                            홈페이지로 이동
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>