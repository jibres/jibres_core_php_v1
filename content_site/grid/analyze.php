<?php
namespace content_site\grid;


class analyze
{
	public static function get_class($_args)
	{
		$grid_cols = 'grid-cols-1 gap-4';
		switch (a($_args, 'container'))
		{
			case 'sm':
				// $grid_cols = 'grid-cols-1';
				break;

			case 'md':
				$grid_cols .= ' md:grid-cols-2';
				break;

			case 'lg':
			case 'auto':
				$grid_cols .= ' md:grid-cols-2 lg:grid-cols-3';
				break;

			case 'xl':
				$grid_cols .= ' md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-6';
				break;

			case '2xl':
			case 'none':
			default:
				$grid_cols .= ' md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-6 2xl:grid-cols-5 px-5';
				break;
		}

		return $grid_cols;
	}
}
?>