<?php

$options_list   = \content_site\section\blog\controller::options();
$section_detail = \dash\data::currentSectionDetail();

echo \lib\sitebuilder\options::admin_html($options_list, $section_detail);

HTML_select_blog_tag($section_detail);

echo \lib\sitebuilder\section_tools::remove_hide_html($section_detail);




function HTML_select_blog_tag($section_detail)
{
	$tag_list = \dash\app\terms\get::get_all_tag();

	if(!is_array($tag_list))
	{
		$tag_list = [];
	}

?>
<form method="post" autocomplete="off" id="form1" data-patch>
	<input type="hidden" name="postoption" value="postoption">

		<input type="text" name="limit" data-rangeSlider data-min="1" data-max="100" data-from="4" data-step="2">

	<div class="mB10">
		<label for='tag'><?php echo T_("Special tag"); ?></label>
		<select name="tag_id" id="tag" class="select22"  data-placeholder='<?php echo T_("Select tag"); ?>' >
			<?php if(a($section_detail, 'preview', 'tag_id')) {?><option value="0"><?php echo T_("None") ?></option><?php }else{ ?><option value=""><?php echo T_("Select tag") ?></option><?php } //endif ?>
			<?php foreach ($tag_list as $key => $value) {?>
				<option value="<?php echo a($value, 'id'); ?>"<?php if(a($section_detail, 'preview', 'tag_id') == $value['id']) { echo ' selected'; } ?>><?php echo a($value, 'title'); ?></option>
			<?php } //endfor ?>
		</select>
	</div>
	<div class="mB10">
		<label for='subtype'><?php echo T_("Post template"); ?></label>
		<select class="select22" name="subtype" id="subtype">
			<option value="any" <?php if(a($section_detail, 'preview', 'subtype') == 'any') { echo 'selected'; } ?> ><?php echo T_("Any post"); ?></option>
			<option value="standard" <?php if(a($section_detail, 'preview', 'subtype') == 'standard') { echo 'selected'; } ?> ><?php echo T_("Standard"); ?></option>
			<option value="gallery" <?php if(a($section_detail, 'preview', 'subtype') == 'gallery') { echo 'selected'; } ?> ><?php echo T_("Gallery"); ?></option>
			<option value="video" <?php if(a($section_detail, 'preview', 'subtype') == 'video') { echo 'selected'; } ?> ><?php echo T_("Video"); ?></option>
			<option value="audio" <?php if(a($section_detail, 'preview', 'subtype') == 'audio') { echo 'selected'; } ?> > <?php echo T_("Audio"); ?></option>
		</select>
	</div>
	<div data-response='subtype' data-response-where='video' <?php if(in_array(a($section_detail, 'preview', 'subtype'), ['video'])){}else{ echo 'data-response-hide';} ?>>
		<div class="mB10">
			<label for='play_item'><?php echo T_("Show item in player"); ?></label>
			<select class="select22" name="play_item" id="play_item">
				<option value="none" <?php if(a($section_detail, 'preview', 'play_item') == 'none') { echo 'selected'; } ?> ><?php echo T_("None"); ?></option>
				<option value="first" <?php if(a($section_detail, 'preview', 'play_item') == 'first') { echo 'selected'; } ?> ><?php echo T_("First"); ?></option>
				<option value="all" <?php if(a($section_detail, 'preview', 'play_item') == 'all') { echo 'selected'; } ?> ><?php echo T_("All"); ?></option>
			</select>
		</div>
	</div>
</form>
<?php } // endfunction ?>