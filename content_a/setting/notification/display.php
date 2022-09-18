<?php
$html = '';



  $html .= '<a href="'. \dash\url::kingdom(). '/a/plan">';
  {
    $html .= '<div class="alert-info text-sm font-bold">';
    {
      $html .= '<div>' .T_("Check your SMS charge"). '</div>';
    }
    $html .= '</div>';
  }
  $html .= '</a>';



$sample  = \lib\app\setting\notification::get_sample();

foreach ($sample as $event => $value)
{
  $html .= '<section class="f" data-option="setting-notification-print-show-vat" id="setting-notification-print-show-vat">';
    $html .= '<div class="c8 s12">';
      $html .= '<div class="data">';
        $html .= '<h3>'. T_("Send sms") . ' '. a($value, 'title');
        if(a($value, 'sub_title'))
        {
          $html .= '  <small class="text-gray-400 text-xs">'. a($value, 'sub_title'). '</small>';
        }
        $html .='</h3>';
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


// $html .= '<div class="alert-info mt-2" >';
// {
//   $html .= T_("If you want to change the text of the SMS template, you can let us know via the ticket so that we can define a new template for you.");
//   $html .= '<a href="'. \dash\url::jibres(). '/my/ticket/add?title='. T_("SMS template"). '" target="_blank" data-direct> ';
//   {
//     $html .= T_("Send ticket");
//   }
//   $html .= '</a>';

// }
// $html .= '</div>';

echo $html;
?>

