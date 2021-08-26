<?php
namespace content_site\assemble\wrench;


class heading
{
	public static function simple1($_args)
	{
		$color_heading    = a($_args, 'color_heading:full_style');
		$heading_class    = a($_args, 'heading:class');

		$heading = '';
		if(a($_args, 'heading') !== null)
		{
			$heading .= '<header>';
			{
				$heading .= "<h2 class='text-3xl leading-6 mb-5 $heading_class' $color_heading>";
				{
					$heading .= a($_args, 'heading');
				}
				$heading .= '</h2>';
			}
			$heading .= '</header>';
		}

		return $heading;
	}


}
?>