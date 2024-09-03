<?php
echo'set lang';
if(in_array(request('lang'),['ar','en'])){
    set_locale(request('lang'));
}
// redirect('/back_end/03-practicing/');
back();