EventCalendar

1. What is it?
EventCalendar it's simple web-application calendar to organize and show your events on site pages.


2. How it use?
EventCalendar has two basic pages: FRONTEND and BACKEND.
Usually BACKEND - is admin page to set or update events information.
And FRONTEND - is user page with calendar view and list view of current month events.
(Backend permissions not implements in EventCalendar, it's in your case).

On calendar view exists events marks with orange (just event) and red (fixed, i.e. important) colors.
BACKEND user can create, update and delete events. Use calendar grid to navigate by days, month or years.
BACKEND and FRONTEND calendar views equals but in BACKEND calendar you can navigate by days, by clicking on target day.
FRONTEND calendar view can't, it just view.


3. How to install?
- DB: Set DB-access params to your DB in index.php file line 25-29.
  Then execute SQL queries from file db.sql. It will create new table for events and set some test data for January of 2015 year.

- Nginx: package contents sample nginx server configuraton. Use it to set up server for event calendar web-application.

On this point you would have web-application. Let us suppose you use sample configuration and your application it accessible by url: http://events/
By this URL you find frontend view of event calendar and can navigate on it.


4. What is application flow?
Your request directing to index.php file, that prepare EventCalendar to execute, and then go to
backend.php or frontend.php, it depends by chosen page.
Then it's include and display template from templates/frontend.phtml or templates/backend.phtml


5. Why so many files in package? What is it for?
Application needed files is:

|--lib/
|   |--Event/
|   |  |--Repository/
|   |  |   '--DB.php
|   |  |
|   |  |--Calendar.php
|   |  '--IRepository.php
|   |
|   |--DB.php
|   '--Utils.php
|
|--templates/
|   |--backend.phtml
|   |--backend-clean.phtml
|   |--frontend.phtml
|   '--frontend-clean.phtml
|
|--backend.php
|--frontend.php
'--index.php

All other files is styles or visual assets of calendar.
If you want use only application needed files without jquery, css and images, then you can change templates.
For example package contents templates/frontend-clean.phtml and templates/backend-clean.phtml to demonstrate it.
To use this 'clean' templates you need go to backend.php line 44:

    include_once TEMPLATES_DIR . DIRECTORY_SEPARATOR . "backend.phtml";

And change it to:

    include_once TEMPLATES_DIR . DIRECTORY_SEPARATOR . "backend-clean.phtml";

And go to frontend.php line 20:

    include_once TEMPLATES_DIR . "/frontend.phtml";

And change it to:

    include_once TEMPLATES_DIR . "/frontend-clean.phtml";

That's all. After this changes, your EventCalendar will be use simplified templates, that you can adjust as you need.
