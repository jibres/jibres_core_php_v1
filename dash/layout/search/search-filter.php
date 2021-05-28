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
        HTML_post_search($value);
        break;

      case 'users_search':
        $apply_filter_btn = true;
        HTML_users_search($value);
        break;

      case 'daterange':
        $apply_filter_btn = true;
        HTML_daterange($value);
        break;

      case 'product_tag_search':
        $apply_filter_btn = true;
        HTML_product_tag_search($value);
        break;

      case 'product_unit_search':
        $apply_filter_btn = true;
        HTML_product_unit_search($value);
        break;

      case 'product_status_search':
        $apply_filter_btn = true;
        HTML_product_status_search($value);
        break;

      case 'raw_file':
        if(isset($value['file_addr']) && is_string($value['file_addr']) && is_file($value['file_addr']))
        {
          require_once($value['file_addr']);
        }
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


function HTML_post_search($value)
{
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
}



function HTML_daterange($value)
{
  echo "<div class='mB10'>";
  echo '<label>'. a($value, 'title'). '</label>';
  $std = \dash\request::get('std');
  $end = \dash\request::get('end');
  $from = T_("From date");
  $to = T_("To date");

  $HTML = <<<HTML
    <div class="row">
      <div class="c-xs-6 c-sm-6">
        <div class="input">
          <input type="tel" name="std" value="$std" data-format='date' placeholder="$from">
        </div>
      </div>
      <div class="c-xs-6 c-sm-6">
        <div class="input">
          <input type="tel" name="end" value="$end" data-format='date' placeholder="$to">
        </div>
      </div>
    </div>
HTML;

  echo $HTML;
  echo "</div>";
}


function HTML_users_search($value)
{
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
}


function HTML_product_tag_search($value)
{
  echo "<div class='mB10'>";
  echo '<div class="row align-center">';
  echo '<div class="c"><label for="tag">'. T_("Tag"). '</label></div>';
  echo '<div class="c-auto os">';
  echo '<a class="font-12"';
  if(!\dash\detect\device::detectPWA())
  { echo " target='_blank' ";
  }
  echo ' href="'. \dash\url::here(). '/tag">'. T_("Manage"). ' <i class="sf-link-external"></i></a>';
  echo '</div>';
  echo '</div>';

  echo '<div>';
  echo '<select name="tagid" id="tag" class="select22" data-model="tag" data-placeholder="'. T_("Select one tag"). '">';
  if(\dash\request::get('tagid'))
  {
      echo '<option value="0">'. T_("None"). '</option>';
  }
  else
  {
      echo '<option value=""></option>';
  }
  foreach (\dash\data::listProductTag() as $k => $v)
  {
      echo '<option value="'. $v['id']. '" ';
      if(\dash\request::get('tagid') === $v['id'])
      {
        echo 'selected';
      }
      echo '> '.$v['title']. '</option>';
  }
  echo '</select>';
  echo '</div>';
  echo "</div>";
}



function HTML_product_unit_search($value)
{
 echo "<div class='mB10'>";
  echo '<div class="row align-center">';
  echo '<div class="c"><label for="unit">'. T_("Unit"). '</label></div>';
  echo '<div class="c-auto os">';
  echo '<a class="font-12"';
  if(!\dash\detect\device::detectPWA())
  {
    echo " target='_blank' ";
  }
  echo ' href="'. \dash\url::here(). '/units">'. T_("Manage"). ' <i class="sf-link-external"></i></a>';
  echo '</div>';
  echo '</div>';

  echo '<div>';
  echo '<select name="unitid" id="unit" class="select22" data-model="tag" data-placeholder="'. T_("like Qty, kg, etc"). '">';
  if(\dash\request::get('unitid'))
  {
      echo '<option value="0">'. T_("None"). '</option>';
  }
  else
  {
      echo '<option value=""></option>';
  }
  foreach (\dash\data::listUnits() as $k => $v)
  {
      echo '<option value="'. $v['id']. '" ';
      if(\dash\request::get('unitid') === $v['id'])
      {
        echo 'selected';
      }
      echo '> '.$v['title']. '</option>';
  }
  echo '</select>';
  echo '</div>';
  echo "</div>";
}


function HTML_product_status_search($value)
{
  echo "<div class='mB10'>";
  echo '<label for="status">'. T_("Status"). '</label>';
  echo '<div>';
  echo '<select name="status" id="status" class="select22"  data-placeholder="'. T_("Product Status"). '">';
  if(\dash\request::get('status'))
  {
      echo '<option value="0">'. T_("None"). '</option>';
  }
  else
  {
      echo '<option value=""></option>';
  }
  foreach (['draft','active','archive', 'deleted'] as $k => $v)
  {
      echo '<option value="'. $v. '" ';
      if(\dash\request::get('status') === $v)
      {
        echo 'selected';
      }
      echo '> '. T_(ucfirst($v)). '</option>';
  }
  echo '</select>';
  echo '</div>';
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
      <a class="btn secondary outline" href="<?php if(\dash\data::listEngine_cleanFilterUrl()){ echo \dash\data::listEngine_cleanFilterUrl(); }else{ echo \dash\url::that(); } ?>"><?php echo T_("Clear filters"); ?></a>
    <?php }//endif ?>
    <?php if($apply_filter_btn) {?>
    <button class="btn primary2 outline"><?php echo T_("Apply filter") ?></button>
  <?php } //endif ?>
  </div>
</div>
