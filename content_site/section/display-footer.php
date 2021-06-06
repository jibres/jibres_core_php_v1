<?php
$result = '';

if(\dash\data::adding())
{
  $data = json_encode(['select' => 'adding']);
  $result .= "<div class='btn master' data-ajaxify data-data='".$data."'>";
  $result .= T_("Select");
  $result .= '</div>';
}


echo $result;
?>