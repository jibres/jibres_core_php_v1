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

		$image_list = option::current_gallery_item(a($_args, 'id'));

		if(!is_array($image_list))
		{
			$image_list = [];
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

			$image_list[$key]['image'] = $value['file'];
		}


		$type      = a($_args, 'type');

		$namespace = sprintf('%s\%s\%s', __NAMESPACE__, 'html', $type);

		if(is_callable([$namespace, 'html']))
		{
			$html .= call_user_func_array([$namespace, 'html'],[$_args, $image_list]);
		}

		return $html;

	}


}
?>