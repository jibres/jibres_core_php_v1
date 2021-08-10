<?php
  $delete_json    = json_encode(['remove' => 'page']);

  $remove_title = T_("Are you sure to remove this page?");
  $remove_desc = T_("All section will be removed and can not be restore");

  $html = '';
  $html .= '<div class="row w-full">';
  $html .= '<div class="cauto">';
  $html .= "<div tabindex=0 class='inline-block bg-gray-50 transition p-3 rounded-lg' data-confirm data-title='$remove_title' data-msg='$remove_desc' data-data='$delete_json'>";
  $html .= '<img class="w-8 inline-block" src="'. \dash\utility\icon::url('Delete', 'minor'). '" alt="Delete">';
  $html .= '<span class="inline-block align-middle ps-2">'. T_("Remove page").'<span>';
  $html .= '</div>';
  $html .= '</div>';
  $html .= '<div class="c"></div>';
  $html .= "<div class='cauto os' >";
  $html .= '</div>';
  $html .= '</div>';

  echo $html;
?>