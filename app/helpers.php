<?php

use Illuminate\Support\Facades\Session;

function translate($phrase) 
{
    $set_lang = Session::get('lang');
    if(in_array($set_lang, explode(',', LANGUAGES))) {
        $phrases = File::getRequire(resource_path() . '/lang/' . $set_lang . '/phrases.php');
        if(isset($phrases[$phrase])) {
            return $phrases[$phrase];
        } else {
            return $phrase;
        }
    } else {
        return $phrase;
    }
}
?>