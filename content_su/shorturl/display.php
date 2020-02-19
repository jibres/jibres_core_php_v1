
<div class="tbox">
  <?php echo T_("Test coding function"); ?>
</div>

<div class="cbox">
  <form method="get" data-action>
    <div class="input ltr">
      <label class="addon"><?php echo T_("String or Number"); ?></label>
      <input type="text" name="val" value="<?php echo \dash\request::get('val'); ?>" >
      <button type="submit" class=" btn primary" ><?php echo T_("Run"); ?></button>
    </div>
  </form>
</div>

<?php if(\dash\data::valEncode() || \dash\data::valDecode()) {?>

<div class="cbox">
  <div class="f">
    <div class="c">
      <p class="fs20"><?php echo T_("Encode"); ?></p>
      <h2 class="fs100"><?php echo \dash\data::valEncode(); ?></h2>
    </div>
    <div class="c">
      <p class="fs20"><?php echo T_("Decode"); ?></p>
      <h2 class="fs100"><?php echo \dash\data::valDecode(); ?></h2>
    </div>
  </div>
</div>
<?php } //endif ?>

