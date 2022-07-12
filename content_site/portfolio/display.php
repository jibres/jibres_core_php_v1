<div class="avand-lg">

    <div  class="box">

      <div class="body">
        <p>
          <?php echo T_("You can introduce your site as an portfolio of Jibers sites"); ?>
          <br>
          <?php echo T_("Your request will be reviewed"); ?>
          <br>
          <?php echo T_("If your request is approved, your website title and website address will be placed on the Jibers portfolio page"); ?>
          <br>
          <?php echo T_("Your website must meet our minimum standards for inclusion"); ?>
        </p>
        <div class="msg"><a target="_blank" class="link-primary" href="<?php echo \dash\url::jibres() ?>/portfolio"><?php echo T_("Jibres portfolio page") ?></a></div>
      </div>
        <footer class="txtRa">
          <a target="_blank" class="btn-success" href="<?php echo \dash\url::jibres(). '/my/ticket/add?title='. \lib\store::code_raw(). '-'. T_("Portfolio") ?>"><?php echo T_("Send request"); ?></a>
        </footer>

      </div>
</div>
