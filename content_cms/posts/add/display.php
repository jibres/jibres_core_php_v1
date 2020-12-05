<div class="avand-md">
	<form method="post" autocomplete="off">
		<div class="box">
			<div class="body">
				<div class="input mB10">
					<input type="text" name="title" id="title" placeholder='<?php echo T_("Enter title here"); ?> *'  <?php \dash\layout\autofocus::html() ?> required maxlength='200' minlength="1" pattern=".{1,200}">
				</div>
				<textarea class="txt" data-editor id='descInput' name="content" placeholder='<?php echo T_("Write your post ..."); ?>' maxlength='100000' rows="15"></textarea>
				<p class="fc-mute mT10 mB0-f"><?php echo T_("First type main text and save as draft, then complete and publish it."); ?></p>
			</div>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Save as draft"); ?></button>
			</footer>
		</div>
	</form>
</div>
