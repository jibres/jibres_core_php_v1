
  <div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::current(); ?>' >

    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>

<?php if(!\dash\data::dataTable()){?>

  <div class="msg warn2 txtC txtB fs14"><?php echo T_("No result found") ?></div>

<?php }else{ ?>

  <table class="tbl1 v4 fs14">
            <thead>
              <tr>
                <th class="collapsing"></th>
                <th><?php echo T_("Domain") ?></th>
                <th><?php echo T_("Action") ?></th>
                <th><?php echo T_("Time") ?></th>
                <th class="collapsing"></th>
              </tr>
            </thead>
            <tbody>

          <?php foreach (\dash\data::dataTable() as $key => $value) {?>
            <tr>
              <td class="collapsing"><code><?php echo \dash\get::index($value, 'id'); ?></code></td>
              <td><a href="<?php echo \dash\url::that(). '/detail?id='. \dash\get::index($value, 'business_domain_id'); ?>"><?php echo \dash\get::index($value, 'domain'); ?></a></td>
              <td><?php echo \dash\get::index($value, 'action'); ?></td>
              <td><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></td>
              <td class="collapsing">
                <?php if(\dash\get::index($value, 'meta')) {?>
                <span data-kerkere=".showDetail<?php echo \dash\get::index($value, 'id'); ?>">
                  <i class="sf-list-ul"></i>
                </span>
              <?php } //endif ?>
              </td>
            </tr>
            <?php if(\dash\get::index($value, 'meta')) {?>
            <tr class="fs08 showDetail<?php echo \dash\get::index($value, 'id'); ?>" data-kerkere-content='hide'>
              <td colspan="4" class="txtL"><pre><?php if(is_array($value['meta'])){ echo json_encode($value['meta'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); }else{ echo htmlspecialchars($value['meta']);} ?></pre></td>
            </tr>
            <?php } //endif ?>
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