<?php
$result = '';
$result .= '<nav class="items long">';
  $result .= '<ul>';

    $result .= '<li>';
      $result .= '<a class="f item" href="'.\dash\url::that(). '?domain='. \dash\request::get('domain').'">';
        $result .= '<div class="key">'. T_("Domain"). '</div>';
        $result .= '<div class="value txtB">'. \dash\data::domainDetail_name(). '</div>';
        $result .= '<div class="go detail"></div>';
      $result .= '</a>';
    $result .= '</li>';
    $result .= '</ul>';
$result .= '</nav>';
echo $result;
?>
