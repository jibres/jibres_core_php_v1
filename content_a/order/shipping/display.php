<?php
$orderDetail    = \dash\data::orderDetail();
$orderStatus    = a($orderDetail, 'factor', 'status');
$orderPayStatus = a($orderDetail, 'factor', 'paystatus');

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

<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-9">
    <?php require_once(root. '/content_a/order/detail.php'); ?>

    <form method="post" autocomplete="off">

      <div class="box">
        <div class="pad">
          <p>
            <i class="sf-box"></i> <?php echo T_("Shipping order") ?>
            <br>
            <small class="text-gray-400"><?php echo T_("Change order Shipping method, date send and something else") ?></small>
          </p>

          <div class="mb-2">
            <div class="row">
              <div class="c-auto">
                <label for="package"><?php echo T_("Package") ?></label>
              </div>
              <div class="c"></div>
              <div class="c-auto">
                <a class="link sm" href="<?php echo \dash\url::here(). '/setting/shipping/package' ?>"><?php echo T_("Manage package") ?></a>
              </div>
            </div>

            <?php if(\dash\data::packageList()) {?>
              <select class="select22" name="package" id="package">
                <?php foreach (\dash\data::packageList() as $key => $value) {?>
                  <option value="<?php echo a($value, 'id') ?>"><?php echo a($value, 'title') ?></option>
                <?php } //endfor ?>
                <option value="custom"><?php echo T_("Custom") ?></option>
              </select>
            <?php }else{ ?>
              <input type="hidden" name="package" value="custom">
            <?php } // endif ?>

            <div data-response='package' data-response-where='custom' <?php if(!\dash\data::packageList()) {}else{echo 'data-response-hide';} ?>>
              <label for="custompackage"><?php echo T_("Custom package") ?></label>
              <div class="input">
                <input type="text" name="custompackage" id="custompackage" >
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
              <div class="check1">
                <input type="checkbox" name="saveforlater" id="saveforlater">
                <label for="saveforlater"><?php echo T_("Save for later") ?></label>
              </div>
            </div>


          </div>

          <div class="mb-2">
            <div class="row">
              <div class="c-auto">
                <label for="method"><?php echo T_("Choos Shipping method") ?></label>
              </div>
              <div class="c"></div>
              <div class="c-auto">
                <a class="link sm" href="<?php echo \dash\url::here(). '/setting/shipping/method' ?>"><?php echo T_("Manage method") ?></a>
              </div>
            </div>
            <?php if(\dash\data::methodList()) {?>
              <select class="select22" name="method" id="method">
                <?php foreach (\dash\data::methodList() as $key => $value) {?>
                  <option value="<?php echo a($value, 'id') ?>"><?php echo a($value, 'title') ?></option>
                <?php } //endfor ?>
                <option value="custom"><?php echo T_("Custom") ?></option>
              </select>
            <?php }else{ ?>
              <div class="alert2">
                <a class="link sm" href="<?php echo \dash\url::here(). '/setting/shipping/method' ?>"><?php echo T_("Add new shipping method") ?></a>
              </div>
            <?php } // endif ?>
          </div>

          <div class="mb-2">
             <label for="shippingdate"><?php echo T_("Shipping date") ?></label>
              <div class="input">
                <input type="text" name="shippingdate" id="shippingdate" data-format='date'>
              </div>
          </div>


        </div>
        <footer class="txtRa">
          <button class="btn master"><?php echo T_("Save"); ?></button>
        </footer>
      </div>
    </form>




  </div>
</div>