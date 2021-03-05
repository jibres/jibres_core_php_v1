<form method="post" autocomplete="off">
  <div class="avand-sm">
    <div class="box">
      <div class="pad">
        <label for="passwd"><?php echo T_("Enter Password") ?></label>
        <div class="input ltr">
          <input type="password" name="passwd" id="passwd" <?php \dash\layout\autofocus::html(); ?>>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Go") ?></button>
      </footer>
    </div>
  </div>
  </form>