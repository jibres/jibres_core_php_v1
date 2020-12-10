<?php if(\dash\data::listEngine_search()) {?>
<form method="get" action="<?php echo \dash\data::listEngine_search(); ?>">
<?php
$all_get = \dash\request::get();
unset($all_get['page']);
if($all_get)
{
  foreach ($all_get as $key => $value)
  {
    echo '<input type="hidden" name="'. $key. '" value="'. $value .'">';
  }
}
?>

  <div class="searchBox">
    <div class="row">
<?php if(\dash\data::listEngine_filter()) {?>
      <div class="cauto">
        <a class="btn light3 <?php if(\dash\data::isFiltered()) { echo 'apply'; }?>" data-kerkere-icon="close" data-kerkere='.filterBox'><?php echo T_("Filter"); ?></a>
      </div>
<?php }?>

      <div class="c">
        <div>
          <div class="input search <?php if(\dash\request::get('q')) { echo 'apply'; }?>">
            <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(). \dash\request::get('barcode'); ?>" class="barCode" data-default data-pass='submit' autocomplete='off' autofocus>
            <button class="addon btn light3 s0"><i class="sf-search"></i></button>
          </div>
        </div>
      </div>
<?php if(\dash\data::listEngine_filter()) {?>
      <div class="cauto">
        <select class="select22 <?php if(\dash\request::get('sort') || \dash\request::get('order')) { echo 'apply'; }?>" data-link>
          <option><i class="sf-sort mRa5"></i><span><?php echo T_("Sort"); ?></span></div>
<?php
if(\dash\data::sortList())
{
  foreach (\dash\data::sortList() as $key => $value)
  {
?>
          <option value="<?php echo \dash\url::that(). '?'. a($value, 'query_string'); ?>" <?php if(\dash\request::get('sort') == a($value, 'query')['sort'] && \dash\request::get('order') == a($value, 'query')['order']) { echo 'selected'; }?> ><?php echo a($value, 'title'); ?></option>
<?php
  }
}
?>
        </select>
      </div>
<?php }?>
    </div>
  </div>

<?php if(\dash\data::listEngine_filter()) {
  echo '<div class="filterBox" data-kerkere-content="hide">';
  $myFilterAddr = str_replace('display.php', 'display-filter.php', \dash\layout\func::display());
  if(is_file($myFilterAddr))
  {
    require_once($myFilterAddr);
  }
  echo '</div>';
}?>
</form>
<?php }?>