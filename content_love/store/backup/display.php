<?php $dataRow = \dash\data::dataRow(); ?>
<div class="avand-lg">
  <?php require_once(root. 'content_love/store/storeDetail.php') ?>

    <div class="box">
      <div class="body">
        <?php if(\dash\data::currentBackup()) {?>
          <p><?php echo T_("Backup created") ?>
            <br>
            <?php echo \dash\fit::date_time(\dash\data::currentBackup_date()); ?>
          </p>
        <?php }else{ ?>
          <p><?php echo T_("No backup of this store funded"); ?></p>
        <?php } //endif ?>

      </div>
        <?php if(\dash\data::currentBackup()) {?>
      <footer class="f">
        <div class="cauto"><div data-ajaxify data-data='{"remove": "remove"}' class="btn danger outline"><?php echo T_("Remove") ?></div></div>

        <div class="c"></div>
        <div class="cauto"><a target="_blank" class="btn master" href="<?php echo \dash\url::that(). \dash\request::full_get(['download' => 1]) ?>"><?php echo T_("Download") ?></a></div>

      </footer>
        <?php } //endif ?>
    </div>







   <form method="post" autocomplete="off" class="hide" id="formrun">
    <input type="hidden" name="backup" value="backup">
  </form>

</div>