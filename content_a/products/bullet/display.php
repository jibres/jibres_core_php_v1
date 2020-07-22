<?php
$propertyList = \dash\data::propertyList();
?>

<div class="avand-xl">
  <div class="jPage" >
        <section class="jbox">
          <header><h2><?php echo T_("Set product feacher bullet"); ?></h2></header>
          <div class="pad jboxProperty">
            <p>
              <?php echo T_("The main features are those that are very prominent and affect the user's choice") ?>
              <br>
              <?php echo T_("You can add a lot of this feature") ?>
            </p>
            <form method="post" autocomplete="off">
              <div class="input">
                <input type="text" name="bullet" placeholder="<?php echo T_("Enter your text here ...") ?>" value="<?php echo \dash\data::dataRow_text(); ?>">
              </div>
              <div class="txtRa">
                <button class="btn master mTB10 addon" ><?php if(\dash\data::editMode()) {echo T_("Edit"); }else{ echo T_("Add");} ?></button>
              </div>
            </form>
            <?php foreach (\dash\data::productDataRow_bullet() as $key => $value) {?>
              <div class="msg f">
                <div class="c"><?php echo \dash\get::index($value, 'text') ?></div>
                <div class="cauto">
                  <a class="btn link" href="<?php echo \dash\url::this() . '/bullet?id='. \dash\request::get('id'). '&index='. $key; ?>"><?php echo T_("Edit"); ?></a>
                  <span data-confirm data-data='{"type": "remove", "index": "<?php echo $key ?>"}' class="linkDel"><?php echo T_("Remove") ?></span>
                </div>

              </div>
            <?php } //endfor ?>
          </div>
      </section>
  </div>
</div>














