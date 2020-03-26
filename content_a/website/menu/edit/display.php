
<div class="f justify-center">
  <div class="c6 m8 s12 x5">
    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo \dash\data::menuDetail_title(); ?></h2></header>

      <div class="body">


          <label for="title"><?php echo T_("Title"); ?></label>
          <div class="input">
            <input type="text" name="title" id="title" value="" maxlength="50" required>
          </div>

          <label for="url"><?php echo T_("Url"); ?></label>
          <div class="input">
            <input type="url" name="url" id="url" value=""  required>
          </div>

          <div class="switch1 mB5">
            <input type="checkbox" name="target" id="target" >
            <label for="target"></label>
            <label for="target"><?php echo T_("Open in New tab"); ?><small></small></label>
          </div>

      </div>

      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Add"); ?></button>
      </footer>
    </form>
  </div>

  <?php if(\dash\data::menuList()) {?>
  <div class="c4 pLa10">
    <nav class="items">
     <ul>
    <?php foreach (\dash\data::menuList() as $key => $value) {?>
       <li>
        <a class="f" href="<?php echo \dash\url::this();?>/menu/edit?id=<?php echo \dash\get::index($value, 'id'); ?>">
          <div class="key"><?php echo \dash\get::index($value, 'title');?></div>
          <div class="go"></div></a>
       </li>
    <?php } //enfor ?>
     </ul>
   </nav>
  </div>
  <?php } //endif ?>

</div>


