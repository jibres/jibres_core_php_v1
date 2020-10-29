<?php
$myGroup        = \dash\request::get('group');
$permissionList = \dash\data::permissionList();
$savedPerm      = \dash\data::savedPerm();
$advancePerm    = \dash\data::advancePerm();

if(!is_array($advancePerm))
{
  $advancePerm = [];
}

if(isset($advancePerm['advance']) && is_array($advancePerm['advance']))
{
  $advancePerm = $advancePerm['advance'];
}
else
{
  $advancePerm = [];
}

$status = false;
if(isset($savedPerm[$myGroup]['status']) && $savedPerm[$myGroup]['status'])
{
  $status = $savedPerm[$myGroup]['status'];
}


$full = false;
if(isset($savedPerm[$myGroup]['access']) && $savedPerm[$myGroup]['access'] === 'full')
{
  $full = true;
}

$saveAdvance = [];
if(isset($savedPerm[$myGroup]['contain']) && is_array($savedPerm[$myGroup]['contain']))
{
  $saveAdvance = $savedPerm[$myGroup]['contain'];
}

if(!is_array($permissionList))
{
  $permissionList = [];
}
?>

<div class="box">
  <div class="pad">
    <?php echo \dash\data::dataRow_key(); ?>
  </div>
</div>

<section class="f" data-option='setting-permission-<?php echo $myGroup; ?>'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo \dash\get::index($permissionList, $myGroup, 'title');?></h3>
      <div class="body">
        <p><?php echo \dash\get::index($permissionList, $myGroup, 'desc') ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
      <div class="action">
        <input type="hidden" name="runaction_<?php echo $myGroup; ?>" value="1">
        <div class="switch1">
          <input type="checkbox" name="<?php echo $myGroup; ?>" id="<?php echo $myGroup; ?>"  <?php if(\dash\get::index($savedPerm, $myGroup, 'status')) { echo 'checked'; } ?>>
          <label for="<?php echo $myGroup; ?>" data-on="<?php echo T_("Access"); ?>" data-off="<?php echo T_("Deny") ?>"></label>
        </div>
      </div>
  </form>
</section>



<form method="post">
  <input type="hidden" name="advance" value="advance">
  <div class="box">
    <div class="body">
      <div class="row">
        <?php foreach ($advancePerm as $key => $value) {?>
          <div class="c-xs-12 c-sm-6 c-md-4">
              <div class="check1">
                <input type="checkbox" name="c_<?php echo $value['caller'] ?>" id="<?php echo $value['caller'] ?>" <?php if(in_array($value['caller'], $saveAdvance) || $full) {echo 'checked';} if(!$status) { echo ' disabled readonly ';} ?>>
                <label for="<?php echo $value['caller'] ?>"><?php echo $value['title'] ?></label>
              </div>
          </div>
        <?php } //endfor ?>
      </div>
    </div>
    <footer class="txtRa">
      <button class="btn master" <?php if(!$status) { echo ' disabled readonly ';} ?>><?php echo T_("Save") ?></button>
    </footer>
</div>
</form>

