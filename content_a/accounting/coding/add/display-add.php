<form method="post" autocomplete="off">
  <div class="avand">
    <div class="row">
      <div class="c-xs-12 c-sm-12 c-md-6">
        <?php echo \dash\data::dataTableAll(); ?>
      </div>
      <div class="c-xs-12 c-sm-12 c-md-6">
        <div class="box">

          <div class="body">


            <?php if(\dash\data::parentList()) {?>
              <label for="parent"><?php echo T_("Parent") ?><?php if(!\dash\request::get('parent')) {?> <small class="fc-red"><?php echo T_("Required") ?></small><?php } //endif ?></label>
              <select class="select22" name="parent" <?php if(\dash\request::get('parent')) {echo 'disabled';} ?>>
                <option value=""><?php echo T_("Please choose parent") ?></option>
                <?php foreach (\dash\data::parentList() as $key => $value) {?>
                  <option value="<?php echo \dash\get::index($value, 'id') ?>" <?php if(\dash\get::index($value, 'id') === \dash\request::get('parent')) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'full_title'); ?></option>
                <?php } // endfor ?>
              </select>
            <?php } // endif ?>
            <?php if(\dash\request::get('parent')) {?>
              <input type="hidden" name="parent" value="<?php echo \dash\request::get('parent') ?>">
            <?php } ?>

            <label for="code"><?php echo T_("Code") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
            <div class="input">
              <input type="number"  max="9999999999" name="code" id="code" required value="<?php echo \dash\data::dataRow_code(); ?>" <?php if(\dash\data::editMode()) { echo 'disabled'; }?> >
            </div>

            <label for="title"><?php echo T_("Title") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
            <div class="input">
              <input type="text" name="title" id="title" required value="<?php echo \dash\data::dataRow_title(); ?>">
            </div>


            <?php if(\dash\data::myType() === 'total') {?>

              <label for="topic"><?php echo T_("Topic") ?> </label>
              <select class="select22" name="topic" data-model='tag'>
                <option value=""><?php echo T_("Please choose topic") ?></option>
              <option value="net sales" <?php if(\dash\data::dataRow_topic() === 'net sales') { echo 'selected';} ?>><?php echo T_("net sales") ?></option>
              <option value="accumulated profit" <?php if(\dash\data::dataRow_topic() === 'accumulated profit') { echo 'selected';} ?>><?php echo T_("accumulated profit") ?></option>
              <option value="orders and prepayments" <?php if(\dash\data::dataRow_topic() === 'orders and prepayments') { echo 'selected';} ?>><?php echo T_("orders and prepayments") ?></option>
              <option value="short term investments" <?php if(\dash\data::dataRow_topic() === 'short term investments') { echo 'selected';} ?>><?php echo T_("short term investments") ?></option>
              <option value="wealth" <?php if(\dash\data::dataRow_topic() === 'wealth') { echo 'selected';} ?>><?php echo T_("wealth") ?></option>
              <option value="other non-operating expenses" <?php if(\dash\data::dataRow_topic() === 'other non-operating expenses') { echo 'selected';} ?>><?php echo T_("other non-operating expenses") ?></option>
              <option value="other operating costs" <?php if(\dash\data::dataRow_topic() === 'other operating costs') { echo 'selected';} ?>><?php echo T_("other operating costs") ?></option>
              <option value="other operating income" <?php if(\dash\data::dataRow_topic() === 'other operating income') { echo 'selected';} ?>><?php echo T_("other operating income") ?></option>
              <option value="other accounts and documents receivable" <?php if(\dash\data::dataRow_topic() === 'other accounts and documents receivable') { echo 'selected';} ?>><?php echo T_("other accounts and documents receivable") ?></option>
              <option value="other accounts and documents payable" <?php if(\dash\data::dataRow_topic() === 'other accounts and documents payable') { echo 'selected';} ?>><?php echo T_("other accounts and documents payable") ?></option>
              <option value="save employee end-of-service benefits" <?php if(\dash\data::dataRow_topic() === 'save employee end-of-service benefits') { echo 'selected';} ?>><?php echo T_("save employee end-of-service benefits") ?></option>
              <option value="save taxes" <?php if(\dash\data::dataRow_topic() === 'save taxes') { echo 'selected';} ?>><?php echo T_("save taxes") ?></option>
              <option value="tangible fixed assets" <?php if(\dash\data::dataRow_topic() === 'tangible fixed assets') { echo 'selected';} ?>><?php echo T_("tangible fixed assets") ?></option>
              <option value="accounts receivable and commercial documents" <?php if(\dash\data::dataRow_topic() === 'accounts receivable and commercial documents') { echo 'selected';} ?>><?php echo T_("accounts receivable and commercial documents") ?></option>
              <option value="business accounts and documents payable" <?php if(\dash\data::dataRow_topic() === 'business accounts and documents payable') { echo 'selected';} ?>><?php echo T_("business accounts and documents payable") ?></option>
              <option value="receivables" <?php if(\dash\data::dataRow_topic() === 'receivables') { echo 'selected';} ?>><?php echo T_("receivables") ?></option>
              <option value="prepayments" <?php if(\dash\data::dataRow_topic() === 'prepayments') { echo 'selected';} ?>><?php echo T_("prepayments") ?></option>
              <option value="long-term accounts and documents" <?php if(\dash\data::dataRow_topic() === 'long-term accounts and documents') { echo 'selected';} ?>><?php echo T_("long-term accounts and documents") ?></option>
              </select>

            <?php } //endif ?>

            <?php if(\dash\data::myType() === 'assistant' || \dash\data::myType() === 'total' || \dash\data::myType() === 'group') {?>

              <label for="nature"><?php echo T_("Nature") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>

              <?php if(\dash\data::myType() === 'assistant' || \dash\data::myType() === 'total') {?>



              <div class="f">

                <div class="c mLa5">
                  <div class="radio3 mB5">
                    <input type="radio" name="nature" value="debtor" id="idebtor" <?php if(\dash\data::dataRow_nature() === 'debtor' || (!\dash\data::dataRow_nature() && \dash\data::parentDetail_nature() === 'debtor')) {echo 'checked';} ?> <?php if(\dash\data::parentDetail_nature()) {echo 'disabled';} ?> >
                    <label for="idebtor"><?php echo T_("Debtor"); ?></label>
                  </div>
                </div>

                <div class="c mLa5">
                  <div class="radio3 mB5">
                    <input type="radio" name="nature" value="creditor" id="icreditor" <?php if(\dash\data::dataRow_nature() === 'creditor' || (!\dash\data::dataRow_nature() && \dash\data::parentDetail_nature() === 'creditor')) {echo 'checked';} ?> <?php if(\dash\data::parentDetail_nature()) {echo 'disabled';} ?> >
                    <label for="icreditor"><?php echo T_("Creditor"); ?></label>
                  </div>
                </div>


                <div class="c mLa5">
                  <div class="radio3 mB5">
                    <input type="radio" name="nature" value="debtor-creditor" id="idebtor-creditor" <?php if(\dash\data::dataRow_nature() === 'debtor-creditor' || (!\dash\data::dataRow_nature() && \dash\data::parentDetail_nature() === 'debtor-creditor')) {echo 'checked';} ?> <?php if(\dash\data::parentDetail_nature()) {echo 'disabled';} ?> >
                    <label for="idebtor-creditor"><?php echo T_("Debtor-Creditor"); ?></label>
                  </div>
                </div>

              </div>

                <?php if(\dash\data::parentDetail_nature()) {?>
                  <input type="hidden" name="nature" value="<?php echo \dash\data::parentDetail_nature(); ?>">
                <?php } //endif ?>

                <?php } // endif ?>

                <?php if(\dash\data::myType() === 'group') {?>


                  <div class="f">

                <div class="c mLa5">
                  <div class="radio3 mB5">
                    <input type="radio" name="nature" value="balance sheet" id="ibalance-sheet" <?php if(\dash\data::dataRow_nature() === 'balance sheet') {echo 'checked';} ?>  >
                    <label for="ibalance-sheet"><?php echo T_("Balance sheet"); ?></label>
                  </div>
                </div>

                <div class="c mLa5">
                  <div class="radio3 mB5">
                    <input type="radio" name="nature" value="disciplinary" id="idisciplinary" <?php if(\dash\data::dataRow_nature() === 'disciplinary') {echo 'checked';} ?>  >
                    <label for="idisciplinary"><?php echo T_("Disciplinary"); ?></label>
                  </div>
                </div>


                <div class="c mLa5">
                  <div class="radio3 mB5">
                    <input type="radio" name="nature" value="harmful profit" id="iharmful-profit" <?php if(\dash\data::dataRow_nature() === 'harmful profit') {echo 'checked';} ?>  >
                    <label for="iharmful-profit"><?php echo T_("Harmful-Profit"); ?></label>
                  </div>
                </div>

              </div>

                <?php } // endif ?>
              </select>
            <?php } // endif ?>



                <?php if(\dash\data::myType() === 'group') {?>

              <label for="class"><?php echo T_("Class") ?> </label>

                <select class="select22" name="class" data-model='tag'>

                <option value=""><?php echo T_("Please choose class") ?></option>
                <option value="current liabilities" <?php if(\dash\data::dataRow_class() === 'current liabilities') { echo 'selected';} ?>><?php echo T_("current liabilities") ?></option>
                <option value="non-current liabilities" <?php if(\dash\data::dataRow_class() === 'non-current liabilities') { echo 'selected';} ?>><?php echo T_("non-current liabilities") ?></option>
                <option value="current assets" <?php if(\dash\data::dataRow_class() === 'current assets') { echo 'selected';} ?>><?php echo T_("current assets") ?></option>
                <option value="non-current assets" <?php if(\dash\data::dataRow_class() === 'non-current assets') { echo 'selected';} ?>><?php echo T_("non-current assets") ?></option>
                <option value="profit and loss" <?php if(\dash\data::dataRow_class() === 'profit and loss') { echo 'selected';} ?>><?php echo T_("profit and loss") ?></option>
                <option value="shareholders rights" <?php if(\dash\data::dataRow_class() === 'shareholders rights') { echo 'selected';} ?>><?php echo T_("shareholders rights") ?></option>

              </select>

            <?php } //endif ?>

            <?php if(\dash\data::myType() === 'assistant' ) {?>

              <div class="switch1 mT10">
                <input type="checkbox" name="detailable" id="detailable"  <?php if(\dash\data::dataRow_detailable()) {echo 'checked';}?> >
                <label for="detailable" data-on="<?php echo T_("Yes") ?>" data-off="<?php echo T_("No") ?>"></label>
                <label for="detailable"><?php echo T_("Detailable?"); ?></label>
              </div>
            <?php } // endif ?>


            <?php if(\dash\data::myType() === 'assistant' ) {?>

            <div class="check1 mT10">
              <input type="checkbox" name="naturecontrol" id="naturecontrol"  <?php if(\dash\data::dataRow_naturecontrol()) {echo 'checked';}?> >
              <label for="naturecontrol"><?php echo T_("naturecontrol"); ?></label>
            </div>

            <div class="check1 mT10">
              <input type="checkbox" name="exchangeable" id="exchangeable"  <?php if(\dash\data::dataRow_exchangeable()) {echo 'checked';}?> >
              <label for="exchangeable"><?php echo T_("exchangeable"); ?></label>
            </div>

            <div class="check1 mT10">
              <input type="checkbox" name="followup" id="followup"  <?php if(\dash\data::dataRow_followup()) {echo 'checked';}?> >
              <label for="followup"><?php echo T_("followup"); ?></label>
            </div>

            <div class="check1 mT10">
              <input type="checkbox" name="currency" id="currency"  <?php if(\dash\data::dataRow_currency()) {echo 'checked';}?> >
              <label for="currency"><?php echo T_("Accounting currency"); ?></label>
            </div>
          <?php } //endif ?>


            <div class="switch1 mT10">
              <input type="checkbox" name="status" id="status"  <?php if(\dash\data::dataRow_status() === 'enable' || !\dash\data::dataRow()) {echo 'checked';}?> >
              <label for="status" data-on="<?php echo T_("Enable") ?>" data-off="<?php echo T_("Disable") ?>"></label>
              <label for="status"><?php echo T_("Status"); ?></label>
            </div>


          </div>
          <footer class="f">
            <?php $buttonTitle = T_("Add"); if(\dash\data::editMode()) { $buttonTitle = T_("Edit"); ?>
            <div class="cauto">
              <div data-confirm data-data='{"remove": "remove"}' class="btn danger"><?php echo T_("Remove") ?></div>
            </div>
          <?php } //endif ?>
          <div class="c"></div>
          <div class="cauto">
            <button class="btn success"><?php echo $buttonTitle; ?></button>
          </div>
        </footer>

      </div>
    </div>


  </div>

</div>
</form>
