

<div id="get_started_card">
  <div class="body">
    <div class="pad">
      <h1><?php echo \dash\face::title(); ?></h1>
      <p><?php echo T_("Based on your country some of our options will be changed."); ?></p>
      <form method="post" autocomplete="off">

		    <div class="mB10">
          <label for='country'><?php echo T_("Country"); ?></label>
          <select class="select22" name="country" id="country" data-model='country' data-next='#province' data-next-default='<?php echo \dash\data::dataRow_province(); ?>'>
            <option value=""><?php echo T_("Choose your country"); ?></option>
            <?php foreach (\dash\data::countryList() as $key => $value) {?>

              <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRow_country() == $key) { echo 'selected';} ?>><?php echo ucfirst($value['name']); if(\dash\language::current() != 'en') { echo ' - '. T_(ucfirst($value['name']));} ?></option>

            <?php } //endif ?>
          </select>
        </div>


        <div class="mB10" data-status='hide'>
          <label for='province'><?php echo T_("Province"); ?></label>
          <select name="province" id="province" class="select22" data-next='#city' data-next-default='<?php echo \dash\data::dataRow_city(); ?>'>
            <option value="0"><?php echo T_("Please choose country"); ?></option>
            <option value="<?php echo \dash\data::dataRow_province(); ?>" selected><?php echo \dash\data::dataRow_province(); ?></option>
          </select>
        </div>


		    <div class="mB10" data-status='hide'>
          <label for='city'><?php echo T_("City"); ?></label>
          <select name="city" id="city" class="select22">
            <option value=""><?php echo T_("Please choose province"); ?></option>
          </select>
        </div>

		    <label for="address"><?php echo T_("Address"); ?></label>
        <textarea class="txt mB10 pB25" name="address" id="address" maxlength='300' rows="2"><?php echo \dash\data::dataRow_address(); ?></textarea>

        <label for="postcode"><?php echo T_("Post code"); ?></label>
        <div class="input">
          <input type="text" name="postcode" id="postcode" value="<?php echo \dash\data::dataRow_postcode(); ?>" data-format="postalCode">
        </div>

        <label for="iphone"><?php echo T_("Phone"); ?></label>
        <div class="input">
          <input type="text" name="phone" id="iphone" value="<?php echo \dash\data::dataRow_phone(); ?>" data-format="tel">
        </div>

        <label for="iwebsite"><?php echo T_("Website"); ?></label>
        <div class="input">

          <input type="url" name="website" id="iwebsite" value="<?php echo \dash\data::dataRow_local_website(); ?>">
        </div>


        <div class="f align-center mB10">
          <div class="c fc-mute"><?php echo \dash\data::stepDesc(); ?></div>
          <div class="cauto os"><button class="btn primary"><?php echo T_("Save"); ?></button></div>
        </div>

      </form>
    </div>
  </div>
</div>
