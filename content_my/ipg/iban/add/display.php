<div class="f justify-center">
  <div class="c6 m8 s12">

    <form method="post" autocomplete="off" class="box impact">
        <header><h2><?php echo T_("Add your bank account number for settlement"); ?></h2></header>
      <div class="body">

          <label for="ititle"><?php echo T_("Title"); ?></label>
          <div class="input">
            <input type="text" name="title"  id="ititle"   maxlength="50">
          </div>

          <label for="iiban"><?php echo T_("IBAN"); ?></label>
          <div class="input ltr">
            <input type="text" name="iban" placeholder="IR000000000000000000000000"  id="iiban"  maxlength="26" required>
          </div>

      </div>

      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Add"); ?></button>
      </footer>
    </form>
  </div>
</div>


