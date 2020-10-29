<?php

$permissionList = \dash\data::permissionList();
$savedPerm = \dash\data::savedPerm();



if(!is_array($permissionList))
{
	$permissionList = [];
}

?>
<div class="box">
  <div class="body">
    <div class="row">
      <div class="c-xs-auto c-sm-auto">
        <?php echo \dash\data::dataRow_key(); ?>
      </div>

      <div class="c-xs c-sm"></div>

      <div class="c-xs-auto c-sm-auto hide">
        <a class="btn link" href="<?php echo \dash\url::this(). '/user?id='. \dash\request::get('id') ?>"><?php echo T_("Manage users by this permission") ?></a>
      </div>
    </div>
  </div>
</div>


<?php foreach ($permissionList as $key => $value) { ?>
<section class="f" data-option='setting-permission-<?php echo $key; ?>'>
  <div class="c8 s12">
    <div class="data">
        <h3><?php echo \dash\get::index($value, 'title');?></h3>
        <p><?php echo \dash\get::index($value, 'desc') ?></p>

      <?php if(\dash\get::index($savedPerm, $key, 'status')) { ?>

        <?php if(isset($savedPerm[$key]['access']) && $savedPerm[$key]['access'] === 'full') {?>
          <div class="badge mA5 success"><?php echo T_("Full access") ?></div>
        <?php } //endif ?>

        <?php if(isset($savedPerm[$key]['access']) && $savedPerm[$key]['access'] === 'customized') {?>

          <div><?php echo T_("Access to") ?></div>
          <?php if(isset($savedPerm[$key]['allow_access_title'])) { foreach ($savedPerm[$key]['allow_access_title'] as $allow_access_title) {?>
            <span class="badge mA5 light"><?php echo $allow_access_title ?></span>
          <?php } /*endfor*/ } //endif ?>
          <div class="mT10"><?php echo T_("Disallow to") ?></div>
           <?php if(isset($savedPerm[$key]['disallow_access_title'])) { foreach ($savedPerm[$key]['disallow_access_title'] as $disallow_access_title) {?>
            <span class="badge mA5 light fc-red"><?php echo $disallow_access_title ?></span>
          <?php } /*endfor*/ } //endif ?>

        <?php } //endif ?>

      <?php } //endif ?>

    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>

      <div class="action">
        <input type="hidden" name="runaction_<?php echo $key; ?>" value="1">
        <div class="switch1">
          <input type="checkbox" name="<?php echo $key; ?>" id="<?php echo $key; ?>"  <?php if(\dash\get::index($savedPerm, $key, 'status')) { echo 'checked'; } ?>>
          <label for="<?php echo $key; ?>" data-on="<?php echo T_("Access"); ?>" data-off="<?php echo T_("Deny") ?>"></label>
        </div>
      </div>

  </form>
  <footer class="txtRa">
    <a class="btn link" href="<?php echo \dash\url::this(). '/advance?id='. \dash\request::get('id'). '&group='. $key ?>"><?php echo T_("Advance") ?></a>
  </footer>
</section>
<?php } //endfor ?>