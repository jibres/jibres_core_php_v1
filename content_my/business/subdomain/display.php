
    <div id="get_started_card">
      <div class="body">
        <div class="pad">
          <h1><?php echo T_("Choose your online address"); ?></h1>
          <p><?php echo T_("Your online store has online address on Jibres domain."); ?> <?php echo T_("Although you can connect your domain into store but to finish setup we need to set it."); ?></p>
          <p class="msg fs09"><?php echo T_("Set it carefully, you can not change it."); ?></p>

          <form method="post" autocomplete="off">
            <div class="input fix mB10">
              <input type="text" name="sd" id="sd" placeholder='<?php echo T_("Your subdomain"); ?>' maxlength="40" class="ltr" autofocus required>
              <label class="addon ltr" for="sd">.Jibres.<?php echo \dash\url::tld(); ?></label>
            </div>

            <button class="btn success block"><?php echo T_("Build my online store"); ?></button>
          </form>

        </div>
        <img src="<?php echo \dash\url::cdn(); ?>/img/business/choose-subdomain.svg" alt='<?php echo T_("choose subdomain on Jibres"); ?>'>
      </div>
      <div class="f align-center">
        <div class="cauto os"><a href="<?php echo \dash\url::this(); ?>" class="btn"><?php echo T_("Cancel"); ?></a></div>
      </div>
    </div>
