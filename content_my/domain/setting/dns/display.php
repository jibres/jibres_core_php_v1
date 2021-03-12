<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>
<form method="post" autocomplete="off" >
  <div class="avand-md">
    <div class="box">
      <div class="pad">
        <label for="ns1"><?php echo T_("DNS #1"); ?></label>
        <div class="input ltr">
          <input type="text" name="ns1" id="ns1" maxlength="50" value="<?php echo \dash\data::domainDetail_ns1(); ?>" >
        </div>

        <label for="ns2"><?php echo T_("DNS #2"); ?></label>
        <div class="input ltr">
          <input type="text" name="ns2" id="ns2" maxlength="50" value="<?php echo \dash\data::domainDetail_ns2(); ?>" >
        </div>
      </div>
      <footer class="txtRa">

        <button class="btn success"><?php echo T_("Update"); ?></button>
      </footer>
    </div>
  </div>
</form>