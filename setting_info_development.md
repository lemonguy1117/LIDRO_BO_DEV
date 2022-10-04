# CI 기본 폴더 변경 및 에러처리

`1-1) application_folder폴더 변경`

> ex) D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\application\index.php 파일 수정

변경 전)

```php
$application_folder = 'application';
```

변경 후)

```php
$application_folder = 'engine';
```

변경 후 에러 발생 메세지)

```html
Your application folder path does not appear to be set correctly. Please open
the following file and correct this: index.php
```

**`※ 에러 처리 방법`**

```html
D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\application 폴더명을
D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\engine 으로 변경
```

`1-2) view_folder폴더 변경`

> ex) D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\application\index.php 파일 수정

변경 전)

```php
$view_folder = '';
```

변경 후)

```php
$view_folder = 'builds';
```

변경 후 에러 발생 메세지1)

```html
Your view folder path does not appear to be set correctly. Please open the
following file and correct this: index.php
```

**`※ 에러 발생 메세지1 처리 방법`**

```html
D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\ 밑에 D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\builds
폴더 생성
```

변경 후 에러 발생 메세지2) 

```html
Warning: include(D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\builds\errors\html\error_php.php): Failed to open stream: No such file or directory in
D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\system\core\Exceptions.php on line 269

Warning: include(): Failed opening 'D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\builds\errors\html\error_php.php' for inclusion (include_path='C:\xampp\php\PEAR') in
D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\system\core\Exceptions.php on line 269

Warning: include(D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\builds\errors\html\error_php.php): Failed to open stream: No such file or directory in
D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\system\core\Exceptions.php on line 269

Warning: include(): Failed opening 'D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\builds\errors\html\error_php.php' for inclusion (include_path='C:\xampp\php\PEAR') in
D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\system\core\Exceptions.php on line 269
```

**`※ 에러 발생 메세지2 처리 방법`**

```html
D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\engine\views\폴더의 전체 파일을(errors폴더
하위 다 포함) D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\builds\폴더의 하위로 전체 복사
```

`1-3) 구조 세팅 1차 삭제할 폴더 및 파일 삭제`

- D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\engine\controllers\Blog.php 파일 삭제
- D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\engine\builds\welcome_message.php 파일 삭제
- D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\engine\third_party 폴더 삭제
- D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\engine\views 폴더 삭제

# 구조 추가 폴더 지정

`1-1) 관리자 페이지 주소 상수와 Template\_(2.2.8 버전) 파일들 추가 및 템플릿 언더바 폴더 선언`

변경 전)

```php
	define('VIEWPATH', $view_folder.DIRECTORY_SEPARATOR);
/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 */
require_once BASEPATH.'core/CodeIgniter.php';
```

변경 후)

```php
	define('VIEWPATH', $view_folder.DIRECTORY_SEPARATOR);

    [하단내용]추가
/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 */
require_once BASEPATH.'core/CodeIgniter.php';
```

`[하단내용]추가`

```php
/*
 * --------------------------------------------------------------------
 * Codding By jbKim
 * 코드이그나이터에서 사용되는 이외의 상수를 추가합니다.
 * --------------------------------------------------------------------
 */
	// 관리자 페이지 주소
	define('ADMINURL', 'admin');
	// 템플릿 언더바 폴더 경로 지정
	$tpleng_folder = 'template_';
	if (is_dir(APPPATH.$tpleng_folder.DIRECTORY_SEPARATOR))
	{
		$view_folder = APPPATH.strtr(
			trim($tpleng_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
	else
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Template_ Engine is not defined .'.SELF;
		exit(3); // EXIT_CONFIG
	}
	define('TPLENGINEPATH', APPPATH.$tpleng_folder.DIRECTORY_SEPARATOR);
```

변경 후 에러 발생 메세지)

Template\_ Engine is not defined .index.php

에러 처리 방법)

다운받은 Template*.2.2.8.zip파일을 압축을 푼다.
압축푼 Template*.2.2.8 폴더를 하위 폴더 파일까지 복사하여 D:\mework\LOCAL*CI3_DEVLAB_SAMPLE\engine\template* 로 복사한다.

`1-2) 리소스 폴더 및 파일 업로드 폴더 추가 선언`

변경 전)

```php
	define('TPLENGINEPATH', APPPATH.$tpleng_folder.DIRECTORY_SEPARATOR);
/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 */
require_once BASEPATH.'core/CodeIgniter.php';
```

변경 후)

```php
	define('TPLENGINEPATH', APPPATH.$tpleng_folder.DIRECTORY_SEPARATOR);
    [하단내용]추가
/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 */
require_once BASEPATH.'core/CodeIgniter.php';
```

`[하단내용]추가`

```php
	// 리소스 폴더 추가
	$etc_folder = 'etc';
	if (is_dir($etc_folder))
	{
		if (($_temp = realpath($etc_folder)) !== FALSE)
		{
			$etc_folder = $_temp;
		}
		else
		{
			$etc_folder = strtr(
				rtrim($etc_folder, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			);
		}
	}
	elseif (is_dir(BASEPATH.$etc_folder.DIRECTORY_SEPARATOR))
	{
		$etc_folder = BASEPATH.strtr(
			trim($etc_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
	else
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your etc folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG
	}
	define('ETCPATH', $etc_folder.DIRECTORY_SEPARATOR);
	// 파입 업로드 폴더 추가
	define('UPLOADPATH', $etc_folder.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR);
```

변경 후 에러 발생 메세지)

Your etc folder path does not appear to be set correctly. Please open the following file and correct this: index.php

에러 처리 방법)

D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\etc 폴더 생성

# form_validation & custom 전용 언어셋 설정

`1-1) form_validation 설정`

> ex) D:\zaksimwork\PICKKOADMIN_REPO\engine\config\form_validation.php 파일 생성
아래내용 처럼 폼 검증 규칙을 넣는다.

```php
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
```

> `사용방법`
컨트롤에서 [하단 내용]으로 사용

```php
$this->load->library('form_validation');
if ($this->form_validation->run('admin_sign_in')) {
} else {
	// echo validation_errors();
	$this->tinyjs->pageBack(str_replace("\n", "\\n", strip_tags(validation_errors())));
}
```

`1-2) custom 전용 언어셋 설정`

> ex) D:\zaksimwork\PICKKOADMIN_REPO\engine\config\autoload.php 파일 수정
변경 전)

```php
$autoload['language'] = array('');
```

변경 후)

```php
$autoload['language'] = array('custom'); //custom은 변경가능
```

파일 추가)
> ex) D:\zaksimwork\PICKKOADMIN_REPO\engine\language\korean\custom_lang.php 파일 추가
```php
<?php
/*
|--------------------------------------------------------------------------
| 전용 언어셋입니다.
|--------------------------------------------------------------------------
| 명명규칙
| cm: 커스텀메세지
| _ + manager: 컨트롤명
| _ + fileupload: 액션(최대2뎁스까지)
| _ + 상태: success(성공), fail(실패), error(에러) 등
*/
defined('BASEPATH') or exit('No direct script access allowed');
// 공통 메세지 관련
$lang['cm_url_error'] = '비정상 접근입니다.';
$lang['cm_have_upfile_fail'] = '업로드할 파일이 존재하지 않습니다.';
$lang['cm_file_upload_fail'] = '파일 업로드에 실패 했습니다.';
$lang['cm_have_no_upfile_error'] = '업로드한 파일이 존재하지 않습니다.';
$lang['cm_upfile_allowed_extension_error'] = '유효하지 않는 파일 확장자입니다.';
$lang['cm_have_seq_data_error'] = '일련번호 데이터가 존재하지 않습니다.';
$lang['cm_have_no_data_error'] = '데이터가 존재하지 않습니다.';
$lang['cm_excel_field_set_error'] = '엑셀 다운로드 양식을 설정해주세요.';
$lang['cm_meta_group_set_error'] = '메타 그룹을 설정해주세요.';
$lang['cm_meta_create_success'] = '정상(메타) 등록 처리되었습니다.';
$lang['cm_meta_update_success'] = '정상(메타) 수정 처리되었습니다.';
$lang['cm_proc_create_success'] = '정상적으로 등록 처리되었습니다.';
$lang['cm_proc_update_success'] = '정상적으로 수정 처리되었습니다.';
// 관리자 로그인 관련
$lang['cm_admin_auth_error'] = '관리자가 아닙니다.';
$lang['cm_admin_sign_in_fail'] = '아이디, 비밀번호를 확인해주세요.';
```

> `사용방법`
컨트롤에서 [하단 내용]으로 사용

```php
$this->js->pageBack($this->lang->line("cm_error_admin_sign_in"));
```