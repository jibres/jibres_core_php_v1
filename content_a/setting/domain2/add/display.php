<div class="avand-md">

  <form method="post" autocomplete="off">
    <div  class="box">
      <header><h2><?php echo T_("Connect store to your domain");?></h2></header>
      <div class="body">
        <p>
          <?php echo T_("You can connect one or more domains to your business. After connecting the domains, select one of them as the primary domain.") ?>
        </p>
        <?php if(\dash\url::tld() === 'ir' || \dash\url::isLocal()) {?>
          <p>
            <?php echo T_("If you want to register new domain, Come here"); ?>
            <a href="<?php echo \dash\url::sitelang(). '/my/domain'; ?>" data-direct target="_blank"><?php echo T_("Domain Center"); ?></a>
          </p>
        <?php } // endif ?>

        <label for="idomain"><?php echo T_("Connect new domain"); ?> <span class="fc-red">*</span></label>
        <div class="input ltr">
          <input type="text" name="domain" id="idomain" <?php \dash\layout\autofocus::html() ?> required maxlength='100' minlength="1"  >
        </div>

      </div>
      <footer class="txtRa">
        <button  class="btn master" ><?php echo T_("Connect"); ?></button>
      </footer>
    </div>
  </form>
</div>
