<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Add category to all product");?></h2></header>
      <div class="body">
        <p><?php echo T_("Your can add category to all products");?></p>
         <div>
        <div class="row align-center">
          <div class="c"><label for='category'><?php echo T_("Tag"); ?></label></div>
          <div class="c-auto os"><a class="font-12"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(); ?>/category"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
        </div>
        <select name="category" id="category" class="select22" data-model="tag" data-placeholder="<?php echo T_("Enter new category or select one category") ?>">
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
</div>

</form>