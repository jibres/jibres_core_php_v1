<section class="avand-md">
  <div class="box">
   <div class="body">
      <h2 class="font-bold text-xl"><?php echo T_("Auto save and publish"); ?></h2>

      <p><?php echo T_("By default, all your changes are automatically saved and published"); ?></p>
      <p><?php echo T_("You can disable this feature and manually publish your changes"); ?></p>
      <p><?php echo T_("If your changes have not been published, only you can see them on Site Builder and your customers will see the previous version of the changes."); ?></p>
      <p><?php echo T_("Turn off this feature if you want to see the changes yourself first and publish them whenever you want"); ?></p>
      <p><?php echo T_("Note that if you are using the HTML section, you must continue to click the save button on that page"); ?></p>

      <div class="text-center mt-3">
        <?php if(\lib\store::detail('force_stop_sitebuilder_auto_save')) {?>
          <p class="bg-red-100 p-5 rounded"><?php echo T_('Auto-save currently disabled') ?></p>
          <div class="btn-success mt-5" data-ajaxify data-data='{"autosave": "enable"}'><?php echo T_("To enable auto-save and publish Click herer") ?></div>

        <?php }else{ ?>
          <p class="bg-green-100 p-5 rounded"><?php echo T_('Auto-save currently enabled') ?></p>
          <div class="btn-outline-danger mt-5" data-confirm data-data='{"autosave": "disable"}'><?php echo T_("To disable auto-save and publish Click herer") ?></div>
        <?php } //endif ?>
      </div>
   </div>
  </div>
</section>