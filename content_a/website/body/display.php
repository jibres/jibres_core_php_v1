
<form method="post" autocomplete="off">
  <div class="box">
    <header><h2><?php echo T_("Add new line") ?></h2></header>
    <div class="body">
      <p><?php echo T_("Choose your line type and after add the line you can customize it"); ?></p>
      <div>
        <label><?php echo T_("Line"); ?></label>
        <select name="line" class="select22">
          <option></option>
          <?php foreach (\dash\data::bodyLine() as $key => $value) {?>
            <option value="<?php echo \dash\get::index($value, 'key'); ?>"><?php echo \dash\get::index($value, 'title'); ?></option>
          <?php } //endfor ?>
        </select>
      </div>
    </div>

    <footer class="txtRa">
      <button class="btn success"><?php echo T_("Add") ?></button>
    </footer>
  </div>
</form>

<?php if(\dash\data::bodyLineList()) {?>
<nav class="items">
  <ul>
  <?php foreach (\dash\data::bodyLineList() as $key => $value) {?>
     <li>
        <a class="f" href="#">
          <div class="key"><?php echo $value;?></div>
          <div class="go"></div>
        </a>
     </li>
  <?php } //endfor ?>
  </ul>
</nav>
<?php } //endif ?>

