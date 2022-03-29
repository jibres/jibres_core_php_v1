<?php require_once(root. 'content_crm/member/userDetail.php'); ?>

<?php
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}
foreach ($dataTable as $key => $row) {
  ?>
  <div class="box">
    <div class="pad">
      <div class="panel">
        <div class="f align-center pad">
          <div class="cauto s5 pRa10">
            <div class="device72" data-device='<?php echo \dash\str::mb_strtolower(a($row, 'os')); ?>'></div>
          </div>
          <div class="pA5 c s7">
            <div class="mB5"><b><?php echo a($row, 'osName'); ?></b> <?php echo \dash\fit::number(a($row, 'osVer')); ?></div>
            <div class="fc-mute ltr compact text-sm"><?php  echo \dash\fit::date_time(a($row, 'datecreated')) ?></div>
            <?php if(isset($row['current_session']) && $row['current_session']) {?>
              <div class="badge success"><?php echo T_("This device"); ?></div>
            <?php }//endif ?>

          </div>
          <div class="pA5 c s12 fs08">
            <div class="mb-2"><b><?php echo a($row, 'browser'); ?></b> <?php echo \dash\fit::number(a($row, 'browserVer')); ?></div>
            <div><?php echo \dash\fit::date_human(a($row, 'last')); ?></div>
          </div>
          <div class="pA5 c3 s12">
            <div class="mB5">
              <a target="_blank" href="https://ipgeolocation.io/ip-location/<?php echo a($row, 'ip'); ?>" title='<?php echo T_("Check ip address"); ?>'><?php echo a($row, 'ip'); ?></a>
            </div>
            <div>
              <a class="badge danger" data-confirm data-data='{"id" : "<?php echo a($row, 'id'); ?>", "type": "terminate" <?php echo \dash\csrf::get_json(); ?>  }'><?php echo T_("Terminate"); ?></a>
            </div>
          </div>
          <?php if(\dash\permission::supervisor()) {?>
            <div class="c12 fs05 pA5 ovh"><?php echo a($row, 'agent'); ?></div>
          <?php } //endif ?>
        </div>
      </div>
    </div>
  </div>
<?php } //endfor ?>
