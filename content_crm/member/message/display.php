<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f">
        <div class="key"><?php echo strip_tags(\dash\get::index($value, 'txt')); ?></div>
        <div class="value hide"><?php if(\dash\get::index($value, 'readdate')){ ?><i title="<?php echo T_("Read at :val", ['val' => \dash\fit::date_time($value['readdate'])]); ?>" class="sf-eye fc-green"></i><?php }else{ ?><i class="sf-new-sign fc-hot" title="<?php echo T_("Not readed yet!") ?>"></i><?php } ?></div>
        <div class="value datetime s0"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
        <div class="go detail s0"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>
