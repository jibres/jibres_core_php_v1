<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>
<div class="avand-md">

<?php if(\dash\data::dataTable()) {?>
<nav class="items pwaMultiLine">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
        <a class="link f" <?php if(a($value, 'verify')){ ?> href="<?php echo \dash\url::this(). '/setting?domain='. $value['domain']; ?>" <?php }//endif ?>>
            <div class="key">
              <div class="line1"><?php echo a($value, 'icon'); ?> <?php echo a($value, 'title'); ?></div>
              <div class="line2 f">
                <div class="c"></div>
                <time class="cauto datetime"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></time>
              </div>

              </div>
        </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>
<?php }else{ ?>
    <div class="msg warn2"><?php echo T_("No action history founded"); ?></div>
<?php } //endif ?>
</div>
