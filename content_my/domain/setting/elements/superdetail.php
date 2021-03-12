<?php if(\dash\permission::supervisor()) {?>


<section class="f" data-option='domain-detail'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("IRNIC status") ?></h3>
      <div class="body">
        <?php if(\dash\data::domainDetail_lastfetch()) {?>
        <p><?php echo T_("Last fetch") ?> <time class="compact"><?php echo \dash\fit::date_time(\dash\data::domainDetail_lastfetch()); ?></time></p>
      <?php } //endif ?>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
      <div class="btn secondary" data-confirm data-data='{"clean" : "lastfetch"}'><?php echo T_("Clean domain fetch") ?></div>
    </div>
  </div>
  <table class="tbl1 minimal">
    <thead>
      <tr>
        <th><?php echo T_("Status"); ?></th>
        <th><?php echo T_("Translate"); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(\dash\data::domainDetail_nicstatus_array()) {?>
        <?php foreach (\dash\data::domainDetail_nicstatus_array() as $key => $value) {?>
          <tr>
            <td><?php echo $value ?></td>
            <td><?php echo T_($value) ?></td>
          </tr>
        <?php } //endif ?>
      <?php } //endif ?>
    </tbody>
  </table>
</section>
<?php } // endif ?>