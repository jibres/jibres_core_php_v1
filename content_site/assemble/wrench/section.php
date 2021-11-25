<?php
namespace content_site\assemble\wrench;


class section
{
	public static function element_start($_args, $_used_for = null)
	{
		$background_style = a($_args, 'background:full_style');
		$section_id       = a($_args, 'section:id');
		$classNames = 'flex overflow-hidden relative';

		$cnElement = 'div';
		if($_used_for === 'header')
		{
			$cnElement = 'header';
			$classNames = 'relative';
		}
		else if($_used_for === 'footer')
		{
			$cnElement = 'footer';
			$classNames = 'relative overflow-hidden';
		}
		else
		{
			if(a($_args, 'heading') !== null)
			{
				$cnElement = 'section';
			}
		}

		if(a($_args, 'height:class'))
		{
			if(a($_args, 'container_justify:class'))
			{
				$classNames .= ' '. a($_args, 'height:class:wo_padding');
			}
			else
			{
				$classNames .= ' '. a($_args, 'height:class');
			}
		}

		if(a($_args, 'padding_top:class'))
		{
			$classNames .= ' '. a($_args, 'padding_top:class');
		}

		if(a($_args, 'font:class'))
		{
			$classNames .= ' '. a($_args, 'font:class');
		}
		if(a($_args, 'container_align:class'))
		{
			$classNames .= ' '. a($_args, 'container_align:class');
		}
		if(a($_args, 'containe_r_justify:class'))
		{
			$classNames .= ' '. a($_args, 'container_justify:class');
		}

		$html = "<$cnElement data-type='". a($_args, 'model'). "' class='$classNames'$background_style $section_id";

		$focusMode = null;

		if(a($_args, 'preview_mode') && \dash\request::key_exists('isiframe', 'get'))
		{
			if(\dash\request::get('focus'))
			{
				$focusMode = \dash\request::get('focus') === a($_args, 'section:id_raw');
				if($focusMode)
				{
					$html .= " data-focus='yes'";
				}
				else
				{
					$html .= " data-focus='no'";
				}
			}
			else
			{
				$html .= " data-focus";
			}
		}

		$html .= ">";


		if(a($_args, 'preview_mode') && \dash\request::key_exists('isiframe', 'get'))
		{
			$html .= "<div";
			$html .= " class='focusAction'";
			$html .= " style='display:none;position:absolute;padding-top:2px;top:3px;margin:0 auto;right:0;left:0;text-align:center;z-index:99;'";
			$html .= ">";
			{
				$editurl = a($_args, 'editurl');
				$sorting = true;
				if($_used_for === 'header' || $_used_for === 'footer')
				{
					$sorting = false;
				}


				if($sorting)
				{
					$sort_up = json_encode(['section' => a($_args, 'id'), 'sorting' => 'up']);
					$html .= "<div class='btn-secondary btn-sm' data-postMsg='parent' data-postMsg-ajaxify='$sort_up' data-postMsg-action='$editurl'>";
					$html .= \dash\utility\icon::bootstrap('arrow-up');
					$html .= "</div>";
				}


				if($focusMode)
				{
					$html .= "<button class='btn-secondary btn-sm mx-1'>". T_("Editing..."). '</button>';
				}
				else
				{
					$html .= "<a class='btn-secondary btn-sm btn-icon mx-1' data-postMsg='parent' data-postMsg-href='". $editurl. "'>";
					$html .= \dash\utility\icon::bootstrap('pencil-square');
					$html .= T_("Edit");
					$html .= "</a>";
				}


				if($sorting)
				{
					$sort_down = json_encode(['section' => a($_args, 'id'), 'sorting' => 'down']);
					$html .= "<div class='btn-secondary btn-sm' data-postMsg='parent' data-postMsg-ajaxify='$sort_down' data-postMsg-action='$editurl'>";
					$html .= \dash\utility\icon::bootstrap('arrow-down');
					$html .= "</div>";
				}


			}
			$html .= "</div>";
		}

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


	public static function container($_args, $_opt = null)
	{
		$classList = 'm-auto';
		if(a($_args, 'container:class'))
		{
			$classList .= ' '. a($_args, 'container:class');
		}
		if(a($_opt, 'class'))
		{
			$classList .= ' '. a($_opt, 'class');
		}
		$element = "<div class='$classList'";
		if(a($_opt, 'style'))
		{
			$element .= ' style="'. a($_opt, 'style'). '"';
		}
		$element .= ">";

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


	public static function container_align_justify($_args)
	{
		$container = a($_args, 'container:class');
		$element = "<div class='$container'>";

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
			// customize gap
			// $grid_cols .=	' gap-0.5 sm:gap-1 md:gap-2 md:gap-x-1 lg:gap-4 lg:gap-x-2';
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