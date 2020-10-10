
<form method="post" enctype="multipart/form-data" autocomplete="off">
  <div class="f justify-center">
    <div class="c8 s12">
      <div class="cbox">
          <div class="switch1 mT20">
           <input type="checkbox" name="forceremember" id="forceremember" <?php if(\dash\data::dataRow_forceremember()) { echo 'checked'; } ?>>
           <label for="forceremember"></label>
           <label for="forceremember"><?php echo T_("Save remember session"); ?></label>
          </div>
          <?php \dash\csrf::html(); ?>

          <div class="txtRa mT20">
            <button class="btn success"><?php echo T_("Save"); ?></button>
          </div>
      </div>
    </div>
  </div>
</form>
