<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Camp_model extends CB_Model
{
    public $_table = 'camp_info';
    public $primary_key = 'idx';

    function __construct()
    {
        parent::__construct();
    }

    public function get_camp_list($limit = '', $offset = '', $where = '', $like = '', $findex = '', $forder = '')
    {
        try {
            $result = array();

            // 전체 레코드 수를 구하기 위한 쿼리
            $this->db->select('count(*) as rownum');
            $this->db->from($this->_table);

            // hide 조건 제거하고 where 조건만 적용
            if (is_array($where) && !empty($where)) {
                $this->db->where($where);
            }

            if ($like) {
                $this->db->like($like);
            }

            $tmpquery = $this->db->get();

            if (!$tmpquery) {
                log_message('error', 'Database Error: ' . $this->db->error()['message']);
                return array('total_rows' => 0, 'list' => array());
            }

            $rows = $tmpquery->row_array();
            $result['total_rows'] = $rows['rownum'];

            // 실제 데이터를 가져오는 쿼리
            $this->db->select('*');
            $this->db->from($this->_table);

            // hide 조건 제거하고 where 조건만 적용
            if (is_array($where) && !empty($where)) {
                $this->db->where($where);
            }

            if ($like) {
                $this->db->like($like);
            }

            if ($findex) {
                $this->db->order_by($findex, $forder);
            }

            if ($limit) {
                $this->db->limit($limit, $offset);
            }

            $qry = $this->db->get();
            $result['list'] = $qry->result_array();

//            print_r($this->db->last_query());
//            exit;

            return $result;

        } catch (Exception $e) {
            log_message('error', 'Exception in get_camp_list: ' . $e->getMessage());
            return array('total_rows' => 0, 'list' => array());
        }
    }




    public function get_my_camp_list($userid, $limit = '', $offset = '', $where = '') {
        $result = array();

        $this->db->select('a.*, i.ch_num, i.ch_start, i.ch_end, i.ch_place');
        $this->db->from('wh_camp_apply a');  // 테이블명 수정
        $this->db->join('wh_camp_info i', 'a.refkey = i.idx', 'left');  // 테이블명 수정
        $this->db->where('a.wr_id', $userid);

        if (is_array($where) && !empty($where)) {
            $this->db->where($where);
        }

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $this->db->order_by('a.idx', 'DESC');

        // 쿼리 로깅
        $query = $this->db->get();
//        print_r($this->db->last_query());
//        exit;
//        log_message('debug', 'Last Query: ' . $this->db->last_query());
        $result['list'] = $query->result_array();

        $this->db->select('count(*) as cnt');
        $this->db->from('wh_camp_apply'); // 테이블명 수정
        $this->db->where('wr_id', $userid);
        if ($where) {
            $this->db->where($where);
        }

        $total = $this->db->get()->row();
        $result['total_rows'] = $total->cnt;

        return $result;
    }


    public function get_upcoming_camps() {
        $today = date('Y-m-d');
        $result = array();

        // 각 지역별로 가장 빠른 날짜의 캠프 하나씩 가져오기
        $this->db->select('MIN(idx) as idx');
        $this->db->from($this->_table);
        $this->db->where('ch_end >=', $today);
        $this->db->where('hide', '0');
        $this->db->group_by('ch_location');
        $subquery = $this->db->get_compiled_select();

        $this->db->select('ch_location, ch_start, ch_end');
        $this->db->from($this->_table);
        $this->db->where_in('idx', "($subquery)", false);
        $this->db->order_by('ch_start', 'ASC');
        $this->db->limit(3);

        return $this->db->get()->result_array();
    }


    public function get_one($idx)
    {
        if (empty($idx)) {
            return false;
        }

        $this->db->where($this->primary_key, $idx);
        $result = $this->db->get($this->_table);

        return $result->row_array();
    }

    public function get_current_applicants($campId) {
        $this->db->select_sum('pastor_male', 'pastor_male');
        $this->db->select_sum('pastor_female', 'pastor_female');
        $this->db->select_sum('teacher_male', 'teacher_male');
        $this->db->select_sum('teacher_female', 'teacher_female');
        $this->db->select_sum('student_male', 'student_male');
        $this->db->select_sum('student_female', 'student_female');
        $this->db->where('refkey', $campId);
        $result = $this->db->get('wh_camp_apply')->row();

        return array_sum((array)$result);
    }




    public function get_apply_list($limit = '', $offset = '', $where = '')
    {
        $result = array();
        $today = date('Y-m-d');

        // 기본 검색 조건 추가
        $sfield = $this->input->get('sfield');
        $skeyword = $this->input->get('skeyword');

        // 전체 레코드 수 쿼리
        $this->db->select('a.*, i.ch_num, i.ch_pay');
        $this->db->from('wh_camp_apply a');
        $this->db->join($this->_table . ' i', 'a.refkey = i.idx', 'left');

        // 마감되지 않은 캠프만 표시하는 조건 제거
        // $this->db->where('i.ch_end >=', $today);
        // 이 라인 제거
        // $this->db->where('i.ch_close', '접수중');

        if (is_array($where) && !empty($where)) {
            $this->db->where($where);
        }

        // 검색 조건 추가
        if ($skeyword) {
            if ($sfield) {
                $this->db->like('a.' . $sfield, $skeyword);
            } else {
                $this->db->group_start();
                $this->db->like('a.church_nm', $skeyword);
                $this->db->or_like('a.damim_nm', $skeyword);
                $this->db->or_like('a.resp_nm', $skeyword);
                $this->db->group_end();
            }
        }

        $tmpquery = $this->db->get();
        $result['total_rows'] = $tmpquery->num_rows();

        // 실제 데이터를 가져오는 쿼리에서도 동일하게 수정
        $this->db->select('a.*, i.ch_num, i.ch_pay');
        $this->db->from('wh_camp_apply a');
        $this->db->join($this->_table . ' i', 'a.refkey = i.idx', 'left');

        //$this->db->where('i.ch_end >=', $today);
        // 이 라인 제거
        // $this->db->where('i.ch_close', '접수중');

        if (is_array($where) && !empty($where)) {
            $this->db->where($where);
        }

        // 년도 조건 추가
        $ch_year = $this->input->get('ch_year');
        if ($ch_year) {
            $this->db->where('i.ch_year', $ch_year);
        }

        // 계절 조건 추가
        $ch_season = $this->input->get('ch_season');
        if ($ch_season) {
            $this->db->where('i.ch_season', $ch_season);
        }

        // 검색 조건 추가 (동일하게 적용)
        if ($skeyword) {
            if ($sfield) {
                $this->db->like('a.' . $sfield, $skeyword);
            } else {
                $this->db->group_start();
                $this->db->like('a.church_nm', $skeyword);
                $this->db->or_like('a.damim_nm', $skeyword);
                $this->db->or_like('a.resp_nm', $skeyword);
                $this->db->group_end();
            }
        }

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $this->db->order_by('a.idx', 'DESC');

        $qry = $this->db->get();
        $result['list'] = $qry->result_array();

        return $result;
    }


    public function get_apply_one($idx)
    {
        if (empty($idx)) {
            return false;
        }

        $this->db->select('*');
        $this->db->from('wh_camp_apply');
        $this->db->where('idx', $idx);

        $result = $this->db->get();


        return $result->row_array();
    }

    public function update_apply($idx, $data)
    {
        if (empty($idx)) {
            return false;
        }

        $this->db->where('idx', $idx);
        return $this->db->update('wh_camp_apply', $data);
    }

    public function delete_apply($idx)
    {
        if (empty($idx)) {
            return false;
        }
        $this->db->where('idx', $idx);
        $this->db->delete('camp_apply');
        return true;
    }


    public function insert_apply($data)
    {
        // 데이터 존재 확인
        if (empty($data)) {
            return false;
        }

        try {
            // 로그 기록
            log_message('debug', 'Inserting apply data: ' . print_r($data, true));

            // 데이터 삽입
            $result = $this->db->insert('camp_apply', $data);

            if ($result) {
                return $this->db->insert_id();
            } else {
                // DB 에러 로그 기록
                log_message('error', 'Database Error: ' . $this->db->error()['message']);
                return false;
            }
        } catch (Exception $e) {
            // 예외 발생시 로그 기록
            log_message('error', 'Exception in insert_apply: ' . $e->getMessage());
            return false;
        }
    }

    public function get_active_camps() {
        $this->db->select('*');
        $this->db->from($this->_table);

        // 상태 조건이 있는 경우 적용
        $ch_close = $this->input->get('ch_close');
        if ($ch_close) {
            $this->db->where('ch_close', $ch_close);
        }

        $this->db->order_by('ch_start', 'DESC');
        return $this->db->get()->result_array();
    }


    public function get_years() {
        $this->db->select('ch_year');
        $this->db->from($this->_table);
        $this->db->where('ch_year IS NOT NULL');
        $this->db->group_by('ch_year');
        $this->db->order_by('ch_year', 'DESC');

        $query = $this->db->get();

//        print_r($this -> db -> last_query());
//        exit;

        return $query->result_array();
    }

}