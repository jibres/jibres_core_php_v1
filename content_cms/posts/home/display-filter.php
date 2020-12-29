<?php
if(\dash\data::productFilterList())
{
  echo '<p>'. T_("Show all products where"). '</p>';
  echo '<div class="mB20">'
  $first = true;
  $myClass = null;
  $lastGroup = null;
  foreach (\dash\data::productFilterList() as $key => $value)
  {
    if($lastGroup !== $value['group'])
    {
      $lastGroup = $value['group'];
      if(!$first)
      {
        if(\dash\request::is_pwa())
        {
          $myClass = null;
          echo '<div class="block"></div>';
        }
        else
        {
          $myClass = 'mLa10';
        }
      }
    }

    echo '<a class="btn '. $myClass;

    if(a($value, 'is_active'))
    {
      echo 'primary2';
    }
    else
    {
     echo 'light';
    }
    echo ' mB10" href="'. \dash\url::that(). '?'. a($value, 'query_string'). '">'. a($value, 'title'). '</a>'
    $myClass = null;
    $first = false;
  }
  echo '</div>';
}
?>
