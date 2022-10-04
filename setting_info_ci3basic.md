# CI 기본 셋팅

`1-1) database 연결`

> ex) D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\engine\config\autoload.php 파일 수정 => 아래내용 변경

변경 전)

```php
$autoload['libraries'] = array();
```

변경 후)

```php
$autoload['libraries'] = array('database');
```

변경 후 에러 발생 메세지)

```html
A Database Error Occurred
Unable to connect to your database server using the provided settings.

Filename: D:/mework/LOCAL_CI3_DEVLAB_SAMPLE/system/database/DB_driver.php

Line Number: 437
```

**`※ 에러 처리 방법`**
 - D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\engine\config\database.php 파일 수정 => 데이타베이스 접속정보 입력

```php
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => '20ftadmin',
	'dbprefix' => 'dv_',
부분만 수정 나머진 동일
```

`1-2) session 연결`

> ex) D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\engine\config\autoload.php 파일 수정 => 아래내용 변경

변경 전)

```php
$autoload['drivers'] = array('');
```

변경 후)

```php
$autoload['drivers'] = array('session');
```

변경 후 에러 발생 메세지)

```html
없음
```

**`※ files 드라이버를 이용한 sessinon 연결 방법`**
 - D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\engine\config\config.php 파일 수정 => files 드라이버 설정정보 입력

변경 전)

```php
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = NULL;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;
```

변경 후)

```php
$r = implode('/', array_slice(explode('/', $_SERVER["SCRIPT_FILENAME"]),0,-1));	//추가됨
$config['sess_driver'] = 'files';				
$config['sess_cookie_name'] = 'ci_ck_session';									//변경됨
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = $r.'/session/';										//변경됨
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;
```

**`※ database 드라이버를 이용한 sessinon 연결 방법`**
 - D:\zaksimwork\PICKKOADMIN_REPO\engine\config\config.php 파일 수정 => database 드라이버 설정정보 입력

변경 전)

```php
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = NULL;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;
```

변경 후)

```php
$config['sess_driver'] = 'database';				//변경됨
$config['sess_cookie_name'] = 'ci_ck_session';		//변경됨
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = 'common_sessions';	//변경됨
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;
```

변경 후 에러 발생 메세지)

A Database Error Occurred
Error Number: 1146

Table '20ftadmin.dv_common_sessions' doesn't exist

SELECT 1 FROM `dv_common_sessions` WHERE `id` = 'vplf08f5n5irtg1f79qe7fd2662i5g2h'

Filename: D:/mework/LOCAL_CI3_DEVLAB_SAMPLE/system/database/DB_driver.php

Line Number: 692

**`※ 에러 발생 메세지 처리 방법`**

```html
해당 database에 하단[테이블 생성 sql문]을 이용하여 dv_common_sessions 테이블 생성
```

`테이블 생성 sql문`

```sql
CREATE TABLE `dv_common_sessions` (
	`id` VARCHAR(45) NOT NULL DEFAULT '' COLLATE 'utf8_general_ci',
	`ip_address` VARCHAR(40) NOT NULL DEFAULT '' COLLATE 'utf8_general_ci',
	`timestamp` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`data` BLOB NOT NULL DEFAULT '',
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `timestamp_KEY` (`timestamp`) USING BTREE
)
COMMENT='사이트 세션(CMSS)'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
```

확인 방법)

`컨트롤에서 [하단소스]로 확인`

```php
$session_id = session_id();
print_r($session_id);
```

## CI 기본 설정 값 변경

---

> D:\mework/LOCAL_CI3_DEVLAB_SAMPLE\engine\config\config.php 파일 수정 => 아래내용 변경

변경 전)

```php
$config['url_suffix'] = '';
$config['language']	= 'english';
$config['enable_hooks'] = FALSE;
$config['log_path'] = '';
$config['encryption_key'] = '';
$config['cookie_prefix']	= '';
```

변경 후)

```php
$config['url_suffix'] = '.do';
$config['language']	= 'korean';
$config['enable_hooks'] = TRUE;
$config['log_path'] = ETCPATH."logs";
$config['encryption_key'] = 'dltlqvlxmthffntus';
$config['cookie_prefix']	= 'dv_';
```