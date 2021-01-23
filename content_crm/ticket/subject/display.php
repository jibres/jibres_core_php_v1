<form method="post" autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <div class="body">
        <p><?php echo T_("Seting the ticket subject helps you to find a specific ticket faster") ?></p>
        <div class="input">
          <input type="text" name="title" value="<?php echo \dash\data::dataRow_title(); ?>" <?php \dash\layout\autofocus::html() ?>>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </div>

  </div>
</form>
