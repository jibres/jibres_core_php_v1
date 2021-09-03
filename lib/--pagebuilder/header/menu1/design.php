<?php

$lineSetting = \dash\data::lineSetting();

$currentMenuID   = null;
$currentMenuName = null;

if(!isset($header_menu_key))
{
  $header_menu_key = 'header_menu_1';
}

if(!isset($header_menu_title))
{
  $header_menu_title = T_("Header Primary Menu");
}

$menu = \lib\app\menu\get::list_all_menu();

\dash\data::allMenu($menu);

?>

<section class="f" data-option='website-header-menu-1'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo $header_menu_title ?></h3>
      <div class="body">
        <p><?php echo T_("A site menu is an essential part of your website. Every site should have one so that your site visitors can navigate between your pages or sections. If your menu is placed in the header or footer, it automatically shows on every page."); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_menu_<?php echo $header_menu_key ?>" value="1">
    <div class="action">
      <?php if(\dash\data::allMenu()) {?>

        <select name="<?php echo $header_menu_key; ?>" id="idmenu<?php echo $header_menu_key; ?>" class="select22" data-placeholder='<?php echo T_("Choose one menu") ?>'>
          <?php if(a($lineSetting, 'detail', $header_menu_key)) {?>
            <option value="0"><?php echo T_("Without menu"); ?></option>
          <?php }else{ ?>
            <option value=""><?php echo T_("Choose one menu") ?></option>
          <?php } //endif ?>
          <?php foreach (\dash\data::allMenu() as $key => $value) {?>
            <option value="<?php echo a($value, 'id'); ?>" <?php if(a($lineSetting, 'detail', $header_menu_key) == a($value, 'id')) { echo 'selected'; $currentMenuID = a($value, 'id'); $currentMenuName = a($value, 'title');} ?>><?php echo a($value, 'title'); ?></option>
          <?php } //endfor ?>
        </select>

    <?php }else{ ?>
      <a class="btn primary" href="<?php echo \dash\url::here() ?>/setting/menu/add"><?php echo T_("Add new menu") ?></a>
    <?php } //endif ?>
    </div>
  </form>
  <?php if(\dash\data::allMenu()) {?>
  <footer class="txtRa">
    <?php if($currentMenuID) {?>
      <a href="<?php echo \dash\url::here(). '/setting/menu/roster?id='. $currentMenuID; ?>" class="btn link"><?php echo T_("Edit menu :val", ['val' => $currentMenuName]); ?></a>
    <?php } //endif ?>
   <a href="<?php echo \dash\url::here() ?>/setting/menu/add" class="btn link"><?php echo T_("Add new menu") ?></a>
  </footer>
    <?php } //endif ?>
</section>
