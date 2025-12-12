@echo off
REM Deprem Cache Güncelleme Scripti
REM Bu dosya her dakika çalıştırılacak şekilde görev zamanlayıcıya eklenmelidir

REM PHP yolunu ayarlayın (XAMPP için)
set PHP_PATH=C:\xampp\php\php.exe

REM Script yolunu ayarlayın
set SCRIPT_PATH=%~dp0cron_update_cache.php

REM Scripti çalıştır
"%PHP_PATH%" -f "%SCRIPT_PATH%"

REM Hata durumunda log'a yaz (opsiyonel)
if errorlevel 1 (
    echo [%date% %time%] Cron job hatasi >> "%~dp0..\cache\cron_error.log"
)

