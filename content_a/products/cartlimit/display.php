<?php
$propertyList   = \dash\data::propertyList();
$storData       = \dash\data::store_store_data();
$productDataRow = \dash\data::productDataRow();

?>


<form method="post" autocomplete="off" id="form1">
  <div class="avand-md">



    <section class="box">

        <header><h2><?php echo T_("General property"); ?></h2></header>
        <div class="body">

          <div data-response='type' data-response-where='product' <?php if(!$productDataRow || \dash\data::productDataRow_type() == 'product'){}else{ echo 'data-response-hide';} ?>>
            <div class="mB10">
              <label for='company'><?php echo T_("Manufacturer"); ?></label>
              <select name="company" id="company" class="select22" data-model="tag" data-placeholder='<?php echo T_("Product manufacturer"); ?>'>
                <option></option>

                <?php if(\dash\data::productDataRow_company_id()) {?>

                  <option value="0"><?php echo T_("Without manufacturer"); ?></option>

                <?php } //endif ?>

                <?php foreach (\dash\data::listCompanies() as $key => $value) {?>

                  <option value="<?php echo $value['title']; ?>" <?php if($value['id'] == \dash\data::productDataRow_company_id()) { echo 'selected'; } ?> ><?php echo $value['title']; ?></option>

                <?php } //endfor ?>

              </select>
            </div>

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

          <div data-response='type' data-response-where='file' <?php if(\dash\data::productDataRow_type() == 'file'){}else{echo 'data-response-hide';} ?>>
            <label for="iFileSize"><?php echo T_("File Size"); ?></label>
            <div class="input">
              <input type="text" name="filesize" id="iFileSize" value="<?php echo \dash\get::index($productDataRow,'filesize'); ?>"  autocomplete="off" maxlength="11" data-format='number'>
              <div class="addon"><?php echo T_("MB"); ?></div>
            </div>
            <label for="iFileAddress"><?php echo T_("File Address"); ?></label>
            <div class="input">
              <input type="url" name="fileaddress" id="iFileAddress" value="<?php echo \dash\get::index($productDataRow,'fileaddress'); ?>"   maxlength="500">
            </div>
          </div>


          <div class="f">
            <div class="c s12 pRa5">
              <label for='minsale'><?php echo T_("Min quantity per order"); ?></label>
              <div class="input">
               <input type="text" name="minsale" id="minsale" data-format='number' value="<?php echo \dash\get::index($productDataRow,'minsale'); ?>" maxlength="7">
              </div>
            </div>
            <div class="c s12">
              <label for='maxsale'><?php echo T_("Max quantity per order"); ?></label>
              <div class="input">
               <input type="text" name="maxsale" id="maxsale" data-format='number' value="<?php echo \dash\get::index($productDataRow,'maxsale'); ?>" maxlength="7">
              </div>
            </div>
          </div>
          <label for='salestep'><?php echo T_("Step quantity"); ?></label>
          <div class="input">
           <input type="text" name="salestep" id="salestep" data-format='number' value="<?php echo \dash\get::index($productDataRow,'salestep'); ?>" maxlength="7">
          </div>



          <label for="ipreparationtime"><?php echo T_("Preparation time"); ?></label>
          <div class="input">
            <input type="text" name="preparationtime" id="ipreparationtime" value="<?php echo \dash\get::index($productDataRow,'preparationtime'); ?>"  autocomplete="off" maxlength="3" data-format='number'>
          <div class="addon"><?php echo T_("Hour"); ?></div>
          </div>


        </div>

    </section>


  </div>
</div>

</form>