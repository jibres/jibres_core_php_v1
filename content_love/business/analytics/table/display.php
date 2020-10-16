<div class="avand">
  <div class="tblBox">
    <table class="tbl1 v6 font-14">
      <thead>
        <tr>

          <th><?php echo T_("Url"); ?></th>
          <th><?php echo T_("subdomain"); ?></th>
          <th><?php echo T_("title"); ?></th>
          <th><?php echo T_("owner"); ?></th>

          <th class="collapsing"><?php echo \dash\request::get('f') ?></th>


        </tr>
      </thead>
      <tbody>
        <?php foreach (\dash\data::dataTable() as $key => $value) {?>
          <tr>
            <td><a href="<?php echo \dash\url::kingdom(). '/'.\dash\store_coding::encode(\dash\get::index($value, 'id'));?>"><code><?php echo \dash\store_coding::encode(\dash\get::index($value, 'id')); ?></code></a></td>
            <td><div class=""><a target="_blank" href="<?php echo \dash\url::protocol(). '://'. \dash\get::index($value, 'subdomain'). '.jibres.'. \dash\url::tld(); ?>"><?php echo \dash\get::index($value, 'subdomain'); ?></a></div></td>
            <td>
              <img src="<?php echo \dash\get::index($value, 'logo'); ?>" class="avatar">
              <?php echo \dash\get::index($value, 'title'); ?>

            </td>
            <td>
              <img src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>" class="avatar">
              <?php echo \dash\get::index($value, 'user_detail', 'displayname'); ?>
              <br>
              <div class="badge light"><?php echo \dash\fit::mobile(\dash\get::index($value, 'user_detail', 'mobile')); ?></div>
              <a target="_blank" href="<?php echo \dash\url::kingdom(). '/enter?userid='. \dash\coding::decode(\dash\get::index($value, 'creator')); ?>"><i class="sf-in-alt"></i></a>
            </td>


            <td class="collapsing txtB fc-blue"><?php echo \dash\fit::number_en(\dash\get::index($value, \dash\request::get('f'))); ?></td>

          </tr>

        <?php } //endfor ?>
      </tbody>
    </table>
    <?php \dash\utility\pagination::html(); ?>
  </div>
</div>