<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Camp class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 */

class Camp extends CB_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Camp_model');
        $this->load->library(array('pagination', 'querystring'));
        $this->load->helper(array('form', 'array'));
    }

    /**
     * 캠프 목록을 보여주는 함수입니다
     */
    public function index()
    {
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_camp_index';
        $this->load->event($eventname);

        $view = array();
        $view['view'] = array();

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        $where = array();
        $where['ch_close !='] = '마감';  // 마감된 캠프 제외

        $findex = 'ch_start';
        $forder = 'asc';

        // 검색 관련 변수 및 where/like 조건 제거
        $result = $this->Camp_model->get_camp_list('', '', $where, '', $findex, $forder);


        $list_num = $result['total_rows'];
        if (element('list', $result)) {
            foreach (element('list', $result) as $key => $val) {
                $result['list'][$key]['num'] = $list_num--;
            }
        }

        $view['view']['data'] = $result;

        // 레이아웃 설정
        $layoutconfig = array(
            'path' => 'camp',
            'layout' => 'layout',
            'skin' => 'list',
            'layout_dir' => $this->cbconfig->item('layout_default'),
            'mobile_layout_dir' => $this->cbconfig->item('mobile_layout_default'),
            'use_sidebar' => $this->cbconfig->item('sidebar_default'),
            'use_mobile_sidebar' => $this->cbconfig->item('mobile_sidebar_default'),
            'skin_dir' => 'basic',
            'mobile_skin_dir' => 'basic',
            'page_title' => '캠프 목록',
            'meta_description' => '캠프 목록을 보여줍니다',
            'meta_keywords' => '캠프',
            'meta_author' => '',
            'page_name' => '',
        );

        $view['layout'] = $this->managelayout->front($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }


    public function apply()
    {
        // AJAX 요청 체크
        if (!$this->input->is_ajax_request()) {
            show_error('Direct access is not allowed');
            return;
        }

        // JSON 응답 헤더 설정
        header('Content-Type: application/json; charset=utf-8');

        try {
            // 로그인 체크
//            if (!$this->member->is_member()) {
//                throw new Exception('로그인이 필요한 서비스입니다.');
//            }

            // post 데이터 받기
            $post = $this->input->post(null, true);

            // 필수값 체크
            if (empty($post['refkey']) || empty($post['church_nm']) || empty($post['resp_nm'])) {
                throw new Exception('필수 입력값이 누락되었습니다.');
            }

            // 데이터 준비
            $data = array(
                'refkey' => $post['refkey'],
                'wr_id' => $post['wr_id'],
                'pastor_male' => isset($post['pastor_male']) ? (int)$post['pastor_male'] : 0,
                'pastor_female' => isset($post['pastor_female']) ? (int)$post['pastor_female'] : 0,
                'teacher_male' => isset($post['teacher_male']) ? (int)$post['teacher_male'] : 0,
                'teacher_female' => isset($post['teacher_female']) ? (int)$post['teacher_female'] : 0,
                'student_male' => isset($post['student_male']) ? (int)$post['student_male'] : 0,
                'student_female' => isset($post['student_female']) ? (int)$post['student_female'] : 0,
                'church_nm' => $post['church_nm'],
                'kyodan' => $post['kyodan'],
                'damim_nm' => $post['damim_nm'],
                'resp_nm' => $post['resp_nm'],
                'email' => $post['email'],
                'position' => $post['position'],
                'mobile' => $post['mobile'],
                'status' => '가등록',
                'regdt' => date('Y-m-d H:i:s')
            );

            // 데이터 저장
            $insert_id = $this->Camp_model->insert_apply($data);

            if (!$insert_id) {
                throw new Exception('데이터 저장에 실패했습니다.');
            }




            // SMS 발송을 위한 캠프 정보 조회
            $camp_info = $this->Camp_model->get_one($post['refkey']);

            // SMS 라이브러리 로드
            $this->load->library('smslib');

            // SMS 수신자 정보
            $list = array(
                array(
                    'phone' => $post['mobile'],
                    'name' => $post['resp_nm']
                )
            );

            // 발신자 정보
            $sender = array(
                'phone' => $this->cbconfig->item('sms_admin_phone')
            );

            // SMS 내용
            // $content = /*element('ch_num', $camp_info) . */ "예약 감사합니다. 입금전용계좌는 농협 301-8990-5295-71 입니다.";

            if (!empty($camp_info['bank_name']) && !empty($camp_info['bank_num'])) {
                $content = "감사합니다. 입금전용계좌는 {$camp_info['bank_name']} {$camp_info['bank_num']} 입니다.";
            } else {
                $content = "30주년 어캠 예약을 감사합니다. 곧 공지 드립니다. 어캠본부";
            }

            // SMS 발송
            $smsresult = $this->smslib->send($list, $sender, $content, '', '캠프신청');

            // 성공 응답
            echo json_encode([
                'success' => true,
                'message' => '신청이 완료되었습니다.',
                'id' => $insert_id,
                'sms_sent' => $smsresult ? true : false
            ]);
            exit;





        } catch (Exception $e) {
            echo json_encode([
                'error' => true,
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }




}