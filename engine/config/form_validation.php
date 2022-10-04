<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| 폼검증 조건 추가
|--------------------------------------------------------------------------
|
| admin_sign_in: 관리자 인증 로그인 용
*/
$config = array();
$config['admin_sign_in'] = array(
    array(
        'field' => 'acmg_id',
        'label' => '관리자 아이디',
        'rules' => 'required'
    ),
    array(
        'field' => 'acmg_pw',
        'label' => '관리자 비밀번호',
        'rules' => 'required',
    ),
);

/*
* 샘플용
* ************************************************************************/
// 샘플운영자 회원가입
$config['sample_create'] = array(
    array(
        'field' => 'spmg_id',
        'label' => '샘플운영자 아이디',
        'rules' => 'required'
    ),
    array(
        'field' => 'spmg_name',
        'label' => '샘플운영자 성명',
        'rules' => 'required'
    ),
    array(
        'field' => 'spmg_pw',
        'label' => '관리자 비밀번호',
        'rules' => 'required|matches[spmg_re_pw]',
    ),
    array(
        'field' => 'spmg_re_pw',
        'label' => '관리자 비밀번호 확인',
        'rules' => 'required',
    ),
);

// 샘플운영자 회원수정
$config['sample_update'] = array(
    array(
        'field' => 'spmg_id',
        'label' => '샘플운영자 아이디',
        'rules' => 'required'
    ),
    array(
        'field' => 'spmg_name',
        'label' => '샘플운영자 성명',
        'rules' => 'required'
    )
);
