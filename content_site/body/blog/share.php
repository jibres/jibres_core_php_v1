<?php
namespace content_site\body\blog;


class share
{

	public static function btn_viewall($_args)
	{
		$html = '';
		if(a($_args, 'btn_viewall_check'))
		{
			$html .= '<footer class="text-center overflow-hidden pt-5 md:pt-10 pb-2">';
			{

				$mode = a($_args, 'btn_viewall_mode');
				if(!$mode)
				{
					$mode = 'outline';
				}

				// $classVal = 'hover:bg-gray-800 font-semibold py-2 px-10 shadow border rounded';

				$html .= "<a class='btn-outline-$mode mx-auto btn-wide' href='". a($_args, 'btn_viewall_link'). "'>";
				$html .= a($_args, 'btn_viewall');
				$html .= '</a>';
			}
			$html .= '</footer>';

		} // endif

		return $html;

	}


	public static function date($_date, $_type)
	{
		switch ($_type)
		{
			case 'date':
				return \dash\fit::date($_date, 'readable');
				break;

			case 'full':
				return \dash\fit::date_time($_date);
				break;

			case 'relative':
				return \dash\fit::date_human($_date);
				break;

			case 'no':
			default:
				return null;
				break;
		}
	}


	public static function post_reading_time($_reading_time, $_post_show_reading_time)
	{
		$html = '';

		if($_post_show_reading_time && $_reading_time)
		{
			$val = ['val' => \dash\fit::number($_reading_time)];
			$html .= '<span class="text-gray-400 leading-8 text-sm" title="'. T_("We are estimate you can read this post within :val.", $val). '">';
			$html .= T_("Read in :val", $val);
			$html .= '</span>';
		}

		return $html;

	}

}
?>