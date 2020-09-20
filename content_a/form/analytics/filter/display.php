<div class="avand-xl">


  <?php if(\dash\data::whereList()) {?>
    <form method="post" autocomplete="off">
      <input type="hidden" name="sortable" value="sortable">
      <div class="tblBox font-14">
        <table class="tbl1 v4">
          <tbody>
            <?php foreach (\dash\data::whereList() as $key => $value) {?>
              <tr>
                <td class="collapsing"><code class="link"><?php echo \dash\get::index($value, 'field') ?></code></td>
                <td><?php echo \dash\get::index($value, 'field_title') ?></td>
                <td><?php echo \dash\get::index($value, 'condition') ?></td>
                <td><?php echo \dash\get::index($value, 'value') ?></td>
              </tr>
            <?php } //endfor ?>
          </tbody>
        </table>
      </div>
    </form>
  <?php }else{ ?>
    <div class="msg font-14 txtC warn2"><?php echo T_("No filter added") ?></div>
  <?php } //endif ?>
</div>
