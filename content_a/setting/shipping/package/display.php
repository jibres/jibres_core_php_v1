<?php
$lenght_unit = null;

if(\lib\store::detail('length_unit'))
{
 $lenght_unit =  a(\lib\units::detail(\lib\store::detail('length_unit'), 'length'), 'name');
}

$mass_unit = null;

if(\lib\store::detail('mass_unit'))
{
 $mass_unit =  a(\lib\units::detail(\lib\store::detail('mass_unit'), 'mass'), 'name');
}

?>
<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <p><?php echo T_("Define packages detail");?></p>

        <label for="title"><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="title" value="<?php echo \dash\data::dataRow_title() ?>">
        </div>

        <div class="row">
          <div class="c-xs c-sm">
            <label for="length"><?php echo T_("Length"); ?></label>
            <div class="input">
              <input type="number" step="0.01" max="99999" name="length" id="length" placeholder="<?php echo \lib\store::detail('length_unit') ?>" value="<?php echo \dash\data::dataRow_length() ?>">

            </div>
          </div>
          <div class="c-xs c-sm">
            <label for="width"><?php echo T_("Width"); ?></label>
            <div class="input">
              <input type="number" step="0.01" max="99999" name="width" id="width" placeholder="<?php echo \lib\store::detail('length_unit') ?>" value="<?php echo \dash\data::dataRow_width() ?>">

            </div>
          </div>
          <div class="c-xs c-sm">
            <label for="height"><?php echo T_("Height"); ?></label>
            <div class="input">
              <input type="number" step="0.01" max="99999" name="height" id="height" placeholder="<?php echo \lib\store::detail('length_unit') ?>" value="<?php echo \dash\data::dataRow_height() ?>">
            </div>
          </div>
          <div class="c-xs-2 c-sm-2">
            <label>&nbsp;</label>
            <div class="input">
              <input type="text" value="<?php echo $lenght_unit ?>" disabled readonly>
            </div>
          </div>
        </div>
        <label for="weight"><?php echo T_("Weight"); ?> <small><?php echo T_("When empty") ?></small></label>
        <div class="input">
          <input type="number" step="0.01" max="99999" name="weight" id="weight" value="<?php echo \dash\data::dataRow_weight() ?>">
          <label for="weight" class="addon"><?php echo $mass_unit ?></label>
        </div>


      </div>
        <footer class="">
          <div class="row">
            <div class="c-auto">
              <?php if(\dash\data::editMode()) {?>
                <a href="<?php echo \dash\url::current() ?>" class="btn-outline-secondary"><?php echo T_("Cancel") ?></a>
              <?php } //endif ?>
            </div>
            <div class="c"></div>
            <div class="c-auto">
              <?php if(\dash\data::editMode()) {?>
                <button  class="btn-primary"><?php echo T_("Edit package"); ?></button>
              <?php }else{ ?>
                <button  class="btn-success"><?php echo T_("Create package"); ?></button>
              <?php } //endif ?>
            </div>
          </div>

      </footer>
    </div>
  </form>

  <?php if(\dash\data::packageList()) {?>
    <?php foreach (\dash\data::packageList() as $key => $value){ ?>
      <div class="box">
        <div class="pad">
          <div class="txtB mB10 fs14"><?php echo a($value, 'title') ?></div>
          <?php if(a($value, 'length')) {?><div><small><?php echo T_("Length"); ?></small> <?php echo \dash\fit::text(a($value, 'length')) ?> <small><?php echo $lenght_unit ?></small></div><?php } //endif ?>
          <?php if(a($value, 'width')) {?><div><small><?php echo T_("Width"); ?></small> <?php echo \dash\fit::text(a($value, 'width')) ?> <small><?php echo $lenght_unit ?></small></div><?php } //endif ?>
          <?php if(a($value, 'height')) {?><div><small><?php echo T_("Height"); ?></small> <?php echo \dash\fit::text(a($value, 'height')) ?> <small><?php echo $lenght_unit ?></small></div><?php } //endif ?>
          <?php if(a($value, 'weight')) {?><div><small><?php echo T_("Weight"); ?></small> <?php echo \dash\fit::text(a($value, 'weight')) ?> <small><?php echo $mass_unit ?></small></div><?php } //endif ?>
        </div>
        <footer class="">
          <div class="row">
            <div class="c-auto"><div class="btn-link-danger" data-confirm data-data='{"remove": "remove", "id" : "<?php echo a($value, 'id') ?>"}'><?php echo T_("Remove") ?></div></div>
            <div class="c"></div>
            <div class="c-auto">
              <?php if(\dash\data::editMode() && \dash\request::get('id') == a($value, 'id')) { /*Nothing*/ }else{ ?>
                <a href="<?php echo \dash\url::current(). '?id='. a($value, 'id') ?>" class="btn-outline-primary"><?php echo T_("Edit") ?></a>
              <?php } //endif ?>
            </div>
          </div>

        </footer>

      </div>
    <?php } ?>
  <?php } //endif ?>
</div>