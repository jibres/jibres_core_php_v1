<?php
$html = '';
$html .= '<form method="get" autocomplete="off" action="'.\dash\url::that().'" data-patch>';
{
  $html .= '<input type="hidden" name="id" value="'.\dash\request::get('id').'">';
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
    }
    $html .= '</div>';
    // $html .= '<footer class="txtRa">';
    // {
    //   $html .= '<button class="btn-primary">'. T_("Next"). '</button>';
    // }
    // $html .= '</footer>';
  }
  $html .= '</div>';



}
$html .= '</form>';

if(\dash\request::get('if'))
{
  $html .= '<form method="post" autocomplete="off">';
  {
    $html .= '<input type="hidden" name="if" value="'.\dash\request::get('if').'">';
    $html .= '<div class="box">';
    {
      $html .= '<div class="body">';
      {
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
        $choiceList = \dash\data::choiceList();
        if($choiceList)
        {
           $html .= '<div>';
          {
            $html .= '<label for="value">'. T_("Value"). '</label>';
            $html .= '<select name="value" class="select22" id="value">';
            {
              $html .= '<option value="">-'. T_('Select value') .' -</option>';

              foreach (\dash\data::choiceList() as $key => $value)
              {
                $html .= '<option value="'. $value['id']. '" ';
                $html .= '>'. $value['title']. '</option>';
              }
            }
            $html .= '</select>';
          }
          $html .= '</div>';
        }
        else
        {
          if(\dash\data::choiceMode() === 'country')
          {
            $html .= '<label for="value">'. T_("Value"). '</label>';
            $html .= \dash\utility\location::countrySelectorHtml(null, null, 'value', 'value');
          }
          else
          {
            $html .= '<lable>'. T_("Value"). '</label>';
            $html .= '<div class="input">';
            {
              $html .= '<input type="text" name="value">';
            }
            $html .= '</div>';
          }
        }
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
                if($value['id'] == \dash\request::get('if'))
                {
                  continue;
                }

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
                if($value['id'] == \dash\request::get('if'))
                {
                  continue;
                }

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
} // endif

if($condition = \dash\data::formDetail_condition())
{
  foreach ($condition as $key => $value)
  {

    $html .= '<div>';
    {
      $html .= 'if: ';
      $html .= $value['if'];
      $html .= ' - ';

      $html .= 'operation: ';
      $html .= $value['operation'];
      $html .= ' - ';

      $html .= 'value: ';
      $html .= $value['value'];
      $html .= ' - ';

      $html .= 'then:';
      $html .= $value['then'];
      $html .= ' - ';

      $html .= 'else:';
      $html .= $value['else'];
      $html .= ' - ';

    }
    $html .= '</div>';
  }

}


echo $html;
?>
