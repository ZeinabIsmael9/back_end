<?php
//echo 'set lang';

// Validate and set the locale
if (in_array(request('lang'), ['ar', 'en'])) {
    set_locale(request('lang'));
}

back();
