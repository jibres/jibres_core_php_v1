
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
        <div class="f">
          <div class="key">
            <div class="f">
              <div class="c"><?php echo \dash\get::index($value, 'title')?></div>
              <div class="c"></div>
              <div class="cauto"><div data-confirm data-data='{"removeline" : "removeline", "linekey": "<?php echo \dash\get::index($value, 'line_key'); ?>", "linetype": "<?php echo \dash\get::index($value, 'key'); ?>"}' class="link fc-red"><?php echo T_("Remove"); ?></div></div>
              <div class="c1"></div>
              <div class="cauto"><div data-kerkere='.ShowKerkere_<?php echo \dash\get::index($value, 'line_key'); ?>'  class="link"><?php echo T_("Edit"); ?></div></div>
            </div>
            <div class='ShowKerkere_<?php echo \dash\get::index($value, 'line_key'); ?>' data-kerkere-content='hide'>
              <?php
              $addr = root. 'content_a/website/body/box/'. \dash\get::index($value, 'type'). '.php';
              if(is_file($addr))
              {
                require($addr);
              }
              ?>
            </div>

            </div>
          <div class="go"></div>
        </div>
     </li>
  <?php } //endfor ?>
  </ul>
</nav>
<?php } //endif ?>

