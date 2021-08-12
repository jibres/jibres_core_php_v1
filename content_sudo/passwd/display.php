<form method="post" autocomplete="off" autocomplete="new-password">
  <div class="avand-sm">
    <div class="box">
      <div class="pad">
        <label for="a"><?php echo T_("Hello Dear") ?></label>
        <div class="input ltr">
          <input type="password" name="a" id="a" autocomplete="new-password" <?php \dash\layout\autofocus::html(); ?>>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Go") ?></button>
      </footer>
    </div>
  </div>
  </form>