<?php
$propertyList = \dash\data::propertyList();
require_once(root. 'content_a/products/productName.php');
?>

<div class="avand-xl">

  <div class="jPage" >



        <section class="jbox">
          <header><h2><?php echo T_("Share text"); ?></h2></header>
          <div class="pad jboxProperty">


            <form method="post" autocomplete="off">

               <textarea name="sharetext"  class="txt" rows="6" maxlength="2000" data-placeholder='<?php echo T_("Share text"); ?>'><?php echo a(\dash\data::productDataRow(),'sharetext'); ?></textarea>

              <div class="txtRa">

                <button class="btn master mt-2" ><?php echo T_("Save"); ?></button>
              </div>
            </form>

          </div>
      </section>

  </div>
</div>














