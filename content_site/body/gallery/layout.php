<?php
namespace content_site\body\gallery;


class layout
{


	/**
	 * Layout gallery html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{

		$html             = '';

		$image_list = option::gallery_items(a($_args, 'id'));

		if(!is_array($image_list))
		{
			$image_list = [];
		}

		$image_list = self::fill_default($_args, $image_list);

		$image_list = array_values($image_list);

		if(a($_args, 'image_random'))
		{
			shuffle($image_list);
		}

		$type      = a($_args, 'type');

		$namespace = sprintf('%s\%s\%s', __NAMESPACE__, 'html', $type);

		if(is_callable([$namespace, 'html']))
		{
			$html .= call_user_func_array([$namespace, 'html'],[$_args, $image_list]);
		}

		return $html;

	}


	private static function fill_default($_args, $image_list)
	{

		$preview_option =  \content_site\call_function::section_type_preview('gallery', a($_args, 'type'), a($_args, 'preview_key'));

		if(isset($preview_option['options']['image_count']))
		{
			$max = intval($preview_option['options']['image_count']);
		}
		else
		{
			$max = option::maximum_capacity(a($_args, 'type'));
		}

		$our_image = [];
		if(isset($preview_option['options']['image_list']) && is_array($preview_option['options']['image_list']))
		{
			$our_image = $preview_option['options']['image_list'];
		}

		if(empty($image_list))
		{
			$image_list = $our_image;
		}


		foreach ($image_list as $key => $value)
		{
			if(!a($value, 'file'))
			{
				if($our_image)
				{
					$image_list[$key]['file']  = a($our_image, 0, 'file');
					$image_list[$key]['title'] = a($our_image, 0, 'title');

					unset($our_image[0]);
					$our_image = array_values($our_image);
				}
				else
				{
					$image_list[$key]['file']  = \dash\sample\img::image();
					$image_list[$key]['title'] = T_("Image :val", \dash\fit::number($key + 1));
				}
			}
		}

		if(is_numeric($max) && count($image_list) < $max)
		{
			$len = $max - count($image_list);

			for ($i=1; $i <= $len; $i++)
			{
				$image_list[] =
				[
					'title' => T_("Image :val", \dash\fit::number($i)),
					'image'    => \dash\sample\img::image()
				];
			}
		}

		return $image_list;
	}


}
?>