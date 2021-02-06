<?php
if(is_array(\dash\data::listEngine_filter()))
{
  echo '<p class="msg info2">'. T_("Organize your data so it's easier to analyze. Filter your data if you only want to display records that meet certain criteria."). '</p>';
  echo '<div class="filterList">';

  $first     = true;
  $myClass   = null;
  $lastGroup = null;

  foreach (\dash\data::listEngine_filter() as $key => $value)
  {
    $mode = null;
    if(isset($value['mode']) && $value['mode'])
    {
      $mode = $value['mode'];
    }

    switch ($mode)
    {
      case 'posts_search':

        break;

      // default
      default:

        if($lastGroup !== $value['group'])
        {
          echo '<div>'. T_("Group by"). ' '. $value['group']. '</div>';
          $lastGroup = $value['group'];
        }


        echo '<a class="btn'. $myClass;

        if(a($value, 'is_active'))
        {
          echo ' primary2';
        }
        else
        {
         echo ' light';
        }
        echo '" href="'. \dash\url::that(). '?'. a($value, 'query_string'). '">'. a($value, 'title'). '</a>';

        break;
    }
    $myClass = null;
    $first = false;
  }
  echo '</div>';
}
?>

<div class="row align-center">
  <div class="c">
    <?php $total_rows = \dash\utility\pagination::get_total_rows(); ?>
    <div class="fc-mute"><span class="txtB"><?php echo \dash\fit::number($total_rows); ?></span> <?php echo T_("Record founded") ?></div>
  </div>
  <div class="c-auto">
    <?php if(\dash\request::get()) {?>
      <a class="btn secondary outline" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
    <?php }//endif ?>
  </div>
</div>
