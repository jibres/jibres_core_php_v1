
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
        <th><?php echo T_("Check DNS"); ?></th>
        <th><?php echo T_("Add to CDN Panel"); ?></th>
        <th><?php echo T_("HTTPS"); ?></th>
        <th><?php echo T_("Last modified"); ?></th>
        <th><?php echo T_("Count Log"); ?></th>
        <th><?php echo T_("Count DNS"); ?></th>
        <th class="collapsing"><?php echo T_("Detail"); ?></th>
      </tr>
    </thead>
    <tbody>
   <?php foreach (\dash\data::dataTable() as $key => $value) {?>
      <tr>
        <td class="ltr txtL">
          <div class="">
            <a target="_blank" href="<?php echo \dash\url::protocol(). '://'. a($value, 'domain'); ?>">
              <code><?php echo a($value, 'domain'); ?></code><i class="sf-external-link"></i>
            </a>
          </div>
        </td>
        <td><?php echo a($value, 'tstatus'); ?></td>


        <td><?php if(a($value, 'dnsok')) {?><i class="sf-check fc-green fs14"></i><?php }else{ ?><i class="sf-times fc-red fs14"></i><?php } //endif ?></td>
        <td><?php if(a($value, 'cdnpanel')) {?><i class="sf-check fc-green fs14"></i><?php }else{ ?><i class="sf-times fc-red fs14"></i><?php } //endif ?></td>
        <td><?php if(a($value, 'httpsverify')) {?><i class="sf-check fc-green fs14"></i><?php }else{ ?><i class="sf-times fc-red fs14"></i><?php } //endif ?></td>

        <td><div><?php echo \dash\fit::date_time(a($value, 'last_log_time')); ?></div><div><?php echo \dash\fit::date_human(a($value, 'last_log_time')); ?></div></td>
        <td><a href="<?php echo \dash\url::that(). '/log?id='. a($value, 'id'); ?>"><?php echo \dash\fit::number(a($value, 'count_log')); ?></a></td>
        <td><a href="<?php echo \dash\url::that(). '/dns?id='. a($value, 'id'); ?>"><?php echo \dash\fit::number(a($value, 'count_dns')); ?></a></td>


        <td class="collapsing"><a class="btn primary" href="<?php echo \dash\url::that(). '/detail?id='. a($value, 'id'); ?>"><?php echo T_("Show detail") ?></a></td>
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