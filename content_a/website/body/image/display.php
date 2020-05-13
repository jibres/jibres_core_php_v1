<div class="avand-md">

  <form method="post" class="box" autocomplete="off" >
    <header><h2><?php echo T_("Simple image") ?></h2></header>
    <div class="body">

     <div class="input ">
        <input type="file" name='image' accept="image/gif, image/jpeg, image/png" id="image1" >
        <label for="image1"></label>
      </div>

      <label for="alt"><?php echo T_("Image Alt"); ?></label>
      <div class="input">
        <input type="text" name="alt" id="alt" value="<?php echo \dash\data::dataRow_alt() ?>"  >
      </div>


      <label for="url"><?php echo T_("Url"); ?></label>
      <div class="input ltr">
        <input type="text" name="url" id="url" value="<?php echo \dash\data::dataRow_url() ?>"  >
      </div>

      <div class="switch1 mB5">
        <input type="checkbox" name="target" id="target" <?php if(\dash\data::dataRow_target()) {echo 'checked';} ?>>
        <label for="target"></label>
        <label for="target"><?php echo T_("Open in New tab"); ?><small></small></label>
      </div>



    </div>
    <footer class="txtRa">
      <button class="btn success"><?php echo T_("Save"); ?></button>
    </footer>
  </form>
  <?php require_once(root. 'content_a/website/body/edit_line.php'); ?>


</div>