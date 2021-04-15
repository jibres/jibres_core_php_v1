<?php
if(\dash\data::lineSetting())
{
  \lib\app\pagebuilder\line\design::draw();
}
else
{

if(\dash\data::lineList())
{

?>
<form method="post">
<nav class="items">
  <ul class="sortable" data-sortable>
  <?php foreach (\dash\data::lineList() as $key => $value) {?>

     <li>
        <a href="<?php echo \dash\url::this(). '/'. a($value,'type') .'?id='. a($value, 'id'); ?>" class="f">
        <input type="hidden" class="hide" name="bodyline[]" value="<?php echo a($value, 'id'); ?>">
          <div class="key">
            <div class="f">
              <div data-handle class="cauto handle"><i class="sf-sort"></i></div>
              <div class="c mLa10"><?php echo a($value, 'title')?></div>
            </div>
          </div>
          <div class="go <?php if(a($value, 'publish')) {echo 'check ok';}else{ echo 'info nok';}?>"></div>
        </a>
     </li>
  <?php } //endfor ?>
  </ul>
</nav>
</form>
<?php if(is_array(\dash\data::lineList()) && count(\dash\data::lineList()) >= 2) {?>
    <div class="msg fs12"><?php echo T_("Change the position of the rows with the help of the handle") ?> <kbd><i class="sf-sort"></i></kbd></div>
<?php } //endif ?>
<?php } //endif ?>
<?php } //endif ?>
