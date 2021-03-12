<?php
$result = '';
$result .= '<nav class="items">';
$result .= '<ul>';
$result .= '<li>';
$result .= '<a class="f item" href="'.\dash\url::that(). '?domain='. \dash\request::get('domain').'">';
$result .= '<div class="key">'. T_("Domain"). '</div>';
$result .= '<div class="value txtB">'. \dash\data::domainDetail_name(). '</div>';
$result .= '<div class="go '. a(\dash\data::domainDetail(), 'status_icon').'"></div>';
$result .= '</a>';
$result .= '</li>';
$result .= '</ul>';
$result .= '</nav>';
echo $result;
?>
