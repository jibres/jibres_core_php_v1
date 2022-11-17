
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
  <form method="get" action='<?php echo \dash\url::this(); ?>' >
    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>

      <?php if(\dash\request::get('type')) {?>

      <input type="hidden" name="type" value="<?php echo \dash\request::get('type'); ?>">

      <?php } // endif ?>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
      <div class="addon btn-warning" data-confirm data-data='{"remove":"lastmonth"}'><?php echo T_("Remove last month log"); ?></div>
    </div>
  </form>
</div>
<?php } //endfunction ?>






<?php function htmlTable() {?>

<div class="tblbox">

  <table class="tbl1 v3 cbox fs12">
    <thead class="text-sm">
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
          <a class="badge danger" href="<?php echo \dash\url::this(); ?>/view?id=<?php echo a($value, 'id'); ?>"><?php echo T_("Detail"); ?></a>
          <a class="badge primary" download data-direct href="<?php echo \dash\url::this(); ?>/download?id=<?php echo a($value, 'id'); ?>"><?php echo T_("Download"); ?></a>

        </td>
      <td>
      <a href="<?php echo \dash\url::this(); ?>?user_id=<?php echo a($value, 'user_id'); ?>"><?php echo a($value, 'user_id'); ?></a>
      <span class="badge">token: <b><a href="<?php echo \dash\url::this(); ?>?token=<?php echo a($value, 'token'); ?>"><?php echo a($value, 'token'); ?></a></b></span>
      <span class="badge">apikey: <b><a href="<?php echo \dash\url::this(); ?>?apikey=<?php echo a($value, 'apikey'); ?>"><?php echo a($value, 'apikey'); ?></a></b></span>
      <span class="badge">appkey: <b><a href="<?php echo \dash\url::this(); ?>?appkey=<?php echo a($value, 'appkey'); ?>"><?php echo a($value, 'appkey'); ?></a></b></span>
      <span class="badge">zoneid: <b><a href="<?php echo \dash\url::this(); ?>?zoneid=<?php echo a($value, 'zoneid'); ?>"><?php echo a($value, 'zoneid'); ?></a></b></span>
      </td>

      <td><a href="<?php echo \dash\url::this(); ?>?subdomain=<?php echo a($value, 'subdomain'); ?>"><?php echo a($value, 'subdomain'); ?></a></td>

      <td><a href="<?php echo \dash\url::this(); ?>?version=<?php echo a($value, 'version'); ?>"><?php echo a($value, 'version'); ?></a></td>

      <td>
        <?php echo a($value, 'url'); ?>

        <span><a href="<?php echo \dash\url::this(); ?>?urlmd5=<?php echo a($value, 'urlmd5'); ?>"><?php echo a($value, 'urlmd5'); ?></a></span>
      </td>
      <td>
        <b><a href="<?php echo \dash\url::this(); ?>?method=<?php echo a($value, 'method'); ?>"><?php echo a($value, 'method'); ?></a></b>
      </td>
      <td>
        <span data-kerkere='.showHeader<?php echo a($value, 'id'); ?>'><i class="sf-plus"></i></span>
        <div class="showHeader<?php echo a($value, 'id'); ?>" data-kerkere-content='hide'>
          <?php echo nl2br(a($value, 'header')); ?>
        </div>
      </td>
      <td><?php echo \dash\fit::number(a($value, 'headerlen')); ?></td>
      <td>
        <span data-kerkere='.showBody<?php echo a($value, 'id'); ?>'><i class="sf-plus"></i></span>
        <div class="showBody<?php echo a($value, 'id'); ?>" data-kerkere-content='hide'>
          <?php echo a($value, 'body'); ?>
        </div>
      </td>
      <td><?php echo \dash\fit::number(a($value, 'bodylen')); ?></td>
      <td>
          <?php echo \dash\fit::date(a($value, 'datesend')); ?>
        <br>
          <?php echo \dash\fit::date_human(a($value, 'datesend')); ?>
      </td>
      <td><a href="<?php echo \dash\url::this(); ?>?pagestatus=<?php echo a($value, 'pagestatus'); ?>"><?php echo \dash\fit::number(a($value, 'pagestatus')); ?></a></td>
      <td><a href="<?php echo \dash\url::this(); ?>?resultstatus=<?php echo a($value, 'resultstatus'); ?>"><?php echo a($value, 'resultstatus'); ?></a></td>
      <td>
        <span data-kerkere='.showResponseHeader<?php echo a($value, 'id'); ?>'><i class="sf-plus"></i></span>
        <div class="showResponseHeader<?php echo a($value, 'id'); ?>" data-kerkere-content='hide'>
          <?php echo nl2br(a($value, 'responseheader')); ?>

        </div>
      </td>
      <td>
        <span data-kerkere='.showResponseBody<?php echo a($value, 'id'); ?>'><i class="sf-plus"></i></span>
        <div class="showResponseBody<?php echo a($value, 'id'); ?>" data-kerkere-content='hide'>
          <?php echo nl2br(a($value, 'responsebody')); ?>
        </div>
      </td>
      <td>
        <?php echo \dash\fit::date(a($value, 'dateresponse')); ?>
        <br>
        <?php echo \dash\fit::date_human(a($value, 'dateresponse')); ?>
      </td>
      <td>
        <span data-kerkere='.showNotif<?php echo a($value, 'id'); ?>'><i class="sf-plus"></i></span>
        <div class="showNotif<?php echo a($value, 'id'); ?>" data-kerkere-content='hide'>
          <?php echo \dash\fit::date(a($value, 'notif')); ?>
        </div>
    </td>
      <td><?php echo \dash\fit::number(a($value, 'responselen')); ?></td>


      </tr>
      <?php } //endif ?>
    </tbody>
  </table>
</div>

<?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>

<?php function htmlFilter() {?>
<p class="f fs14 alert-info p-2 rounded">
  <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 alert-warning p-2 rounded">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 alert-success pTB20"><?php echo T_("No record exist!"); ?></p>
<?php } //endif ?>

