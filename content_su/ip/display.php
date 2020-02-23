<?php if(\dash\data::ipDetail()) {?>


<div class="cbox">
  <div class="f">
    <?php foreach (\dash\data::ipDetail() as $key => $value) {?>

    <div class="msg c3 mL5"><?php echo $key; ?> <span class="floatL"><?php echo $value; ?></span></div>
  <?php } //endfor ?>
  </div>
</div>

<?php } //endif ?>


<?php if(\dash\data::ipFiles()) {?>

<div class="ltr">
<table class="tbl1 v3">
  <?php foreach (\dash\data::ipFiles() as $key => $value) {?>

  <tr>
    <td class="txtL">
      <span class="sf-database fs15 mR10"></span>
      <a href="<?php echo \dash\url::site(); ?>/files/ip/<?php echo \dash\get::index($value, 'name'); ?>" title='<?php echo T_("Click to download"); ?>'><?php echo \dash\get::index($value, 'name'); ?></a>
    </td>
    <td class="rtl s0"><?php echo \dash\get::index($value, 'ago'); ?></td>
    <td class="rtl pR25-f"><?php echo \dash\fit::text(\dash\get::index($value, 'size')); ?> <?php echo T_("MB"); ?></td>

  </tr>
<?php } //endfor ?>
</table>
</div>

<?php }else{ ?>

<div class="msg danger fs16"><?php echo T_("No backup was found"); ?></div>
<?php } //endif ?>




<?php if(\dash\data::rawFile()) {?>

<?php
  $editable = ['new', 'block', 'unblock'];
?>

<div class="ltr">
  <?php foreach (\dash\data::rawFile() as $key => $value) {?>

    <div class="cbox">

      <h3><?php echo $key; ?></h3>
      <?php if(in_array($key, $editable)) {?>

          <form method="post" autocomplete="off">
            <div class="input ltr">
              <label class="addon"><?php echo T_("Add data to this file"); ?></label>
              <input type="text" name="ip">
              <input type="hidden" name="file" value="<?php echo $key; ?>">
              <input type="hidden" name="type" value="add">
              <button type="submit" class="btn primary"><?php echo T_("Add"); ?></button>
            </div>
          </form>
          <hr>

        <?php }//endif ?>
        <?php foreach ($value as $k => $v) {?>
          <?php if($v) { echo $v; if(in_array($key, $editable))  {?>

          <div href="<?php echo \dash\url::pwd(); ?>" class="badge danger" data-confirm data-data='{"type" : "remove_ip", "file" : "<?php echo $key; ?>", "ip" : "<?php echo trim($v); ?>"}' ><?php echo T_("Remove"); ?></div>
        <?php } //endif ?>
        <br>
        <?php } //endif ?>

      <?php } //endfor ?>
    </div>
  <?php } //endfor ?>
</div>
<?php } //endif ?>

