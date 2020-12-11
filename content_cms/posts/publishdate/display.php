<?php
$dataRow = \dash\data::dataRow();
$myFirstURL = '';
?>
<div class="avand-md">
  <form method="post" autocomplete="off" id="formPublishdate">
    <div class="box">
      <div class="pad">
        <p>
          <?php echo T_("By default, the publish date of the post is saved at the moment the status changes to the publish. You can change it and put it in the future. By doing this, your post will not be visible on the website until it is published until the specified time, at which time it will be automatically displayed to the customers."); ?>
        </p>


            <label for="publishdate"><?php echo T_("Publish date") ?></label>
            <div class="input">
              <input type="text" name="publishdate" data-format='date' value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_publishdate())); ?>" id="publishdate" >
            </div>

            <label for="publishtime"><?php echo T_("Publish time") ?></label>
            <div class="input">
              <input type="text" name="publishtime" data-format='time' value="<?php echo date("H:i", strtotime(\dash\data::dataRow_publishdate())); ?>" id="publishdate" >
            </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </form>
</div>