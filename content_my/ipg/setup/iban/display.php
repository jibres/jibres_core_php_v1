<?php require_once(core. 'layout/tools/stepGuide.php'); ?>


<div class="f justify-center">
  <div class="c6 m8 s12">

    <form method="post" autocomplete="off" class="box impact">
        <header><h2><?php echo T_("Add your bank account number for settlement"); ?></h2></header>
      <div class="body">
          <label for="iiban"><?php echo T_("IBAN"); ?></label>
          <div class="input ltr">
            <input type="text" name="iban" placeholder="IR000000000000000000000000" value="<?php echo \dash\data::ibanDetail_merchantIban(); ?>" id="iiban"  maxlength="26" required>
          </div>

      </div>

      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Save & Next"); ?></button>
      </footer>
    </form>
  </div>
</div>


