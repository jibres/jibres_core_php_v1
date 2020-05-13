<div class="avand-md">

  <form method="post" class="box" autocomplete="off" >
    <header><h2><?php echo T_("Simple text") ?></h2></header>
    <div class="body">
      <textarea class="txt" rows="5" name="text" placeholder="<?php echo T_("Type here...") ?>" id="text"><?php echo \dash\get::index(\dash\data::lineSetting_text(), 'text') ?></textarea>
    </div>
    <footer class="txtRa">
      <button class="btn success"><?php echo T_("Save"); ?></button>
    </footer>
  </form>
  <?php require_once(root. 'content_a/website/body/edit_line.php'); ?>


</div>