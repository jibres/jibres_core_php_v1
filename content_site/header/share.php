<?php
namespace content_site\header;


class share
{


	public static function announcement($_args)
	{
		$html = '';

		if(a($_args, 'announcement_check'))
		{
			$link_detail  = \content_site\assemble\link::generate(a($_args, 'announcement_link'));

			$link = a($link_detail, 'link');
			$target = a($link_detail, 'target_blank_html');

			$html .= "<a href='$link' $target class='block text-center text-base'  style='@keyframes topLineGradient{0%{background-position: 0% 50%;}50%{background-position:100% 50%;}100%{background-position:% 50%;}}; height:50px;line-height:50px;background-color:#e73c7e;background:linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);background-size: 400% 400%;animation: topLineGradient 15s ease infinite;color: #fff; '>";
			{
				$html .= a($_args, 'announcement_description');
			}
			$html .= "</a>";
		}
		return $html;
	}
}
?>