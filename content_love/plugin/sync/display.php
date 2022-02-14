
<?php $dataRow = \dash\data::pluginDataRow(); ?>
<div class="avand">


  <form method="post" autocomplete="off">
    <input type="hidden" name="sync" value="sync">
    <div class="box">
      <div class="body">
        <h1><?php echo a($dataRow, 'plugin_title') ?></h1>
        <h2><?php echo T_("Send sync request to all business") ?></h2>


      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Send") ?></button>
      </footer>
    </div>
  </form>


</div>