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
              <select class="select22" name="topic" >
                <option value=""><?php echo T_("Please choose topic") ?></option>
                <?php $topic = ['net sales','accumulated profit','orders and prepayments','short term investments','wealth','other non-operating expenses','other operating costs','other operating income','other accounts and documents receivable','other accounts and documents payable','save employee end-of-service benefits','save taxes','tangible fixed assets','accounts receivable and commercial documents','business accounts and documents payable','receivables','prepayments','long-term accounts and documents','cash balance','received financial facilities','administrative costs','sales costs','financial costs','general expenses','intangible fixed assets']; ?>

                <?php foreach ($topic as $key => $value) {?>
                  <option value="<?php echo $value ?>" <?php if(\dash\data::dataRow_topic() === $value) { echo 'selected';} ?>><?php echo T_($value); ?></option>
                <?php } //endif ?>
              </select>

            <?php } //endif ?>

            <?php if(\dash\data::myType() === 'assistant' || \dash\data::myType() === 'total' || \dash\data::myType() === 'group') {?>

              <label for="nature"><?php echo T_("Nature") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>

              <?php if(\dash\data::myType() === 'assistant' || \dash\data::myType() === 'total') {?>



              <div class="f">

                <div class="c mLa5">
                  <div class="radio3 mB5">
                    <input type="radio" name="nature" value="debtor" id="idebtor" <?php if(\dash\data::dataRow_nature() === 'debtor' || (!\dash\data::dataRow_nature() && \dash\data::parentDetail_nature() === 'debtor')) {echo 'checked';} ?> <?php if(\dash\data::parentDetail_nature()) {echo 'disabled2';} ?> >
                    <label for="idebtor"><?php echo T_("Debtor"); ?></label>
                  </div>
                </div>

                <div class="c mLa5">
                  <div class="radio3 mB5">
                    <input type="radio" name="nature" value="creditor" id="icreditor" <?php if(\dash\data::dataRow_nature() === 'creditor' || (!\dash\data::dataRow_nature() && \dash\data::parentDetail_nature() === 'creditor')) {echo 'checked';} ?> <?php if(\dash\data::parentDetail_nature()) {echo 'disabled2';} ?> >
                    <label for="icreditor"><?php echo T_("Creditor"); ?></label>
                  </div>
                </div>


                <div class="c mLa5">
                  <div class="radio3 mB5">
                    <input type="radio" name="nature" value="debtor-creditor" id="idebtor-creditor" <?php if(\dash\data::dataRow_nature() === 'debtor-creditor' || (!\dash\data::dataRow_nature() && \dash\data::parentDetail_nature() === 'debtor-creditor')) {echo 'checked';} ?> <?php if(\dash\data::parentDetail_nature()) {echo 'disabled2';} ?> >
                    <label for="idebtor-creditor"><?php echo T_("Debtor-Creditor"); ?></label>
                  </div>
                </div>

              </div>



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

                <select class="select22" name="class" >

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

            <div class="check1 mT10">
              <input type="checkbox" name="naturecontrol" id="naturecontrol"  <?php if(\dash\data::dataRow_naturecontrol()) {echo 'checked';}?> >
              <label for="naturecontrol"><?php echo T_("naturecontrol"); ?></label>
            </div>

            <div class="check1 mT10">
              <input type="checkbox" name="currency" id="currency"  <?php if(\dash\data::dataRow_currency()) {echo 'checked';}?> >
              <label for="currency"><?php echo T_("Accounting currency"); ?></label>
            </div>

            <div class="check1 mT10">
              <input type="checkbox" name="exchangeable" id="exchangeable"  <?php if(\dash\data::dataRow_exchangeable()) {echo 'checked';}?> >
              <label for="exchangeable"><?php echo T_("exchangeable"); ?></label>
            </div>

            <?php if(\dash\data::myType() === 'assistant' ) {?>
              <div class="check1 mT10">
                <input type="checkbox" name="detailable" id="detailable"  <?php if(\dash\data::dataRow_detailable()) {echo 'checked';}?> >
                <label for="detailable"><?php echo T_("Detailable?"); ?></label>
              </div>
            <?php } // endif ?>

            <div class="check1 mT10">
              <input type="checkbox" name="followup" id="followup"  <?php if(\dash\data::dataRow_followup()) {echo 'checked';}?> >
              <label for="followup"><?php echo T_("followup"); ?></label>
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
              <div data-confirm data-data='{"remove": "remove"}' class="btn linkDel"><?php echo T_("Remove") ?></div>
            </div>
          <?php } //endif ?>
          <?php if(\dash\get::index(\dash\data::loadDetail(), 'add_child_link')) {?>
              <div class="cauto"><a class="btn secondary outline" href="<?php echo \dash\get::index(\dash\data::loadDetail(), 'add_child_link'); ?>"><?php echo \dash\get::index(\dash\data::loadDetail(), 'add_child_text'); ?></a></div>
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
