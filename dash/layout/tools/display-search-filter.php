<?php

$title = isset($filter_title) ? $filter_title : T_("Show all data where");

if(is_array(\dash\data::listEngine_filter()))
{
  echo '<p>'. $title. '</p>';
  echo '<div class="mB20">';

  $first     = true;
  $myClass   = null;
  $lastGroup = null;

  foreach (\dash\data::listEngine_filter() as $key => $value)
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
          $myClass = ' mLa10';
        }
      }
    }

    echo '<a class="btn '. $myClass;

    if(a($value, 'is_active'))
    {
      echo ' primary2';
    }
    else
    {
     echo ' light';
    }
    echo ' mB10 mLa5" href="'. \dash\url::that(). '?'. a($value, 'query_string'). '">'. a($value, 'title'). '</a>';
    $myClass = null;
    $first = false;
  }
  echo '</div>';
}
?>

<div class="f font-12">
  <div class="cauto">
    <?php $total_rows = \dash\utility\pagination::get_total_rows(); ?>
    <div class="fc-mute mA10"><span class="txtB"><?php echo \dash\fit::number($total_rows); ?></span> <?php echo T_("Record founded") ?></div>
  </div>
  <div class="c"></div>
  <div class="cauto">
    <?php if(\dash\request::get()) {?>
      <a class="btn outline" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
    <?php }//endif ?>
  </div>
</div>
