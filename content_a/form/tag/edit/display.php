<form method="post" autocomplete="off" id='form1'>
<div class="avand-md">

      <section class="box">
        <div class="body">
          <label for="itagname"><?php echo T_("Title"); ?></label>
          <div class="input">
            <input type="text" name="title" id="itagname" placeholder='<?php echo T_("Tag name"); ?>' value="<?php echo \dash\data::dataRow_title(); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1" required>
          </div>

          <div class="mB10">
              <label for="desc"><?php echo T_("Description") ?></label>
              <textarea name="desc" data-editor class="txt" rows="3" id="desc" placeholder="<?php echo T_("Inquiry Message") ?>"><?php echo \dash\data::dataRow_desc(); ?></textarea>
            </div>


         <div class="row">
            <div class="c-xs-6 c-sm-6">
              <div class="radio3">
                <input type="radio" name="privacy" value="public" <?php if(\dash\data::dataRow_privacy() === 'public') {echo 'checked';} ?>  id="privacypublic">
                <label for="privacypublic"><?php echo T_("Public") ?></label>
              </div>
            </div>
            <div class="c-xs-6 c-sm-6">
              <div class="radio3">
                <input type="radio" name="privacy" value="private"  <?php if(\dash\data::dataRow_privacy() === 'private') {echo 'checked';} ?> id="privacyprivate">
                <label for="privacyprivate"><?php echo T_("Private") ?></label>
              </div>
            </div>
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
