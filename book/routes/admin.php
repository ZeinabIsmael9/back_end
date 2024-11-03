<?php

define('ADMIN', 'admin');

route_get(ADMIN, 'admin.index');
route_get(ADMIN . '/lang', 'controllers.admin.set_lang');
//admin authenticate
route_get(ADMIN . '/login', 'admin.login');
route_get(ADMIN . '/logout', 'controllers.admin.logout');
route_post(ADMIN . '/do/login','controllers.admin.login');


//catrgories CDUD
route_get(ADMIN . '/categories', 'admin.categories.index');
route_get(ADMIN . '/categories/create', 'admin.categories.create');
route_get(ADMIN . '/categories/show', 'admin.categories.show');
route_get(ADMIN . '/categories/show', 'admin.categories.show');
route_get(ADMIN . '/categories/edit', 'admin.categories.edit');
route_post(ADMIN . '/categories/edit', 'controllers.admin.categories.update');
route_post(ADMIN . '/categories/delete', 'controllers.admin.categories.destroy');
route_post(ADMIN . '/categories/create', 'controllers.admin.categories.create');



//users CDUD
route_get(ADMIN . '/users', 'admin.users.index');
route_get(ADMIN . '/users/create', 'admin.users.create');
route_post(ADMIN . '/users/create', 'controllers.admin.users.create');
route_get(ADMIN . '/users/show', 'admin.users.show');
route_get(ADMIN . '/users/show', 'admin.users.show');
route_get(ADMIN . '/users/edit', 'admin.users.edit');
route_post(ADMIN . '/users/edit', 'controllers.admin.users.update');
route_post(ADMIN . '/users/delete', 'controllers.admin.users.destroy');




//books CDUD
route_get(ADMIN . '/books', 'admin.books.index');
route_get(ADMIN . '/books/create', 'admin.books.create');
route_post(ADMIN . '/books/create', 'controllers.admin.books.create');
route_get(ADMIN . '/books/show', 'admin.books.show');
route_get(ADMIN . '/books/show', 'admin.books.show');
route_get(ADMIN . '/books/edit', 'admin.books.edit');
route_post(ADMIN . '/books/edit', 'controllers.admin.books.update');
route_post(ADMIN . '/books/delete', 'controllers.admin.books.destroy');
