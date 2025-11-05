<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Main class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

/**
 * 메인 페이지를 담당하는 controller 입니다.
 */
class Main extends CB_Controller
{

	/**
	 * 모델을 로딩합니다
	 */
    protected $models = array('Board', 'Camp');


	/**
	 * 헬퍼를 로딩합니다
	 */
	protected $helpers = array('form', 'array');

	function __construct()
	{
		parent::__construct();

		/**
		 * 라이브러리를 로딩합니다
		 */
		$this->load->library(array('querystring'));
        $this->load->model('Camp_model'); // 추가
	}


	/**
	 * 전체 메인 페이지입니다
	 */
    public function index()
    {
        $view = array();
        $view['view'] = array();

        // 메인 페이지용 upcoming 캠프 데이터
        $result = $this->Camp_model->get_upcoming_camps();
        $view['view']['data'] = array('list' => $result);

        // 모달용 전체 캠프 리스트
        $where = array();
        $where['ch_close !='] = '마감';
        $findex = 'ch_start';
        $forder = 'asc';
        $camp_list = $this->Camp_model->get_camp_list('', '', $where, '', $findex, $forder);

//        print_r($camp_list);
//        exit;

        // camp_list를 board_list와 유사한 구조로 설정
        $modal_camp_list = array();
        if ($camp_list && isset($camp_list['list'])) {
            foreach ($camp_list['list'] as $key => $val) {
                $modal_camp_list[] = $val;
            }
        }
        $view['view']['modal_camp_list'] = $modal_camp_list;

        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_main_index';
        $this->load->event($eventname);

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        $where = array(
            'brd_search' => 1,
        );



		$board_id = $this->Board_model->get_board_list($where);
		$board_list = array();
		if ($board_id && is_array($board_id)) {
			foreach ($board_id as $key => $val) {
				$board_list[] = $this->board->item_all(element('brd_id', $val));
			}
		}
		$view['view']['board_list'] = $board_list;
		$view['view']['canonical'] = site_url();

		// 이벤트가 존재하면 실행합니다
		$view['view']['event']['before_layout'] = Events::trigger('before_layout', $eventname);

		/**
		 * 레이아웃을 정의합니다
		 */
		$page_title = $this->cbconfig->item('site_meta_title_main');
		$meta_description = $this->cbconfig->item('site_meta_description_main');
		$meta_keywords = $this->cbconfig->item('site_meta_keywords_main');
		$meta_author = $this->cbconfig->item('site_meta_author_main');
		$page_name = $this->cbconfig->item('site_page_name_main');

		$layoutconfig = array(
			'path' => 'main',
			'layout' => 'layout',
			'skin' => 'main',
			'layout_dir' => $this->cbconfig->item('layout_main'),
			'mobile_layout_dir' => $this->cbconfig->item('mobile_layout_main'),
			'use_sidebar' => $this->cbconfig->item('sidebar_main'),
			'use_mobile_sidebar' => $this->cbconfig->item('mobile_sidebar_main'),
			'skin_dir' => $this->cbconfig->item('skin_main'),
			'mobile_skin_dir' => $this->cbconfig->item('mobile_skin_main'),
			'page_title' => $page_title,
			'meta_description' => $meta_description,
			'meta_keywords' => $meta_keywords,
			'meta_author' => $meta_author,
			'page_name' => $page_name,
		);
		$view['layout'] = $this->managelayout->front($layoutconfig, $this->cbconfig->get_device_view_type());
		$this->data = $view;
		$this->layout = element('layout_skin_file', element('layout', $view));
		$this->view = element('view_skin_file', element('layout', $view));
	}
}
