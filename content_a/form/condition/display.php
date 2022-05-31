<?php $myType = a(\dash\data::itemDetail(), 'type_detail') ?>
<form method="post" autocomplete="off">
  <input type="hidden" name="field" value="<?php echo \dash\request::get('field') ?>">
  <div class="box">
    <header><h2><?php echo \dash\data::filterDetail_title() ?></h2></header>
    <div class="body">
      <div>
        <div class="msg"><?php echo T_("Only questions that have options can be included in the condition") ?></div>
        <select name="question" class="select22">
          <option value="">- <?php echo T_('Select question') ?> -</option>
          <?php foreach (\dash\data::items() as $key => $value) {
            if(!in_array(a($value, 'type'), ['yes_no','single_choice','dropdown','country','province','gender','list_amount',]))
            {
              continue;
            }
            ?>
            <option value="<?php echo $value['id'] ?>"><?php echo $value['title'] ?></option>
          <?php } // endforeach; ?>
        </select>
      </div>

      <?php if(\dash\request::get('item')) {?>

        <label for="condition"><?php echo T_("Condition") ?></label>
        <select class="select22 mb-2" name="condition">
          <option value=""><?php echo T_("Please select on item") ?></option>
          <option value="isnull"><?php echo T_("Not answered") ?></option>
          <option value="isnotnull"><?php echo T_("Answered") ?></option>
          <option value="larger"><?php echo T_("Is larger than") ?></option>
          <option value="less"><?php echo T_("Is less than") ?></option>
          <option value="equal">=</option>
          <option value="notequal">!=</option>
          <option value="like">Like</option>

        </select>

      <?php } //endif ?>



      <div class="mb-2" data-response='condition' data-response-hide data-response-where='equal|notequal|larger|less|like'>
        <label for="value"><?php echo T_("Value") ?></label>
        <select name="value" id="vaue" class="select22" data-model='tag'>
          <option value=""><?php echo T_("Value"); ?></option>
          <?php if(\dash\data::itemDetail_choice() && is_array(\dash\data::itemDetail_choice())) {?>
            <?php foreach (\dash\data::itemDetail_choice() as $key => $value) {?>
              <option value="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></option>
            <?php } //endfor ?>
          <?php } //endif ?>
        </select>
      </div>


    </div>
    <footer class="f">

      <div class="c"></div>
      <div class="cauto"><button class="btn master"><?php echo T_("Add condition") ?></button></div>
    </footer>
  </div>
</form>

