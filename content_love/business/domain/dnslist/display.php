
  <div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::current(); ?>' >

    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>

<?php if(!\dash\data::dataTable()){?>

  <div class="alert-warning text-center font-bold fs14"><?php echo T_("No result found") ?></div>

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
        <td class="ltr text-left">
          <div class="">
            <a target="_blank" href="<?php echo \dash\url::protocol(). '://'. a($value, 'domain'); ?>">
              <code><?php echo a($value, 'domain'); ?></code><i class="sf-external-link"></i>
            </a>
          </div>
        </td>
        <td><?php echo a($value, 'tstatus'); ?></td>
        <td><?php echo a($value, 'type') ?></td>
        <td><?php echo a($value, 'key') ?></td>
        <td><?php echo a($value, 'value') ?></td>

        <td><div><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></div><div><?php echo \dash\fit::date_human(a($value, 'datecreated')); ?></div></td>
      </tr>
    <?php } //endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

<?php if(\dash\data::isFiltered()) {?>
<p class="f fs14 alert-warning p-2 rounded">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::current(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>

<?php } //endif ?>