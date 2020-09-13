<?php require_once(root. 'content_love/business/domain/pageStep.php'); ?>
<form method="post" autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <div class="body">
        <div class="msg">
          <a href="<?php echo \dash\url::protocol(). '://'. \dash\data::dataRow_domain() ?>" target="_blank"><?php echo \dash\data::dataRow_domain() ?> <i class="sf-link-external"></i></a>
        </div>
        <div class="msg"><?php echo \dash\data::dataRow_tstatus() ?></div>
        <div class="msg"><?php echo \dash\fit::date_time(\dash\data::dataRow_datecreated()) ?></div>
      </div>
    </div>
  </div>
</form>
