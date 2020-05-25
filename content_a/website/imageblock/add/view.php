<?php
namespace content_a\website\imageblock\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add imageblock page'));


		if(\dash\data::imageblockID())
		{
			\dash\face::btnSetting(\dash\url::this(). '/imageblock/setting?id='. \dash\data::imageblockID());


			if(\dash\data::lineSetting_imageblock() && is_array(\dash\data::lineSetting_imageblock()))
			{
				// back
				\dash\data::back_text(T_('Slider list'));
				\dash\data::back_link(\dash\url::that(). '?id='. \dash\data::imageblockID());

			}
			else
			{
				// back
				\dash\data::back_text(T_('Website body'));
				\dash\data::back_link(\dash\url::this(). '/body');
			}
		}
		else
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this(). '/body');
			\dash\face::btnSetting(\dash\url::this(). '/imageblock/setting');
		}

		$ratio = \lib\app\website\body\line\imageblock::ratio(\dash\data::lineSetting());
		$ratioHtml = '';
		if(isset($ratio['ratio']))
		{
			$ratioHtml .= 'data-ratio="'. $ratio['ratio']. '" ';
		}

		if(isset($ratio['min_w']))
		{
			$ratioHtml .= 'data-min-w="'. $ratio['min_w']. '" ';
		}

		if(isset($ratio['min_h']))
		{
			$ratioHtml .= 'data-min-h="'. $ratio['min_h']. '" ';
		}

		if(isset($ratio['max_w']))
		{
			$ratioHtml .= 'data-max-w="'. $ratio['max_w']. '" ';
		}

		if(isset($ratio['max_h']))
		{
			$ratioHtml .= 'data-max-h="'. $ratio['max_h']. '" ';
		}

		\dash\data::ratioHtml($ratioHtml);


		if(\dash\data::lineSetting_imageblock() && is_array(\dash\data::lineSetting_imageblock()))
		{
			$imageblock = \dash\data::lineSetting_imageblock();
			foreach ($imageblock as $key => $value)
			{
				$imageblock[$key]['edit_link'] = \dash\url::this(). '/imageblock/edit?id='. \dash\data::imageblockID(). '&index='. $key;
			}

			// $imageblock[] =
			// [
			// 	'image'  => \dash\url::icon(),
			// 	'edit_link'    => \dash\url::this(). '/imageblock/add?id='. \dash\data::imageblockID(),
			// 	'alt'    => null,
			// 	'sort'   => null,
			// 	'target' => null,
			// 	'mod'    => 'add',
			// ];

			\dash\data::lineSetting_imageblock($imageblock);
		}
	}
}
?>
