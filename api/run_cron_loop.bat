@echo off
REM Sürekli çalışan cronjob scripti
REM Bu dosyayı görev zamanlayıcıya "sistem başlatıldığında çalıştır" olarak ekleyin

REM PHP yolunu ayarlayın (XAMPP için)
set PHP_PATH=C:\xampp\php\php.exe

REM Script yolunu ayarlayın
set SCRIPT_PATH=%~dp0cron_update_cache.php

:loop
REM Scripti çalıştır
"%PHP_PATH%" -f "%SCRIPT_PATH%"

REM 20 saniye bekle 
timeout /t 20 /nobreak >nul

REM Döngüye devam et
goto loop

