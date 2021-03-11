<?php

$result = '';

if(\dash\data::needVerifyEmail())
{
    $result .= '<div class="msg info2 font-12">';
    $result .= '<p>';
    $result .= T_("If you want to manage this domain you must add this emails to your account and verify it");
    $result .= '</p>';

    foreach (\dash\data::needVerifyEmail() as $key => $value)
    {
    	$result .= '<a class="badge light font-12 mLa5" href="'. \dash\url::kingdom(). '/account/my/email?v=1&email='. $value. '">';
    	$result .= $value;
    	$result .= '</a>';
    }

    $result .= '</div>';
}

echo $result;

$result = ''; // need to this!

?>
