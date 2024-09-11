ECHO OFF
ECHO (a) artisan down
ECHO (b) git pull
ECHO (c) composer install
ECHO (d) npm install
ECHO (e) !!! Update .env file !!!
ECHO (f) artisan migrate
ECHO (g) artisan db:seed
ECHO (h) !!! copy storage/app directory /storage/app !!!
ECHO (i) npm build
ECHO (j) composer autoloader
ECHO (k) clean cache
ECHO (l) !!! restart job queue (php artisan queue:work) !!!
ECHO (m) artisan up
set /p "selection=Run command? "
IF "%selection%"=="a" (
    php artisan down
) ELSE IF "%selection%"=="b" (
    git pull
) ELSE IF "%selection%"=="c" (
    composer install
) ELSE IF "%selection%"=="d" (
    npm install
) ELSE IF "%selection%"=="e" (
    ECHO *
    ECHO !!! Update .env file !!!
    ECHO *
) ELSE IF "%selection%"=="f" (
    php artisan migrate
) ELSE IF "%selection%"=="g" (
    php artisan db:seed
) ELSE IF "%selection%"=="h" (
    ECHO *
    ECHO !!! copy storage/app directory /storage/app !!!
    ECHO *
) ELSE IF "%selection%"=="i" (
    npm run build
) ELSE IF "%selection%"=="j" (
    composer install --optimize-autoloader --no-dev
) ELSE IF "%selection%"=="k" (
    php artisan config:cache
    pause
    php artisan event:cache	
    pause
    php artisan view:cache
     pause
) ELSE IF "%selection%"=="l" (
    ECHO *
    ECHO !!! restart job queue php artisan queue:work !!!
    ECHO *
) ELSE IF "%selection%"=="m" (
    php artisan up
) ELSE (
 ECHO no command selected
)