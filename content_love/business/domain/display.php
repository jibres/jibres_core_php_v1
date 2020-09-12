
  <div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::current(); ?>' >

    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>


<table class="tbl1 v6 fs11">
  <thead>
    <tr>
      <th><?php echo T_("Domain"); ?></th>
      <th><?php echo T_("Status"); ?></th>
      <th><?php echo T_("Check DNS"); ?></th>
      <th><?php echo T_("Add to CDN Panel"); ?></th>
      <th><?php echo T_("HTTPS"); ?></th>
      <th><?php echo T_("Date created"); ?></th>
      <th class="collapsing"><?php echo T_("Detail"); ?></th>
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


      <td><?php if(\dash\get::index($value, 'https')) {?><i class="sf-check fc-green fs14"></i><?php }else{ ?><i class="sf-times fc-red fs14"></i><?php } //endif ?></td>
      <td><?php if(\dash\get::index($value, 'master')) {?><i class="sf-check fc-green fs14"></i><?php }else{ ?><i class="sf-times fc-red fs14"></i><?php } //endif ?></td>
      <td><?php if(\dash\get::index($value, 'master')) {?><i class="sf-check fc-green fs14"></i><?php }else{ ?><i class="sf-times fc-red fs14"></i><?php } //endif ?></td>

      <td><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></td>

      <td class="collapsing"><a class="btn primary" href="<?php echo \dash\url::that(). '/detail?id='. \dash\get::index($value, 'id'); ?>"><?php echo T_("Show detail") ?></a></td>
    </tr>
<?php } //endfor ?>
  </tbody>
</table>


<?php \dash\utility\pagination::html(); ?>