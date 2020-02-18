
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
  <form method="get" action='<?php echo \dash\url::this(); ?>' data-action>
    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" autofocus autocomplete='off'>

      <?php if(\dash\request::get('type')) {?>

      <input type="hidden" name="type" value="<?php echo \dash\request::get('type'); ?>">

      <?php } // endif ?>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>
<?php } //endfunction ?>






<?php function htmlTable() {?>

<div class="tblbox">

  <table class="tbl1 v3 cbox fs12">
    <thead class="fs09">
      <tr>
        <th><?php echo T_("Show"); ?></th>
        <th><?php echo T_("Auth"); ?></th>

        <th><?php echo T_("Subdomain"); ?></th>
        <th><?php echo T_("Version"); ?></th>
        <th><?php echo T_("Url"); ?></th>
        <th><?php echo T_("Method"); ?></th>
        <th><?php echo T_("Header"); ?></th>
        <th><?php echo T_("Header len"); ?></th>
        <th><?php echo T_("Body"); ?></th>
        <th><?php echo T_("Bodylen"); ?></th>
        <th><?php echo T_("Date send"); ?></th>
        <th><?php echo T_("Page status"); ?></th>
        <th><?php echo T_("Result status"); ?></th>
        <th><?php echo T_("Response header"); ?></th>
        <th><?php echo T_("Response body"); ?></th>
        <th><?php echo T_("Datere sponse"); ?></th>
        <th><?php echo T_("Notif"); ?></th>
        <th><?php echo T_("Response len"); ?></th>

      </tr>
    </thead>

    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>

      <tr>
        <td>
          <a class="badge danger" href="<?php echo \dash\url::this(); ?>/view?id=<?php echo @$value['id']; ?>"><?php echo T_("Detail"); ?></a>
          <a class="badge primary" target="_blank" href="<?php echo \dash\url::this(); ?>/download?id=<?php echo @$value['id']; ?>"><?php echo T_("Download"); ?></a>

        </td>
      <td>
      <a href="<?php echo \dash\url::this(); ?>?user_id=<?php echo @$value['user_id']; ?>"><?php echo @$value['user_id']; ?></a>
      <span class="badge">token: <b><a href="<?php echo \dash\url::this(); ?>?token=<?php echo @$value['token']; ?>"><?php echo @$value['token']; ?></a></b></span>
      <span class="badge">apikey: <b><a href="<?php echo \dash\url::this(); ?>?apikey=<?php echo @$value['apikey']; ?>"><?php echo @$value['apikey']; ?></a></b></span>
      <span class="badge">appkey: <b><a href="<?php echo \dash\url::this(); ?>?appkey=<?php echo @$value['appkey']; ?>"><?php echo @$value['appkey']; ?></a></b></span>
      <span class="badge">zoneid: <b><a href="<?php echo \dash\url::this(); ?>?zoneid=<?php echo @$value['zoneid']; ?>"><?php echo @$value['zoneid']; ?></a></b></span>
      </td>

      <td><a href="<?php echo \dash\url::this(); ?>?subdomain=<?php echo @$value['subdomain']; ?>"><?php echo @$value['subdomain']; ?></a></td>

      <td><a href="<?php echo \dash\url::this(); ?>?version=<?php echo @$value['version']; ?>"><?php echo @$value['version']; ?></a></td>

      <td>
        <?php echo @$value['url']; ?>

        <span><a href="<?php echo \dash\url::this(); ?>?urlmd5=<?php echo @$value['urlmd5']; ?>"><?php echo @$value['urlmd5']; ?></a></span>
      </td>
      <td>
        <b><a href="<?php echo \dash\url::this(); ?>?method=<?php echo @$value['method']; ?>"><?php echo @$value['method']; ?></a></b>
      </td>
      <td>
        <span data-kerkere='.showHeader<?php echo @$value['id']; ?>'><i class="sf-plus"></i></span>
        <div class="showHeader<?php echo @$value['id']; ?>" data-kerkere-content='hide'>
          <?php echo nl2br(@$value['header']); ?>
        </div>
      </td>
      <td><?php echo \dash\fit::number(@$value['headerlen']); ?></td>
      <td>
        <span data-kerkere='.showBody<?php echo @$value['id']; ?>'><i class="sf-plus"></i></span>
        <div class="showBody<?php echo @$value['id']; ?>" data-kerkere-content='hide'>
          <?php echo @$value['body']; ?>
        </div>
      </td>
      <td><?php echo \dash\fit::number(@$value['bodylen']); ?></td>
      <td>
          <?php echo \dash\fit::date(@$value['datesend']); ?>
        <br>
          <?php echo \dash\fit::date_human(@$value['datesend']); ?>
      </td>
      <td><a href="<?php echo \dash\url::this(); ?>?pagestatus=<?php echo @$value['pagestatus']; ?>"><?php echo \dash\fit::number(@$value['pagestatus']); ?></a></td>
      <td><a href="<?php echo \dash\url::this(); ?>?resultstatus=<?php echo @$value['resultstatus']; ?>"><?php echo @$value['resultstatus']; ?></a></td>
      <td>
        <span data-kerkere='.showResponseHeader<?php echo @$value['id']; ?>'><i class="sf-plus"></i></span>
        <div class="showResponseHeader<?php echo @$value['id']; ?>" data-kerkere-content='hide'>
          <?php echo nl2br(@$value['responseheader']); ?>

        </div>
      </td>
      <td>
        <span data-kerkere='.showResponseBody<?php echo @$value['id']; ?>'><i class="sf-plus"></i></span>
        <div class="showResponseBody<?php echo @$value['id']; ?>" data-kerkere-content='hide'>
          <?php echo nl2br(@$value['responsebody']); ?>
        </div>
      </td>
      <td>
        <?php echo \dash\fit::date(@$value['dateresponse']); ?>
        <br>
        <?php echo \dash\fit::date_human(@$value['dateresponse']); ?>
      </td>
      <td>
        <span data-kerkere='.showNotif<?php echo @$value['id']; ?>'><i class="sf-plus"></i></span>
        <div class="showNotif<?php echo @$value['id']; ?>" data-kerkere-content='hide'>
          <?php echo \dash\fit::date(@$value['notif']); ?>
        </div>
    </td>
      <td><?php echo \dash\fit::number(@$value['responselen']); ?></td>


      </tr>
      <?php } //endif ?>
    </tbody>
  </table>
</div>

<?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>

<?php function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("No record exist!"); ?></p>
<?php } //endif ?>

