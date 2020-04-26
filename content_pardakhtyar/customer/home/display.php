<?php
if(\dash\data::dataTable())
{
  if(\dash\data::dataFilter())
  {

    htmlSearchBox();
    htmlTable();
    htmlFilter();

  }
  else
  {
    htmlSearchBox();
    htmlTable();
  }
}
else
{
  if(\dash\data::dataFilter())
  {

    htmlSearchBox();
    htmlFilterNoResult();
  }
  else
  {
    htmlStartAddNew();

  }
}
?>





<?php function htmlSearchBox() {?>
<div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::here(); ?>/customer'>
    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search in customers"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" autofocus  data-pass='submit' autocomplete='off'>
      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>
<?php } //endfunction ?>


<?php function htmlTable() {?>

  <table class="tbl1 v1 cbox fs12">
    <thead>
      <tr>
        <th>Action</th>
        <th>Tracking Number</th>

        <th>Iranian Detail</th>
        <th>Contact Detail</th>
        <th>Foreign Detail</th>
        <th>Company Detail</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
      <tr>
        <td>

          <div><a href="<?php echo \dash\url::here(); ?>/customer/dashboard?id=<?php echo \dash\get::index($value, 'id'); ?>" class="btn success"><?php echo T_("Dashboard"); ?></a></div>

          {%if false%}
          <div><a href="<?php echo \dash\url::here(); ?>/customer/edit?id=<?php echo \dash\get::index($value, 'id'); ?>" class="badge">Edit <?php echo \dash\get::index($value, 'id'); ?></a></div>

          <div><a href="<?php echo \dash\url::here(); ?>/check?id=<?php echo \dash\get::index($value, 'id'); ?>&table=customer&requestType=13" class="badge success">Add</a></div>
          <div><a href="<?php echo \dash\url::here(); ?>/check?id=<?php echo \dash\get::index($value, 'id'); ?>&table=customer&fetch=1&trackingNumber=<?php echo \dash\get::index($value, 'trackingNumber'); ?>" class="badge primary">Check</a></div>

          <div class="btn" data-confirm data-data='{"id" : "<?php echo \dash\get::index($value, 'id'); ?>", "table" : "customer", "requestType" : 13}'>Add request</div>
          <div class="btn" data-confirm data-data='{"id" : "<?php echo \dash\get::index($value, 'id'); ?>", "table" : "customer", "fetch" : 1, "trackingNumber" : "<?php echo \dash\get::index($value, 'trackingNumber'); ?>"}'>Fetch</div>
          <div><a href="<?php echo \dash\url::here(); ?>/shop?customer_id=<?php echo \dash\get::index($value, 'id'); ?>" class="btn info">Shop</a></div>
          {%endif%}


        </td>
        <td>
          <div><small><?php echo T_("trackingNumber"); ?></small> <b><?php echo \dash\get::index($value, 'trackingNumber'); ?></b></div>
          {%if false%}
            <div><small><?php echo T_("trackingNumberPsp"); ?></small> <b><?php echo \dash\get::index($value, 'trackingNumberPsp'); ?></b></div>
            <div><small><?php echo T_("requestType"); ?></small> <b><?php echo \dash\get::index($value, 'requestType'); ?></b></div>
          {%endif%}
          <div><small><?php echo T_("status"); ?></small> <b><?php echo \dash\get::index($value, 'status'); ?></b></div>
          <div><small><?php echo T_("merchantType"); ?></small> <b><?php echo \dash\get::index($value, 'merchantType_title'); ?></b></div>
          <div><small><?php echo T_("residencyType"); ?></small> <b><?php echo \dash\get::index($value, 'residencyType_title'); ?></b></div>
          <div><small><?php echo T_("vitalStatus"); ?></small> <b><?php echo \dash\get::index($value, 'vitalStatus_title'); ?></b></div>
        </td>

        <td>
          <div><small><?php echo T_("firstNameFa"); ?></small> <b><?php echo \dash\get::index($value, 'firstNameFa'); ?></b></div>
          <div><small><?php echo T_("lastNameFa"); ?></small> <b><?php echo \dash\get::index($value, 'lastNameFa'); ?></b></div>
          <div><small><?php echo T_("fatherNameFa"); ?></small> <b><?php echo \dash\get::index($value, 'fatherNameFa'); ?></b></div>
          <div><small><?php echo T_("firstNameEn"); ?></small> <b><?php echo \dash\get::index($value, 'firstNameEn'); ?></b></div>
          <div><small><?php echo T_("lastNameEn"); ?></small> <b><?php echo \dash\get::index($value, 'lastNameEn'); ?></b></div>
          <div><small><?php echo T_("fatherNameEn"); ?></small> <b><?php echo \dash\get::index($value, 'fatherNameEn'); ?></b></div>
          <div><small><?php echo T_("birthCrtfctNumber"); ?></small> <b><?php echo \dash\get::index($value, 'birthCrtfctNumber'); ?></b></div>
          <div><small><?php echo T_("birthDate"); ?></small> <b><?php echo \dash\get::index($value, 'birthDate_title'); ?></b></div>
          <div><small><?php echo T_("gender"); ?></small> <b><?php echo \dash\get::index($value, 'gender_title'); ?></b></div>
          <div><small><?php echo T_("birthCrtfctSeriesLetter"); ?></small> <b><?php echo \dash\get::index($value, 'birthCrtfctSeriesLetter'); ?></b></div>
          <div><small><?php echo T_("birthCrtfctSeriesNumber"); ?></small> <b><?php echo \dash\get::index($value, 'birthCrtfctSeriesNumber'); ?></b></div>
          <div><small><?php echo T_("nationalCode"); ?></small> <b><?php echo \dash\get::index($value, 'nationalCode'); ?></b></div>
          <div><small><?php echo T_("birthCrtfctSerial"); ?></small> <b><?php echo \dash\get::index($value, 'birthCrtfctSerial'); ?></b></div>
        </td>
        <td>
          <div><small><?php echo T_("telephoneNumber"); ?></small> <b><?php echo \dash\get::index($value, 'telephoneNumber'); ?></b></div>
          <div><small><?php echo T_("emailAddress"); ?></small> <b><?php echo \dash\get::index($value, 'emailAddress'); ?></b></div>
          <div><small><?php echo T_("webSite"); ?></small> <b><?php echo \dash\get::index($value, 'webSite'); ?></b></div>
          <div><small><?php echo T_("fax"); ?></small> <b><?php echo \dash\get::index($value, 'fax'); ?></b></div>
          <div><small><?php echo T_("cellPhoneNumber"); ?></small> <b><?php echo \dash\get::index($value, 'cellPhoneNumber'); ?></b></div>
          <div><small><?php echo T_("Description"); ?></small> <b><?php echo \dash\get::index($value, 'Description'); ?></b></div>
        </td>
        <td>
          <div><small><?php echo T_("foreignPervasiveCode"); ?></small> <b><?php echo \dash\get::index($value, 'foreignPervasiveCode'); ?></b></div>
          <div><small><?php echo T_("passportNumber"); ?></small> <b><?php echo \dash\get::index($value, 'passportNumber'); ?></b></div>
          <div><small><?php echo T_("passportExpireDate"); ?></small> <b><?php echo \dash\get::index($value, 'passportExpireDate'); ?></b></div>
          <div><small><?php echo T_("countryCode"); ?></small> <b><?php echo \dash\get::index($value, 'countryCode'); ?></b></div>
        </td>
        <td>
          <div><small><?php echo T_("registerNumber"); ?></small> <b><?php echo \dash\get::index($value, 'registerNumber'); ?></b></div>
          <div><small><?php echo T_("comNameFa"); ?></small> <b><?php echo \dash\get::index($value, 'comNameFa'); ?></b></div>
          <div><small><?php echo T_("comNameEn"); ?></small> <b><?php echo \dash\get::index($value, 'comNameEn'); ?></b></div>
          <div><small><?php echo T_("commercialCode"); ?></small> <b><?php echo \dash\get::index($value, 'commercialCode'); ?></b></div>
          <div><small><?php echo T_("registerDate"); ?></small> <b><?php echo \dash\get::index($value, 'registerDate'); ?></b></div>
          <div><small><?php echo T_("nationalLegalCode"); ?></small> <b><?php echo \dash\get::index($value, 'nationalLegalCode'); ?></b></div>
        </td>

      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>
<?php \dash\utility\pagination::html(); ?>

<?php } //endfunction ?>


<?php function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/customer"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/customer"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("Hi!"); ?> <a href="<?php echo \dash\url::here(); ?>/customer/add"><?php echo T_("Try to start with add new customer!"); ?></a></p>
<?php } //endfunction ?>

