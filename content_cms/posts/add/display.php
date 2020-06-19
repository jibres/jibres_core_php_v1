
<form class="f justify-center" method="post" autocomplete="off">
 <div class="c9 x6 s12 pRa20">
  <div class="cbox mB10">

   <div class="input mB10">
	  <input type="text" name="title" id="title" placeholder='<?php echo T_("Enter title here"); ?> *'  <?php \dash\layout\autofocus::html() ?> required maxlength='200' minlength="1" pattern=".{1,200}">

	</div>


   <textarea class="txt mB10" data-editor id='descInput' name="content" placeholder='<?php echo T_("Write post "); ?>' maxlength='100000' rows="15"></textarea>

   <div class="msg"><?php echo T_("First type main text and save as draft, then complete and publish it."); ?></div>
   <button class="btn success block mT20"><?php echo T_("Save as draft"); ?></button>
  </div>

 </div>
</form>


