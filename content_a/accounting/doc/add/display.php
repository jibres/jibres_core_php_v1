<?php require_once('display-doc.php'); ?>

<?php if(\dash\data::dataRow_status() === 'lock' || \dash\data::dataRow_status() === 'deleted') {}else{?>
<?php require_once('display-docdetail.php'); ?>
<?php } //endif ?>

<?php require_once('display-list.php'); ?>

