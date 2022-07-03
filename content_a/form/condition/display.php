<?php
$html = '';
$html .= '<form method="get" autocomplete="off" action="'.\dash\url::that().'">';
{
  $html .= '<input type="hidden" name="id" value="'. \dash\request::get('id'). '">';
  $html .= '<div class="box">';
  {
    $html .= '<div class="body">';
    {
      $html .= '<div>';
      {
        $html .= '<div class="msg">'. T_("Only questions that have options can be included in the condition"). '</div>';
          $html .= '<select name="item" class="select22">';
          {

            $html .= '<option value="">-'. T_('Select question') .' -</option>';

            foreach (\dash\data::items() as $key => $value)
            {
              if(!in_array(a($value, 'type'), ['yes_no','single_choice','dropdown','country','province','gender','list_amount',]))
              {
                continue;
              }

              $html .= '<option value="'. $value['id']. '" ';
              if(\dash\request::get('item') == $value['id'])
              {
                $html .= 'selected';
              }

              $html .= '>'. $value['title']. '</option>';
            }
          }
          $html .= '</select>';
      }
      $html .= '</div>';

    }
    $html .= '</div>';

    $html .= '<footer class="f">';
    {
      $html .= '<div class="c"></div>';
      $html .= '<div class="cauto"><button class="btn master">'. T_("Add condition"). '</button></div>';
    }
    $html .= '</footer>';
  }
  $html .= '</div>';


}
$html .= '</form>';


echo $html;
?>
