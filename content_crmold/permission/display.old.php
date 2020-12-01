<?php
$groupPos = \dash\data::perm_groupPos();
if(!is_array($groupPos))
{
  $groupPos = [];
}



?>

  <table class="tbl1 v1 cbox fs12">
    <thead class="">
      <tr>
        <th><?php echo T_("Permission title"); ?></th>

        <?php foreach (\dash\data::perm_group() as $slug => $myGroup) {?>


        <th title='<?php echo $slug; ?> <?php if(in_array($myGroup, $groupPos)){?> <br><b><?php echo T_("Customized"); ?></b><?php }//endif ?>' class="txtC">
          <a href="<?php echo \dash\url::this(); ?>/add?id=<?php echo $slug; ?>"><?php echo T_(\dash\get::index($myGroup, 'title')); ?>
          <br>
          <small class="badge mT5"><?php echo T_("Edit"); ?></small>
          </a>
        </th>
        <?php } //endfor ?>
      </tr>
    </thead>

    <tbody>
       <tr>
        <td><?php echo T_("Count of user in permission"); ?></td>
        <?php foreach (\dash\data::perm_usercount() as $slug => $count) {?>

        <td  class="txtC">
            <?php if(!$count) {?>

              <div class="badge danger" title='<?php echo T_("Remove this permission if not need"); ?>'><a href="<?php echo \dash\url::this(); ?>/delete?id=<?php echo $slug; ?>"><?php echo T_("No user"); ?></a></div>

            <?php }else{ ?>

              <div class="badge success" title='<?php echo T_("Click to show list of user by this permission"); ?>'>
                <a href="<?php echo \dash\url::here(); ?>/member?permission=<?php echo $slug; ?>"><?php echo \dash\fit::number($count); ?> <?php echo T_("User"); ?></a>
              </div>

            <?php } //endif ?>
        </td>
        <?php } //endfor ?>
      </tr>

      <?php foreach (\dash\data::perm_list() as $content => $allPerms) {?>

        <?php foreach ($allPerms as $cat => $permList) {?>

        <tr class="active">
          <th colspan="<?php echo count(\dash\data::perm_group()) +1; ?>"><span class="badge floatRa"><?php echo T_($content); ?></span> <?php echo T_($cat); ?></th>
        </tr>

        <?php foreach ($permList as $key => $value) {?>

      <tr>
        <td class="txtB" title="<?php echo $key; ?>">

          <?php echo T_($value['title']); ?>

          <?php if(isset($value['check']) && $value['check']) {?>
          <span class="sf-bolt floatRa" data-tippy-placement="bottom" data-tippy-animation="perspective" title='<?php echo T_("Need double check permission for some sensitive permissions"); ?>'></span><?php }//endif ?>
          <?php if(isset($value['verify']) && $value['verify']) {?>
            <span class="sf-chain-broken floatRa" data-tippy-placement="bottom" data-tippy-animation="perspective" title='<?php echo T_("Do hard check and need to enter again"); ?>'></span><?php } // endif ?>
        </td>

        <?php foreach (\dash\data::perm_group() as $groupName => $groupList) {?>


        <td class="txtC">
          <?php if(@in_array($key, $groupList['contain']) || $groupName === 'admin') {?>

          <i class="sf-check fc-green"></i>
          <?php }else{ ?>
          <i class="sf-times fc-red"></i>
          <?php }//endif ?>
        </td>
        <?php }//endfor ?>
      </tr>
      <?php }//endfor ?>
      <?php }//endfor ?>

<?php }//endfor ?>

        <tr>
        <td><?php echo T_("Count of user in permission"); ?></td>
        <?php foreach (\dash\data::perm_usercount() as $slug => $count) {?>

        <td  class="txtC">
            <?php if(!$count) {?>

              <div class="badge danger" title='<?php echo T_("Remove this permission if not need"); ?>'><a href="<?php echo \dash\url::this(); ?>/delete?id=<?php echo $slug; ?>"><?php echo T_("No user"); ?></a></div>

            <?php }else{ ?>

              <div class="badge success" title='<?php echo T_("Click to show list of user by this permission"); ?>'>
                <a href="<?php echo \dash\url::here(); ?>/member?permission=<?php echo $slug; ?>"><?php echo \dash\fit::number($count); ?> <?php echo T_("User"); ?></a>
              </div>

            <?php } //endif ?>
        </td>
        <?php } //endfor ?>
      </tr>

    </tbody>
  </table>
