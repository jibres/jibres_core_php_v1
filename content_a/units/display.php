
<?php if(\dash\data::editMode()) {?>

<div class="f justify-center">
  <div class="c5 s12">
    <?php addNewUnit(); ?>
  </div>
</div>

<?php }elseif(\dash\data::removeMode()) {?>

    <?php removeUnit(); ?>

<?php }else{ ?>

    <?php htmlTable(); ?>

<?php } //endif ?>






<?php function addNewUnit() {?>

<div class="cbox">

  <?php if(\dash\data::editMode()) {?>

		<h3><?php echo T_("Edit unit"); ?> <span class="fc-green txtB"><?php echo \dash\data::dataRow_title(); ?></span></h3>

  <?php }else{ ?>

		<h3><?php echo T_("Add new unit"); ?></h3>

	<?php } //endif ?>

  <form method="post" autocomplete="off">

    <label for="iunitname"><?php echo T_("Title"); ?></label>
    <div class="input">
      <input type="hidden" name="oldunit" value="<?php echo \dash\data::dataRow_title(); ?>">
      <input type="text" name="unit" id="iunitname" placeholder='<?php echo T_("Unit name"); ?>' value="<?php echo \dash\data::dataRow_title(); ?>" autofocus maxlength='50' minlength="1" required>
    </div>


      <div class="msg">

      <small><?php echo T_("Sometimes employees sell some product with decimal unit and if you are force this unit to give integer value, we are not allow them to enter invalid value"); ?></small>
      <div class="switch1 mT10">
       <input type="checkbox" name="int" id="int" <?php if(\dash\data::dataRow_int()) { echo 'checked'; } ?> >
       <label for="int"></label>
       <label for="int"><?php echo T_("Only accept integer value?"); ?></label>
      </div>
      </div>

    <?php if(\dash\data::editMode()) {?>

      <?php if(\dash\data::dataRow_count()) {?>

        <p class="msg mT10 <?php if(\dash\data::dataRow_count() > 10) { echo 'danger';} else { echo 'warn2'; } ?> "><?php echo T_("By update name of this unit all product will be update to new value."); ?> <a class="badge" href='<?php echo \dash\url::here(); ?>/products?unitid=<?php echo \dash\data::dataRow_id(); ?>' title='<?php echo T_("Click to check list of this product"); ?>'><?php echo \dash\fit::number(\dash\data::dataRow_count()); ?> <?php echo T_("Product"); ?></a></p>

      <?php }else{ ?>

        <p class="msg mT10 info2"><?php echo T_("No product in this unit"); ?>
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
          <th><?php echo T_("Unit"); ?></th>

          <th class="txtC"><?php echo T_("Count product"); ?></th>
          <th class="txtC"><?php echo T_("Force integer value"); ?></th>
          <th class="txtC"><?php echo T_("Action"); ?></th>
        </tr>
      </thead>

      <tbody>

        <?php foreach (\dash\data::dataTable() as $key => $value) {?>


        <tr <?php if(\dash\request::get('id') == $value['id']) { echo ' class="positive" '; } ?>>
          <td>

            <?php if(isset($value['title'])) { echo $value['title']; }else{ echo T_("Without Unit"); } ?>

          </td>

          <td class="txtC">
            <a href="<?php echo \dash\url::here(); ?>/products?unitid=<?php echo \dash\get::index($value, 'id'); ?>" title='<?php echo T_("Click to check products in this unit"); ?>'><?php echo \dash\fit::number(\dash\get::index($value, 'count')); ?></a>
          </td>
          <td class="txtC"><?php if(isset($value['int']) && $value['int']) { ?><i class="sf-check fc-green"></i><?php }else{ echo '-';} ?></td>
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
    <?php echo T_("You have not product unit yet!"); ?>
    <br>
    <?php echo T_("To add a product unit you must set unit when registering or editing a product"); ?>
    <a href="<?php echo \dash\url::here(). '/products'; ?>" class="btn secondary xs"><?php echo T_("Product list"); ?></a>

</div>
<?php } //endif ?>

<?php } //endfunction ?>









<?php function removeUnit() {?>


<div class="f justify-center">
  <div class="x6 c5 m8 s12 pRa10">
    <dvi class="cbox">
        <?php if(\dash\data::dataRow_count()) {?>


          <div class="msg <?php if(\dash\data::dataRow_count() < 10) { echo 'warn2';} else { echo 'danger2'; } ?>">
            <div class="msg  txtC txtB"><?php echo \dash\data::dataRow_title(); ?></div>
            <p>
              <b><?php echo \dash\fit::number(\dash\data::dataRow_count()); ?></b>  <?php echo T_("Product found in this unit"); ?>
              <br>
              <?php echo T_("To remove this unit you must set all products by this unit as a non product unit or set another unit for this products"); ?>
            </p>
          </div>

          <div class="msg info2 txtC txtB">
            <a href="<?php echo \dash\url::here(); ?>/products?unitid=<?php echo \dash\data::dataRow_id(); ?>"><?php echo T_("Show product list"); ?> <?php echo \dash\data::dataRow_title(); ?></a>
          </div>

          <form method="post">
            <input type="hidden" name="type" value="remove">
            <?php if(is_array(\dash\data::allUnit()) && count(\dash\data::allUnit()) === 1) {?>

                <input type="hidden" name="whattodo" value="non-unit">

                <div class="f mT20">
                  <div class="c pRa10">
                    <button class="btn danger outline block hauto" type="submit"><?php echo T_("Set all products by this unit as a non product unit and remove this unit"); ?></button>
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
                    <input type="radio" name="whattodo" value="non-unit" id="whattodo-non" <?php if(@count(\dash\data::allUnit()) === 1) { echo ' checked ';} ?>   >
                    <label for="whattodo-non"><?php echo T_("Set all products as a non product unit"); ?></label>
                  </div>
                </div>

                <div class="c">
                  <div class="radio3 mB5">
                    <input type="radio" name="whattodo" value="new-unit" id="whattodo-new" <?php if(@count(\dash\data::allUnit()) === 1) { echo ' disabled ';} ?>  >
                    <label for="whattodo-new"><?php echo T_("Select new unit"); ?><?php if(is_array(\dash\data::allUnit()) && count(\dash\data::allUnit()) === 1) {?> <small><?php echo T_("You have not other unit!"); ?></small> <?php } //endif ?></label>
                  </div>
                </div>

              </div>

              <div data-response='whattodo' data-response-where='new-unit' data-response-hide>

              <label for='unit'><?php echo T_("New unit"); ?></label>
              <select name="unit" class="select22" id="unit">
                <option value=""><?php echo T_("Select new unit to update all product unit"); ?></option>
                <?php if(is_array(\dash\data::allUnit())) {?>

                  <?php foreach (\dash\data::allUnit() as $key => $value) {?>

                    <?php if(isset($value['title']) && $value['title'] !== \dash\request::get('id')) {?>

                    <option value="<?php echo \dash\get::index($value, 'id'); ?>"><?php echo $value['title']; ?></option>

                    <?php } //endif ?>

                  <?php } //endfor ?>

                <?php } //endif ?>

              </select>
              </div>



              <div data-response='whattodo' data-response-where='new-unit|non-unit' data-response-hide>

                <div class="f mT20">
                  <div class="c pRa10">
                    <button class="btn danger outline block" type="submit"><?php echo T_("Save and remove unit"); ?></button>
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
              <?php echo T_("Non product found by this unit"); ?>
              <br>
              <?php echo T_("You can delete this unit now"); ?>
            </p>
          </div>
          <form method="post">
            <input type="hidden" name="type" value="remove">
            <button  class="btn danger outline block mT20" type="submit"><?php echo T_("Remove unit"); ?></button>
          </form>

        <?php } //endif ?>

    </dvi>
  </div>
</div>
<?php }//endfunction ?>

