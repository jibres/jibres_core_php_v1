<?php require_once(root. 'content_a/app/android/pageSteps.php'); ?>
<?php
$introSaved = \dash\data::introSaved();

?>

<div class="f justify-center">
  <div class="c8 m12 s12">
    <div class="cbox">
        <h4><?php echo T_("Intro setting"); ?></h4>
        <div class="mB20">
         <div class="f">
          <div class="vcard shadow mA10 s12">
            <img alt="siftal" src="<?php echo \dash\get::index($introSaved, 1, 'image'); ?>">
            <div class="content">
              <a class="header"><?php echo \dash\get::index($introSaved, 1, 'title'); ?></a>
              <div class="desc"><?php echo \dash\get::index($introSaved, 1, 'desc'); ?></div>
            </div>
            <div class="footer"><?php echo T_("Page"); ?> <?php echo \dash\fit::number(1); ?></div>
          </div>

          <div class="vcard shadow mA10 s12">
            <img alt="siftal" src="<?php echo \dash\get::index($introSaved, 2, 'image'); ?>">
            <div class="content">
              <a class="header"><?php echo \dash\get::index($introSaved, 2, 'title'); ?></a>
              <div class="desc"><?php echo \dash\get::index($introSaved, 2, 'desc'); ?></div>
            </div>
            <div class="footer"><?php echo T_("Page"); ?> <?php echo \dash\fit::number(2); ?></div>
          </div>

          <div class="vcard shadow mA10 s12">
            <img alt="siftal" src="<?php echo \dash\get::index($introSaved, 3, 'image'); ?>">
            <div class="content">
             <a class="header"><?php echo \dash\get::index($introSaved, 3, 'title'); ?></a>
              <div class="desc"><?php echo \dash\get::index($introSaved, 3, 'desc'); ?></div>
            </div>
            <div class="footer"><?php echo T_("Page"); ?> <?php echo \dash\fit::number(3); ?></div>
          </div>
     	</div>
       </div>

      <form method="post" autocomplete="off">

         <h4><?php echo T_("Intro theme"); ?></h4>

        <div class="radio1">
          <input type="radio" name="theme" value="theme1" <?php if(\dash\data::introSaved_theme() == 'theme1') { echo 'checked'; }?>  id="sRdc1">
          <label for="sRdc1">Theme 1</label>
        </div>

        <div class="radio1">
          <input type="radio" name="theme" value="theme2" <?php if(\dash\data::introSaved_theme() == 'theme2') { echo 'checked'; }?>  id="sRdc2">
          <label for="sRdc2">Theme 2</label>
        </div>


        <div class="radio1">
          <input type="radio" name="theme" value="theme3" <?php if(\dash\data::introSaved_theme() == 'theme3') { echo 'checked'; }?>  id="sRdc3">
          <label for="sRdc3">Theme 3</label>
        </div>


        <div class="radio1">
          <input type="radio" name="theme" value="theme4" <?php if(\dash\data::introSaved_theme() == 'theme4') { echo 'checked'; }?>  id="sRdc4">
          <label for="sRdc4">Theme 4</label>
        </div>


        <div class="radio1">
          <input type="radio" name="theme" value="theme5" <?php if(\dash\data::introSaved_theme() == 'theme5') { echo 'checked'; }?>  id="sRdc5">
          <label for="sRdc5">Theme 5</label>
        </div>



         <h4 class="mT20" data-kerkere='.intro1'  data-kerkere-icon='open'><?php echo T_("Edit intro page 1"); ?></h4>
         <div class="intro1" >
         	<label for="title1"><?php echo T_("Title"); ?></label>
         	<div class="input">
         		<input type="text" name="title1" id="title1" value="<?php echo \dash\get::index($introSaved, 1, 'title'); ?>" maxlength="50">
         	</div>

         	<label for="desc1"><?php echo T_("Description"); ?></label>
         	<div class="input">
         		<input type="text" name="desc1" id="desc1" value="<?php echo \dash\get::index($introSaved, 1, 'desc'); ?>" maxlength="100">
         	</div>

         	<label for="file1"><?php echo T_("Image"); ?></label>
         	<div class="input">
         		<input type="file" name="file1" id="file1">
         	</div>
         </div>

         <h4 class="mT20" data-kerkere='.intro2'  data-kerkere-icon='open'><?php echo T_("Edit intro page 2"); ?></h4>
         <div class="intro2" >
         	<label for="title2"><?php echo T_("Title"); ?></label>
         	<div class="input">
         		<input type="text" name="title2" id="title2" value="<?php echo \dash\get::index($introSaved, 2, 'title'); ?>" maxlength="50">
         	</div>

         	<label for="desc2"><?php echo T_("Description"); ?></label>
         	<div class="input">
         		<input type="text" name="desc2" id="desc2" value="<?php echo \dash\get::index($introSaved, 2, 'desc'); ?>" maxlength="100">
         	</div>

         	<label for="file2"><?php echo T_("Image"); ?></label>
         	<div class="input">
         		<input type="file" name="file2" id="file2">
         	</div>
         </div>

         <h4 class="mT20" data-kerkere='.intro3'  data-kerkere-icon='open'><?php echo T_("Edit intro page 3"); ?></h4>
         <div class="intro3" >
         	<label for="title3"><?php echo T_("Title"); ?></label>
         	<div class="input">
         		<input type="text" name="title3" id="title3" value="<?php echo \dash\get::index($introSaved, 3, 'title'); ?>" maxlength="50">
         	</div>

         	<label for="desc3"><?php echo T_("Description"); ?></label>
         	<div class="input">
         		<input type="text" name="desc3" id="desc3" value="<?php echo \dash\get::index($introSaved, 3, 'desc'); ?>" maxlength="100">
         	</div>

         	<label for="file3"><?php echo T_("Image"); ?></label>
         	<div class="input">
         		<input type="file" name="file3" id="file3">
         	</div>
         </div>

         <div class="txtRa">
         	<button class="btn success"><?php echo T_("Save"); ?></button>
         </div>


      </form>
    </div>
  </div>
</div>


