# Competition deploy document

## How to install
1. [Install Composer](https://getcomposer.org/download/) and then [install Laravel](https://laravel.com/docs/5.5/installation) and [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git) on your server if you haven't already
2. Clone this repository on your server by running this command: `git clone https://github.com/ssssssander/competition.git`
3. Create a `.env` file in your project root folder based on the `.env.example` file, also located in the project root folder. Make sure you fill in database info, mail info, admin info (remember to encapsulate your name in double quotes if it contains spaces), your app URL, your app key, whether or not you're running in production and anything else you may want to add
4. Run `composer install` in your project root folder to install all the Composer dependencies
5. Run `php artisan migrate:refresh --seed` in your project root folder to set up your admin account and default terms
6. If you wish to change the default terms, enter the website and log in using your admin credentials and edit the terms in the dashboard
7. Run `crontab -e` and add this Cron entry to the end of the file to set up the Laravel scheduler and start the competition: `* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1`

## Additional info
- The Laravel form builder dependency is vital to this project, don't remove it
- When a term ends an email will be sent notifying of the term ending to the admin email address
- Every day at 23:59 an email with an Excel file attached containing all the participants on that day will be sent to the admin email address
- When you remove a participant, the row is soft deleted
- When you press the reset button all participants will be hard deleted, terms will be reset to the default, the current term will revert back to 1, and any winners will be removed from all terms. This will essentially give you a clean slate, use with caution.
- When you edit the terms, the current term will be reverted to 1 and any winners will be removed from all terms
- Remember to never make your `.env` file publicly available
