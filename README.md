## Quick Installation
    !! MUST have MySQL installed with default root profile !!
    These are Windows Powershell Commands
    
    git clone https://github.com/Maruness/laravel-app

    cd laravel-app

    !! Skip this if PHP and Composer is already installed !!
    Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.4'))

    composer install

    npm install

    npm run build

    php artisan migrate

    php artisan serve
    
    ! Open another powershell/command prompt !
    
    composer run dev
    
## Laravel App (Simple Task List)
A Laravel Application for taking down and logging task.

How to use?
Upon starting, register as a user or login if you already have an account. Explore a bit upon logging to see the different functionalities.
To add a task, simply enter a name in the task input bar and then click the + to add it to your task list. Tick as complete or Delete task depends on you. 

## Tools Used
- Laravel v12
- PHP
- Blade
- Vite
- TailwindCSS v4.1
- MySQL
