<form method="post" autocomplete="off" id="savehtmlform">
	<input type="hidden" name="savehtml" value="html">
	<button class="jbtn btn-primary">Save</button>
	<textarea name="html" class="ltr w-full p-5"  placeholder="Write yout HTML here ..." style="height: 90vh!important; max-height: 70%!important; border: 3px solid #eeeeee;"><?php echo htmlentities(\dash\data::myHtmlText()); ?></textarea>
</form>