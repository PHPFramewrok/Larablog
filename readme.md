## Larablog

This project aims to achieve a full-featured personnal website / blog.

This is an open source project, if you'd like to participate and/or use it, enjoy :)

# Installation
1. Git clone this repo
2. run <code>composer install</code>
3. at the root, create <code>.env</code> file and insert the following lines

```
APP_ENV=local
APP_DEBUG=true
APP_KEY=RandomString

DB_HOST=localhost
DB_DATABASE=larablog
DB_USERNAME=root
DB_PASSWORD=

```

4. run <code>php artisan key:generate</code>
5. Edit infos in .env file
6. Create a database and run <code>php artisan migrate</code>
7. run <code>php artisan db:seed</code>


# TODO

* Add Portfolio Management
* Make the menu editable from BackOffice
* Review registration process
* Profile Page and Profile Edit
* Add Footer
* Add Widgets emplacements
* Category List
* Search Form
* RSS Feed