

<div id="get_started_card">
  <div class="body">
    <div class="pad">
      <h1><?php echo \dash\face::title(); ?></h1>
      <p><?php echo T_("You can set it later but in setup process we help you to quick start."); ?> <?php echo T_("So, it's better to set it now!"); ?></p>

      <form method="post" enctype="multipart/form-data" autocomplete="off">

        <img id="finalImage" src="<?php echo \dash\data::dataRow_logo(); ?>" class="mB20-f">

        <div class="box" data-uploader data-name='logo' data-ratio="1" data-final='#finalImage'>
          <input type="file" accept="image/jpeg, image/png" id="image1">
          <label for="image1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
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
