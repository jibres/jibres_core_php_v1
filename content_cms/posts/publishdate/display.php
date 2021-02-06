<?php require_once(root. 'content_cms/posts/postDetail.php'); ?>
<div class="avand-md">
  <form method="post" autocomplete="off" id="formPublishdate">
    <div class="box">
      <div class="pad">
        <p>
          <?php echo T_("By default, the publish date of the post is saved at the moment the status changes to the publish. You can change it and put it in the future. By doing this, your post will not be visible on the website until it is published until the specified time, at which time it will be automatically displayed to the customers."); ?>
        </p>

        <?php if(\dash\data::dataRow_status() !== 'publish'){?>
          <div class="row mB10">
            <div class="c-xs-12 c-sm-6">
              <div class="radio3">
                <input type="radio" name="PDT" id="publishdatetypeonpublish" value="publishdatetypeonpublish" <?php if(!\dash\data::dataRow_publishdate()){ echo 'checked'; } ?>>
                <label for="publishdatetypeonpublish"><?php echo T_("When post published") ?></label>
              </div>

            </div>
            <div class="c-xs-12 c-sm-6">
              <div class="radio3">
                <input type="radio" name="PDT" id="publishdatetypecustomized" value="publishdatetypecustomized" <?php if(\dash\data::dataRow_publishdate()){ echo 'checked'; } ?>>
                <label for="publishdatetypecustomized"><?php echo T_("In special date") ?></label>
              </div>
            </div>
          </div>

          <div data-response='PDT' data-response-where='publishdatetypecustomized' <?php if(!\dash\data::dataRow_publishdate()){ echo 'data-response-hide';} ?>>
          <?php } //endif
          $nowDate = str_replace('-', '/', \dash\utility\convert::to_en_number(\dash\fit::date(date("Y/m/d"))));
          $publishdate = null;
          if(\dash\data::dataRow_publishdate())
          {
            $publishdate = \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_publishdate()));
          }
          ?>

          <label for="publishdate"><?php echo T_("Publish date") ?></label>
          <div class="input">
            <input type="text" name="publishdate" data-format='date' placeholder="<?php echo $nowDate ?>" value="<?php if(\dash\data::dataRow_publishdate()) { echo $publishdate; }else{echo $nowDate; } ?>" id="publishdate" >
          </div>

          <label for="publishtime"><?php echo T_("Publish time") ?></label>
          <div class="input">
            <input type="text" name="publishtime" data-format='time' placeholder="<?php echo date("H:i"); ?>" value="<?php if(\dash\data::dataRow_publishdate()) { echo date("H:i", strtotime(\dash\data::dataRow_publishdate())); }else{ echo date("H:i");} ?>" id="publishtime" >
          </div>
          <?php if(\dash\data::dataRow_status() !== 'publish'){?>
          </div>
        <?php  }//endif ?>

        <label for="showdate"><?php echo T_("Show date in post page");?></label>
        <select class="select22" name="showdate">
          <option value="default" <?php if(\dash\data::dataRow_showdate() == 'default') { echo 'selected'; } ?> ><?php echo \dash\data::defaultTitleShowdate(); ?></option>
          <option value="visible" <?php if(\dash\data::dataRow_showdate() == 'visible') { echo 'selected'; } ?> ><?php echo T_("Visible"); ?></option>
          <option value="hidden" <?php if(\dash\data::dataRow_showdate() == 'hidden') { echo 'selected'; } ?> ><?php echo T_("Hidden"); ?></option>
        </select>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </form>
</div>