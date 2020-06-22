<?php
$propertyList = \dash\data::propertyList();
?>

<div class="avand-xl">

  <div class="jPage" >



        <section class="jbox">
          <header><h2><?php echo T_("Description"); ?></h2></header>
          <div class="pad jboxProperty">


            <form method="post" autocomplete="off">

               <textarea name="desc" data-editor class="txt" rows="6" maxlength="2000" data-placeholder='<?php echo T_("Description"); ?>'><?php echo \dash\get::index(\dash\data::productDataRow(),'desc'); ?></textarea>

              <div class="txtRa">

                <button class="btn master mT10" ><?php echo T_("Save"); ?></button>
              </div>
            </form>

          </div>
      </section>

  </div>
</div>














