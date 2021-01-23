<section class="f" data-option='crm-ticket-status'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Change status");?></h3>
      <div class="body">
        <p><?php echo T_("You can change ticket status");?></p>
        <div class="msg">
          <?php echo T_("Current Status") ?> <b><?php echo T_(\dash\data::dataRow_status()) ?></b>
        </div>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
<?php

$status = \dash\data::dataRow_status();
$edit_array                         = [];
$edit_array['runaction_editstatus'] = 1;

if($status === 'awaiting' || $status === 'answered')
{
  $edit_array['status'] = 'close';
  $new_status           = T_("Close ticket");
  $btnclass             = 'secondary';
}
elseif($status === 'close')
{
  $edit_array['status'] = 'awaiting';
  $new_status           = T_("Reopen ticket");
  $btnclass             = 'success';
}
else
{
  $edit_array['status'] = 'close';
  $new_status           = T_("Close ticket");
  $btnclass             = 'secondary';
}

$json = json_encode($edit_array);
echo "<div class='btn ". $btnclass. "' data-ajaxify data-data='". $json . "' data-method='post'>". $new_status . '</div>';

$spam = null;
if($status === 'close')
{
  $edit_array['status'] = 'spam';
  $json                 = json_encode($edit_array);
  $spam                 = "<div class='btn linkDel' data-ajaxify data-data='". $json . "' data-method='post'>". T_("Spam") . '</div>';
}

$edit_array['status'] = 'deleted';
$json                 = json_encode($edit_array);
$deleted              = "<div class='btn linkDel' data-confirm data-data='". $json . "' data-method='post'>". T_("Delete") . '</div>';

?>
    </div>
  </div>
  <footer class="f">
    <div class="cauto"><?php echo $spam ?></div>
    <div class="c"></div>
    <div class="cauto"><?php echo $deleted ?></div>
  </footer>
</section>
