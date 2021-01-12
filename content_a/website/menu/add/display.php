<div class="avand-md">
    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Build new menu"); ?></h2></header>
      <div class="body">
        <p class="">
          <?php echo T_("After build menu you can use from this menu in website theme setting and put it in every where you need"); ?>
        </p>

        <label for="menutitle"><?php echo T_("Menu title"); ?></label>
        <div class="input">
          <input type="text" name="title" id="menutitle" value="" maxlength="50" required <?php \dash\layout\autofocus::html() ?>>
        </div>

      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Create menu"); ?></button>
      </footer>
    </form>
</div>