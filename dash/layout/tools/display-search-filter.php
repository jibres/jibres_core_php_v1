<?php
if(is_array(\dash\data::listEngine_filter()))
{
  echo '<p class="msg info2">'. T_("Organize your data so it's easier to analyze. Filter your data if you only want to display records that meet certain criteria."). '</p>';
  echo '<div class="filterList">';

  $first            = true;
  $myClass          = null;
  $lastGroup        = null;
  $apply_filter_btn = false;

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
         $apply_filter_btn = true;
        echo "<div class='mB10'>";
        echo '<label>'. a($value, 'title'). '</label>';
        echo '<select name="post_id" class="select22"  data-model=\'html\'  data-ajax--url="'. \dash\url::kingdom(). '/cms/posts/api?json=true" data-shortkey-search data-placeholder="'. a($value, 'title'). '">';
        if(\dash\request::get('post_id'))
        {
          $userselected_detail = \dash\app\posts\get::get(\dash\request::get('post_id'));
          if($userselected_detail)
          {
            echo '<option value="'. a($userselected_detail, 'id'). '">';
            echo a($userselected_detail, 'title');
            echo '</option>';
          }
          // echo "<option value=''>". T_("None"). '</option>';
        }
        echo '</select>';
        echo "</div>";
        break;

      case 'users_search':
        $apply_filter_btn = true;
        echo "<div class='mB10'>";
        echo '<label>'. a($value, 'title'). '</label>';
        echo '<select name="user" class="select22"  data-model=\'html\'  data-ajax--url="'. \dash\url::kingdom(). '/crm/api?json=true" data-shortkey-search data-placeholder="'. a($value, 'title'). '">';
        if(\dash\request::get('user'))
        {
          $userselected_detail = \dash\app\user::get(\dash\request::get('user'));
          if($userselected_detail)
          {
            echo '<option value="'. a($userselected_detail, 'id'). '">';
            echo a($userselected_detail, 'displayname');
            echo '</option>';
          }
          // echo "<option value=''>". T_("None"). '</option>';
        }
        echo '</select>';
        echo "</div>";
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

<div class="row align-center mT10">
  <div class="c">
    <?php $total_rows = \dash\utility\pagination::get_total_rows(); ?>
    <div class="fc-mute"><span class="txtB"><?php echo \dash\fit::number($total_rows); ?></span> <?php echo T_("Record founded") ?></div>
  </div>
  <div class="c-auto">
    <?php if(\dash\request::get()) {?>
      <a class="btn secondary outline" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
    <?php }//endif ?>
    <?php if($apply_filter_btn) {?>
    <button class="btn primary2 outline"><?php echo T_("Apply filter") ?></button>
  <?php } //endif ?>
  </div>
</div>
