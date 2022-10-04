# Xampp를 이용한 로컬 개발 환경 셋팅 및 에러처리

1-1)

> C:\xampp\apache\conf\extra\httpd-vhosts.conf 파일 수정 => 아래내용 추가

```php
## LOCAL_CI3_DEVLAB_SAMPLE 프로젝트 연습용
<VirtualHost *:80>
    ServerAdmin [개인메일주소]
    DocumentRoot "D:/mework/LOCAL_CI3_DEVLAB_SAMPLE"
    ServerName ci3sample
    ServerAlias www.ci3sample.loc.kr ci3sample.loc.kr ci3sample
    ErrorLog "logs/ci3sample.loc.kr-error.log"
    CustomLog "logs/ci3sample.loc.kr-access.log" common
</VirtualHost>
```

1-2)

> C:\Windows\System32\drivers\etc\hosts 파일 수정 => 아래내용 추가

```php
127.0.0.1 ci3sample.loc.kr
```

1-3)
[CI3 기본 화면 확인](http://ci3sample.loc.kr/ "CI 기본 화면으로 이동합니다.")

**`※ 에러처리`**

1. <u>접근이 거부됨 으로 나올때</u>

> C:\xampp\apache\conf\httpd.conf 파일 수정 => Xampp에 Apache재시작

변경전)

```php
<Directory />
    AllowOverride none
    Require all denied
</Directory>
```

변경후)

```php
<Directory />
    AllowOverride All
    #Require all denied
</Directory>
```
