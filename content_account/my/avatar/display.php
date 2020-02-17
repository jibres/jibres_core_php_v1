
<form method="post" enctype="multipart/form-data" autocomplete="off">
  <div class="f justify-center txtC">
    <div class="c6 m8 x5 s12">



      <div class="cbox">
        <h3 class="txtC mB20"><?php echo T_("Avatar"); ?></h3>

        <?php if(\dash\data::dataRow_avatar()) {?>
          <img src="<?php echo \dash\data::dataRow_avatar(); ?>" class="box200">
        <?php }//endif ?>

        <div class="input mT10">
         <input type="file" accept="image/gif, image/jpeg, image/png" name="avatar" id="avatar1"  data-max="500">
         <label for="avatar1" content_account\my>
         </label>
        </div>

        <div class="f align-center">
          <?php if(\dash\data::dataRow_avatar()) {?>
          <div class="cauto">
            <div class="btn danger xs"  data-confirm data-method='post' data-data='{"remove" : "avatar"}'><?php echo T_("Remove"); ?> <?php echo T_("Your avatar"); ?></div>
          </div>
          <?php } //endif ?>
          <div class="c"></div>
          <div class="cauto">
            <button class="btn success"><?php echo T_("Save"); ?></button>
          </div>
        </div>

      </div>


    </div>
  </div>
</form>
