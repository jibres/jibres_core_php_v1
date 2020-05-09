

<?php if(\dash\data::bodyLineList()) {?>
<nav class="items">
  <ul>
  <?php foreach (\dash\data::bodyLineList() as $key => $value) {?>

     <li>
        <a href="<?php echo \dash\url::that(). '/'. \dash\get::index($value,'key') .'?key='. \dash\get::index($value, 'saved_detail', 'line_key'); ?>" class="f">
          <div class="key">
            <div class="f">
              <div class="c2">
                <?php echo \dash\get::index($value, 'title')?>
              </div>
              <div class="c1">
                <?php if(\dash\get::index($value, 'saved_detail', 'publish')) {?>
                  <i title="<?php echo T_("Published") ?>" class="sf-check fc-green"></i>
                <?php }else{ ?>
                  <i title="<?php echo T_("Draft") ?>" class="sf-refresh fc-red"></i>
                <?php } //endif ?>
              </div>
              <div class="c">
                <?php if(\dash\get::index($value, 'saved_detail', 'title')) {?>
                  <?php echo \dash\get::index($value, 'saved_detail', 'title') ?>
                <?php } //endif ?>
              </div>

            </div>
          </div>
          <div class="go"></div>
        </a>
     </li>
  <?php } //endfor ?>
  </ul>
</nav>
<?php } //endif ?>

