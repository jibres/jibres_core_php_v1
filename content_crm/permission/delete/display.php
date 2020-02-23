
<?php

$permLoad = \dash\data::perm_load();

if(isset($permLoad['contain']))
{
  $permLoad = $permLoad['contain'];
}

if(!is_array($permLoad))
{
  $permLoad = [];
}

?>


<form method="post">

<div class="cbox mB10">
  <div class="f">


    <div class="c6 s12 input pRa5">
      <label><?php echo T_("Slug"); ?> <small class="fc-red"><?php echo T_("Require"); ?> *</small></label>
      <input type="text" name="name" title='<?php echo T_("The permission name should be unique and contain only alphanameric characters and underscores"); ?>' placeholder='<?php echo T_("Name of your permission"); ?> *' autocomplete="off" class="ltr" <?php if(isset($permLoad['title']) && $permLoad['title']) {?> readonly disabled <?php }//endif ?> value="<?php echo \dash\request::get('id'); ?>">
    </div>
    <div class="c6 s12 input">
      <label><?php echo T_("Title"); ?> <small class="fc-red"><?php echo T_("Require"); ?> *</small></label>
      <input type="text" name="label" title='<?php echo T_("The permission label is used to represent your permission in user management"); ?>' placeholder='<?php echo T_("Label of your permission"); ?> *' autocomplete="off" value="<?php echo \dash\get::index($permLoad, 'title'); ?>">
    </div>


  </div>
</div>
<button class="btn danger block xl"><?php echo T_("Remove"); ?></button>


</form>


