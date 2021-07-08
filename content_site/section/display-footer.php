<?php
if(\dash\url::child())
{

  if(\dash\url::subchild())
  {
    if(\dash\request::get('index'))
    {
     /**
       * btn remove and hide
       */
      $delete_json    = json_encode(['delete' => 'block']);

      $remove_title = T_("Are you sure to remove this block?");

      $html = '';
      $html .= '<div class="row w-full">';
      $html .= '<div class="cauto">';
      $html .= "<div tabindex=0 class='inline-block bg-gray-50 hover:bg-gray-100 focus:bg-gray-200 active:bg-gray-300 hover:text-red-500 focus:text-red-600 active:text-red-700 transition p-3 rounded-lg' data-confirm data-title='$remove_title' data-data='$delete_json'>";
      $html .= '<img class="w-8 inline-block" src="'. \dash\utility\icon::url('Delete', 'minor'). '">';
      $html .= '<span class="inline-block align-middle ps-2">'. T_("Remove block").'<span>';
      $html .= '</div>';
      $html .= '</div>';
      $html .= '<div class="c"></div>';
      $html .= "<div class='cauto os' >";
      $html .= '</div>';
      $html .= '</div>';

      echo $html;
    }
  }
  else
  {
    /**
     * btn remove and hide
     */
    $delete_json    = json_encode(['delete' => 'section']);
    $hide_view_json = json_encode(['hide_view' => 'toggle']);

    $remove_title = T_("Are you sure to remove this section?");

    $html = '';
    $html .= '<div class="row w-full">';
    $html .= '<div class="cauto">';
    $html .= "<div tabindex=0 class='inline-block bg-gray-50 hover:bg-gray-100 focus:bg-gray-200 active:bg-gray-300 hover:text-red-500 focus:text-red-600 active:text-red-700 transition p-3 rounded-lg' data-confirm data-title='$remove_title' data-data='$delete_json'>";
    $html .= '<img class="w-8 inline-block" src="'. \dash\utility\icon::url('Delete', 'minor'). '">';
    $html .= '<span class="inline-block align-middle ps-2">'. T_("Remove section").'<span>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="c"></div>';
    $html .= "<div class='cauto os' >";
    $html .= "<a tabindex=0 class='inline-block bg-gray-50 hover:bg-gray-100 focus:bg-gray-200 active:bg-gray-300 transition p-3 rounded-lg' data-ajaxify data-data='$hide_view_json'>";

    if(a(\dash\data::currentSectionDetail(), 'status_preview') === 'hidden')
    {
      $html .= '<img class="w-8 inline-block" src="'. \dash\utility\icon::url('hide', 'minor'). '">';
    }
    elseif(in_array(a(\dash\data::currentSectionDetail(), 'status_preview'), ['enable', 'draft', null]))
    {
      $html .= '<img class="w-8 inline-block" src="'. \dash\utility\icon::url('view', 'minor'). '">';
    }

    $html .= '</a>';
    $html .= '</div>';
    $html .= '</div>';

    echo $html;

  }
}
else
{

  /**
   * Load block list
   */
  $result = '';

  if(\dash\data::adding())
  {
    $data = json_encode(['select' => 'adding']);
    $result .= "<div class='btn master' data-ajaxify data-data='".$data."'>";
    $result .= T_("Select");
    $result .= '</div>';
  }


  echo $result;
}
?>