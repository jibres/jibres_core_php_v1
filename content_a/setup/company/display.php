

<div id="get_started_card">
  <div class="body">
    <div class="pad">
      <h1><?php echo \dash\face::title(); ?></h1>
      <p><?php echo T_("If you want to issue an official invoice, complete your legal information."); ?> <?php echo T_("It's totaly optional!"); ?></p>
      <form method="post" autocomplete="off">

      <?php if(\dash\data::dataRow_country() === 'IR') {?>



        <label for="icompanyname"><?php echo T_("Company name"); ?></label>
        <div class="input">
          <input type="text" name="companyname" id="icompanyname" value="<?php echo \dash\data::dataRow_companyname(); ?>" maxlength="40">
        </div>


        <label for="icompanyregisternumber"><?php echo T_("Company register number"); ?></label>
        <div class="input">
          <input type="text" name="companyregisternumber" id="icompanyregisternumber" value="<?php echo \dash\data::dataRow_companyregisternumber(); ?>" data-format='int' maxlength="10">
        </div>

        <label for="icompanynationalid"><?php echo T_("Company national id"); ?></label>
        <div class="input">
          <input type="text" name="companynationalid" id="icompanynationalid" value="<?php echo \dash\data::dataRow_companynationalid(); ?>" data-format='int' maxlength="11">
        </div>

        <label for="icompanyeconomiccode"><?php echo T_("Economic code"); ?></label>
        <div class="input">
          <input type="text" name="companyeconomiccode" id="icompanyeconomiccode" value="<?php echo \dash\data::dataRow_companyeconomiccode(); ?>" data-format='int' maxlength="12">
        </div>


        <label for="iceonationalcode"><?php echo T_("CEO nationalcode"); ?></label>
        <div class="input">
          <input type="text" name="ceonationalcode" id="iceonationalcode" value="<?php echo \dash\data::dataRow_ceonationalcode(); ?>" data-format='nationalCode'>
        </div>

<?php }else{ ?>

        <label for="vatNumber"><?php echo T_("VAT number"); ?></label>
        <div class="input">
          <input type="text" name="companyregisternumber" id="vatNumber" value="<?php echo \dash\data::dataRow_companyregisternumber(); ?>" data-format='int'>
        </div>

<?php } //endif ?>


        <div class="f align-center mB10">
          <div class="c fc-mute"><?php echo \dash\data::stepDesc(); ?></div>
          <div class="cauto os pRa10"><button class="btn outline secondary"><?php echo T_("Skip"); ?></button></div>
          <div class="cauto os"><button class="btn primary"><?php echo T_("Save"); ?></button></div>
        </div>

      </form>
    </div>
  </div>
</div>

