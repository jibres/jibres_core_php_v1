<div class="h-full flex flex-wrap content-center px-3">

 <div class="backBtn">
  <a class="btn-light btn-sm" href="<?php echo \dash\data::back_link(); ?>" <?php if(\dash\data::back_direct()) { echo 'data-direct';} ?>>
<?php
if(\dash\language::dir() === 'rtl')
{
 echo \dash\utility\icon::svg('ChevronRight', 'minor');
}
else
{
 echo \dash\utility\icon::svg('ChevronLeft', 'minor');
}
?>
    <span class="px-1"><?php echo \dash\data::back_text(); ?></span>
  </a>
 </div>
  <div class="flex-grow px-5 font-bold"><?php echo \dash\face::title(); ?></div>

 <div class="actionBtn">
<?php if(\dash\data::action_link() && \dash\data::action_text()) {?>
  <a href="<?php echo \dash\data::action_link(); ?>" class="btn-secondary"><?php echo \dash\data::action_text(); ?></a>
<?php }?>
<?php if(\dash\data::btnSaveSiteBuilder()) { ?>
<form method="post" autocomplete="off" action="<?php echo \dash\url::here(). '/page?id='. \dash\request::get('id'); ?>">
  <input type="hidden" name="savepage" value="savepage">
  <button class="btn-primary"><?php echo T_("Save & Publish"); ?></button>
</form>
<?php } // endif ?>
<?php if(\dash\data::btnSaveSiteBuilderHtml()) { ?>
  <button form="savehtmlform" class="btn-secondary"><?php echo T_("Save HTML"); ?></button>
<?php }//endif ?>
<?php if(\dash\data::btnSaveSiteBuilderEditor()) { ?>
  <button form="sectioneditorhtml" class="btn-secondary"><?php echo T_("Save Text"); ?></button>
<?php }//endif ?>
 </div>


</div>