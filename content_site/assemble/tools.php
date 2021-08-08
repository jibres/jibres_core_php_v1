<?php
namespace content_site\assemble;


class tools
{

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
			$html .= '<div class="text-gray-400 leading-8 text-sm" title="'. T_("We are estimate you can read this post within :val.", $val). '">';
			$html .= T_(":val read", $val);
			$html .= '</div>';
		}

		return $html;

	}


	public static function section_id($_type, $_id)
	{
		return 'id="'.$_type. '-'. $_id.'"';
	}
}
?>