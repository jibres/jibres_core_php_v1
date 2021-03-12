<?php

$result = '';

if(\dash\data::needVerifyEmail())
{
    $result .= '<div class="msg info2 font-16">';
    $result .= '<p class="mB5-f">';
    $result .= T_("If you want to manage this domain you must add this emails to your account and verify it");
    $result .= '</p>';

    $result .= '<div class="ltr txtRa">';
    foreach (\dash\data::needVerifyEmail() as $key => $value)
    {
    	$result .= '<a class="btn primary font-12 mRa5" href="'. \dash\url::kingdom(). '/account/my/email?v=1&email='. $value. '">';
    	$result .= $value;
    	$result .= '</a>';
    }
    $result .= '</div>';

    $result .= '</div>';
}

echo $result;

$result = ''; // need to this!

?>
