<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apply extends CB_Controller
{
    public $campdir = 'camp/apply';
    protected $modelname = 'Camp_model';

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form'); // form 헬퍼 로딩
        $this->load->library(array('pagination', 'querystring'));
        $this->load->model('Camp_model');
    }

    public function index($camp_idx = null)
    {
        $eventname = 'event_admin_camp_apply_index';
        $this->load->event($eventname);

        $view = array();
        $view['view'] = array();

        // GET 파라미터로 전달된 camp_idx 확인
        if (!$camp_idx) {
            $camp_idx = $this->input->get('camp_idx');
        }

        // 진행중인 캠프 목록 가져오기
        $camp_list = $this->Camp_model->get_active_camps();
        $view['view']['camp_list'] = $camp_list;

        // 기본 선택 캠프가 없으면 '전체' 선택
        if (!$camp_idx) {
            $camp_idx = 'all';
        }

        // 선택된 캠프 idx 뷰로 전달
        $view['view']['selected_camp_idx'] = $camp_idx;

        // 페이징 관련 변수 설정 (이 부분이 누락되었습니다)
        $param =& $this->querystring;
        $page = (((int) $this->input->get('page')) > 0) ? ((int) $this->input->get('page')) : 1;
        $per_page = admin_listnum();
        $offset = ($page - 1) * $per_page;

        // 검색 조건
        $where = array();
        if ($camp_idx && $camp_idx !== 'all') {
            $where['refkey'] = $camp_idx;
        }

        // 캠프 상태 조건 추가
        $ch_close = $this->input->get('ch_close');
        if ($ch_close) {
            $where['ch_close'] = $ch_close;
        }

        // 캠프 상태 조건 추가
        $ch_season = $this->input->get('ch_season');
        if ($ch_season) {
            $where['ch_season'] = $ch_season;
        }

        // 년도 목록 가져오기
        $years = $this->Camp_model->get_years();
        $view['view']['years'] = $years;

        // 캠프 정보 (전체가 아닐 경우에만)
        $camp_info = null;
        if ($camp_idx && $camp_idx !== 'all') {
            $camp_info = $this->Camp_model->get_one($camp_idx);
        }
        $view['view']['camp_info'] = $camp_info;

        // 신청자 목록
        $result = $this->Camp_model->get_apply_list($per_page, $offset, $where);

        $list_num = $result['total_rows'] - ($page - 1) * $per_page;
        if (element('list', $result)) {
            foreach (element('list', $result) as $key => $val) {
                $result['list'][$key]['num'] = $list_num--;
            }
        }

        $view['view']['data'] = $result;

        // 페이지네이션
        $config['base_url'] = admin_url($this->campdir) . '?' . $param->replace('page');
        $config['total_rows'] = $result['total_rows'];
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $view['view']['paging'] = $this->pagination->create_links();
        $view['view']['page'] = $page;

        $search_option = array(
            'church_nm' => '교회명',
            'damim_nm' => '담임목사',
            'resp_nm' => '담당자명'
        );

        $view['view']['skeyword'] = ($this->input->get('skeyword') ? $this->input->get('skeyword') : '');
        $view['view']['search_option'] = search_option($search_option, $this->input->get('sfield'));

        $view['view']['listall_url'] = admin_url($this->campdir);

        $layoutconfig = array('layout' => 'layout', 'skin' => 'index');
        $view['layout'] = $this->managelayout->admin($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }


    public function write($idx = null)
    {
        $eventname = 'event_admin_camp_apply_write';
        $this->load->event($eventname);

        $view = array();
        $view['view'] = array();

        // 이벤트가 존재하면 실행
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        if ($idx) {
            $apply_data = $this->Camp_model->get_apply_one($idx);
            if (!$apply_data) {
                show_404();
            }
            $view['view']['data'] = $apply_data;

            // 관련 캠프 정보 가져오기
            if (isset($apply_data['refkey'])) {
                $camp_info = $this->Camp_model->get_one($apply_data['refkey']);
                $view['view']['camp_info'] = $camp_info;
            }
        }

        // 뷰 설정
        $layoutconfig = array(
            'layout' => 'layout',
            'skin' => 'write'
        );
        $view['layout'] = $this->managelayout->admin($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }

    public function write_update()
    {


        // POST 데이터 검증
        $this->load->library('form_validation');

        $this->form_validation->set_rules('church_nm', '교회명', 'required');
        $this->form_validation->set_rules('resp_nm', '담당자명', 'required');
        $this->form_validation->set_rules('mobile', '연락처', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('message', validation_errors('<div class="alert alert-danger">', '</div>'));
            redirect($_SERVER['HTTP_REFERER']);
            return;
        }

        // 저장할 데이터 준비
        $data = array(
            'church_nm' => $this->input->post('church_nm'),
            'kyodan' => $this->input->post('kyodan'),
            'zip' => $this->input->post('zip'),
            'addr1' => $this->input->post('addr1'),
            'addr2' => $this->input->post('addr2'),
            'resp_nm' => $this->input->post('resp_nm'),
            'position' => $this->input->post('position'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            'pastor_male' => $this->input->post('pastor_male'),
            'pastor_female' => $this->input->post('pastor_female'),
            'teacher_male' => $this->input->post('teacher_male'),
            'teacher_female' => $this->input->post('teacher_female'),
            'student_male' => $this->input->post('student_male'),
            'student_female' => $this->input->post('student_female'),
            'sale_price' => $this->input->post('sale_price'),
            'sale_total' => $this->input->post('sale_total'),
            'deposit' => $this->input->post('deposit'),
            'balance' => $this->input->post('balance'),
            'deposit_nm' => $this->input->post('deposit_nm'),
            'deposit_dt' => $this->input->post('deposit_dt'),
            'status' => $this->input->post('status'),
            'memo' => $this->input->post('memo')
        );

        $idx = $this->input->post('idx');

        if ($this->Camp_model->update_apply($idx, $data)) {
            $this->session->set_flashdata('message', '성공적으로 수정되었습니다.');
        } else {
            $this->session->set_flashdata('message', '수정 중 오류가 발생했습니다.');
        }

        redirect(admin_url($this->campdir));
    }


    // Apply.php 컨트롤러에 추가
    public function delete()
    {
        // 이벤트 이름 정의
        $eventname = 'event_admin_camp_apply_delete';
        $this->load->event($eventname);

        // 이벤트가 존재하면 실행
        Events::trigger('before', $eventname);

        // POST로 전달된 idx 값들을 확인
        $ids = $this->input->post('chk');
        if ($ids && is_array($ids)) {
            foreach ($ids as $idx) {
                $this->Camp_model->delete_apply($idx);
            }
            $this->session->set_flashdata('message', '선택한 항목이 삭제되었습니다');
        }

        // 이벤트가 존재하면 실행
        Events::trigger('after', $eventname);

        $param =& $this->querystring;
        $redirecturl = admin_url($this->campdir . '?' . $param->output());
        redirect($redirecturl);
    }



    public function print($idx = null)
    {
        if (!$idx) {
            show_404();
        }

        $view = array();
        $view['view'] = array();

        // 신청 데이터 가져오기
        $apply_data = $this->Camp_model->get_apply_one($idx);
        if (!$apply_data) {
            show_404();
        }
        $view['view']['data'] = $apply_data;

        // 관련 캠프 정보 가져오기
        if (isset($apply_data['refkey'])) {
            $camp_info = $this->Camp_model->get_one($apply_data['refkey']);
            $view['view']['camp_info'] = $camp_info;
        }

        // 인쇄용 레이아웃 설정
        $layoutconfig = array(
            'layout' => 'layout_print',
            'skin' => 'print'
        );
        $view['layout'] = $this->managelayout->admin($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }




}
