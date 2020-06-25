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

          <?php foreach ($propertyList as $value) {?>

            <?php $rand_key = rand(1, 9999); ?>
            <tr <?php if(\dash\get::index($value, 'from_category')) {echo 'class="positive"';}else{echo 'class="warning"';}?>>
              <td>
                <div class="input">
                  <input type="text" name="cat_<?php echo $rand_key; ?>" placeholder='<?php echo T_("Group"); ?>' value="<?php echo \dash\get::index($value, 'cat'); ?>">
                </div>
              </td>
              <td>
                <div class="input">
                  <input type="text" name="key_<?php echo $rand_key; ?>" placeholder='<?php echo T_("Type"); ?>' value="<?php echo \dash\get::index($value, 'key', 'key') ?>">
                </div>
              </td>
              <td>
                <div class="input">
                  <input type="text" name="value_<?php echo $rand_key; ?>" placeholder='<?php echo T_("Value"); ?>' value="<?php echo \dash\get::index($value, 'value') ?>">
                </div>
              </td>
            </tr>
          <?php } //endfor ?>
          <?php $rand_key = rand(1, 9999); ?>
          <tr class="active">
            <td>
              <div class="input">
                <input type="text" name="cat_<?php echo $rand_key; ?>" placeholder='<?php echo T_("Group"); ?>'>
              </div>
            </td>
            <td>
              <div class="input">
                <input type="text" name="key_<?php echo $rand_key; ?>" placeholder='<?php echo T_("Type"); ?>'>
              </div>
            </td>
            <td>
              <div class="input">
                <input type="text" name="value_<?php echo $rand_key; ?>" placeholder='<?php echo T_("Value"); ?>'>
              </div>
            </td>
          </tr>
          </tbody>
        </table>

    </div>
  </section>

</div>
</div>

</form>