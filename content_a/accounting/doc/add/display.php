<?php require_once('display-doc.php'); ?>

<?php if(\dash\data::dataRow_status() === 'lock') {}else{?>
<?php require_once('display-docdetail.php'); ?>
<?php } //endif ?>

<?php require_once('display-list.php'); ?>

