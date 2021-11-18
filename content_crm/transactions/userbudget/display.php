<nav class="items">
  <ul>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::here(); ?>/member/glance?id=<?php echo $value['id']; ?>">
        <img src="<?php echo \dash\fit::img(a($value, 'avatar')); ?>" alt="Avatar - <?php echo a($value, 'displayname'); ?>">
        <div class="key"><?php echo a($value, 'displayname'); ?><?php if($value['permission']) {?><span class="badge success mLa10 s0"><?php echo T_(ucfirst($value['permission'])); ?></span><?php } ?></div>
<?php if($value['permission']) { ?>
        <div class="go star gold"></div>
<?php } ?>
        <div class="key mobile font-bold"><?php echo \dash\fit::mobile(a($value, 'mobile')); ?></div>
        <div class="value datetime humandate"><?php  echo \dash\fit::number(a($value, 'budget')); ?></div>

        <div class="go s0<?php if(isset($value['status']) && in_array($value['status'], ['disable','removed','filter','unreachable'])) { echo ' nok';}else{}?>"></div>
      </a>
     </li>
<?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>
