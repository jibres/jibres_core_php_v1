
<div class="msg fs14 primary2 txtB">
  <?php echo T_("Choose your header template"); ?>
</div>
<?php foreach (\dash\data::headerTemplate() as $key => $value) {?>
  <div class="box">
    <header><h2><?php echo \dash\get::index($value, 'title'); ?></h2></header>
    <div class="body">
      <div class="f">
        <div class="c">
          <p>
            <?php echo nl2br(\dash\get::index($value, 'desc')); ?>
          </p>
          <?php if(\dash\get::index($value, 'tag')) {?>
            <p>
            <?php foreach (\dash\get::index($value, 'tag') as $tag => $tag_string) {?>
              <span class="badge light"><a class="fc-blue" href="<?php echo \dash\url::that(). '?tag='. $tag ?>"><?php echo $tag_string ?></a></span>
            <?php } ?>
            </p>
          <?php } ?>

        </div>
        <div class="cauto os"><img class="avatar fs50" src="<?php echo \dash\get::index($value, 'sample_image'); ?>"></div>
      </div>
    </div>
    <footer class="txtRa">
      <?php if(\dash\get::index($value, 'key') === \dash\data::issetHeader()) {?>
        <div class="btn secondary outline"><?php echo T_("Current Template"); ?></div>
      <?php }else{ ?>
        <div data-confirm data-data='{"header" : "<?php echo \dash\get::index($value, 'key'); ?>"}' class="btn success"><?php echo T_("Choose this header"); ?></div>
      <?php } //endif ?>
    </footer>
  </div>
<?php } // endfor ?>

