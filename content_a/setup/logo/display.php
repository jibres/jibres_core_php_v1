

<div id="get_started_card">
  <div class="body">
    <div class="pad">
      <h1><?php echo \dash\face::title(); ?></h1>
      <p><?php echo T_("You can set it later but in setup process we help you to quick start."); ?> <?php echo T_("So, it's better to set it now!"); ?></p>
      <p class="msg primary2"><?php echo T_("Please use square logo!"); ?></p>
      <form method="post" enctype="multipart/form-data" autocomplete="off">


        <div class="input preview">
         <input type="file" accept="image/gif, image/jpeg, image/png" name="logo" data-max="1000" data-preview id="logo1">
         <label for="logo1">
          <img src="<?php echo \dash\data::dataRow_logo(); ?>" class="box200">
         </label>
        </div>

        <div class="f align-center mB10">
          <div class="c fc-mute"><?php echo \dash\data::stepDesc(); ?></div>
          <div class="cauto os pRa10"><button class="btn outline secondary" name="skip" value="skip"><?php echo T_("Skip"); ?></button></div>
          <div class="cauto os"><button class="btn primary"><?php echo T_("Save"); ?></button></div>
        </div>

      </form>
    </div>
  </div>
</div>
