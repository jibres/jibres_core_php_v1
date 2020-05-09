<section class="f" data-option='website-header-menu-1'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo \dash\get::index($box_detail, 'title');?></h3>
      <div class="body">
        <p><?php
$desc = \dash\get::index($box_detail, 'desc');
if($desc)
{
  echo $desc;
}
else
{
  echo T_("A site menu is an essential part of your website. Every site should have one so that your site visitors can navigate between your pages or sections. If your menu is placed in the header or footer, it automatically shows on every page.");
}
?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <?php if(\dash\data::allMenu()) {?>

        <select name="<?php echo $box; ?>" id="idmenu<?php echo $box; ?>" class="select22">
          <?php if(\dash\get::index($header_detail, 'saved', $box)) {?>
            <option value="0"><?php echo T_("Without menu"); ?></option>
          <?php }else{ ?>
            <option></option>
          <?php } //endif ?>
          <?php foreach (\dash\data::allMenu() as $key => $value) {?>
            <option value="<?php echo \dash\get::index($value, 'key'); ?>" <?php if(\dash\get::index($header_detail, 'saved', $box) == \dash\get::index($value, 'key')) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'title'); ?></option>
          <?php } //endfor ?>
        </select>

    <?php }else{ ?>
      <a class="btn primary" href="<?php echo \dash\url::this() ?>/menu/add"><?php echo T_("Add new menu") ?></a>
    <?php } //endif ?>
    </div>
  </form>
  <?php if(\dash\data::allMenu()) {?>
  <footer class="txtRa">
   <a href="<?php echo \dash\url::this() ?>/menu/add" class="btn link"><?php echo T_("Add new menu") ?></a>
  </footer>
    <?php } //endif ?>
</section>
