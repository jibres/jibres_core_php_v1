<?php $myType = \dash\get::index(\dash\data::itemDetail(), 'type_detail') ?>
  <form method="post" autocomplete="off">
    <input type="hidden" name="field" value="<?php echo \dash\request::get('field') ?>">
    <div class="box">
      <header><h2><?php echo \dash\data::filterDetail_title() ?></h2></header>
      <div class="body">
        <div class="msg f">
            <div class="cauto"><?php echo \dash\data::itemDetail_title(); ?></div>
            <div class="c"></div>
            <div class="cauto"><?php echo $myType['title']; ?></div>
          </div>

        <label for="condition"><?php echo T_("Operator") ?></label>
        <select class="select22 mB10" name="condition">
          <option value=""><?php echo T_("Please select on item") ?></option>
          <option value="isnull"><?php echo T_("Not answered") ?></option>
          <option value="isnotnull"><?php echo T_("Answered") ?></option>
          <option value="larger"><?php echo T_("Is larger than") ?></option>
          <option value="less"><?php echo T_("Is less than") ?></option>
          <option value="equal">=</option>
          <option value="notequal">!=</option>

        </select>

        <div data-response='condition' data-response-hide data-response-where='larger|less' data-response-effect='slide'>
          <label for="value"><?php echo T_("Value") ?></label>
          <div class="input">
            <input type="text" name="value" >
          </div>
        </div>


        <div data-response='condition' data-response-hide data-response-where='equal|notequal' data-response-effect='slide'>
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
        <div class="cauto"><button class="btn master"><?php echo T_("Next") ?></button></div>
      </footer>
    </div>
  </form>

