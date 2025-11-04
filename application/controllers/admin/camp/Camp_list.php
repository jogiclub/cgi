<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * List class for Camp management
 */
class Camp_list extends CB_Controller  // PHP 예약어 'List' 피하기 위해 Camp_list로 변경
{
    public $campdir = 'camp/camp_list';  // 디렉토리 경로도 변경
    protected $modelname = 'camp_model';  // 모델명은 소문자로 통일

    protected $helpers = array('form', 'array');

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('pagination', 'querystring'));
        $this->load->model('camp_model');  // 모델 명시적 로드 추가
    }

    /**
     * 캠프 목록을 가져오는 메소드
     */
    public function index()
    {
        $eventname = 'event_admin_camp_list_index';  // 이벤트 이름 변경
        $this->load->event($eventname);

        $view = array();
        $view['view'] = array();

        // 이벤트가 존재하면 실행
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        $param =& $this->querystring;
        $page = (((int) $this->input->get('page')) > 0) ? ((int) $this->input->get('page')) : 1;

        // 정렬 필드
        $view['view']['sort'] = array(
            'idx' => $param->sort('idx', 'asc'),
            'ch_num' => $param->sort('ch_num', 'asc'),
            'ch_start' => $param->sort('ch_start', 'asc'),
            'ch_end' => $param->sort('ch_end', 'asc'),
            'ch_location' => $param->sort('ch_location', 'asc'),
            'ch_place' => $param->sort('ch_place', 'asc'),
            'icon' => $param->sort('icon', 'asc'),
            'ch_close' => $param->sort('ch_close', 'asc')
        );

        $findex = $this->input->get('findex', null, 'idx');
        $forder = $this->input->get('forder', null, 'desc');
        $sfield = $this->input->get('sfield', null, '');
        $skeyword = $this->input->get('skeyword', null, '');

        $per_page = admin_listnum();
        $offset = ($page - 1) * $per_page;

        $where = array();
        if ($this->input->get('ch_close') === 'Y') {
            $where['ch_close'] = '마감';
        }
        if ($this->input->get('ch_close') === 'N') {
            $where['ch_close'] = '접수중';
        }





//        $result = $this->{$this->modelname}->get_camp_list($per_page, $offset, $where, '', $findex, $forder);
        $result = $this->camp_model->get_camp_list($per_page, $offset, $where, '', $findex, $forder);

        $list_num = $result['total_rows'] - ($page - 1) * $per_page;

        if (element('list', $result)) {
            foreach (element('list', $result) as $key => $val) {
                $result['list'][$key]['num'] = $list_num--;
                $result['list'][$key]['ch_cur_num'] = $this->camp_model->get_current_applicants($val['idx']);
            }
        }

        $view['view']['data'] = $result;
        $view['view']['primary_key'] = $this->{$this->modelname}->primary_key;

        // 페이지네이션
        $config['base_url'] = admin_url($this->campdir) . '?' . $param->replace('page');
        $config['total_rows'] = $result['total_rows'];
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $view['view']['paging'] = $this->pagination->create_links();
        $view['view']['page'] = $page;

        $search_option = array(
            'ch_num' => '캠프명',
            'ch_location' => '지역',
            'ch_place' => '장소'
        );

        $view['view']['skeyword'] = ($sfield && array_key_exists($sfield, $search_option)) ? $skeyword : '';
        $view['view']['search_option'] = search_option($search_option, $sfield);
        $view['view']['listall_url'] = admin_url($this->campdir);
        $view['view']['write_url'] = admin_url($this->campdir . '/write');
        $view['view']['list_delete_url'] = admin_url($this->campdir . '/listdelete/?' . $param->output());

        $layoutconfig = array('layout' => 'layout', 'skin' => 'index');
        $view['layout'] = $this->managelayout->admin($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }

    /**
     * 캠프 등록/수정
     */
    public function write($pid = 0)
    {
        $eventname = 'event_admin_camp_write';
        $this->load->event($eventname);

        $view = array();
        $view['view'] = array();

        if ($pid) {
            $pid = (int) $pid;
            if (empty($pid) OR $pid < 1) {
                show_404();
            }
        }

        $primary_key = $this->{$this->modelname}->primary_key;
        $getdata = array();
        if ($pid) {
            // get_one 메소드가 없다면 아래 메소드를 Camp_model에 추가해야 합니다
            $getdata = $this->camp_model->get_one($pid);
        }

        /**
         * Validation 라이브러리를 가져옵니다
         */
        $this->load->library('form_validation');

        /**
         * 전송된 데이터의 유효성을 체크합니다
         */
        $config = array(
            array(
                'field' => 'ch_num',
                'label' => '캠프명',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'ch_start',
                'label' => '시작일',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'ch_end',
                'label' => '종료일',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'ch_location',
                'label' => '지역',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'ch_place',
                'label' => '장소',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'ch_pay',
                'label' => '참가비',
                'rules' => 'trim|required|numeric',
            )
        );

        $this->form_validation->set_rules($config);
        $form_validation = $this->form_validation->run();

        if ($form_validation) {
            // 파일 업로드 처리
            $upload_path = config_item('uploads_dir') . '/camp/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0707, true);
            }

            $this->load->library('upload');

            // 첨부파일 업로드
            $ch_file = '';
            if (isset($_FILES['ch_file']) && !empty($_FILES['ch_file']['name'])) {
                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = '*';
                $config['max_size'] = '20480'; // 20MB
                $config['encrypt_name'] = true;

                $this->upload->initialize($config);
                if ($this->upload->do_upload('ch_file')) {
                    $ch_file = $this->upload->data('file_name');
                }
            }

            // 시간표 이미지 업로드
            $ch_schedule = '';
            if (isset($_FILES['ch_schedule']) && !empty($_FILES['ch_schedule']['name'])) {
                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '5120'; // 5MB
                $config['encrypt_name'] = true;

                $this->upload->initialize($config);
                if ($this->upload->do_upload('ch_schedule')) {
                    $ch_schedule = $this->upload->data('file_name');
                }
            }

            $updatedata = array(
                'ch_num' => $this->input->post('ch_num', true),
                'ch_start' => $this->input->post('ch_start', true),
                'ch_end' => $this->input->post('ch_end', true),
                'ch_location' => $this->input->post('ch_location', true),
                'ch_place' => $this->input->post('ch_place', true),
                'ch_pay' => $this->input->post('ch_pay', true),
                'ch_to' => $this->input->post('ch_to', true),
                'ch_addr' => $this->input->post('ch_addr', true),
                'ch_tel' => $this->input->post('ch_tel', true),
                'ch_link' => $this->input->post('ch_link', true),
                'ch_year' => $this->input->post('ch_year', true),
                'ch_season' => $this->input->post('ch_season', true),
                'ch_etc_pro' => $this->input->post('ch_etc_pro', true),
                'bank_name' => $this->input->post('bank_name', true),
                'bank_num' => $this->input->post('bank_num', true),
                'ch_close' => $this->input->post('ch_close') ? '마감' : '접수중',
                'icon' => $this->input->post('icon', true)  // icon 필드 추가
            );

            // 파일이 업로드된 경우에만 updatedata에 추가
            if ($ch_file) {
                $updatedata['ch_file'] = $ch_file;
            }
            if ($ch_schedule) {
                $updatedata['ch_schedule'] = $ch_schedule;
            }

            if ($this->input->post($primary_key)) {
                $this->camp_model->update($this->input->post($primary_key), $updatedata);
                $this->session->set_flashdata('message', '정상적으로 수정되었습니다');
            } else {
                $updatedata['ch_num'] = time();
                $this->camp_model->insert($updatedata);
                $this->session->set_flashdata('message', '정상적으로 입력되었습니다');
            }

            $param =& $this->querystring;
            $redirecturl = admin_url($this->campdir . '?' . $param->output());
            redirect($redirecturl);
        }

        $view['view']['data'] = $getdata;
        $view['view']['primary_key'] = $primary_key;

        $layoutconfig = array('layout' => 'layout', 'skin' => 'write');
        $view['layout'] = $this->managelayout->admin($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }


    public function copy($pid)
    {
        if (!$pid) {
            return false;
        }

        $camp = $this->camp_model->get_one($pid);

        if ($camp) {
            unset($camp['idx']);
            $camp['ch_num'] = time();
            $this->camp_model->insert($camp);

            $this->output->set_content_type('application/json')
                ->set_output(json_encode(['success' => true]));
        }
    }

}