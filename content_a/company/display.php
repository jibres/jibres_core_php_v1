
<?php if(\dash\data::editMode()) {?>

<div class="f justify-center">
  <div class="c5 s12">
    <?php addNewCompany(); ?>
  </div>
</div>

<?php }elseif(\dash\data::removeMode()) {?>

    <?php removeCompany(); ?>

<?php }else{ ?>

    <?php htmlTable(); ?>

<?php } //endif ?>






<?php function addNewCompany() {?>

<div class="cbox">

  <?php if(\dash\data::editMode()) {?>

		<h3><?php echo T_("Edit company"); ?> <span class="fc-green txtB"><?php echo \dash\data::dataRow_title(); ?></span></h3>

  <?php }else{ ?>

		<h3><?php echo T_("Add new company"); ?></h3>

	<?php } //endif ?>

  <form method="post" autocomplete="off">

    <label for="icompanyname"><?php echo T_("Title"); ?></label>
    <div class="input">
      <input type="hidden" name="oldcompany" value="<?php echo \dash\data::dataRow_title(); ?>">
      <input type="text" name="company" id="icompanyname" placeholder='<?php echo T_("Company name"); ?>' value="<?php echo \dash\data::dataRow_title(); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1" required>
    </div>

    <?php if(\dash\data::editMode()) {?>

      <?php if(\dash\data::dataRow_count()) {?>

        <p class="msg mT10 <?php if(\dash\data::dataRow_count() > 10) { echo 'danger';} else { echo 'warn2'; } ?> "><?php echo T_("By update name of this company all product will be update to new value."); ?> <a class="badge" href='<?php echo \dash\url::here(); ?>/products?companyid=<?php echo \dash\data::dataRow_id(); ?>' title='<?php echo T_("Click to check list of this product"); ?>'><?php echo \dash\fit::number(\dash\data::dataRow_count()); ?> <?php echo T_("Product"); ?></a></p>

      <?php }else{ ?>

        <p class="msg mT10 info2"><?php echo T_("No product in this company"); ?>
          <span class="txtB"><?php echo T_("You can delete it now!"); ?></span>
          <a href="<?php echo \dash\url::this(); ?>/remove?id=<?php echo \dash\request::get('id'); ?>" class="badge danger mLa5"><?php echo T_("Remove"); ?></a>
        </p>

      <?php } //endif ?>

       <div class="f mT20">
          <div class="c pRa10">
            <button class="btn outline warn block"><?php echo T_("Edit"); ?></button>
          </div>
          <div class="cauto">
            <a class="btn primary block" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Cancel"); ?></a>
          </div>
       </div>

    <?php }else{ ?>

       <button class="btn primary block mT20"><?php echo T_("Add"); ?></button>

    <?php }// endif ?>
  </form>
</div>

<?php } //endfunction ?>








<?php function htmlTable() {?>

<?php if(\dash\data::dataTable()) {?>

<div class="f justify-center">
  <div class="c8 s12">

    <table class="tbl1 v1 cbox fs12">
      <thead>
        <tr class="fs09">
          <th><?php echo T_("Company"); ?></th>

          <th class="txtC"><?php echo T_("Count product"); ?></th>
          <th class="txtC"><?php echo T_("Action"); ?></th>
        </tr>
      </thead>

      <tbody>

        <?php foreach (\dash\data::dataTable() as $key => $value) {?>


        <tr <?php if(\dash\request::get('id') == $value['id']) { echo ' class="positive" '; } ?>>
          <td>

            <?php if(isset($value['title'])) { echo $value['title']; }else{ echo T_("Without Company"); } ?>

          </td>

          <td class="txtC">
            <a href="<?php echo \dash\url::here(); ?>/products?companyid=<?php echo \dash\get::index($value, 'id'); ?>" title='<?php echo T_("Click to check products in this company"); ?>'><?php echo \dash\fit::number(\dash\get::index($value, 'count')); ?></a>
          </td>
          <td class="collapsing">
            <a class="block" href="<?php echo \dash\url::this(); ?>?id=<?php echo \dash\get::index($value, 'id'); ?>"><i class="sf-edit-write fs11  mRa10"></i><span class="sm"><?php echo T_("Edit"); ?></span></a>
            <a class="block" href="<?php echo \dash\url::this(); ?>/remove?id=<?php echo \dash\get::index($value, 'id'); ?>"><i class="sf-trash mRa10  fs11 fc-red"></i><span class="sm"><?php echo T_("Remove"); ?></span></a>

          </td>
        </tr>
        <?php } //endfor ?>
      </tbody>
    </table>
  </div>
</div>

<?php }else{ ?>

<div class="msg info2 fs12 txtB">

    <?php echo T_("Hi!"); ?>
    <br>
    <?php echo T_("You have not product company yet!"); ?>
    <br>
    <?php echo T_("To add a product company you must set company when registering or editing a product"); ?>
    <a href="<?php echo \dash\url::here(). '/products'; ?>" class="btn secondary xs"><?php echo T_("Product list"); ?></a>

</div>
<?php } //endif ?>

<?php } //endfunction ?>









<?php function removeCompany() {?>


<div class="f justify-center">
  <div class="x6 c5 m8 s12 pRa10">
    <dvi class="cbox">
        <?php if(\dash\data::dataRow_count()) {?>


          <div class="msg <?php if(\dash\data::dataRow_count() < 10) { echo 'warn2';} else { echo 'danger2'; } ?>">
            <div class="msg  txtC txtB"><?php echo \dash\data::dataRow_title(); ?></div>
            <p>
              <b><?php echo \dash\fit::number(\dash\data::dataRow_count()); ?></b>  <?php echo T_("Product found in this company"); ?>
              <br>
              <?php echo T_("To remove this company you must set all products by this company as a non product company or set another company for this products"); ?>
            </p>
          </div>

          <div class="msg info2 txtC txtB">
            <a href="<?php echo \dash\url::here(); ?>/products?companyid=<?php echo \dash\data::dataRow_id(); ?>"><?php echo T_("Show product list"); ?> <?php echo \dash\data::dataRow_title(); ?></a>
          </div>

          <form method="post">
            <input type="hidden" name="type" value="remove">
            <?php if(is_array(\dash\data::allCompany()) && count(\dash\data::allCompany()) === 1) {?>

                <input type="hidden" name="whattodo" value="non-company">

                <div class="f mT20">
                  <div class="c pRa10">
                    <button class="btn danger outline block hauto" type="submit"><?php echo T_("Set all products by this company as a non product company and remove this company"); ?></button>
                  </div>
                  <div class="cauto">
                    <a class="btn primary block" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Cancel"); ?></a>
                  </div>
               </div>

            <?php }else{ ?>

              <div class="f mB10">
              <h4><?php echo T_("What do you want to do?"); ?></h4>
                <div class="c">
                  <div class="radio3 mB5">
                    <input type="radio" name="whattodo" value="non-company" id="whattodo-non" <?php if(@count(\dash\data::allCompany()) === 1) { echo ' checked ';} ?>   >
                    <label for="whattodo-non"><?php echo T_("Set all products as a non product company"); ?></label>
                  </div>
                </div>

                <div class="c">
                  <div class="radio3 mB5">
                    <input type="radio" name="whattodo" value="new-company" id="whattodo-new" <?php if(@count(\dash\data::allCompany()) === 1) { echo ' disabled ';} ?>  >
                    <label for="whattodo-new"><?php echo T_("Select new company"); ?><?php if(is_array(\dash\data::allCompany()) && count(\dash\data::allCompany()) === 1) {?> <small><?php echo T_("You have not other company!"); ?></small> <?php } //endif ?></label>
                  </div>
                </div>

              </div>

              <div data-response='whattodo' data-response-where='new-company' data-response-hide>

              <label for='company'><?php echo T_("New company"); ?></label>
              <select name="company" class="select22" id="company">
                <option value=""><?php echo T_("Select new company to update all product company"); ?></option>
                <?php if(is_array(\dash\data::allCompany())) {?>

                  <?php foreach (\dash\data::allCompany() as $key => $value) {?>

                    <?php if(isset($value['id']) && $value['id'] !== \dash\request::get('id')) {?>

                    <option value="<?php echo \dash\get::index($value, 'id'); ?>"><?php echo $value['title']; ?></option>

                    <?php } //endif ?>

                  <?php } //endfor ?>

                <?php } //endif ?>

              </select>
              </div>



              <div data-response='whattodo' data-response-where='new-company|non-company' data-response-hide>

                <div class="f mT20">
                  <div class="c pRa10">
                    <button class="btn danger outline block" type="submit"><?php echo T_("Save and remove company"); ?></button>
                  </div>
                  <div class="cauto">
                    <a class="btn primary block" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Cancel"); ?></a>
                  </div>
               </div>
              </div>

            <?php } //endif ?>

          </form>

        <?php }else{ ?>


          <div class="msg info">
            <p>
              <?php echo T_("Non product found by this company"); ?>
              <br>
              <?php echo T_("You can delete this company now"); ?>
            </p>
          </div>
          <form method="post">
            <input type="hidden" name="type" value="remove">
            <button  class="btn danger outline block mT20" type="submit"><?php echo T_("Remove company"); ?></button>
          </form>

        <?php } //endif ?>

    </dvi>
  </div>
</div>
<?php }//endfunction ?>

