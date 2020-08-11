

<?php if(\dash\data::bodyLineList()) {?>
<form method="post">
<nav class="items">
  <ul class="sortable" data-sortable>
  <?php foreach (\dash\data::bodyLineList() as $key => $value) {?>

     <li>
        <a href="<?php echo \dash\url::this(). '/'. \dash\get::index($value,'type') .'?id='. \dash\get::index($value, 'id'); ?>" class="f">
        <input type="hidden" class="hide" name="bodyline[]" value="<?php echo \dash\get::index($value, 'id'); ?>">
          <div class="key">
            <div class="f">
              <div data-handle class="c1 handle"><i class="sf-sort"></i></div>
              <div class="c2"><?php echo \dash\get::index($value, 'title')?></div>
              <div class="c1">
                <?php if(\dash\get::index($value, 'publish')) {?>
                  <i title="<?php echo T_("Published") ?>" class="sf-check fc-green"></i>
                <?php }else{ ?>
                  <i title="<?php echo T_("Draft") ?>" class="sf-refresh fc-red"></i>
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
</form>
  <?php if(is_array(\dash\data::bodyLineList()) && count(\dash\data::bodyLineList()) >= 2) {?>
    <div class="msg fs12"><?php echo T_("Change the position of the rows with the help of the handle") ?> <kbd><i class="sf-sort"></i></kbd></div>
  <?php } //endif ?>
<?php } //endif ?>

