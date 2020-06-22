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
              <?php echo T_("You can add alot of this feacher") ?>
            </p>
            <form method="post" autocomplete="off">
              <div class="input">
                <input type="text" name="bullet" placeholder="<?php echo T_("Enter your text here ...") ?>">
              </div>
              <div class="txtRa">
                <button class="btn master mTB10 addon" ><?php echo T_("Add"); ?></button>
              </div>
            </form>
            <?php foreach (\dash\data::productDataRow_bullet() as $key => $value) {?>
              <div class="msg">
                <?php echo \dash\get::index($value, 'text') ?>
              </div>
            <?php } //endfor ?>
          </div>
      </section>
  </div>
</div>














