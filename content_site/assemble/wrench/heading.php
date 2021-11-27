<?php
namespace content_site\assemble\wrench;


class heading
{
	public static function simple1($_args)
	{
		$color_heading    = a($_args, 'color_heading:full_style');
		$heading_class    = a($_args, 'heading:class');

		$link = null;

		if(array_key_exists('btn_viewall_check', $_args) && !a($_args, 'btn_viewall_check') && a($_args, 'btn_viewall_link'))
		{
			$link = $_args['btn_viewall_link'];
		}


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

				if($link)
				{
					$heading .= '<a href="'. $link. '">';
				}

				$heading .= "<h2 class='font-bold leading-6 mb-5 $heading_class' $color_heading>";
				{

					$heading .= a($_args, 'heading');

				}
				$heading .= '</h2>';

				if($link)
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