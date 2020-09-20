<?php require_once(root. 'content_a/form/analytics/pageStep.php'); ?>

<form method="post" id="formexec">
  <input type="hidden" name="execfilter" value="execfilter">
</form>
<div class="avand-xl">
  <form method="post" autocomplete="off">
    <div class="box">
      <header><h2><?php echo \dash\data::filterDetail_title() ?></h2></header>
      <div class="body">
        <label for="ititle"><?php echo T_("Question") ?></label>
        <select class="select22" name="field">
          <option value=""><?php echo T_("Please select on item") ?></option>
          <?php foreach (\dash\data::fields() as $key => $value) {?>
            <option value="<?php echo \dash\get::index($value, 'field') ?>"><?php echo \dash\get::index($value, 'title') ?></option>
          <?php } //endfor ?>
        </select>

        <label for="condition"><?php echo T_("Operator") ?></label>
        <select class="select22 mB10" name="condition">
          <option value=""><?php echo T_("Please select on item") ?></option>
          <option value="isnull">IS NULL</option>
          <option value="isnotnull">IS NOT NULL</option>
          <option value="larger"><?php echo T_("Is larger than") ?></option>
          <option value="less"><?php echo T_("Is less than") ?></option>
          <option value="equal">=</option>
          <option value="notequal">!=</option>

        </select>

        <div data-response='condition' data-response-hide data-response-where='larger|less|equal|notequal' data-response-effect='slide'>
          <label for="value"><?php echo T_("Value") ?></label>
           <select name="value" id="vaue" class="select22" data-model='tag'>
            <option value=""><?php echo T_("Value"); ?></option>
            <?php foreach (\dash\data::allChoice() as $key => $value) {?>
              <option value="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></option>
            <?php } //endfor ?>
            </select>

        </div>

      </div>
      <footer class="f">
        <div class="cauto"><div data-confirm data-data='{"removefilter": "removefilter"}' class="btn linkDel" ><?php echo T_("Remove filter"); ?></div></div>
        <div class="c"></div>
        <div class="cauto"><button class="btn master"><?php echo T_("Add") ?></button></div>

      </footer>
    </div>
  </form>

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
                <td><?php echo \dash\get::index($value, 'condition_title') ?></td>
                <td><?php echo \dash\get::index($value, 'value') ?></td>
                <td class="collapsing">
                    <div class="linkDel btn" data-confirm data-data='{"remove": "remove", "id" : "<?php echo \dash\get::index($value, 'id') ?>"}'><?php echo T_("Remove") ?></div>
                </td>
              </tr>
            <?php } //endfor ?>
          </tbody>
        </table>
      </div>
    </form>
  <?php } //endif ?>
</div>
