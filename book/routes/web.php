<?php
include base_path('routes/admin.php');
route_get('/', 'home');
route_get('/lang', 'controllers.set_lang');
route_get('test','test');


route_post('upload','controllers.upload');
route_init();
// file_put_contents('debug.json', json_encode(['routes'=>$GET_ROUTES,'segment'=>$segment], JSON_PRETTY_PRINT)) ;
//    file_put_contents('debug.json', json_encode(['routes'=>$POST_ROUTES,'segment'=>$segment], JSON_PRETTY_PRINT)) ;
