<?php
$listSaveCat = \dash\data::listSavedCat();
if(!is_array($listSaveCat))
{
  $listSaveCat = [];
}
?>
<div class="box">
  <div class="pad">
    <div class="mB10">
      <div class="row align-center">
        <div class="c"><label for='category'><?php echo T_("Category"); ?></label></div>
        <div class="c-auto os"><a class="text-sm"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(); ?>/category"><span><?php echo T_("Manage"); ?></span> <?php echo \dash\utility\icon::svg('External', 'minor', null, 'h-3 w-3 inline-block'); ?></a></div>
      </div>

      <select name="category[]" id="category" class="select22" data-model="tag" multiple="multiple" data-ajax--delay="100" data-ajax--url='<?php echo \dash\url::kingdom(). '/a/category/api'; ?>?json=true'>
        <?php foreach ($listSaveCat as $key => $value) {?>
          <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
        <?php } //endfor ?>
      </select>
    </div>
  </div>
</div>