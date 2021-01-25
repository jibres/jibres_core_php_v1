<section class="f" data-option='crm-ticket-status'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Change status");?></h3>
      <div class="body">
        <p><?php echo T_("You can change ticket status");?></p>
        <?php
if(\dash\data::dataRow_status() === 'close')
{
  echo '<div class="msg minimal info2">'. T_("This ticket is closed");
  echo '</div>';
}
?>
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
?>
    </div>
  </div>

</section>


<section class="f" data-option='crm-ticket-solved'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Change solved status");?></h3>
      <div class="body">
        <p>
<?php
if(\dash\data::dataRow_solved())
{
  echo '<div class="msg minimal success2">'. T_("This ticket is solved"). '<br>';
  echo T_("If your problem is not solved yet, please set this ticket as unsolved");
  echo '</div>';
}
else
{
  echo T_("If your problem is solved, please set this ticket as solved. \n This will help you understand how many of your customers' requests are successfully solved");
}
?>

        </p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
<?php

$solved = \dash\data::dataRow_solved();
$edit_array                         = [];
$edit_array['runaction_editsolved'] = 1;
if($solved)
{
  $edit_array['solved'] = '0';
  $new_solved           = T_("Set as  not solved");
  $btnclass             = 'warn';

}
else
{
  $edit_array['solved'] = '1';
  $new_solved           = T_("Set as solved");
  $btnclass             = 'success';
}

$json = json_encode($edit_array);
echo "<div class='btn ". $btnclass. "' data-ajaxify data-data='". $json . "' data-method='post'>". $new_solved . '</div>';

?>
    </div>
  </div>
</section>




<section class="f" data-option='crm-ticket-remove'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Remove ticket");?></h3>
      <div class="body">
        <p class="fc-red">
          <?php echo T_("Remove ticket with all conversations") ?>
        </p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
      <div data-confirm data-data='{"runaction_editstatus" : 1, "status" : "deleted"}' class="btn danger"><?php echo T_("Remove") ?></div>
    </div>
  </div>
  <footer class="txtRa">
      <div data-confirm data-data='{"runaction_editstatus" : 1, "status" : "spam"}' class="btn linkDel"><?php echo T_("Set as Spam ticket") ?></div>
  </footer>
</section>
