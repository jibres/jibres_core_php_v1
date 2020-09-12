<form method="post" autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <div class="body">
        <p>
          <?php echo T_("Add any domain you want.") ?>
          <br>
          <?php echo T_("The domain will be listed after registration and the steps will be completed over time"); ?>
        </p>
        <?php var_dump(\dash\data::dataRow()); ?>
        <label for="idomain"><?php echo T_("Domain") ?></label>
        <div class="input ltr">
          <input type="text" name="domain" id="idomain">
        </div>

      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Add") ?></button>
      </footer>
    </div>
  </div>
</form>
