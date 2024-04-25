<?php
//Файл роутинга (регистрация страниц)
require_once "app/Services/Router.php";


Router::page('/', 'main');
Router::page('/search', 'search');
Router::page('/create_tables', 'createTables');
Router::page('/fill_database', 'fillDatabase');

Router::enable();