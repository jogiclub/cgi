<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *--------------------------------------------------------------------------
 *Admin Page 에 보일 메뉴를 정의합니다.
 *--------------------------------------------------------------------------
 *
 * Admin Page 에 새로운 메뉴 추가시 이곳에서 수정해주시면 됩니다.
 *
 */


$config['admin_page_menu']['camp'] =
    array(
        '__config' => array('캠프설정', 'bi-calendar4-week'),
        'menu' => array(
            'camp_list?ch_close=N' => array('캠프목록', ''),
            'apply?&ch_year=2026&ch_season=겨울' => array('참가자', ''),
        ),
    );
