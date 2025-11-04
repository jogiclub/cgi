<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Converter_gnuboard class
 *
 * 이 소스는 그누보드를 씨아이보드로 변환하는 프로그램입니다.
 * 그누보드 및 씨아이보드 모두 수시로 버전업이 되기 때문에, 그리고 회원님께서 운영하고 계신 그누보드가 최신버전이 아닐 경우도 있기 때문에
 * 항상 올바르게 작동할수는 없습니다.
 * 
 * 이 컨버터는 그누보드 5.1.x 를 씨아이보드 1.3.5 로 변환하는 기준으로 작성되었습니다
 *
 */

class Converter_gnuboard extends CB_Controller
{


	/**
	*  이 페이지 접근 가능 IP 입니다
	*  여기에 현재 접속하고 계신 IP 를 입력해주세요
	*/
	protected $allow_ip = '172.69.58.21';
	protected $gnuboard_prefix = 'g5_';
	protected $default_prefix;
	protected $limit ='1000';


	/**
	*  모델을 로딩합니다
	*/
	protected $models = array('Post', 'Comment');

	/**
	*  헬퍼를 로딩합니다
	*/
	protected $helpers = array('form', 'array');

	function __construct()
	{
		parent::__construct();

		if($this->member->is_admin() == FALSE) {
			alert('최고관리자만 접근이 가능합니다');
		}

		$this->default_prefix = $this->db->dbprefix;

	}

	public function _check_allowed_ip()
	{
		if($this->allow_ip == '' OR $this->allow_ip != $this->input->ip_address()) {
			$header = array();
			$header['converter_step'] = 0;
			$this->load->view('converter_gnuboard/header',  $header);
			$this->load->view('converter_gnuboard/step0');
			$this->load->view('converter_gnuboard/footer');
			return FALSE;
		}

		return TRUE;

	}

	/**
	*  그누보드를 씨아이보드로 컨버팅하는 페이지입니다
	*/
	public function index()
	{
		if( ! $this->_check_allowed_ip()) {
			return;
		}

		redirect('converter_gnuboard/step1');
	}

	public function step1()
	{

		if( ! $this->_check_allowed_ip()) {
			return;
		}

		$view = array();
		$header = array();
		$message = '';
		
		$gnuboard_prefix = $this->gnuboard_prefix;
		$this->db->set_dbprefix($gnuboard_prefix);

		$view['title1'] = '그누보드 prefix';
		$view['content1'] = '<span class="bold color_blue">' . $this->gnuboard_prefix .'</span>';

		$view['title2'] = 'config 테이블';
		$e = $this->db->table_exists('config');
		if ($e) {
			$view['content2'] = '<span class="bold color_blue">발견</span>';
		} else {
			$view['content2'] = '<span class="bold color_red">발견되지 않음</span>';
			$message .= "그누보드 config 테이블이 발견되지 않았습니다.<br />";
		}
		
		$view['title3'] = 'member 테이블';
		if ($this->db->table_exists('member')) {
			$view['content3'] = '<span class="bold color_blue">발견</span>';
		} else {
			$view['content3'] = '<span class="bold color_red">발견되지 않음</span>';
			$message .= "그누보드 member 테이블이 발견되지 않았습니다.<br />";
		}
		
		$view['title4'] = 'board 테이블';
		if ($this->db->table_exists('board')) {
			$view['content4'] = '<span class="bold color_blue">발견</span>';
		} else {
			$view['content4'] = '<span class="bold color_red">발견되지 않음</span>';
			$message .= "그누보드 board 테이블이 발견되지 않았습니다.<br />";
		}

		if($message) $message .= '그누보드 prefix 가 올바른지 확인하여주시고, 테이블이 존재하는지 확인하여주세요. prefix 는 Convert_gnuboard.php 의 &dollar;gnuboard_prefix 변수에서 수정이 가능합니다.';


		$header['converter_step'] = 1;
		$view['message'] = $message;
		$this->load->view('converter_gnuboard/header',  $header);
		$this->load->view('converter_gnuboard/step1', $view);
		$this->load->view('converter_gnuboard/footer');
	}


	public function step2($conv='', $start='')
	{

		if( ! $this->_check_allowed_ip()) {
			return;
		}

		$view = array();
		$header = array();
		$message = '';
		
		if( ! $start OR ! is_numeric($start)) $start = 0;
		$limit = $this->limit;
		$end = '';
		$next = 0;
		
		$gnuboard_prefix = $this->gnuboard_prefix;
		$this->db->set_dbprefix($gnuboard_prefix);
	
		$this->db->select('count(*) as cnt');
		$qry = $this->db->get('member');
		$count  = $qry->row_array();
		$total_count = $count['cnt'];
		
		if($conv == 'conv') {
			$this->db->limit($limit, $start);
			$this->db->order_by('mb_no', 'asc');
			$qry = $this->db->get('member');
			$result = $qry->result_array();
			
			$this->db->set_dbprefix($this->default_prefix);
			if($result) {
				foreach($result as $key => $value) {
					
					$this->db->select('count(*) as cnt');
					$this->db->where('mem_userid', element('mb_id', $value));
					$this->db->or_where('mem_email', element('mb_email', $value));
					$this->db->or_where('mem_nickname', element('mb_nick', $value));
					$sql = $this->db->get('member');
					$mresult = $sql->row_array();

					if( ! $mresult['cnt']) {
						
						$mb_email_certify = 0;
						if(element('mb_email_certify', $value) > '0000-00-00 00:00:00') {
							$mb_email_certify = 1;
						}

						$mb_denied = 0;
						if(element('mb_leave_date', $value) OR element('mb_intercept_date', $value)) {
							$mb_denied = 1;
						}

						$mb_zip = '';
						if(element('mb_zip1', $value) && element('mb_zip2', $value)) {
							$mb_zip = element('mb_zip1', $value) . '-' . element('mb_zip2', $value);
						}

						$insertdata = array(
							'mem_userid' => element('mb_id', $value),
							'mem_email' => element('mb_email', $value),
							'mem_password' => element('mb_password', $value),
							'mem_username' => element('mb_name', $value),
							'mem_nickname' => element('mb_nick', $value),
							'mem_level' => element('mb_level', $value),
							'mem_point' => element('mb_point', $value),
							'mem_homepage' => element('mb_homepage', $value),
							'mem_phone' => element('mb_hp', $value),
							'mem_birthday' => element('mb_birth', $value),
							'mem_sex' => element('mb_sex', $value),
							'mem_zipcode' => $mb_zip,
							'mem_address1' => element('mb_addr1', $value),
							'mem_address2' => element('mb_addr2', $value),
							'mem_address3' => element('mb_addr3', $value),
							'mem_address4' => element('mb_addr_jibeon', $value),
							'mem_receive_email' => element('mb_mailling', $value),
							'mem_use_note' => element('mb_open', $value),
							'mem_receive_sms' => element('mb_sms', $value),
							'mem_open_profile' => element('mb_open', $value),
							'mem_denied' => $mb_denied,
							'mem_email_cert' => $mb_email_certify,
							'mem_register_datetime' => element('mb_datetime', $value),
							'mem_register_ip' => element('mb_ip', $value),
							'mem_lastlogin_datetime' => element('mb_today_login', $value),
							'mem_lastlogin_ip' => element('mb_login_ip', $value),
							'mem_profile_content' => element('mb_profile', $value),
							'mem_adminmemo' => element('mb_memo', $value),
						);
						$this->db->insert('member', $insertdata);
					}
					
				} 
			}

			$next = $start + $limit;
			if($next >= $total_count) { 
				$next = $total_count;
				$end = '1';
			}
			$message = '총 ' . number_format($total_count) . ' 건 중 ' . $next . ' 건이 이전되었습니다';
			if( $end ) {
				$message .= '<br />이전이 모두 완료되었습니다. 다음단계로 이동하시면 됩니다.';
			} else {
				$message .= '<br />이전하기 버튼을 누르시면 다음 ' . $limit . ' 건이 계속하여 이전됩니다';
			}
		} 

		$header['converter_step'] = 2;
		$view['message'] = $message;
		$view['start'] = $start;
		$view['next'] = $next;
		$view['end'] = $end;
		$view['limit'] = $limit;
		$view['total_count'] = $total_count;
		$this->load->view('converter_gnuboard/header',  $header);
		$this->load->view('converter_gnuboard/step2', $view);
		$this->load->view('converter_gnuboard/footer');
	}


	// 게시물 이전
	public function step3($gnutable='', $brd_id='', $start='')
	{

		if( ! $this->_check_allowed_ip()) {
			return;
		}

		$view = array();
		$header = array();
		$message = '';
		
		if( ! $start OR ! is_numeric($start)) $start = 0;
		$limit = $this->limit;
		$end = '';
		$next = 0;
		$gnuboard = '';
		$ciboard = '';
		$gnuboardinfo = '';
		$ciboardinfo = '';
	
		if($gnutable && $brd_id) {
			$this->db->set_dbprefix($this->gnuboard_prefix);
			$this->db->where('wr_is_comment', '0');
			$this->db->limit($limit, $start);
			$this->db->order_by('wr_id', 'asc');
			$qry = $this->db->get('write_' . $gnutable);
			$result = $qry->result_array();

			$this->db->where('bo_table', $gnutable);
			$qry = $this->db->get('board');
			$gnuboardinfo = $qry->row_array();
			

			$this->db->set_dbprefix($this->default_prefix);
			
			$this->db->where('brd_id', $brd_id);
			$qry = $this->db->get('board');
			$ciboardinfo = $qry->row_array();
			
			$this->load->model(array('Board_model', 'Board_group_model', 'Comment_model', 'Like_model', 'Post_extra_vars_model',  'Post_file_model', 'Post_link_model', 'Post_meta_model', 'Scrap_model' ));

			if($result) {
				foreach($result as $key => $post) {
					
					// 게시글 이전
					$post_num = $this->Post_model->next_post_num();

					$mem_id = 0;
					$memwhere = array('mem_userid' => $post['mb_id']);
					$mb = $this->Member_model->get_one('', '', $memwhere);
					if($mb) $mem_id = $mb['mem_id'];

					$link_count = 0;
					if($post['wr_link1']) $link_count++;
					if($post['wr_link2']) $link_count++;
					$post_secret = '0';
					if(strpos($post['wr_option'], 'secret')) $post_secret = '1';

					$post_html = '0';
					if(strpos($post['wr_option'], 'html1')) $post_html = '1';
					
					// 게시글 입력
					$insertdata = array(
						'post_num' => $post_num,
						'post_reply' => $post['wr_reply'],
						'brd_id' => $brd_id,
						'post_title' => $post['wr_subject'],
						'post_content' => $post['wr_content'],
						'mem_id' => $mem_id,
						'post_userid' => $post['mb_id'],
						'post_nickname' => $post['wr_name'],
						'post_email' => $post['wr_email'],
						'post_homepage' => $post['wr_homepage'],
						'post_datetime' => $post['wr_datetime'],
						'post_password' => $post['wr_password'],
						'post_updated_datetime' => $post['wr_datetime'],
						'post_update_mem_id' => $mem_id,
						'post_link_count' => $link_count,
						'post_secret' => $post_secret,
						'post_html' => $post_html,
						'post_hit' => $post['wr_hit'],
						'post_ip' => $post['wr_ip'],
						'post_device' => 'desktop',
					);
					$new_post_id = $this->Post_model->insert($insertdata);
					
					// 링크 입력
					if($post['wr_link1']) {
						$linkinsert = array(
							'post_id' => $new_post_id,
							'brd_id' => $brd_id,
							'pln_url' => $post['wr_link1'],
							'pln_hit' => $post['wr_link1_hit'],
						);
						$this->Post_link_model->insert($linkinsert);
					}
					if($post['wr_link2']) {
						$linkinsert = array(
							'post_id' => $new_post_id,
							'brd_id' => $brd_id,
							'pln_url' => $post['wr_link2'],
							'pln_hit' => $post['wr_link2_hit'],
						);
						$this->Post_link_model->insert($linkinsert);
					}
					

					// 첨부파일 입력
					$this->db->set_dbprefix($this->gnuboard_prefix);
					$filewhere = array(
						'bo_table' => $gnutable,
						'wr_id' => $post['wr_id'],
					);
					$this->db->where($filewhere);
					$fileqry = $this->db->get('board_file');
					$fileresult = $fileqry->result_array();
					
					$this->db->set_dbprefix($this->default_prefix);
					
					$filenum = 0;
					$imagenum = 0;
					if ($fileresult) {
						foreach ($fileresult as $data) {
							
							$year = substr($data['bf_datetime'], 0, 4);
							$month = substr($data['bf_datetime'], 5, 2);

							$upload_path = './uploads/post/';
							if ( ! is_dir($upload_path)) {
								mkdir($upload_path, 0707);
								$file = $upload_path . 'index.php';
								$f = @fopen($file, 'w');
								@fwrite($f, '');
								@fclose($f);
								@chmod($file, 0644);
							}
							$upload_path .= $year . '/';
							if ( ! is_dir($upload_path)) {
								mkdir($upload_path, 0707);
								$file = $upload_path . 'index.php';
								$f = @fopen($file, 'w');
								@fwrite($f, '');
								@fclose($f);
								@chmod($file, 0644);
							}
							$upload_path .= $month . '/';
							if ( ! is_dir($upload_path)) {
								mkdir($upload_path, 0707);
								$file = $upload_path . 'index.php';
								$f = @fopen($file, 'w');
								@fwrite($f, '');
								@fclose($f);
								@chmod($file, 0644);
							}
							if( ! file_exists('./data/file/' . $gnutable . '/' .  $data['bf_file'])) continue;
							$new_file_name = $year . '/' . $month . '/' . $data['bf_file'];
							$bftype = explode('.', $data['bf_file']);
							$bf_type = $bftype[count($bftype)-1];
							$is_image = ($data['bf_type']) ? '1':'0'; 
							if($is_image) {
								$imagenum ++;
							} else {
								$filenum ++;
							}
							$fileinsert = array(
								'post_id' => $new_post_id,
								'brd_id' => $brd_id,
								'mem_id' => $mem_id,
								'pfi_originname' => $data['bf_source'],
								'pfi_filename' => $new_file_name,
								'pfi_download' => $data['bf_download'],
								'pfi_filesize' => $data['bf_filesize'],
								'pfi_width' => $data['bf_width'],
								'pfi_height' => $data['bf_height'],
								'pfi_type' => $bf_type,
								'pfi_is_image' => $is_image,
								'pfi_datetime' => $data['bf_datetime'],
								'pfi_ip' => $post['wr_ip'],
							);
							$this->Post_file_model->insert($fileinsert);
							copy('./data/file/' . $gnutable . '/' .  $data['bf_file'] , './uploads/post/' . $new_file_name);
						}
					}
					
					// 추천, 비추천 입력
					$this->db->set_dbprefix($this->gnuboard_prefix);
					$goodwhere = array(
						'bo_table' => $gnutable,
						'wr_id' => $post['wr_id'],
					);
					$this->db->where($goodwhere);
					$goodqry = $this->db->get('board_good');
					$goodresult = $goodqry->result_array();
					
					$this->db->set_dbprefix($this->default_prefix);
					
					$good = 0;
					$nogood = 0;
					if ($goodresult) {
						foreach ($goodresult as $data) {
							
							$good_mem_id = '';
							$memwhere = array('mem_userid' => $data['mb_id']);
							$mb = $this->Member_model->get_one('', '', $memwhere);
							if($mb) {
								$good_mem_id = $mb['mem_id'];
							} else {
								continue;
							}
							if($data['bg_flag'] == 'good') {
								$lik_type = 1;
								$good ++;
							} else {
								$lik_type = 2;
								$nogood ++;
							}
							$goodinsert = array(
								'target_id' => $new_post_id,
								'target_type' => '1',
								'brd_id' => $brd_id,
								'mem_id' => $good_mem_id,
								'target_mem_id' => $mem_id,
								'lik_type' => $lik_type,
								'lik_datetime' => $data['bg_datetime'],
							);
							$this->Like_model->insert($goodinsert);
						}
					}

					$updata = array(
						'post_file' => $filenum,
						'post_image' => $imagenum,
						'post_like' => $good,
						'post_dislike' => $nogood,
					);
					$this->Post_model->update($new_post_id, $updata);


					// 스크랩 입력
					$this->db->set_dbprefix($this->gnuboard_prefix);
					$scrapwhere = array(
						'bo_table' => $gnutable,
						'wr_id' => $post['wr_id'],
					);
					$this->db->where($scrapwhere);
					$scrapqry = $this->db->get('scrap');
					$scrapresult = $scrapqry->result_array();
					
					$this->db->set_dbprefix($this->default_prefix);
					
					if ($scrapresult) {
						foreach ($scrapresult as $data) {
							
							$memwhere = array('mem_userid' => $data['mb_id']);
							$mb = $this->Member_model->get_one('', '', $memwhere);
							if($mb) {
								$scrap_mem_id = $mb['mem_id'];
							} else {
								continue;
							}
							$scrapinsert = array(
								'mem_id' => $scrap_mem_id,
								'post_id' => $new_post_id,
								'brd_id' => $brd_id,
								'target_mem_id' => $mem_id,
								'scr_datetime' => $data['ms_datetime'],
							);
							$this->Scrap_model->insert($scrapinsert);
						}
					}

					// 댓글 입력
					$this->db->set_dbprefix($this->gnuboard_prefix);
					$cmtwhere = array(
						'wr_is_comment' => '1',
						'wr_num' => $post['wr_num'],
					);
					$this->db->where($cmtwhere);
					$this->db->order_by('wr_id', 'asc');
					$cmtqry = $this->db->get('write_' .$gnutable);
					$cmtresult = $cmtqry->result_array();
					
					$this->db->set_dbprefix($this->default_prefix);
					
					if ($cmtresult) {
						foreach ($cmtresult as $data) {
							
							$memwhere = array('mem_userid' => $data['mb_id']);
							$mb = $this->Member_model->get_one('', '', $memwhere);
							if($mb) {
								$cmt_mem_id = $mb['mem_id'];
							} else {
								$cmt_mem_id = 0;
							}

							$cmt_num = $this->Comment_model->next_comment_num();
							$cmt_secret = '0';
							if(strpos($data['wr_option'], 'secret')) $cmt_secret = '1';

							$cmt_html = '0';
							if(strpos($data['wr_option'], 'html1')) $cmt_html = '1';
							
							$cmtinsert = array(
								'post_id' => $new_post_id,
								'brd_id' => $brd_id,
								'cmt_num' => $cmt_num,
								'cmt_reply' => $data['wr_comment_reply'],
								'cmt_html' => $cmt_html,
								'cmt_secret' => $cmt_secret,
								'cmt_content' => $data['wr_content'],
								'mem_id' => $cmt_mem_id,
								'cmt_password' => $data['wr_password'],
								'cmt_userid' => $data['mb_id'],
								'cmt_nickname' => $data['wr_name'],
								'cmt_email' => $data['wr_email'],
								'cmt_homepage' => $data['wr_homepage'],
								'cmt_datetime' => $data['wr_datetime'],
								'cmt_updated_datetime' => $data['wr_datetime'],
								'cmt_ip' => $data['wr_ip'],
								'cmt_device' => 'desktop',
							);
							$this->Comment_model->insert($cmtinsert);
						}
					}

				}
			}
			
			$this->db->set_dbprefix($this->gnuboard_prefix);
			$this->db->select('count(*) as cnt');
			$this->db->where('wr_is_comment', '0');
			$qry = $this->db->get('write_' . $gnutable);
			$count  = $qry->row_array();
			$total_count = $count['cnt'];
			
			$next = $start + $limit;
			if($next >= $total_count) { 
				$next = $total_count;
				$end = '1';
			}
			$message = '이전중 : 그누보드 ' . html_escape(element('bo_subject', $gnuboardinfo)) . ' ( ' . element('bo_table', $gnuboardinfo) . ' ) => 씨아이보드 ' . html_escape(element('brd_name', $ciboardinfo)) . ' ( ' . element('brd_key', $ciboardinfo) . ' )';
			$message .= '<br />총 ' . number_format($total_count) . ' 건 중 ' . $next . ' 건이 이전되었습니다';
			if( $end ) {
				$message .= '<br />이전이 모두 완료되었습니다. <br />계속하여 다른 게시판 이전을 윈하시면 &quot;새로운 게시판 이전하기&quot; 를 클릭하여 계속 진행하여 주세요.';
			} else {
				$message .= '<br />이전하기 버튼을 누르시면 다음 ' . $limit . ' 건이 계속하여 이전됩니다';
			}
		} else {
			$this->db->set_dbprefix($this->gnuboard_prefix);
			$qry = $this->db->get('board');
			$gnuboard = $qry->result_array();
			
			$this->db->set_dbprefix($this->default_prefix);
			$qry = $this->db->get('board');
			$ciboard = $qry->result_array();
		} 

		$header['converter_step'] = 3;
		$view['message'] = $message;
		$view['start'] = $start;
		$view['next'] = $next;
		$view['end'] = $end;
		$view['limit'] = $limit;
		$view['gnuboard'] = $gnuboard;
		$view['ciboard'] = $ciboard;
		$view['gnutable'] = $gnutable;
		$view['brd_id'] = $brd_id;
		$this->load->view('converter_gnuboard/header',  $header);
		$this->load->view('converter_gnuboard/step3', $view);
		$this->load->view('converter_gnuboard/footer');
	}

}
