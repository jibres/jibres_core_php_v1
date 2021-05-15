<?php require_once(root. 'content_a/tag/tagName.php') ?>
<div class="avand-md">
  <form method="post" autocomplete="off" >
    <section class="box">
      <div class="body">
        <div class="msg"><?php echo \dash\request::get('group'); ?></div>
          <label><?php echo T_("New group title") ?> </label>
          <div class="input">
            <input type="text" name="cat" placeholder="<?php echo T_("Group"); ?>" id="title" maxlength="100" value="<?php echo \dash\request::get('group'); ?>">
          </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Edit") ?></button>
      </footer>
    </section>
  </form>
</div>