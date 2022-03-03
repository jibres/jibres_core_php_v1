<?php $dataRow = \dash\data::dataRow(); ?>


<div class="tblBox font-16">
  <table class="tbl1 v4">
    <thead>
      <tr>
        <th><?php echo T_("Feature") ?></th>
        <th><?php echo T_("Status") ?></th>
        <th><?php echo T_("Added by") ?></th>
        <th><?php echo T_("Datecreated") ?></th>
        <th><?php echo T_("Expire date") ?></th>
        <th><?php echo T_("Package count") ?></th>
        <th><?php echo T_("Remain") ?></th>
        <th><?php echo T_("Date modified") ?></th>
        <th class="collapsing"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::pluginList() as $key => $value) {?>
        <tr>
          <td><?php echo a($value, 'plugin_title') ?></td>
          <td><?php echo T_(a($value, 'tstatus')) ?></td>
          <td><?php echo T_(a($value, 'addedby')) ?></td>
          <td><?php if(a($value, 'datecreated')) {echo \dash\fit::date_time(a($value, 'datecreated'));}else{echo '-';}  ?></td>
          <td><?php if(a($value, 'expiredate')) {echo \dash\fit::date_time(a($value, 'expiredate'));}else{echo '-';}  ?></td>
          <td><?php echo \dash\fit::number(a($value, 'packagecount')) ?></td>
          <td><?php echo \dash\fit::number(a($value, 'remain')) ?></td>
          <td><?php if(a($value, 'datemodified')) {echo \dash\fit::date_time(a($value, 'datemodified'));}else{echo '-';}  ?></td>
          <td class="collapsing">
            <a href="<?php echo \dash\url::this(). '/edit?pid='. a($value, 'id'). '&id='. \dash\request::get('id'); ?>" class="btn-primary"><?php echo T_("Edit") ?></a>
          </td>
        </tr>
      <?php } //endfor ?>
    </tbody>
  </table>
</div>



  <form method="post" autocomplete="off">
    <input type="hidden" name="addplugin" value="1">
    <div class="box">
      <div class="body">
        <label for="plugin"><?php echo T_("Add new plugin to this business") ?></label>
        <div>
          <select class="select22" name="plugin" id="plugin" data-placeholder="<?php echo T_("Please select one item") ?>">
            <option value=""><?php echo T_("Please select one item") ?></option>
            <?php foreach (\dash\data::allplugin() as $key => $value) { ?>

              <option value="<?php echo a($value, 'plugin') ?>" ><?php echo a($value, 'title') ?></option>
            <?php } //endif ?>
          </select>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Add") ?></button>
      </footer>
    </div>
  </form>

