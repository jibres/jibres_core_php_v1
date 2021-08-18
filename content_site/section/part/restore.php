<?php 

 /**
   * btn restore
   */

$restore_json    = json_encode(['restore' => 'section']);

$html .= '<p class="msg">';
$html .= T_("This setting was removed. But you can restore it. If you save page, this section completely removed and can not be restore");
$html .= '</p>';
$restore_title = T_("Are you sure to restore this section?");


$html .= '<nav class="items long mT20">';
{
  $html .= '<ul>';
  {
    $html .= '<li>';
    {
        $html .= "<div class='item f' data-confirm data-title='$restore_title' data-data='$restore_json'>";
        {
          $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-2" src="'. \dash\utility\icon::url('Undo'). '">';
          $html .= '<div class="key">'. T_("Restore section"). '</div>';
          $html .= '<div class="go"></div>';
        }
        $html .= '</div>';
    }
    $html .= '</li>';
  }
  $html .= '</ul>';
}
$html .= '</nav>';

?>