<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center">
        <div class="key">
          <?php echo a($value, 'title'); ?>
        </div>

        <div class="value datetime s0"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
        <div class="go detail s0"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>
