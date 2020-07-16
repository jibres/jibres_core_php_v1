<?php
$propertyList   = \dash\data::propertyList();
$storData       = \dash\data::store_store_data();
$productDataRow = \dash\data::productDataRow();

?>

<form method="post" autocomplete="off" id="form1">
  <div class="avand-xl">

    <div class="jPage" >



      <section class="jbox">
        <header><h2><?php echo T_("Property"); ?></h2></header>
        <div class="pad jboxProperty">



          <p class="msg"><?php echo T_("Set product property"); ?></p>


          <div><?php echo T_("Dimensions"); ?> <span class="fc-mute"> <?php echo \dash\get::index($storData,'length_detail','name'); ?></span></div>
          <div class="f">

            <div class="c">
              <label for="iLength"><?php echo T_("Length"); ?></label>
              <div class="input">
                <input type="text" name="length" id="iLength" value="<?php echo \dash\get::index($productDataRow,'length'); ?>"  autocomplete="off" maxlength="11" data-format='number'>
              </div>
            </div>



            <div class="c mLa5">
              <label for="iWidth"><?php echo T_("Width"); ?></label>
              <div class="input">
                <input type="text" name="width" id="iWidth" value="<?php echo \dash\get::index($productDataRow,'width'); ?>"  autocomplete="off" maxlength="11" data-format='number'>
              </div>
            </div>



            <div class="c mLa5">
              <label for="iHeight"><?php echo T_("Height"); ?></label>
              <div class="input">
                <input type="text" name="height" id="iHeight" value="<?php echo \dash\get::index($productDataRow,'height'); ?>"  autocomplete="off" maxlength="11" data-format='number'>
              </div>
            </div>


          </div>

          <label for="iweight"><?php echo T_("Weight"); ?></label>
          <div class="input">
            <input type="text" name="weight" id="iweight" value="<?php echo \dash\get::index($productDataRow,'weight'); ?>"  autocomplete="off" maxlength="7" data-format='number'>
            <div class="addon"><?php echo \dash\get::index($storData,'mass_detail','name'); ?></div>
          </div>

        </div>


        <table class="tbl1 v4">
          <thead>
            <tr>
              <th colspan="3"><?php echo T_("Custom property") ?></th>
            </tr>
          </thead>

          <tbody>

            <?php foreach ($propertyList as $property_value) {?>

              <?php $rand_key = rand(1, 9999); ?>
              <tr>
                <td>

                  <?php if(!\dash\data::catList()) {?>
                    <div class="input">
                      <input type="text" name="cat_<?php echo $rand_key; ?>" placeholder="<?php echo T_("Group"); ?>" id="title" maxlength="100" value="<?php echo \dash\get::index($property_value, 'cat'); ?>">
                    </div>
                  <?php }else{ ?>
                    <div>
                      <select name="cat_<?php echo $rand_key; ?>" class="select22" data-model='tag' data-placeholder="<?php echo T_("Group"); ?>" >
                        <option></option>
                        <?php foreach (\dash\data::catList() as $key => $value) {?>
                          <option value="<?php echo $value; ?>" <?php if($value == \dash\get::index($property_value, 'cat')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                        <?php } //endfor ?>
                      </select>
                    </div>
                  <?php } //endif ?>
                </td>

                <td>
                  <?php if(!\dash\data::keyList()) {?>
                    <div class="input">
                      <input type="text" name="key_<?php echo $rand_key; ?>" placeholder="<?php echo T_("Type"); ?>" id="title" maxlength="100" value="<?php echo \dash\get::index($property_value, 'key', 'key'); ?>">
                    </div>
                  <?php }else{ ?>
                    <div>
                      <select name="key_<?php echo $rand_key; ?>" class="select22" data-model='tag' data-placeholder="<?php echo T_("Type"); ?>" >
                        <option></option>
                        <?php foreach (\dash\data::keyList() as $key => $value) {?>
                          <option value="<?php echo $value; ?>" <?php if($value == \dash\get::index($property_value, 'key', 'key')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                        <?php } //endfor ?>
                      </select>
                    </div>
                  <?php } //endif ?>
                </td>

                <td>

                  <?php if(!\dash\data::valueList()) {?>
                    <div class="input">
                      <input type="text" name="value_<?php echo $rand_key; ?>" placeholder="<?php echo T_("Value"); ?>" id="title" maxlength="100" value="<?php echo \dash\get::index($property_value, 'value'); ?>">
                    </div>
                  <?php }else{ ?>
                    <div>
                      <select name="value_<?php echo $rand_key; ?>" class="select22" data-model='tag' data-placeholder="<?php echo T_("Value"); ?>" >
                        <option></option>
                        <?php foreach (\dash\data::valueList() as $key => $value) {?>
                          <option value="<?php echo $value; ?>" <?php if($value == \dash\get::index($property_value, 'value')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                        <?php } //endfor ?>
                      </select>
                    </div>
                  <?php } //endif ?>
                </td>



              </tr>
            <?php } //endfor ?>
            <?php $rand_key = rand(1, 9999); ?>
            <tr class="active">
              <td>
                <?php if(!\dash\data::catList()) {?>
                  <div class="input">
                    <input type="text" name="cat_<?php echo $rand_key; ?>" placeholder="<?php echo T_("Group"); ?>" id="title" maxlength="100" value="<?php echo \dash\get::index($value, 'cat'); ?>">
                  </div>
                <?php }else{ ?>
                  <div>
                    <select name="cat_<?php echo $rand_key; ?>" class="select22" data-model='tag' data-placeholder="<?php echo T_("Group"); ?>" >
                      <option></option>
                      <?php foreach (\dash\data::catList() as $key => $value) {?>
                        <option value="<?php echo $value; ?>" <?php if($value == \dash\get::index($value, 'cat')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                      <?php } //endfor ?>
                    </select>
                  </div>
                <?php } //endif ?>
              </td>
              <td>
                <?php if(!\dash\data::keyList()) {?>
                  <div class="input">
                    <input type="text" name="key_<?php echo $rand_key; ?>" placeholder="<?php echo T_("Type"); ?>" id="title" maxlength="100" value="<?php echo \dash\get::index($value, 'key'); ?>">
                  </div>
                <?php }else{ ?>
                  <div>
                    <select name="key_<?php echo $rand_key; ?>" class="select22" data-model='tag' data-placeholder="<?php echo T_("Type"); ?>" >
                      <option></option>
                      <?php foreach (\dash\data::keyList() as $key => $value) {?>
                        <option value="<?php echo $value; ?>" <?php if($value == \dash\get::index($value, 'key')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                      <?php } //endfor ?>
                    </select>
                  </div>
                <?php } //endif ?>
              </td>
              <td>
                <?php if(!\dash\data::valueList()) {?>
                  <div class="input">
                    <input type="text" name="value_<?php echo $rand_key; ?>" placeholder="<?php echo T_("Value"); ?>" id="title" maxlength="100" value="<?php echo \dash\get::index($value, 'value'); ?>">
                  </div>
                <?php }else{ ?>
                  <div>
                    <select name="value_<?php echo $rand_key; ?>" class="select22" data-model='tag' data-placeholder="<?php echo T_("Value"); ?>" >
                      <option></option>
                      <?php foreach (\dash\data::valueList() as $key => $value) {?>
                        <option value="<?php echo $value; ?>" <?php if($value == \dash\get::index($value, 'value')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                      <?php } //endfor ?>
                    </select>
                  </div>
                <?php } //endif ?>
              </td>
            </tbody>
          </table>

        </div>
      </section>

    </div>
  </div>

</form>