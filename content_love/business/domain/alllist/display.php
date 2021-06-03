<nav class="items long ltr">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) { ?>
     <li>
      <a class="item f align-center" href="<?php echo \dash\url::that(). '/detail?id='. a($value, 'id'); ?>">
        <div class="key"><?php echo a($value, 'domain'); ?></div>
        <div class="value">
          <?php if(a($value, 'dnsok')) {?><span class="fc-green mLa5">DNS</span><?php }else{ ?><span class="fc-mute mLa5">DNS</span><?php } //endif ?>
          <?php if(a($value, 'cdnpanel')) {?><span class="fc-green mLa5">CDN</span><?php }else{ ?><span class="fc-mute mLa5">CND</span><?php } //endif ?>
          <?php if(a($value, 'httpsverify')) {?><span class="fc-green mLa5">HTTPS</span><?php }else{ ?><span class="fc-mute mLa5">HTTPS</span><?php } //endif ?>
        </div>
        <div class="value"><?php echo a($value, 'status'); ?></div>
        <div class="go detail"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>