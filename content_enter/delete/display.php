
<div class="f">
	<label><?php echo T_("Why you want to delete your account!?"); ?></label>
	<textarea  name="why" rows="2" maxlength="200"><?php echo \dash\data::getWhy(); ?></textarea>
</div>

<button type="submit" class="btn danger block mT10"><?php echo T_("Delete Account"); ?></button>
