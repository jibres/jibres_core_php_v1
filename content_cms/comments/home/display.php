<nav class="items">
  <ul>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href2="<?php echo \dash\url::this(); ?>/edit?id=<?php echo $value['id']; ?>">
        <img src="<?php echo a($value, 'avatar'); ?>" alt="Avatar - <?php echo a($value, 'displayname'); ?>">
        <div class="key"><?php echo substr(a($value, 'content'), 0, 70); ?></div>
        <div class="value status s0"><?php echo T_($value['status']); ?></div>
<?php if($value['status'] === 'approved') { ?>
        <div class="go star gold"></div>
<?php } ?>
        <div class="value datetime humandate s0"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
        <div class="go <?php if(isset($value['status']) && in_array($value['status'], ['span','deleted','unapproved'])) { echo ' nok';}else{}?>"></div>
      </a>
     </li>
<?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>