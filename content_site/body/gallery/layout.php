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

		$image_list = option::gallery_items(a($_args, 'id'), a($_args, 'preview_mode'));

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

		return \content_site\call_function::final_html(__NAMESPACE__, a($_args, 'model'), $_args, $image_list);

	}


	private static function fill_default($_args, $image_list)
	{

		$preview_option =  \content_site\call_function::section_model_preview('gallery', a($_args, 'model'), a($_args, 'preview_key'));

		if(isset($preview_option['options']['image_count']))
		{
			$max = intval($preview_option['options']['image_count']);
		}
		else
		{
			$max = option::maximum_capacity(a($_args, 'model'));
		}

		if($image_list && is_array($image_list))
		{
			$max = count($image_list);
		}

		$our_image = [];
		if(isset($preview_option['options']['image_list']) && is_array($preview_option['options']['image_list']))
		{
			$our_image = $preview_option['options']['image_list'];
		}

		// // clean current image list
		// foreach ($image_list as $key => $value)
		// {
		// 	if(!a($value, 'file'))
		// 	{
		// 		unset($image_list[$key]);
		// 	}
		// }

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
					$image_list[$key]['title'] = T_("Image :val", ['val' => \dash\fit::number($key + 1)]);
				}
			}

			$image_list[$key]['file_detail'] = \lib\filepath::get_detail($value['file']);
			$image_list[$key]['thumb']       = $value['file'];
		}

		if(is_numeric($max) && count($image_list) < $max)
		{
			$len = $max - count($image_list);

			$counter = 0;

			for ($i=1; $i <= $len; $i++)
			{
				$counter++;

				$image_list[] =
				[
					'title' => T_("Image :val", ['val' => \dash\fit::number($i)]),
					'file'    => \dash\sample\img::image()
				];

				// check have not loop error
				if($counter > 50)
				{
					return $image_list;
				}
			}
		}

		return $image_list;
	}


}
?>