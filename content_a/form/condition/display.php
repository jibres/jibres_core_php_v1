<?php
$html = '';
$html .= '<form method="get" autocomplete="off" action="'.\dash\url::that().'">';
{
  $html .= '<input type="hidden" name="id" value="'. \dash\request::get('id'). '">';
  $html .= '<div class="box">';
  {
    $html .= '<div class="body">';
    {
      $html .= '<div class="msg">'. T_("Only questions that have options can be included in the condition"). '</div>';

      /*==========================
      =            IF            =
      ==========================*/
      $html .= '<div>';
      {
        $html .= '<label for="if">'. T_("IF"). '</label>';
        $html .= '<select name="if" class="select22" id="if">';
        {
          $html .= '<option value="">-'. T_('Select question') .' -</option>';

          foreach (\dash\data::itemsconditionable() as $key => $value)
          {
            $html .= '<option value="'. $value['id']. '" ';
            if(\dash\request::get('if') == $value['id'])
            {
              $html .= 'selected';
            }

            $html .= '>'. $value['title']. '</option>';
          }
        }
        $html .= '</select>';
      }
      $html .= '</div>';
      /*=====  End of IF  ======*/

      /*=================================
      =            OPERATION            =
      =================================*/
      $html .= '<div>';
      {
        $html .= '<label for="operation">'. T_("Operator"). '</label>';
        $html .= '<select name="operation" class="select22" id="operation">';
        {
          $html .= '<option value="">-'. T_('Select operation') .' -</option>';

          foreach (\dash\data::operationList() as $key => $value)
          {
            $html .= '<option value="'. $key. '" ';
            $html .= '>'. $value. '</option>';
          }
        }
        $html .= '</select>';
      }
      $html .= '</div>';
      /*=====  End of OPERATION  ======*/



      /*=============================
      =            VALUE            =
      =============================*/
      $html .= '<lable>'. T_("Value"). '</label>';
      $html .= '<div class="input">';
      {
        $html .= '<input type="text" name="value">';
      }
      $html .= '</div>';
      /*=====  End of VALUE  ======*/



      /*============================
      =            THEN            =
      ============================*/
      $html .= '<div class="mt-4">';
      {
          $html .= '<label for="then">'. T_("Then"). '</label>';
          $html .= '<select name="then" class="select22">';
          {
            $html .= '<option value="">-'. T_('Select question') .' -</option>';

            foreach (\dash\data::items() as $key => $value)
            {
              $html .= '<option value="'. $value['id']. '" ';
              $html .= '>'. $value['title']. '</option>';
            }
          }
          $html .= '</select>';
      }
      $html .= '</div>';
      /*=====  End of THEN  ======*/


      /*============================
      =            ELSE            =
      ============================*/
      $html .= '<div class="mt-4">';
      {
          $html .= '<label for="else">'. T_("Else"). '</label>';
          $html .= '<select name="else" class="select22">';
          {
            $html .= '<option value="">-'. T_('Select question') .' -</option>';

            foreach (\dash\data::items() as $key => $value)
            {
              $html .= '<option value="'. $value['id']. '" ';
              $html .= '>'. $value['title']. '</option>';
            }
          }
          $html .= '</select>';
      }
      $html .= '</div>';
      /*=====  End of ELSE  ======*/


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
