<form method="post" autocomplete="off" >
  <div class="avand-lg">
    <section class="box">
      <header><h2><?php echo T_("Remove category"); ?></h2></header>
      <div class="body">
        <div class="msg">
          <?php echo T_(":val products by this category founded", ['val' => \dash\fit::number(\dash\data::dataRow_count())]) ?>
        <br>
          <a class="link" href="<?php echo \dash\url::here(); ?>/products?catid=<?php echo \dash\data::dataRow_id(); ?>"><?php echo T_("Show products by this category"); ?></a>
        </div>

        <p>
          <?php echo T_("You can remove this category from all product or change it to another category"); ?>
        </p>

        <div class="row mB10">
          <div class="c-xs-12 c-sm-6">
            <div class="radio3">
              <input type="radio" name="wd" value="wde" id="wde">
              <label for="wde"><?php echo T_("Remove this category from all products") ?></label>
            </div>
          </div>
          <div class="c-xs-12 c-sm-6">
            <div class="radio3">
              <input type="radio" name="wd" value="wdn" id="wdn">
              <label for="wdn"><?php echo T_("Selecte new category") ?></label>
            </div>
          </div>
        </div>

        <div data-response='wd' data-response-where='wdn' data-response-hide>

        <div class="mB10">
          <label for='cat'><?php echo T_("New Category"); ?></label>
           <select name="catid" id="cat" class="select22" data-model="tag" data-placeholder="<?php echo T_("Select one category") ?>">
            <?php if(\dash\request::get('catid')) {?>
              <option value="0"><?php echo T_("None") ?></option>
            <?php }else{?>
              <option value="" readonly></option>
            <?php } //endif ?>
            <?php foreach (\dash\data::listCategory() as $key => $value) {?>
              <?php if($value['id'] === \dash\request::get('id')) {continue;}?>
              <option value="<?php echo $value['id']; ?>" ><?php echo $value['title']; ?></option>
            <?php } //endfor ?>
          </select>
        </div>

        </div>



    </div>
    <footer class="txtRa">
      <button class="btn danger"><?php echo T_("Save change and remove category") ?></button>
    </footer>
  </section>
</div>


</form>
