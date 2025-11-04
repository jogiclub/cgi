<div class="box">
    <div class="box-table">
        <?php
        echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
        $attributes = array('class' => 'form-horizontal', 'name' => 'fadminwrite', 'id' => 'fadminwrite');
        echo form_open_multipart(current_full_url(), $attributes);
        ?>
        <input type="hidden" name="<?php echo element('primary_key', $view); ?>" value="<?php echo element(element('primary_key', $view), element('data', $view)); ?>" />

        <div class="form-group mb-3 row">
            <label class="col-sm-2 col-form-label">캠프명</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ch_list" value="<?php echo set_value('ch_list', element('ch_list', element('data', $view))); ?>" />
            </div>
        </div>

        <div class="form-group mb-3 row">
            <label class="col-sm-2 col-form-label">기간</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="date" class="form-control" name="ch_start" value="<?php echo set_value('ch_start', element('ch_start', element('data', $view))); ?>" />
                    <span class="input-group-text">~</span>
                    <input type="date" class="form-control" name="ch_end" value="<?php echo set_value('ch_end', element('ch_end', element('data', $view))); ?>" />
                </div>
            </div>
        </div>

        <div class="form-group mb-3 row">
            <label class="col-sm-2 col-form-label">지역</label>
            <div class="col-sm-10">
                <select name="ch_location" class="form-select">
                    <option value="">지역을 선택하세요</option>
                    <option value="서울" <?php echo set_select('ch_location', '서울', (element('ch_location', element('data', $view)) === '서울' ? true : false)); ?>>서울</option>
                    <option value="경기" <?php echo set_select('ch_location', '경기', (element('ch_location', element('data', $view)) === '경기' ? true : false)); ?>>경기</option>
                    <option value="인천" <?php echo set_select('ch_location', '인천', (element('ch_location', element('data', $view)) === '인천' ? true : false)); ?>>인천</option>
                    <option value="강원" <?php echo set_select('ch_location', '강원', (element('ch_location', element('data', $view)) === '강원' ? true : false)); ?>>강원</option>
                    <option value="충북" <?php echo set_select('ch_location', '충북', (element('ch_location', element('data', $view)) === '충북' ? true : false)); ?>>충북</option>
                    <option value="충남" <?php echo set_select('ch_location', '충남', (element('ch_location', element('data', $view)) === '충남' ? true : false)); ?>>충남</option>
                    <option value="대전" <?php echo set_select('ch_location', '대전', (element('ch_location', element('data', $view)) === '대전' ? true : false)); ?>>대전</option>
                    <option value="경북" <?php echo set_select('ch_location', '경북', (element('ch_location', element('data', $view)) === '경북' ? true : false)); ?>>경북</option>
                    <option value="경남" <?php echo set_select('ch_location', '경남', (element('ch_location', element('data', $view)) === '경남' ? true : false)); ?>>경남</option>
                    <option value="대구" <?php echo set_select('ch_location', '대구', (element('ch_location', element('data', $view)) === '대구' ? true : false)); ?>>대구</option>
                    <option value="부산" <?php echo set_select('ch_location', '부산', (element('ch_location', element('data', $view)) === '부산' ? true : false)); ?>>부산</option>
                    <option value="울산" <?php echo set_select('ch_location', '울산', (element('ch_location', element('data', $view)) === '울산' ? true : false)); ?>>울산</option>
                    <option value="전북" <?php echo set_select('ch_location', '전북', (element('ch_location', element('data', $view)) === '전북' ? true : false)); ?>>전북</option>
                    <option value="전남" <?php echo set_select('ch_location', '전남', (element('ch_location', element('data', $view)) === '전남' ? true : false)); ?>>전남</option>
                    <option value="광주" <?php echo set_select('ch_location', '광주', (element('ch_location', element('data', $view)) === '광주' ? true : false)); ?>>광주</option>
                    <option value="제주" <?php echo set_select('ch_location', '제주', (element('ch_location', element('data', $view)) === '제주' ? true : false)); ?>>제주</option>
                </select>
            </div>
        </div>

        <div class="form-group mb-3 row">
            <label class="col-sm-2 col-form-label">장소</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ch_place" value="<?php echo set_value('ch_place', element('ch_place', element('data', $view))); ?>" />
            </div>
        </div>

        <div class="form-group mb-3 row">
            <label class="col-sm-2 col-form-label">주소</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ch_addr" value="<?php echo set_value('ch_addr', element('ch_addr', element('data', $view))); ?>" />
            </div>
        </div>

        <div class="form-group mb-3 row">
            <label class="col-sm-2 col-form-label">연락처</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ch_tel" value="<?php echo set_value('ch_tel', element('ch_tel', element('data', $view))); ?>" />
            </div>
        </div>

        <div class="form-group mb-3 row">
            <label class="col-sm-2 col-form-label">참가비</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="number" class="form-control" name="ch_pay" value="<?php echo set_value('ch_pay', element('ch_pay', element('data', $view))); ?>" />
                    <span class="input-group-text">원</span>
                </div>
            </div>
        </div>

        <div class="form-group mb-3 row">
            <label class="col-sm-2 col-form-label">모집인원</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="ch_to" value="<?php echo set_value('ch_to', element('ch_to', element('data', $view))); ?>" />
            </div>
        </div>

        <div class="form-group mb-3 row">
            <label class="col-sm-2 col-form-label">일정표</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="ch_schedule" rows="5"><?php echo set_value('ch_schedule', element('ch_schedule', element('data', $view))); ?></textarea>
            </div>
        </div>

        <div class="form-group mb-3 row">
            <label class="col-sm-2 col-form-label">마감여부</label>
            <div class="col-sm-10">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="ch_close" id="ch_close" value="1" <?php echo set_checkbox('ch_close', '1', (element('ch_close', element('data', $view)) === '1' ? true : false)); ?> />
                    <label class="form-check-label" for="ch_close">마감</label>
                </div>
            </div>
        </div>

        <div class="btn-group float-end" role="group">
            <button type="button" class="btn btn-secondary" onClick="document.location.href='<?php echo admin_url($this->pagedir); ?>';">취소하기</button>
            <button type="submit" class="btn btn-success">저장하기</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    $(function() {
        $('#fadminwrite').validate({
            rules: {
                ch_list: { required: true },
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
                ch_list: { required: '캠프명을 입력해주세요' },
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