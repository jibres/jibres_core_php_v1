
<div class="f justify-center">
  <div class="c6 m8 s12 x5">
    <form method="post" class="box" autocomplete="off">
      <header><h2><?php echo T_("Add item to menu"). ' '. \dash\data::menuDetail_title(); ?></h2></header>

      <div class="body">


          <label for="title"><?php echo T_("Title"); ?></label>
          <div class="input">
            <input type="text" name="title" id="title" value="" maxlength="50" required>
          </div>

          <label for="url"><?php echo T_("Url"); ?></label>
          <div class="input ltr">
            <input type="text" name="url" id="url" value=""  required>
          </div>

          <label for="sort"><?php echo T_("Sort"); ?></label>
          <div class="input">
            <input type="number" name="sort" id="sort" value="" min="0" max="9999">
          </div>

          <div class="switch1 mB5">
            <input type="checkbox" name="target" id="target" >
            <label for="target"></label>
            <label for="target"><?php echo T_("Open in New tab"); ?><small></small></label>
          </div>

      </div>

      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Add"); ?></button>
      </footer>
    </form>

    <form method="post" class="box" autocomplete="off">
      <header data-kerkere='.showManageMentMenu'><h2><?php echo T_("Manage menu"). ' '. \dash\data::menuDetail_title(); ?></h2></header>
      <div class="showManageMentMenu" data-kerkere-content='hide'>

      <div class="body">
          <input type="hidden" name="editmenu" value="editmenu">

          <label for="menutitle"><?php echo T_("Edit menu title"); ?></label>
          <div class="input">
            <input type="text" name="menutitle" id="menutitle" value="<?php echo \dash\data::menuDetail_title() ?>" maxlength="50" required>
            <button class="addon btn primary"><?php echo T_("Edit"); ?></button>
          </div>

          <?php if(\dash\data::usageList()) {?>
            <p><?php echo T_("Usage menu list") ?></p>
            <?php foreach (\dash\data::usageList() as $key => $value) {?>
              <a href="<?php echo \dash\url::this(). \dash\get::index($value, 'link'); ?>" class="badge pA20 fs11"><?php echo \dash\get::index($value, 'title') ?></a>
            <?php } //endforeach ?>
          <?php }else{ ?>
            <p class="mT20">
              <?php echo T_("This menu not use anywhere. You can remove it") ?>
              <span data-confirm data-data='{"menuid": "<?php echo \dash\request::get('id'); ?>", "removemenu": "removemenu"}' class="link fc-red" ><?php echo T_("Remove"); ?></span>
            </p>
          <?php }//endif ?>




      </div>


      </div>
    </form>
  </div>

  <div class="c6 x5 s12 pLa10">

    <nav class="items">
     <ul>

    <?php foreach (\dash\data::menuDetailList() as $key => $value) {?>
       <li>
        <a class="f" href2="<?php echo \dash\get::index($value, 'url');?>" data-kerkere='.showMenuItem_<?php echo $key; ?>' data-kerkere-single>
          <div class="key"><?php echo \dash\get::index($value, 'title');?>
            <?php if(\dash\get::index($value, 'target')) {?><i class="sf-link fc-mute"></i> <?php }// endif ?>
          </div>
          <div class="go"></div>
        </a>

        <div class="showMenuItem_<?php echo $key; ?>" data-kerkere-content='hide'>
          <form method="post" class="box" autocomplete="off">
            <div class="body">

              <input type="hidden" name="itemkey" value="<?php echo $key; ?>">
              <div class="input mB10">
                <input type="text" name="title" id="title" value="<?php echo \dash\get::index($value, 'title'); ?>" maxlength="50" required>
              </div>


              <div class="input mB10 ltr">
                <input type="text" name="url" id="url" value="<?php echo \dash\get::index($value, 'url'); ?>"  required>
              </div>


              <div class="input mB10">
                <input type="number" name="sort" id="sort" value="<?php echo \dash\get::index($value, 'sort'); ?>" min="0" max="9999">
              </div>

              <div class="check1 mB5">
                <input type="checkbox" name="target" id="target_<?php echo $key; ?>" <?php if(\dash\get::index($value, 'target')) { echo 'checked'; } ?>>
                <label for="target_<?php echo $key; ?>"><?php echo T_("Open in New tab"); ?><small></small></label>
              </div>

            </div>
            <footer class="f">
              <div class="c">
                <div data-confirm data-data='{"itemkey": "<?php echo $key; ?>", "remove": "remove"}' class="btn link fc-red" ><?php echo T_("Remove"); ?></div>
              </div>
              <div class="cauto os">
                <button class="btn primary"><?php echo T_("Update"); ?></button>
              </div>
            </footer>

          </form>

        </div>

       </li>
    <?php } //enfor ?>
     </ul>
   </nav>
  </div>

</div>


