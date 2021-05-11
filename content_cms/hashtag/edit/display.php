<form method="post" autocomplete="off" id='form1'>
  <div class="avand-md">
    <div class="box">
      <div class="body">
        <label for="itagname"><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="title" id="itagname" placeholder='<?php echo T_("Hashtag name"); ?>' value="<?php echo \dash\data::dataRow_title(); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1" required>
        </div>
        <label for="itagurl"><?php echo T_("Url"); ?></label>
        <div class="input ltr">
          <input type="text" name="url" id="itagurl" placeholder='<?php echo T_("Hashtag name"); ?>' value="<?php echo \dash\data::dataRow_url(); ?>" maxlength='50' minlength="1" >
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </div>
    <div class="box">
      <div class="pad">
        <?php if(!\dash\data::dataRow_count()) {?>
          <p><?php echo T_("You can delete this tag because we are not found any post in that."); ?></p>
        <?php }else{ ?>
          <p><?php echo T_("You can delete this tag and merge all post in this tag by another tag."); ?></p>
        <?php }//endif ?>
      </div>
      <footer>
        <?php if(!\dash\data::dataRow_count()) {?>
          <div class="txtRa"><span data-confirm data-data='{"delete" : "delete"}' class="btn linkDel" ><?php echo T_("Remove tag"); ?></span></div>
        <?php }else{ ?>
          <div class="txtRa"><a href="<?php echo \dash\url::this(). '/remove?'. \dash\request::fix_get() ?>" class="btn linkDel" ><?php echo T_("Remove tag"); ?></a></div>
        <?php }//endif ?>
      </footer>
    </div>
    <?php if(\dash\data::dataRow_count()) {?>
      <nav class="items long">
        <ul>
          <li>
            <a class="f item" href="<?php echo \dash\url::here(); ?>/posts?tagid=<?php echo \dash\data::dataRow_id(); ?>">
              <div class="key"><?php echo T_("Show posts by this tag"); ?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\data::dataRow_count()) ?></div>
              <div class="go"></div>
            </a>
          </li>
        </ul>
      </nav>
    <?php } //endif ?>
  </div>
</form>