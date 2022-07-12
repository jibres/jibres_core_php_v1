<div class="avand-lg">

    <div  class="box">

      <div class="body">
        <p><?php echo nl2br(T_("You can introduce your site as an example of Jibers sites \nYour request will be reviewed \nIf your request is approved, your website title and website address will be placed on the Jibers portfolio page")); ?></p>
        <div class="msg"><a target="_blank" class="link-primary" href="<?php echo \dash\url::jibres() ?>/portfolio"><?php echo T_("Jibres portfolio page") ?></a></div>

        <?php if(\lib\store::detail('portfolio') === 'request') {?>
          <div class="alert-info" ><?php echo T_("Your request pending review"); ?></div>
        <?php }elseif(\lib\store::detail('portfolio') === 'reject') {?>
          <div class="alert-danger" ><?php echo T_("Request rejectd"); ?></div>
        <?php }elseif(\lib\store::detail('portfolio') === 'accept') {?>
          <div class="alert-success" ><?php echo T_("Request accepted"); ?></div>
          <?php } // endif ?>

      </div>
        <footer class="txtRa">
          <?php if(!\lib\store::detail('portfolio') || \lib\store::detail('portfolio') === 'delete') {?>
          <div data-confirm data-data='{"portfolio": "request"}'  class="btn-primary" ><?php echo T_("Send request"); ?></div>
          <?php }elseif(\lib\store::detail('portfolio') === 'request') {?>
          <!-- <div data-confirm data-data='{"portfolio": "delete"}'  class="btn-danger" ><?php echo T_("Cancel request"); ?></div> -->
          <?php }elseif(\lib\store::detail('portfolio') === 'reject') {?>
            <!-- <div  class="btn-danger" ><?php echo T_("Request rejectd"); ?></div> -->
          <?php }elseif(\lib\store::detail('portfolio') === 'accept') {?>
          <!-- <div data-confirm data-data='{"portfolio": "delete"}'  class="btn-danger" ><?php echo T_("Remove from jibres portfolio"); ?></div> -->
            <?php } // endif ?>
        </footer>

      </div>
</div>
