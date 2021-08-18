<form method="post" autocomplete="off" data-patch>
    <input type="hidden" name="savehtmltitle" value="1">
    <label for="htmltitle"><?php echo T_("Section title") ?></label>
    <div class="input">
        <input type="text" name="htmltitle" id="htmltitle" value="<?php echo \dash\data::myHtmlTitle() ?>">
    </div>
</form>

<hr>
<h4>Hi Developer</h4>
<div class="jalert">
    You can add some html here
</div>