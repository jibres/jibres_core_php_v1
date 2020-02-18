
  <div class="f">
<?php foreach (\dash\data::dataRow() as $key => $value) {?>


    <div class="c5 fs14 mTB5 mLR5">
      <div class="badge warn"><?php echo $key; ?></div>
      <div class="badge primary"><?php echo $value; ?></div>
    </div>

<?php } ?>
  </div>
