<form method="get" action="<?php echo \dash\url::that(); ?>">
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
    <div class="f">
      <div class="cauto pRa10">
        <a class="btn light3 <?php if(\dash\data::isFiltered()) { echo 'apply'; }?>" data-kerkere-icon="close" data-kerkere='.filterBox'><?php echo T_("Filter"); ?></a>
      </div>
      <div class="c pRa10">
        <div>
          <div class="input search <?php if(\dash\request::get('q')) { echo 'apply'; }?>">
            <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(). \dash\request::get('barcode'); ?>" class="barCode" data-default data-pass='submit' autocomplete='off' autofocus>
            <button class="addon btn light3 s0"><i class="sf-search"></i></button>
          </div>
        </div>
      </div>

      <div class="cauto">
        <select class="select22 <?php if(\dash\request::get('sort') || \dash\request::get('order')) { echo 'apply'; }?>" data-link>
          <option><i class="sf-sort mRa5"></i><span><?php echo T_("Sort"); ?></span></div>
<?php
if(\dash\data::sortList())
{
  foreach (\dash\data::sortList() as $key => $value)
  {
?>
          <option value="<?php echo \dash\url::that(). '?'. \dash\get::index($value, 'query_string'); ?>" <?php if(\dash\request::get('sort') == \dash\get::index($value, 'query')['sort'] && \dash\request::get('order') == \dash\get::index($value, 'query')['order']) { echo 'selected'; }?> ><?php echo \dash\get::index($value, 'title'); ?></option>
<?php
  }
}
?>
        </select>
      </div>
    </div>
  </div>

  <div class="filterBox" data-kerkere-content='hide'>
    <?php require_once('display-search-filter.php'); ?>
  </div>

</form>