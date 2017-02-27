bookstore-symfony
=================

Bookstore demo project, created to demonstrate ability to use Symfony key features.


Install
=================
1. Clone this repo ( git clone https://bitbucket.org/dmitry-pro/bookstore-symfony )
2. Create MySQL or MariaDB database with name "bookstore-symfony"
3. Run "./install.sh" script
4. If You want to fill the database with some demo books data, simply run "bin/console doctrine:fixtures:load"
5. Create super-admin user: run "bin/console fos:user:create Admin admin@example.com pass --super-admin"
6. For dev purposes run "bin/console server:run" to launch embedded server
7. Try http://127.0.0.1:8000/app_dev.php. You can sign up and create new account to test basic features
8. To access backoffice try to log in with credentials "admin@example.com | pass"

Key features
=================

1. Main page (simple static page) - http://127.0.0.1:8000/app_dev.php
2. Books page (index/search/filter) - http://127.0.0.1:8000/app_dev.php (can be visited only by registered users)
3. Login page - http://127.0.0.1:8000/app_dev.php/login
4. Registration page - http://127.0.0.1:8000/app_dev.php/register
5. Password resetting page - http://127.0.0.1:8000/app_dev.php/resetting/request
3. Profile page (there You can view and edit profile, and change password) - http://127.0.0.1:8000/app_dev.php/profile
4. Backoffice (manage author/genre/book entities) - http://127.0.0.1:8000/app_dev.php/backoffice
5. Logout URI - http://127.0.0.1:8000/app_dev.php/logout

Search
=================

Implemented by using simple MySQL "LIKE" clauses and by-word split (for more wide resultset). No fulltext indexer and morphology support included.
Will be slow on high loads, usable only for demo purposes or on small data sets.

Mailing
=================

To test Password Resetting page You must receive a letter with the special link. If you are in dev environment, probably You have no mailer configured, so no letter will be sent.
But in dev environment we have EmailBundle that catches all the sent emails, so we can view all of them in "./var/logs/emails" folder.

Known issues
=================

1. No tests yet
2. Irresponsible HTML (no adaptivity)
3. Fixed books number per page (books_per_page parameter in parameters.yml)
