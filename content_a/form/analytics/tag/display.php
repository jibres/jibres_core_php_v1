<?php require_once(root. 'content_a/form/analytics/pageStep.php'); ?>
<div class="avand-md">


  <form method="post" >
      <input type="hidden" name="addtagtoall" value="addtagtoall">
      <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Add tag to all answer");?></h2></header>
      <div class="body">
        <p><?php echo T_("Your can add tag to all answers");?></p>
          <div class="row mB10">
            <div class="c-xs-6 c-sm-6">
              <div class="radio3">
                <input type="radio" name="type" value="include" checked id="typeinclude">
                <label for="typeinclude"><?php echo T_("Included") ?></label>
              </div>
            </div>
            <div class="c-xs-6 c-sm-6">
              <div class="radio3">
                <input type="radio" name="type" value="notinclude" id="typenotinclude">
                <label for="typenotinclude"><?php echo T_("Not Included") ?></label>
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


</div>