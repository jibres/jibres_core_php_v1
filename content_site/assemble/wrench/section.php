<?php
namespace content_site\assemble\wrench;


class section
{
	public static function element_start($_args)
	{
		$background_style = a($_args, 'background:full_style');
		$section_id       = a($_args, 'secition:id');

		$cnElement = 'div';
		if(a($_args, 'heading') !== null)
		{
			$cnElement = 'section';
		}

		$classNames = 'flex overflow-hidden';
		if(a($_args, 'height:class'))
		{
			$classNames .= ' '. a($_args, 'height:class');
		}
		if(a($_args, 'font:class'))
		{
			$classNames .= ' '. a($_args, 'font:class');
		}

		$html = "<$cnElement data-type='". a($_args, 'model'). "' class='$classNames'$background_style $section_id>";

		return $html;
	}


	public static function element_end($_args)
	{
		$cnElement = '</div>';

		if(a($_args, 'heading') !== null)
		{
			$cnElement = '</section>';
		}

		return $cnElement;
	}


	public static function container($_args)
	{
		$container = a($_args, 'container:class');
		$element = "<div class='$container m-auto relative'>";

		return $element;
	}


	public static function container_auto($_args, $_count)
	{
		$containerMaxWidth = 'max-w-screen-lg w-full px-2 sm:px-4 lg:px-4 m-auto';
		if($_count > 3)
		{
			$containerMaxWidth = 'max-w-screen-xl w-full px-2 sm:px-4 lg:px-4 m-auto';
		}
		$element = "<div class='$containerMaxWidth'>";

		return $element;
	}


	public static function grid_by_count($_args, $_count)
	{
		$grid_cols = 'grid grid-cols-'. $_count;
		if($_count > 12)
		{
			$grid_cols = 'grid grid-cols-'. 12;
		}
		if(a($_args, 'magicbox_gap:class'))
		{
			$grid_cols .=	' '. a($_args, 'magicbox_gap:class');
		}

		$gridElement = "<div class='$grid_cols'>";

		return $gridElement;
	}


	public static function grid_12($_args)
	{
		$grid_cols = 'relative grid grid-cols-12';
		$gap = a($_args, 'magicbox_gap:class');

		if($gap)
		{
			$grid_cols .=	' '. $gap;
		}
		else
		{
			$grid_cols .=	' gap-0.5 sm:gap-1 md:gap-2 lg:gap-4';
		}

		$gridElement = "<div class='$grid_cols'>";

		return $gridElement;
	}


	public static function grid_by_row($_args, $_count)
	{
		$grid_cols = 'grid grid-rows-'. $_count. ' grid-flow-col';
		if($_count > 6)
		{
			$grid_cols = 'grid grid-rows-6';
		}
		if(a($_args, 'magicbox_gap:class'))
		{
			$grid_cols .=	' '. a($_args, 'magicbox_gap:class');
		}

		$gridElement = "<div class='$grid_cols'>";

		return $gridElement;
	}

}
?>