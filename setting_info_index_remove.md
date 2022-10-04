# index.php 제거하기

1-1)

> ex) D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\application\controllers\Blog.php파일 생성 => 아래내용 추가

```php
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    public function index()
    {
        echo 'Hello World!';
    }
}
```

1-2) 결과: 브라우저 화면에 [Hello World!] 표시 되어야 정상

[CI 기본 블로그 화면 브라우저 확인](http://ci3sample.loc.kr/index.php/blog/ "CI 기본 블로그 화면으로 이동합니다.")

1-3)

> ex) D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\application\.htaccess 파일 복사하여 D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\.htaccess 로 복사 후에 파일 수정

`index.php죽일 때 사용`

```php
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```

1-4) 결과: 브라우저 화면에 [Hello World!] 표시 되어야 정상

[CI index.php 제거 후 블로그 화면 브라우저 확인](http://ci3sample.loc.kr/blog/ "CI index.php 제거 후 블로그 화면으로 이동합니다.")

**`※ CI 기본 설정 값 변경`**

> ex) D:\mework\LOCAL_CI3_DEVLAB_SAMPLE\application\config\config.php 파일 수정

변경 전)

```php
$config['base_url'] = '';
```

변경 후)

```php
if (isset($_SERVER['HTTP_HOST'])) {
    $config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http');
    $config['base_url'] .= '://' . $_SERVER['HTTP_HOST'];
    $config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
} else {
    $config['base_url'] = '';
}
```

변경 전)

```php
$config['index_page'] = 'index.php';
```

변경 후)

```php
$config['index_page'] = '';
```
