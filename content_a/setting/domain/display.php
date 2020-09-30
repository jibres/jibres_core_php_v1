

<?php if(!\dash\data::dataTable()){?>

  <?php require_once('add/display.php'); ?>

<?php }else{ ?>


<div class="avand-md">
  <nav class="items">
    <ul>
      <li>
          <a class="f item" href="<?php echo 'https://'. \lib\store::detail('subdomain').'.jibres.'. \dash\url::jibres_tld(); ?>" target='_blank'>
            <div class="key"><?php echo \lib\store::detail('subdomain').'.jibres.'. \dash\url::jibres_tld(); ?></div>
            <div class="value"><?php echo T_("Connected"); ?></div>
            <div class="go"></div>
          </a>
      </li>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
      <li>
          <a class="f item" href="<?php echo \dash\url::that(). '/manage?domain='. \dash\get::index($value, 'domain'); ?>">
            <div class="key"><?php echo \dash\get::index($value, 'domain'); ?>
              <?php if(\dash\get::index($value, 'master')) {?>
                <span class="badge rounded success2"><?php echo T_("Master domain") ?></span>
              <?php } //endif ?>
            </div>
            <div class="value"><?php echo \dash\get::index($value, 'tstatus'); ?></div>
            <div class="go"></div>
          </a>
      </li>
      <?php } //endfor ?>

    </ul>
  </nav>
</div>


<?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>