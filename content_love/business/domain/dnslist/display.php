
  <div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::current(); ?>' >

    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>

<?php if(!\dash\data::dataTable()){?>

  <div class="msg warn2 txtC txtB fs14"><?php echo T_("No result found") ?></div>

<?php }else{ ?>

  <table class="tbl1 v6 fs11">
    <thead>
      <tr>
        <th><?php echo T_("Domain"); ?></th>
        <th><?php echo T_("Status"); ?></th>
        <th><?php echo T_("Type"); ?></th>
        <th><?php echo T_("Key"); ?></th>
        <th><?php echo T_("Value"); ?></th>
        <th><?php echo T_("Date created"); ?></th>
      </tr>
    </thead>
    <tbody>
   <?php foreach (\dash\data::dataTable() as $key => $value) {?>
      <tr>
        <td class="ltr txtL">
          <div class="">
            <a target="_blank" href="<?php echo \dash\url::protocol(). '://'. \dash\get::index($value, 'domain'); ?>">
              <code><?php echo \dash\get::index($value, 'domain'); ?></code><i class="sf-external-link"></i>
            </a>
          </div>
        </td>
        <td><?php echo \dash\get::index($value, 'tstatus'); ?></td>
        <td><?php echo \dash\get::index($value, 'type') ?></td>
        <td><?php echo \dash\get::index($value, 'key') ?></td>
        <td><?php echo \dash\get::index($value, 'value') ?></td>

        <td><div><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></div><div><?php echo \dash\fit::date_human(\dash\get::index($value, 'datecreated')); ?></div></td>
      </tr>
    <?php } //endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

<?php if(\dash\data::isFiltered()) {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::current(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>

<?php } //endif ?>