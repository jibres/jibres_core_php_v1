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



<?php foreach (\dash\data::perm_list() as $permKey => $permList) {?>

<?php foreach ($permList as $ckey => $cvalue) {?>

<div class="cbox mB10 fs11">
  <h2>
    <span class="badge info mRa10"><?php echo T_($permKey); ?></span><?php echo T_($ckey); ?>
  </h2>
  <div class="f">
  <?php foreach ($cvalue as $key => $value) {?>

  	<?php if(isset($value['titleBefore']) && $value['titleBefore']) {?>
		<h4 class='c12 mT10'><?php echo T_($value['titleBefore']); ?></h4>
	<?php }//endif ?>

    <div class="switch1 c3 m6 s12">
     <input type="checkbox" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
     data-require="<?php if(isset($value['require']) && is_array($value['require'])) { echo implode('|', $value['require']); }?>"
     <?php if(in_array($key, $permLoad) || \dash\request::get('id') === 'admin') { echo 'checked';} ?>>
     <label for="<?php echo $key; ?>"></label>
     <label for="<?php echo $key; ?>" title='<?php echo $key; ?>'><?php echo T_(\dash\get::index($value, 'title')); ?></label>
    </div>
    <?php if(isset($value['breakAfter']) && $value['breakAfter']) {?><div class='c12 mT10'></div><?php } //endif ?>
<?php }//endfor ?>
  </div>
</div>
<?php }//endfor ?>
<?php }//endfor ?>


<button class="btn primary block xl"><?php echo T_("Save"); ?></button>
</form>


<?php if(false) {?>

function pushStateFinal()
{
  $('input[type=checkbox]').off('change');
  $('input[type=checkbox]').on('change', function()
  {
    var myRequire = $(this).attr('data-require');
    if($(this).is(":checked") === true && myRequire)
    {
      myRequire = myRequire.split('|');
      console.log(myRequire);

      $.each(myRequire, function(index, val)
      {
        console.log(val)
        console.log($('#'+ val));
        $('#'+ val).prop('checked', true);
      });
    }
  });

<?php } //endif ?>