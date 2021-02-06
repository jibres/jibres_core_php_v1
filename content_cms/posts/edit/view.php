<?php
namespace content_cms\posts\edit;

class view
{
	public static function config()
	{

		$moduleTypeTxt = \dash\data::myType();
		$moduleType    = '';



		$dataRow = \dash\data::dataRow();
		$id = \dash\request::get('id');

		\dash\data::moduleTypeTxt($moduleTypeTxt);
		\dash\data::moduleType($moduleType);

		\dash\face::btnSave('formEditPost');

		\dash\face::btnSetting(\dash\url::this(). '/advance'. \dash\request::full_get());

		if(a($dataRow, 'status') === 'publish')
		{
			\dash\data::postViewLink(\dash\data::dataRow_link());
			\dash\face::btnView(\dash\data::dataRow_link());
		}
		else
		{
			\dash\data::postViewLink(\dash\data::dataRow_link(). '?preview=yes');
			\dash\face::btnPreview(\dash\data::postViewLink());
		}


		$myTitle     = T_("Edit post");
		$myBadgeLink = \dash\url::this(). $moduleType;
		$myBadgeText = T_('Back to list of posts');

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link($myBadgeLink);

		$myTitle = T_('Edit post');

		\dash\face::title($myTitle);

		$cmsSettingSaved = \lib\app\setting\get::cms_setting();
		\dash\data::cmsSettingSaved($cmsSettingSaved);

		$one_gallery_type = null;

		$gallery = a($dataRow, 'gallery_array');

		if(is_array($gallery) && count($gallery) === 1)
		{
			$one_gallery_type = a($gallery, 0, 'type');
		}

		switch (a($dataRow, 'subtype'))
		{
			case 'standard':
				\lib\ratio::data_ratio_html(a($cmsSettingSaved, 'thumbratiostandard'));
				switch ($one_gallery_type)
				{
					case 'image': self::convertPostTo('gallery'); break;
					case 'video': self::convertPostTo('video');	break;
					case 'audio': self::convertPostTo('audio');	break;
					default: /*nothing*/ break;
				}
				break;

			case 'gallery':
				\lib\ratio::data_ratio_html(a($cmsSettingSaved, 'thumbratiogallery'));
				break;

			case 'video':
				\lib\ratio::data_ratio_html(a($cmsSettingSaved, 'thumbratiovideo'));
				break;

			case 'audio':
				\lib\ratio::data_ratio_html(a($cmsSettingSaved, 'thumbratiopodcast'));
				break;

			default:
				# code...
				break;
		}


	}


	private static function convertPostTo($_type)
	{
		$result = '';
		$result .= T_("You can change ths post type to :val", ['val' => T_(ucfirst($_type))]);
		$result .= ' ';
		$result .= '<span class="link" data-title="'.T_("Are you sure to convert this post type to :val", ['val' => T_(ucfirst($_type))]) .'" data-confirm data-data=\'{"forcesubtype": "'.$_type.'"}\'>'. T_("Convert now"). '</span>';
		\dash\data::convertPostTo($result);
	}
}
?>