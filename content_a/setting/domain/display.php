<?php $domain = (\dash\url::tld() === 'com') ? '.myjibres.com': '.jibres.store'; ?>
<div class="avand-md">
  <nav class="items">
    <ul>
      <li>
        <a class="f item" href="<?php  echo 'https://'. \lib\store::detail('subdomain'). $domain; ?>" target='_blank'>
          <div class="key"><?php echo \lib\store::detail('subdomain'). $domain; ?></div>
          <div class="value"><?php echo T_("Connected"); ?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>
  <?php if(\dash\data::dataTable()){ ?>
    <nav class="items">
      <ul>
        <?php foreach (\dash\data::dataTable() as $key => $value) {?>
          <li>
            <a class="f item" href="<?php echo \dash\url::that(). '/manage?domain='. a($value, 'domain'); ?>">
              <div class="key"><?php echo a($value, 'domain'); ?>
              <?php if(a($value, 'master')) {?>
                <span class="badge rounded success2"><?php echo T_("Master domain") ?></span>
              <?php } //endif ?>
            </div>
            <div class="value"><?php echo a($value, 'tstatus'); ?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php } //endfor ?>
    </ul>
  </nav>
<?php } // endif ?>
</div>
<?php
\dash\utility\pagination::html();
echo '<br>';
require_once('add/display.php');
?>
