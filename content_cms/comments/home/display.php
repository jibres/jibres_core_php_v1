
<?php
$sortLink = \dash\data::sortLink();
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}

?>
  <table class="tbl1 v1 cbox fs12">
    <thead>
      <tr>
        <th data-sort="<?php echo a($sortLink, 'author', 'order') ; ?>"><a href="<?php echo a($sortLink, 'author', 'link') ; ?>"><?php echo T_("Author"); ?></a></th>
        <th class="s0"><?php echo T_("Detail"); ?></th>
        <th data-sort="<?php echo a($sortLink, 'content', 'order') ; ?>"><a href="<?php echo a($sortLink, 'content', 'link') ; ?>"><?php echo T_("Comment"); ?></a></th>
        <th class="s0" data-sort="<?php echo a($sortLink, 'status', 'order') ; ?>"><a href="<?php echo a($sortLink, 'status', 'link') ; ?>"><?php echo T_("Status"); ?></a></th>
        <th class="m0 s0" data-sort="<?php echo a($sortLink, 'datecreated', 'order') ; ?>"><a href="<?php echo a($sortLink, 'datecreated', 'link') ; ?>"><?php echo T_("Date"); ?></a></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>

<?php
  $statusClass = '';
  if(isset($value['status']))
  {
    switch ($value['status'])
    {
      case 'deleted' : $statusClass    = 'negative'; break;
      case 'awaiting' : $statusClass   = 'active'; break;
      case 'unapproved' : $statusClass = 'warning'; break;
    }
  }
?>



      <tr class="<?php echo $statusClass; ?> <?php echo a($value, 'status'); ?>">
        <td class="collapsing sauto">
          <?php if(isset($value['avatar']) && $value['avatar']) {?>
            <img src="<?php echo $value['avatar']; ?>" class="avatar">
          <?php } //endif ?>


          <?php if(isset($value['user_id']) && $value['user_id']) {?>

          <a href="<?php echo \dash\url::kingdom(); ?>/crm/member/glance?id=<?php echo $value['user_id']; ?>">
            <span class="sf-user fc-mute"></span>
            <?php if(isset($value['author']) && $value['author']) { echo $value['author']; } else {?><small class='fc-mute'><?php echo T_("Without name"); ?></small><?php } //endif ?>
          </a>

          <?php }else{ ?>


            <span class="sf-chain-broken fc-mute"></span>
            <?php if(isset($value['author']) && $value['author']) { echo $value['author']; } else {?><small class='fc-mute'><?php echo T_("Without name"); ?></small><?php } //endif ?>

          <?php } //endif ?>

        </td>
        <td class="collapsing s0">
          <?php if(isset($value['mobile']) && $value['mobile']) {?><a class="sf-phone-square" href='tel:<?php echo $value['mobile']; ?>' title='<?php echo $value['mobile']; ?>'></a>
            <a class="sf-mobile" href='<?php echo \dash\url::here(); ?>/sms/send?mobile=<?php echo $value['mobile']; ?>' title='<?php echo $value['mobile']; ?>'></a><?php } //endif ?>
          <?php if(isset($value['url']) && $value['url']) {?><a class="sf-globe" href='<?php echo $value['url']; ?>' title='<?php echo $value['url']; ?>'></a><?php } //endif ?>
          <?php if(isset($value['email']) && $value['email']) {?><a class="sf-envelope" href='mailto:<?php echo $value['email']; ?>' title='<?php echo $value['email']; ?>'></a><?php } //endif ?>

        </td>
        <td>

          <?php if(isset($value['post_title']) && $value['post_title']) {?>

          <div class="badge light"><a href="<?php echo \dash\url::kingdom(); ?>/n/<?php echo a($value, 'post_id'); ?>"><?php echo $value['post_title']; ?></a></div>

          <?php } //endfi ?>

          <p><?php echo a($value, 'content'); ?></p>

          <div class="rowAction floatRa">
            <a class="mRa5 fc-green" href="<?php echo \dash\url::pwd(); ?>" data-ajaxify data-method='post' data-data='{"id":"<?php echo a($value, 'id'); ?>", "status":"approved"}'><?php echo T_("Approve"); ?></a>
            <a class="mRa5 fc-mute" href="<?php echo \dash\url::this(); ?>/edit?id=<?php echo a($value, 'id'); ?>"><?php echo T_("Edit"); ?></a>
            <a class="mRa5 fc-black" href="<?php echo \dash\url::pwd(); ?>" data-ajaxify data-method='post' data-data='{"id":"<?php echo a($value, 'id'); ?>", "status":"unapproved"}'><?php echo T_("Unapprove"); ?></a>
            <a class="mRa5 fc-red" href="<?php echo \dash\url::pwd(); ?>" data-ajaxify data-method='post' data-data='{"id":"<?php echo a($value, 'id'); ?>", "status":"deleted"}'><?php echo T_("Trash"); ?></a>
            <a class="mRa5 fc-red" href="<?php echo \dash\url::pwd(); ?>" data-ajaxify data-method='post' data-data='{"id":"<?php echo a($value, 'id'); ?>", "status":"spam"}'><?php echo T_("Spam"); ?></a>
          </div>
        </td>
        <td class="collapsing s0" ><?php echo T_(ucfirst(a($value, 'status'))); ?></td>
        <td class="collapsing s0 m0" ><?php echo \dash\fit::date(a($value, 'datecreated')); ?></td>
      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>
