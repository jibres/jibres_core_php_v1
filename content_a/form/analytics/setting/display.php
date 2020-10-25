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

  <form method="post" >
      <input type="hidden" name="addtagtoall" value="addtagtoall">
      <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Add tag to all answer");?></h2></header>
      <div class="body">
        <p><?php echo T_("Your can add tag to all answers");?></p>
          <div class="row mB10">
            <div class="c-xs-6 c-sm-4">
              <div class="radio3">
                <input type="radio" name="type" value="include" checked id="typeinclude">
                <label for="typeinclude"><?php echo T_("Included") ?></label>
              </div>
            </div>
            <div class="c-xs-6 c-sm-4">
              <div class="radio3">
                <input type="radio" name="type" value="notinclude" id="typenotinclude">
                <label for="typenotinclude"><?php echo T_("Not Included") ?></label>
              </div>
            </div>

             <div class="c-xs-6 c-sm-4">
              <div class="radio3">
                <input type="radio" name="type" value="all" id="typeall">
                <label for="typeall"><?php echo T_("All") ?></label>
              </div>
            </div>
          </div>

         <div>
        <div class="row align-center">
          <div class="c"><label for='tag'><?php echo T_("Tag"); ?></label></div>
          <div class="c-auto os"><a class="font-12"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(). '/form/tag'. \dash\request::full_get() ?>"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
        </div>
        <select name="tag" id="tag" class="select22" data-model="tag" data-placeholder="<?php echo T_("Enter new tag or select one tag") ?>">
          <option value="" readonly></option>
          <?php foreach (\dash\data::allTagList() as $key => $value) {?>
            <option value="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></option>
          <?php } //endfor ?>
        </select>
      </div>
      </div>
      <footer class="txtRa">
        <button  class="btn success" ><?php echo T_("Save"); ?></button>
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