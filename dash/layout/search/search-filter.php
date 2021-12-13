<?php
$html = '';
if(is_array(\dash\data::listEngine_filter()))
{
  $html .= '<p class="alert-info">'. T_("Organize your data so it's easier to analyze. Filter your data if you only want to display records that meet certain criteria."). '</p>';
  $html .= '<div class="filterList">';

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
        $html .= HTML_post_search($value);
        break;

      case 'users_search':
        $apply_filter_btn = true;
        $html .= HTML_users_search($value);
        break;

      case 'daterange':
        $apply_filter_btn = true;
        $html .= HTML_daterange($value);
        break;

      case 'product_tag_search':
        $apply_filter_btn = true;
        $html .= HTML_product_tag_search($value);
        break;

      case 'product_unit_search':
        $apply_filter_btn = true;
        $html .= HTML_product_unit_search($value);
        break;

      case 'product_status_search':
        $apply_filter_btn = true;
        $html .= HTML_product_status_search($value);
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
          $html .= '<div>'. T_("Group by"). ' '. $value['group']. '</div>';
          $lastGroup = $value['group'];
        }


        $html .= '<a class="btn'. $myClass;

        if(a($value, 'is_active'))
        {
          $html .= ' primary2';
        }
        else
        {
         $html .= ' light';
        }
        $html .= '" href="'. \dash\url::current(). '?'. a($value, 'query_string'). '">'. a($value, 'title'). '</a>';

        break;
    }
    $myClass = null;
    $first = false;
  }
  $html .= '</div>';

  echo $html;
}


function HTML_post_search($value)
{
  $html = '';
  $html .= "<div class='mB10'>";
  $html .= '<label>'. a($value, 'title'). '</label>';
  $html .= '<select name="post_id" class="select22"  data-model=\'html\'  data-ajax--url="'. \dash\url::kingdom(). '/cms/posts/api?json=true" data-shortkey-search data-placeholder="'. a($value, 'title'). '">';
  if(\dash\request::get('post_id'))
  {
    $userselected_detail = \dash\app\posts\get::get(\dash\request::get('post_id'));
    if($userselected_detail)
    {
      $html .= '<option value="'. a($userselected_detail, 'id'). '">';
      $html .= a($userselected_detail, 'title');
      $html .= '</option>';
    }
    // $html .= "<option value=''>". T_("None"). '</option>';
  }
  $html .= '</select>';
  $html .= "</div>";
  return $html;
}



function HTML_daterange($value)
{
  $html = '';
  $html .= "<div class='mB10'>";
  $html .= '<label>'. a($value, 'title'). '</label>';
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

  $html .= $HTML;
  $html .= "</div>";
  return $html;
}


function HTML_users_search($value)
{
  $html = '';
  $html .= "<div class='mB10'>";
  $html .= '<label>'. a($value, 'title'). '</label>';
  $html .= '<select name="user" class="select22"  data-model=\'html\'  data-ajax--url="'. \dash\url::kingdom(). '/crm/api?json=true" data-shortkey-search data-placeholder="'. a($value, 'title'). '">';
  if(\dash\request::get('user'))
  {
    $userselected_detail = \dash\app\user::get(\dash\request::get('user'));
    if($userselected_detail)
    {
      $html .= '<option value="'. a($userselected_detail, 'id'). '">';
      $html .= a($userselected_detail, 'displayname');
      $html .= '</option>';
    }
    // $html .= "<option value=''>". T_("None"). '</option>';
  }
  $html .= '</select>';
  $html .= "</div>";

  return $html;
}


function HTML_product_tag_search($value)
{
  $html = '';
  $html .= "<div class='mB10'>";
  $html .= '<div class="row align-center">';
  $html .= '<div class="c"><label for="tag">'. T_("Category"). '</label></div>';
  $html .= '<div class="c-auto os">';
  $html .= '<a class="font-12"';
  if(!\dash\detect\device::detectPWA())
  { $html .= " target='_blank' ";
  }
  $html .= ' href="'. \dash\url::here(). '/category">'. T_("Manage"). ' <i class="sf-link-external"></i></a>';
  $html .= '</div>';
  $html .= '</div>';

  $html .= '<div>';
  $html .= '<select name="catid" id="tag" class="select22" data-model="tag" data-placeholder="'. T_("Select one category"). '" data-ajax--delay="100" data-ajax--url="'. \dash\url::kingdom(). '/a/category/api?json=true&getid=1">';
  if(\dash\request::get('catid'))
  {
      $html .= '<option value="0">'. T_("None"). '</option>';
      $loadCategory = \lib\app\category\get::get(\dash\request::get('catid'));
      $html .= '<option value="'. a($loadCategory, 'id'). '" selected>'. a($loadCategory, 'title') .'</option>';
  }
  else
  {
      $html .= '<option value=""></option>';
  }

  $html .= '</select>';
  $html .= '</div>';
  $html .= "</div>";
  return $html;
}



function HTML_product_unit_search($value)
{
  $html = '';
  $html .= "<div class='mB10'>";
  $html .= '<div class="row align-center">';
  $html .= '<div class="c"><label for="unit">'. T_("Unit"). '</label></div>';
  $html .= '<div class="c-auto os">';
  $html .= '<a class="font-12"';
  if(!\dash\detect\device::detectPWA())
  {
    $html .= " target='_blank' ";
  }
  $html .= ' href="'. \dash\url::here(). '/units">'. T_("Manage"). ' <i class="sf-link-external"></i></a>';
  $html .= '</div>';
  $html .= '</div>';

  $html .= '<div>';
  $html .= '<select name="unitid" id="unit" class="select22" data-model="tag" data-placeholder="'. T_("like Qty, kg, etc"). '">';
  if(\dash\request::get('unitid'))
  {
      $html .= '<option value="0">'. T_("None"). '</option>';
  }
  else
  {
      $html .= '<option value=""></option>';
  }
  foreach (\dash\data::listUnits() as $k => $v)
  {
      $html .= '<option value="'. $v['id']. '" ';
      if(\dash\request::get('unitid') === $v['id'])
      {
        $html .= 'selected';
      }
      $html .= '> '.$v['title']. '</option>';
  }
  $html .= '</select>';
  $html .= '</div>';
  $html .= "</div>";
  return $html;
}


function HTML_product_status_search($value)
{
  $html = '';
  $html .= "<div class='mB10'>";
  $html .= '<label for="status">'. T_("Status"). '</label>';
  $html .= '<div>';
  $html .= '<select name="status" id="status" class="select22"  data-placeholder="'. T_("Product Status"). '">';
  if(\dash\request::get('status'))
  {
      $html .= '<option value="0">'. T_("None"). '</option>';
  }
  else
  {
      $html .= '<option value=""></option>';
  }
  foreach (['draft','active','archive', 'deleted'] as $k => $v)
  {
      $html .= '<option value="'. $v. '" ';
      if(\dash\request::get('status') === $v)
      {
        $html .= 'selected';
      }
      $html .= '> '. T_(ucfirst($v)). '</option>';
  }
  $html .= '</select>';
  $html .= '</div>';
  $html .= '</div>';
  return $html;
}
?>

<div class="row align-center mT10">
  <div class="c">
    <?php $total_rows = \dash\utility\pagination::get_total_rows(); ?>
    <div class="fc-mute"><span class="font-bold"><?php echo \dash\fit::number($total_rows); ?></span> <?php echo T_("Record founded") ?></div>
  </div>
  <div class="c-auto">
    <?php if(\dash\request::get()) {?>
      <a class="btn-outline-secondary" href="<?php if(\dash\data::listEngine_cleanFilterUrl()){ echo \dash\data::listEngine_cleanFilterUrl(); }else{ echo \dash\url::that(); } ?>"><?php echo T_("Clear filters"); ?></a>
    <?php }//endif ?>
    <?php if($apply_filter_btn) {?>
    <button class="btn-outline-primary"><?php echo T_("Apply filter") ?></button>
  <?php } //endif ?>
  </div>
</div>
