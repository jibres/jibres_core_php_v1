<?php
$lineSetting = \dash\data::lineSetting();

if(!\lib\pagebuilder\tools\tools::in('filter'))
{
?>
<section class="f" data-option='website-line-filter '>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set filter");?></h3>
      <div class="body">
        <p><?php echo T_("You can extract your favorite data with different filters");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <a class="btn master" href="<?php echo \dash\url::current(). '/filter'. \dash\request::full_get(); ?>"><?php echo T_("Set filter") ?></a>
      </div>
  </div>
</section>
<?php
}
else
{


\dash\data::listProductTag(\lib\app\tag\search::list());

?>
<div class="avand-md">
  <form method="post" autocomplete="off" id="form1">
    <div class="box">
      <div class="body">
        <label for="type"><?php echo T_("Type"); ?></label>
        <div>
          <select class="select22" name="type" data-placeholder='<?php echo T_("Latest product") ?>'>
            <option value=""><?php echo T_("Latest product") ?></option>
            <option value="latestproduct" <?php if(a($lineSetting, 'detail', 'type') === 'latestproduct') {echo 'selected';} ?>><?php echo T_("Latest product") ?></option>
            <option value="randomproduct" <?php if(a($lineSetting, 'detail', 'type') === 'randomproduct') {echo 'selected';} ?>><?php echo T_("Random product") ?></option>
            <option value="bestselling" <?php if(a($lineSetting, 'detail', 'type') === 'bestselling') {echo 'selected';} ?>><?php echo T_("Best-selling product") ?></option>
          </select>
        </div>
        <div class="mB10">
          <label for='cat'><?php echo T_("Special category"); ?> <small><a href="<?php echo \dash\url::here(); ?>/category"><?php echo T_("Add"); ?></a></small></label>
          <select name="cat_id" id="cat" class="select22"  data-placeholder='<?php echo T_("Select or add new category"); ?>' >
            <option></option>
            <?php foreach (\dash\data::listProductTag() as $key => $value) {?>
              <option value="<?php echo a($value, 'id'); ?>"<?php if(a($lineSetting, 'detail', 'cat_id') == $value['id']) { echo ' selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
            <?php } //endfor ?>
          </select>
        </div>
      </div>
    </div>
  </div>
</form>
</div>
<?php } //endif ?>