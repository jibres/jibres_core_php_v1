<div class="avand-md">

  <form method="post" class="box" autocomplete="off" >
    <header><h2><?php echo T_("Simple quote") ?></h2></header>
    <div class="body">

      <label for="title"><?php echo T_("Title"); ?></label>
      <div class="input">
        <input type="text" name="title" id="title" value="<?php echo \dash\get::index(\dash\data::lineSetting_quote(), 'title') ?>"  >
      </div>

      <textarea class="txt" rows="5" name="quote" placeholder="<?php echo T_("Type here...") ?>" id="quote"><?php echo \dash\get::index(\dash\data::lineSetting_quote(), 'quote') ?></textarea>

      <label for="url"><?php echo T_("Url"); ?></label>
      <div class="input ltr">
        <input type="text" name="url" id="url" value="<?php echo \dash\get::index(\dash\data::lineSetting_quote(), 'url') ?>"  >
      </div>

    </div>
    <footer class="txtRa">
      <button class="btn success"><?php echo T_("Save"); ?></button>
    </footer>
  </form>
  <?php require_once(root. 'content_a/website/body/edit_line.php'); ?>


</div>