<form method="post" autocomplete="off" id='form1'>
<div class="avand-md">

      <section class="box">
        <div class="body">
          <label for="itagname"><?php echo T_("Title"); ?></label>
          <div class="input">
            <input type="text" name="title" id="itagname" placeholder='<?php echo T_("Tag name"); ?>' value="<?php echo \dash\data::dataRow_title(); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1" required>
          </div>

        </div>

      </section>



       <section class="box">
          <div class="pad">
            <?php if(!\dash\data::dataRow_count() && !\dash\data::dataRow_have_child()) {?>
            <p><?php echo T_("You can delete this tag because we are not found any form in that."); ?></p>
            <?php }else{ ?>
              <p><?php echo T_("You can delete this tag and merge all form in this tag by another tag."); ?></p>
            <?php }//endif ?>
          </div>
          <footer>
            <?php if(!\dash\data::dataRow_count() && !\dash\data::dataRow_have_child()) {?>
              <div class="txtRa"><span data-confirm data-data='{"delete" : "delete"}' class="btn linkDel" ><?php echo T_("Remove tag"); ?></span></div>
            <?php }else{ ?>
              <div class="txtRa"><a href="<?php echo \dash\url::that(). '/remove?'. \dash\request::fix_get() ?>" class="btn linkDel" ><?php echo T_("Remove tag"); ?></a></div>
            <?php }//endif ?>
          </footer>
        </section>
    <nav class="items long hide">
      <ul>
          <li>
            <a class="f item" href="<?php echo \dash\url::here(); ?>/forms?tagid=<?php echo \dash\data::dataRow_id(); ?>">
              <div class="key"><?php echo T_("Show forms by this tag"); ?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\data::dataRow_count()) ?></div>
              <div class="go"></div>
            </a>
          </li>
      </ul>
    </nav>

    </div>

</div>
</form>
