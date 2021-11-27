<?php
namespace content_site\assemble\wrench;


class heading
{
	public static function simple1($_args, $_link = null)
	{
		$color_heading    = a($_args, 'color_heading:full_style');
		$heading_class    = a($_args, 'heading:class');

		$heading = '';
		if(a($_args, 'heading') !== null)
		{
			$heading .= '<header>';
			{
				$size = 'text-lg md:text-xl lg:text-2xl';
				if(array_key_exists('heading_size', $_args))
				{
					$size = \content_site\options\heading\heading_size::class_name($_args['heading_size']);
				}
				$heading_class .= ' '. $size;

				if($_link)
				{
					$heading .= '<a href="'. $_link. '">';
				}

				$heading .= "<h2 class='font-bold leading-6 mb-5 $heading_class' $color_heading>";
				{

					$heading .= a($_args, 'heading');

				}
				$heading .= '</h2>';

				if($_link)
				{
					$heading .= '</a>';
				}
			}
			$heading .= '</header>';
		}

		return $heading;
	}


}
?>