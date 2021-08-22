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

		if(!$image_list && \content_site\utility::fill_by_default_data())
		{
			$image_list = self::fill_default($_args);
		}

		$image_list = array_values($image_list);

		if(a($_args, 'image_random'))
		{
			shuffle($image_list);
		}

		foreach ($image_list as $key => $value)
		{
			if(!a($value, 'file'))
			{
				$value['file'] = \dash\sample\img::image();
			}

			$image_list[$key]['file'] = $value['file'];
		}


		$type      = a($_args, 'type');

		$namespace = sprintf('%s\%s\%s', __NAMESPACE__, 'html', $type);

		if(is_callable([$namespace, 'html']))
		{
			$html .= call_user_func_array([$namespace, 'html'],[$_args, $image_list]);
		}

		return $html;

	}


	private static function fill_default($_args)
	{
		$image_list = [];

		$preview_option =  \content_site\call_function::section_type_preview('gallery', a($_args, 'type'), a($_args, 'preview_key'));

		if(isset($preview_option['options']['image_count']))
		{
			$max = intval($preview_option['options']['image_count']);
		}
		else
		{
			$max = option::maximum_capacity(a($_args, 'type'));
		}


		if(is_numeric($max))
		{
			for ($i=1; $i <= $max; $i++)
			{
				$image_list[] =
				[
					'title' => T_("Image :val", \dash\fit::number($i)),
					'file'    => \dash\sample\img::image()
				];
			}
		}

		return $image_list;
	}


}
?>