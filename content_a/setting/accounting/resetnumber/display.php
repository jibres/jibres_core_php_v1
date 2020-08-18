<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Reset Accounting document number");?></h2></header>
      <div class="body">

        <div class="c4 s12" method="post" autocomplete="off">
          <div class="action f">


        <?php if(\dash\data::accountingYear()) {?>
          <label for="parent"><?php echo T_("Accounting year") ?></label>
          <select class="select22" name="year_id">
            <option value=""><?php echo T_("Please choose year") ?></option>
            <?php foreach (\dash\data::accountingYear() as $key => $value) {?>
              <option value="<?php echo \dash\get::index($value, 'id') ?>" <?php if((!\dash\data::dataRow_id() && \dash\get::index($value, 'isdefault')) || (\dash\get::index($value, 'id') === \dash\data::dataRow_year_id())) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'title'); ?></option>
            <?php } // endfor ?>
          </select>
        <?php }else{ ?>
          <div class="msg warn2"><a class="btn link" href="<?php echo \dash\url::here(). '/accounting/year/add' ?>"><?php echo T_("Add new accounting year") ?></a></div>
        <?php } // endif ?>



          </div>
        </div>
      </div>
      <footer class="txtRa">
        <button  class="btn warn" ><?php echo T_("Reset"); ?></button>
      </footer>
  </div>
</div>

</form>