<?php if(\dash\request::get('type') === 'add' || \dash\request::get('type') === 'edit') {?>
<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <header><h2><?php echo T_("Add new inventory") ?></h2></header>
      <div class="body">

        <label for="title"><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="title" id="title"  minlength="1" maxlength="100" value="<?php echo \dash\data::dataRow_name() ?>" <?php \dash\layout\autofocus::html() ?>>
        </div>


      </div>
      <footer class="txtRa">
        <?php if(\dash\request::get('type') === 'add') {?>
          <button class="btn success"><?php echo T_("Add") ?></button>
        <?php }else{ ?>
          <button class="btn primary"><?php echo T_("Edit") ?></button>
        <?php } //endif ?>
      </footer>
    </div>
  </form>
</div>
<?php }else{ ?>
  <div class="row">
    <div class="c-xs-12 c-sm-6">
      <div class="dcard grShadow grGreen2 grBlue2 x3 op100">
        <a class="mB25 fcWhite900 fs20"><?php echo T_("Central inventory") ?></a>
        <div class="f">
          <div class="c6 pA5"><div class="grShadow pA10"><?php echo T_("Products") ?> <span class="floatRa"><?php echo \dash\fit::number(rand(1, 9999)) ?></span></div></div>
          <div class="c6 pA5"><div class="grShadow pA10"><?php echo T_("Products items") ?> <span class="floatRa"><?php echo \dash\fit::number(rand(1, 9999)) ?></span></div></div>
          <div class="c12 pA5"><div class="grShadow pA10"><?php echo T_("Last update") ?> <span class="floatRa"><?php echo \dash\fit::date_human(date("Y-m-d H:i:s")) ?></span></div></div>

        </div>
      </div>
    </div>
    <?php if(\dash\data::dataTable()) {?>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <div class="c-xs-12 c-sm-6">
          <div class="dcard grShadow grGreen2 grBlue2 x3 op100">
            <a class="mB25 fcWhite900 fs20"><?php echo $value['name'] ?></a>
            <div class="f">
              <div class="c6 pA5"><div class="grShadow pA10"><?php echo T_("Products") ?> <span class="floatRa"><?php echo \dash\fit::number(rand(1, 9999)) ?></span></div></div>
              <div class="c6 pA5"><div class="grShadow pA10"><?php echo T_("Products items") ?> <span class="floatRa"><?php echo \dash\fit::number(rand(1, 9999)) ?></span></div></div>
              <div class="c6 pA5"><div class="grShadow pA10"><?php echo T_("Last update") ?> <span class="floatRa"><?php echo \dash\fit::date_human(date("Y-m-d H:i:s")) ?></span></div></div>
              <div class="c6 pA5"><a href="<?php echo \dash\url::current(). '?type=edit&id='. $value['id']; ?>" class="link"><div class="grShadow pA10 txtC"><?php echo T_("Edit") ?></div></a></div>
            </div>
          </div>
        </div>
      <?php } //endfor ?>
    <?php } //endif ?>
  </div>
<?php } //endif ?>
