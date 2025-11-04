<div class="box">
    <div class="box-table">
        <?php
        echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
        $attributes = array('class' => 'form-horizontal', 'name' => 'fadminwrite', 'id' => 'fadminwrite');
        echo form_open_multipart(current_full_url(), $attributes);
        ?>
        <input type="hidden" name="<?php echo element('primary_key', $view); ?>" value="<?php echo element(element('primary_key', $view), element('data', $view)); ?>" />

        <div class="form-group">
            <label class="col-sm-2 control-label">캠프명</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ch_num" value="<?php echo set_value('ch_num', element('ch_num', element('data', $view))); ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">년도</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="ch_year" value="<?php echo set_value('ch_year', element('ch_year', element('data', $view))); ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">시즌</label>
            <div class="col-sm-10">
                <select name="ch_season" class="form-control">
                    <option value="">시즌을 선택하세요</option>
                    <option value="여름" <?php echo set_select('ch_season', '여름', (element('ch_season', element('data', $view)) === '여름' ? true : false)); ?>>여름</option>
                    <option value="겨울" <?php echo set_select('ch_season', '겨울', (element('ch_season', element('data', $view)) === '겨울' ? true : false)); ?>>겨울</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">기간</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control datepicker" name="ch_start" value="<?php echo set_value('ch_start', element('ch_start', element('data', $view))); ?>" />
                    <span class="input-group-addon">~</span>
                    <input type="text" class="form-control datepicker" name="ch_end" value="<?php echo set_value('ch_end', element('ch_end', element('data', $view))); ?>" />
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">지역</label>
            <div class="col-sm-10">
                <select name="ch_location" class="form-control">
                    <option value="">지역을 선택하세요</option>
                    <option value="서울" <?php echo set_select('ch_location', '서울', (element('ch_location', element('data', $view)) === '서울' ? true : false)); ?>>서울</option>
                    <option value="호남" <?php echo set_select('ch_location', '호남', (element('ch_location', element('data', $view)) === '호남' ? true : false)); ?>>호남</option>
                    <option value="영남" <?php echo set_select('ch_location', '영남', (element('ch_location', element('data', $view)) === '영남' ? true : false)); ?>>영남</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">장소</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ch_place" value="<?php echo set_value('ch_place', element('ch_place', element('data', $view))); ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">주소</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ch_addr" value="<?php echo set_value('ch_addr', element('ch_addr', element('data', $view))); ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">연락처</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ch_tel" value="<?php echo set_value('ch_tel', element('ch_tel', element('data', $view))); ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">참가비</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="number" class="form-control" name="ch_pay" value="<?php echo set_value('ch_pay', element('ch_pay', element('data', $view))); ?>" />
                    <span class="input-group-addon">원</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">모집인원</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="ch_to" value="<?php echo set_value('ch_to', element('ch_to', element('data', $view))); ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">일정표</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="ch_schedule" rows="5"><?php echo set_value('ch_schedule', element('ch_schedule', element('data', $view))); ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">아이콘</label>
            <div class="col-sm-10">
                <select name="icon" class="form-control">
                    <option value="1" <?php echo set_select('icon', '1', (element('icon', element('data', $view)) === '1' ? true : false)); ?>>절찬접수</option>
                    <option value="2" <?php echo set_select('icon', '2', (element('icon', element('data', $view)) === '2' ? true : false)); ?>>인기</option>
                    <option value="3" <?php echo set_select('icon', '3', (element('icon', element('data', $view)) === '3' ? true : false)); ?>>마감임박</option>
                    <option value="4" <?php echo set_select('icon', '4', (element('icon', element('data', $view)) === '4' ? true : false)); ?>>마감</option>
                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">마감여부</label>
            <div class="col-sm-10">
                <label for="ch_close" class="checkbox-inline">
                    <input type="checkbox" name="ch_close" id="ch_close" value="마감" <?php echo set_checkbox('ch_close', '마감', (element('ch_close', element('data', $view)) === '마감' ? true : false)); ?> /> 마감
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">첨부파일</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="ch_file" />
                <?php if(element('ch_file', element('data', $view))) { ?>
                    <p class="help-block">
                        <a href="<?php echo base_url('uploads/camp/'.element('ch_file', element('data', $view))); ?>" class="btn btn-default btn-xs" download>
                            <i class="fa fa-download"></i> 첨부파일 다운로드
                        </a>
                    </p>
                <?php } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">시간표 이미지</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="ch_schedule" accept="image/*" />
                <?php if(element('ch_schedule', element('data', $view))) { ?>
                    <p class="help-block">
                        <a href="<?php echo base_url('uploads/camp/'.element('ch_schedule', element('data', $view))); ?>" class="btn btn-default btn-xs" download>
                            <i class="fa fa-download"></i> 시간표 다운로드
                        </a>
                    </p>
                <?php } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">장소 링크</label>
            <div class="col-sm-10">
                <input type="url" class="form-control" name="ch_link" value="<?php echo set_value('ch_link', element('ch_link', element('data', $view))); ?>" placeholder="https://" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">프로그램 소개</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="ch_etc_pro" rows="5"><?php echo set_value('ch_etc_pro', element('ch_etc_pro', element('data', $view))); ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">은행</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="bank_name" value="<?php echo set_value('bank_name', element('bank_name', element('data', $view))); ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">계좌번호</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="bank_num" value="<?php echo set_value('bank_num', element('bank_num', element('data', $view))); ?>" />
            </div>
        </div>

        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-default btn-sm" onClick="document.location.href='<?php echo admin_url($this->pagedir); ?>';">취소하기</button>
            <button type="submit" class="btn btn-success btn-sm">저장하기</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    $(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            language: 'kr'
        });

        $('#fadminwrite').validate({
            rules: {
                ch_num: { required: true },
                ch_start: { required: true },
                ch_end: { required: true },
                ch_location: { required: true },
                ch_place: { required: true },
                ch_pay: {
                    required: true,
                    number: true,
                    min: 0
                },
                ch_to: {
                    required: true,
                    number: true,
                    min: 1
                }
            },
            messages: {
                ch_num: { required: '캠프명을 입력해주세요' },
                ch_start: { required: '시작일을 선택해주세요' },
                ch_end: { required: '종료일을 선택해주세요' },
                ch_location: { required: '지역을 선택해주세요' },
                ch_place: { required: '장소를 입력해주세요' },
                ch_pay: {
                    required: '참가비를 입력해주세요',
                    number: '숫자만 입력 가능합니다',
                    min: '0 이상의 값을 입력해주세요'
                },
                ch_to: {
                    required: '모집인원을 입력해주세요',
                    number: '숫자만 입력 가능합니다',
                    min: '1명 이상 입력해주세요'
                }
            }
        });
    });
</script>