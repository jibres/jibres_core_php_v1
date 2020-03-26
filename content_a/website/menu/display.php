
<div class="f justify-center">
  <div class="c6 m8 s12 x4">
    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Build new menu"); ?></h2></header>

      <div class="body">
          <p class="">
            <?php echo T_("After build menu you can use from this menu in website theme setting and put it in every where you need"); ?>
          </p>

          <label for="menutitle"><?php echo T_("Menu title"); ?></label>
          <div class="input">
            <input type="text" name="title" id="menutitle" value="" maxlength="50" required>
          </div>

      </div>
      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Save"); ?></button>
      </footer>
    </form>
  </div>

  <?php if(\dash\data::menuList()) {?>
  <div class="c4 pLa10">
    <nav class="items">
     <ul>
    <?php foreach (\dash\data::menuList() as $key => $value) {?>
       <li>
        <a class="f" href="<?php echo \dash\url::this();?>/theme">
          <div class="key"><?php echo \dash\get::index($value, 'title');?></div>
          <div class="go"></div></a>
       </li>
    <?php } //enfor ?>
     </ul>
   </nav>
  </div>
  <?php } //endif ?>

</div>


