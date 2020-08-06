<form method="post" autocomplete="off">
  <div class="avand-lg">
    <div class="box">
      <header><h2><?php echo T_("Add new accounting coding") ?></h2></header>
      <div class="body">

        <?php if(\dash\data::parentList()) {?>
          <label for="parent"><?php echo T_("Parent") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
          <select class="select22" name="parent">
            <option value=""><?php echo T_("Please choose parent") ?></option>
            <?php foreach (\dash\data::parentList() as $key => $value) {?>
              <option value="<?php echo \dash\get::index($value, 'id') ?>"><?php echo \dash\get::index($value, 'full_title'); ?></option>
            <?php } // endfor ?>
          </select>
        <?php } // endif ?>

        <label for="title"><?php echo T_("Title") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <div class="input">
          <input type="text" name="title" id="title" required value="<?php echo \dash\data::dataRow_title(); ?>">
        </div>


        <label for="code"><?php echo T_("Code") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <div class="input">
          <input type="number" min="10" max="99" name="code" id="code" required value="<?php echo \dash\data::dataRow_code(); ?>">
        </div>


      </div>
      <?php if(\dash\data::editMode()) {?>
      <footer class="f">
        <div class="cauto">
          <div data-confirm data-data='{"remove": "remove"}' class="btn danger"><?php echo T_("Remove") ?></div>
        </div>
        <div class="c"></div>
        <div class="cauto">
          <button class="btn success"><?php echo T_("Edit") ?></button>
        </div>

      </footer>
        <?php }else{ ?>
      <footer class="txtRa">
          <button class="btn master"><?php echo T_("Add") ?></button>
      </footer>
      <?php } //endif ?>
    </div>
  </div>
</form>
