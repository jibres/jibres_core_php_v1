<div class="avand-md">

  <form method="post" class="box" autocomplete="off" >
    <header><h2><?php echo T_("Edit setting of latest news") ?></h2></header>
    <div class="body">
      <label for="limit"><?php echo T_("Count show news"); ?></label>
      <div class="input">
        <input type="number" name="limit" id="limit" value="<?php echo \dash\data::savedOption_limit() ?>"  >
      </div>
    </div>
    <footer class="txtRa">
      <button class="btn success"><?php echo T_("Save"); ?></button>
    </footer>
  </form>
  <?php require_once(root. 'content_a/website/body/edit_line.php'); ?>


</div>