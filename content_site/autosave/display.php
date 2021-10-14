<section class="avand-md">
  <div class="box">
   <div class="body">
      <h2 class="txtB"><?php echo T_("Auto save and publish"); ?></h2>
      <p><?php echo T_('by default we save all changes automatically. if you want to change page and not publish it you must be turn off this feature') ?></p>

      <?php if(\lib\store::detail('force_stop_sitebuilder_auto_save')) {?>
        <p class="bg-red-100 p-5 rounded"><?php echo T_('Auto-save currently disabled') ?></p>
        <div class="btn-success mt-5" data-ajaxify data-data='{"autosave": "enable"}'><?php echo T_("To enable auto-save and publish Click herer") ?></div>

      <?php }else{ ?>
        <p class="bg-green-100 p-5 rounded"><?php echo T_('Auto-save currently enabled') ?></p>
        <div class="btn-danger mt-5" data-confirm data-data='{"autosave": "disable"}'><?php echo T_("To disable auto-save and publish Click herer") ?></div>
      <?php } //endif ?>
   </div>
  </div>
</section>