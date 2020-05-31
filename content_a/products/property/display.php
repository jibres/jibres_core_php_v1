<?php
$propertyList = \dash\data::propertyList();
?>

<div class="avand-xl">

  <div class="jPage" >



        <section class="jbox">
          <header><h2><?php echo T_("Property"); ?></h2></header>
          <div class="pad jboxProperty">


            <form method="post" autocomplete="off">

              <p class="msg"><?php echo T_("Set product property"); ?></p>

              <table class="tbl1 v4">


              <?php foreach ($propertyList as $value) {?>
                <?php $rand_key = rand(1, 9999); ?>
                <tr>
                  <td>
                    <div class="input">
                      <input type="text" name="cat_<?php echo $rand_key; ?>" placeholder='<?php echo T_("Group"); ?>' value="<?php echo \dash\get::index($value, 'cat'); ?>">
                    </div>
                  </td>
                  <td>
                    <div class="input">
                      <input type="text" name="key_<?php echo $rand_key; ?>" placeholder='<?php echo T_("Type"); ?>' value="<?php echo \dash\get::index($value, 'key') ?>">
                    </div>
                  </td>
                  <td>
                    <div class="input">
                      <input type="text" name="value_<?php echo $rand_key; ?>" placeholder='<?php echo T_("Value"); ?>' value="<?php echo \dash\get::index($value, 'value') ?>">
                    </div>
                  </td>
                </tr>
              <?php } //endfor ?>
              </table>

              <div class="txtRa">

                <button class="btn master mB10" ><?php echo T_("Save"); ?></button>
              </div>
            </form>

          </div>
      </section>

  </div>
</div>














