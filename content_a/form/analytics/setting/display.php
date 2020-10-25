<?php require_once(root. 'content_a/form/analytics/pageStep.php'); ?>
<div class="avand-md">
  <form method="post" autocomplete="off" >
    <div class="box">
      <div class="body">
        <div class="msg f">
          <div class="cauto"><?php echo T_("Export filter data") ?></div>
          <div class="c"></div>
          <div class="cauto"><a href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['export' => 'export']); ?>" target="_blank" class="btn master" ><?php echo T_("Export now") ?></a></div>
        </div>

        <div class="msg f">
          <div class="cauto"><?php echo T_("Print all data") ?></div>
          <div class="c"></div>
          <div class="cauto"><a href="<?php echo \dash\url::that(). '/answer?'. \dash\request::fix_get(['printall' => 1]); ?>" target="_blank" class="btn success" ><?php echo T_("Print") ?></a></div>
        </div>

        <div class="msg">
          <div data-kerkere-icon data-kerkere='.showField' class="btn link"><?php echo T_("You can customize visible field") ?></div>
        </div>
        <div data-kerkere-content="hide" class="showField">

          <?php if(\dash\data::fields()) {?>
            <div class="pA10">

              <?php foreach (\dash\data::fields() as $key => $value) { if($value['field'] === 'f_answer_id') {continue;} ?>
              <div class="check1">
                <input type="checkbox" name="<?php echo $value['field'] ?>" value="<?php echo $value['field'] ?>" id="<?php echo $value['field'] ?>" <?php if(isset($value['visible']) && $value['visible']) { echo 'checked';} ?>>
                <label for="<?php echo $value['field'] ?>"><?php echo $value['title'] ?></label>
              </div>
            <?php } //endif ?>
          </div>
        <?php } //endif ?>
      </div>

    </div>
    <footer class="txtRa">
      <button class="btn master"><?php echo T_("Save") ?></button>

    </footer>
  </div>
</form>




<div class="box">
  <div class="body">
    <div class="fc-red"><?php echo T_("Remove this filter. All condition of this filter will be removed") ?></div>
  </div>
  <footer class="txtRa">
    <div data-confirm data-data='{"removefilter": "removefilter"}' class="btn linkDel" ><?php echo T_("Remove filter"); ?></div>

  </footer>
</div>

</div>