<div class="box">
  <div class="pad">
    <p><?php echo T_("Remove page and all section") ?></p>
    <div class="check1">
      <input type="checkbox" name="readydelete" id="readydelete">
      <label for="readydelete"><?php echo T_("Are you sure to remove this page?"); ?></label>
    </div>
    <div data-response='readydelete' data-response-hide>
      <button data-confirm data-data='{"remove":"page"}' class="btn danger block mT20"><?php echo T_("Remove") ?></button>
    </div>
  </div>
</div>
