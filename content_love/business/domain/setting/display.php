<?php require_once(root. 'content_love/business/domain/pageStep.php'); ?>
<div class="avand-md">
  <form method="post" autocomplete="off">
    <input type="hidden" name="checkdns" value="checkdns">
    <div class="box">
      <div class="body">
        <?php if(\dash\data::dataRow_checkdns()) {?>
          <p><?php echo T_("DNS Checked") ?> <?php echo \dash\fit::date_time(\dash\data::dataRow_checkdns()); ?></p>
        <?php }else{ ?>
          <p><?php echo T_("DNS not checked yet") ?></p>
        <?php } //endif ?>
      </div>
      <footer class="txtRa">
        <?php if(\dash\data::dataRow_checkdns()) {?>
          <button class="btn primary"><?php echo T_("Check DNS again") ?></button>
        <?php }else{ ?>
          <button class="btn master"><?php echo T_("Check DNS") ?></button>
        <?php } //endif ?>
      </footer>
    </div>
  </form>


  <div class="box">
    <div class="body">
      <div class="f">
        <div class="c">
          <p class=""><?php echo T_("All action, dns record and Domain record of this domain will be removed") ?></p>
        </div>
        <div class="cauto pRa5">
          <div data-confirm data-data='{"removedomain": "removedomain"}' class="btn linkDel"><?php echo T_("Remove domain") ?></div>
        </div>
      </div>
    </div>
  </div>

</div>


<div class="hide">

  cdnpanel
  httpsrequest
</div>