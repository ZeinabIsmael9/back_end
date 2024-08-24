<?php
define('ADMIN', 'admin');

route_get(ADMIN, 'admin.index');

route_get(ADMIN . '/lang', 'controllers.admin.set_lang');
//admin authenticate
route_get(ADMIN . '/login', 'admin.login');
route_get(ADMIN . '/logout', 'controllers.admin.logout');
//var_dump($routes);
route_post(ADMIN . '/do/login','controllers.admin.login');

//catrgories
route_get(ADMIN . '/categories', 'admin.categories.index');
route_get(ADMIN . '/categories/create', 'admin.categories.create');
route_post(ADMIN . '/categories/create', 'controllers.admin.categories.create');
