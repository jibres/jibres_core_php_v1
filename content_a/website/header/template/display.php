
<div class="avand">

  <div class="msg fs14 primary2 txtB f">
    <div class="c">
      <?php echo T_("Pick a your header template and customize anything. After choose one of them, you can personalize your own unique header by set logo, menu and another features based on your choosen header."); ?>
    </div>
    <div class="cauto"></div>
    <?php if(\dash\request::get()) {?>
    <div class="cauto">
      <a class="btn primary" href="<?php echo \dash\url::that(); ?>/template"><?php echo T_("Clear filter") ?></a>
    </div>

    <?php } // endif ?>
  </div>
  <?php foreach (\dash\data::headerTemplate() as $key => $value) {?>
    <div class="box">
      <header class="f align-center">
        <div class="c">
          <h2><?php echo \dash\get::index($value, 'title'); ?></h2>
          <span><?php echo T_("version"). ' '. \dash\fit::number(\dash\get::index($value, 'version')) ?></span>
        </div>
        <div class="cauto">
<?php if(\dash\get::index($value, 'key') === \dash\data::issetHeader()) {?>
          <div class="btn success"><?php echo T_("Current Template"); ?></div>
<?php }else{ ?>
          <div data-confirm data-data='{"header" : "<?php echo \dash\get::index($value, 'key'); ?>"}' class="btn secondary outline"><?php echo T_("Choose this template"); ?></div>
<?php } //endif ?>
        </div>
      </header>
      <div class="body">
        <div class="f">
          <div class="c">
            <div class="btn"></div>
            <p>
              <?php echo nl2br(\dash\get::index($value, 'desc')); ?>
            </p>
            <?php if(\dash\get::index($value, 'tag')) {?>
              <p>
              <?php foreach (\dash\get::index($value, 'tag') as $tag => $tag_string) {?>
                <span class="badge light"><a class="fc-blue" href="<?php echo \dash\url::that(). '/template?tag='. $tag ?>"><?php echo $tag_string ?></a></span>
              <?php } ?>
              </p>
            <?php } ?>

          </div>
          <div class="cauto os"><img class="avatar fs50" src="<?php echo \dash\get::index($value, 'sample_image'); ?>"></div>
        </div>
      </div>
      <footer class="txtRa">

      </footer>
    </div>
  <?php } // endfor ?>


</div>