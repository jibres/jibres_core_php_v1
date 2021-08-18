<?php
if(\dash\request::get('iframepreview'))
{
	echo \dash\data::myHtmlText();
	return;
}
?>
<form method="post" autocomplete="off"  id="savehtmlform" class="ltr h-1/2 w-full rounded-lg overflow-hidden">
	<input type="hidden" name="savehtml" value="html">
	<pre id="codeEditorLive" data-code-editor="html" data-code-editor-sync="[name='html']" class="h-full"><?php echo htmlentities(\dash\data::myHtmlText()); ?></pre>
	<textarea name="html" class="hide ltr w-full h-full p-5 resize-none mt-5" placeholder="Write yout HTML here ..."><?php echo htmlentities(\dash\data::myHtmlText()); ?></textarea>
</form>


<div class="preview h-1/2 pt-10 rounded-lg">
 <div class="h-full rounded-lg overflow-hidden ring ring-gray-500 shadow-md hover:shadow-lg transition">
	<iframe class="w-full h-full" src="<?php echo \dash\data::myIframePreviewHmtl() ?>"></iframe>
 </div>
</div>
