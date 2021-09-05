<?php
$html = '';

$html .= '<div class="box">';
{
  foreach (\dash\data::myIconList() as $key => $value)
  {
    $myJson           = \dash\request::get();
    unset($myJson['callback']);
    $myJson['icon'] = $value;
    $myJson           = json_encode($myJson);
    $class = 'w-20 m-5 border-3';
    if($value === \dash\request::get('selected'))
    {
      $class .= ' border-4 border-light-gray-800 ';
    }
    $html .= "<div class='inline-block $class' data-ajaxify data-action=". \dash\url::site().  \dash\request::get('callback'). " data-data='". $myJson. "' class='vcard mB10'>";
    {
      $html .= \dash\utility\icon::svg($value, 'major');
    }
    $html .= '</div>';

  }
}
$html .= '</div>';

echo $html;
?>
