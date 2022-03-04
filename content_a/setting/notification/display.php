<?php
$html = '';

if(!\lib\app\plugin\business::is_activated('sms_pack'))
{
  $html .= '<a href="'. \dash\url::kingdom(). '/a/plugin/view/sms_pack">';
  {
    $html .= '<div class="alert-info text-sm font-bold">';
    {
      $html .= '<div>' .T_("You must get the sms pack plugin to active this notification"). '</div>';
    }
    $html .= '</div>';
  }
  $html .= '</a>';
}


$sample  = \lib\app\setting\notification::get_sample();

foreach ($sample as $event => $value)
{
  $html .= '<section class="f" data-option="setting-notification-print-show-vat" id="setting-notification-print-show-vat">';
    $html .= '<div class="c8 s12">';
      $html .= '<div class="data">';
        $html .= '<h3>'. T_("Send sms") . ' '. a($value, 'title').'</h3>';
        $html .= '<div class="body">';
          $html .= '<p>'. a($value, 'text').'</p>';

          if(is_array(a($value , 'template')) && a($value, 'active'))
          {
            $html .= '<div data-kerkere=".showTemplete'.$event.'" data-kerkere-icon class="btn-light btn-sm">' . T_("Change template"). '</div>';
            $html .= '<div class="showTemplete'.$event.'" data-kerkere-content="hide">';
            {
              foreach ($value['template'] as $k => $v)
              {
                $html .= '<div class="alert-primary mt-2" data-ajaxify data-method="post" data-data=\'{"set_template":"set", "event" : "'.$event.'", "template":"'.$k.'"}\'>';
                {
                  $html .= $v;
                }
                $html .= '</div>';

              }
            }
            $html .= '</div>';
          }

        $html .= '</div>';
      $html .= '</div>';
    $html .= '</div>';
    $html .= '<form class="c4 s12" method="post" data-patch>';
      $html .= '<input type="hidden" name="set_'.$event.'" value="1">';
      $html .= '<div class="action">';
        $html .= '<div class="switch1">';
          $html .= '<input type="checkbox" name="'.$event.'" id="set_'.$event.'" ';
          if(a($value, 'active'))
          {
            $html .= 'checked';
          }
          $html .= '>';
          $html .= '<label for="set_'.$event.'" data-on="'. T_("On") .'" data-off="'. T_("Off"). '"></label>';
        $html .= '</div>';
      $html .= '</div>';
    $html .= '</form>';
  $html .= '</section>';

}

echo $html;
?>
