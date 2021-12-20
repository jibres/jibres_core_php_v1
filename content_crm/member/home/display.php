<nav class="items mt-2">
  <ul>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::here(); ?>/member/glance?id=<?php echo $value['id']; ?>">
        <img src="<?php echo \dash\fit::img(a($value, 'avatar')); ?>" alt="Avatar - <?php echo a($value, 'displayname'); ?>">
        <div class="key"><?php echo a($value, 'displayname'); ?><?php if($value['permission']) {?> <small class="s0"><?php echo T_(ucfirst($value['permission'])); ?></small><?php } ?></div>
        <div class="value status s0"><?php echo T_($value['status']); ?></div>
<?php if($value['permission']) { ?>
        <div class="go star gold"></div>
<?php } ?>
        <div class="key mobile font-bold"><?php echo \dash\fit::mobile(a($value, 'mobile')); ?></div>
        <div class="value datetime humandate s0"><?php  echo \dash\fit::date_time($value['datecreated']); ?></div>

        <div class="go s0<?php if(isset($value['status']) && in_array($value['status'], ['disable','removed','filter','unreachable'])) { echo ' nok';}else{}?>"></div>
      </a>
     </li>
<?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>
