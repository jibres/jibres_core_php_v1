
<div class="avand-lg">
  <form method="post" class="box" autocomplete="off">
    <div class="body">

      <label for="text"><?php echo T_("Footer Text"); ?></label>
      <textarea name="text" class="txt" data-editor><?php echo \dash\data::maintextSaved_text() ?></textarea>


    </div>

    <footer class="txtRa">
      <button class="btn primary"><?php echo T_("Save"); ?></button>
    </footer>
  </form>

</div>
