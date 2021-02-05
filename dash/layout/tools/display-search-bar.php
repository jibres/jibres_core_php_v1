<?php if(\dash\data::listEngine_search()) {?>
<form method="get" action="<?php echo \dash\data::listEngine_search(); ?>">
<?php
$all_get = \dash\request::get();
unset($all_get['page']);
unset($all_get['q']);
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
      <div class="c-auto">
        <a class="btn light3 <?php if(\dash\data::isFiltered()) { echo 'apply'; }?>" data-kerkere-icon="close" data-kerkere='.filterBox'><?php echo T_("Filter"); ?></a>
      </div>
<?php }?>

      <div class="c">
        <div>
          <div class="input search <?php if(\dash\request::get('q')) { echo 'apply'; }?>">
            <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" class="barCode" data-default data-pass='submit' autocomplete='off' autofocus>
            <button class="addon btn light3 s0"><i class="sf-search"></i></button>
          </div>
        </div>
      </div>
<?php if(\dash\data::listEngine_filter()) {?>
      <div class="c-2 c-xs-3 sortBox">
        <select class="select22 <?php if(\dash\request::get('sort') || \dash\request::get('order')) { echo 'apply'; }?>" data-link data-placeholder='<?php echo T_("Sort"); ?>'>
<?php
if(\dash\data::sortList())
{
  foreach (\dash\data::sortList() as $key => $value)
  {
    echo "<option";
    if(a($value, 'clear') === true)
    {
      echo ' value=""';
    }
    else
    {
      echo ' value="';
      echo \dash\url::that();
      if(a($value, 'query_string'))
      {
        echo "?". a($value, 'query_string');
      }
      echo '"';
    }
    if(\dash\request::get('sort') == a($value, 'query', 'sort') && \dash\request::get('order') == a($value, 'query', 'order'))
    {
      echo ' selected';
    }
    echo ">";
    echo a($value, 'title');
    echo "</option>";
  }
}
?>
        </select>
      </div>
<?php }?>
    </div>
  </div>

<?php if(\dash\data::listEngine_filter())
{
  echo '<div class="filterBox" data-kerkere-content="hide">';
  if(\dash\data::listEngine_filter() === true)
  {
    $myFilterAddr = str_replace('display.php', 'display-filter.php', \dash\layout\func::display());
    if(is_file($myFilterAddr))
    {
      require_once($myFilterAddr);
    }
  }
  else
  {
    require_once(core. 'layout/tools/display-search-filter.php');
  }
  echo '</div>';
}?>
</form>
<?php }?>