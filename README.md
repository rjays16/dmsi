# PCR-DEV

HOW TO INSTALL PROJECT for development
1. Clone this project to desired folder location
2. Prep the project for local development. go to terminal and select project location then execute following:
    = composer install
    = php artisan migrate
    = php artisan db:seed


HOW TO PULL NEW CHANGES TO SERVER
1. Access the server via Putty or any type of remote tool.
2. Go to project folder and execute following commands:
    = git pull
    = php artisan migrate *only if needed*
    = php artisan config:cache
    = sudo systemctl restart nginx *only if needed*
