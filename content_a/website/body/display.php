

<?php if(\dash\data::bodyLineList()) {?>
<form data-sortable method="post">
<nav class="items">
  <ul class="sortable">
  <?php foreach (\dash\data::bodyLineList() as $key => $value) {?>

     <li>
        <a data-handle href="<?php echo \dash\url::this(). '/'. \dash\get::index($value,'type') .'?id='. \dash\get::index($value, 'id'); ?>" class="f">
        <input type="hidden" class="hide" name="bodyline[]" value="<?php echo $key; ?>">
          <div class="key">
            <div class="f">
              <div class="c1 handle"><i class="sf-list"></i></div>
              <div class="c1 handle "><i class="sf-bag"></i></div>
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
<?php } //endif ?>

