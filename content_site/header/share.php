<?php
namespace content_site\header;


class share
{


	public static function announcement($_args)
	{
		$html = '';

		if(a($_args, 'announcement_check'))
		{
			$html .= "<div class='topLine'>";
			{
				$html  .= \content_site\assemble\link::generate(a($_args, 'announcement_link'), a($_args, 'announcement_description'));
			}
			$html .= "</div>";
		}
		return $html;
	}
}
?>