<?php
namespace content_site\assemble\element;


class video
{
	public static function html($_args)
	{
		$html = '';

		$src      = a($_args, 'src');
		$imgClass = a($_args, 'class');

		$html .= "<div";
		if(a($_args, 'videoFrameClass'))
		{
			$html .= ' class="'. a($_args, 'videoFrameClass'). '"';
		}
		$html .= ">";
		$html .= "<video ";

		$html .= "data-src='". $src. "' ";

		if(a($_args, 'video_controls') !== false)
		{
			$html .= "controls ";
		}

		if(a($_args, 'video_loop'))
		{
			$html .= "loop ";
		}

		if(a($_args, 'video_autoplay'))
		{
			$html .= "autoplay ";
		}

		if(a($_args, 'video_nodownload'))
		{
			$html .= 'controlsList="nodownload" ';
		}

		if(a($_args, 'video_nofullscreen'))
		{
			$html .= 'nofullscreen ';
		}

		if(a($_args, 'video_muted'))
		{
			$html .= 'muted ';
		}

		if(a($_args, 'video_clickable') !== false)
		{
			$html .= 'data-clickable ';
		}

		if(a($_args, 'video_disablepictureinpicture'))
		{
			$html .= 'disablePictureInPicture ';
		}

		if(a($_args, 'video_poster'))
		{
			$html .= "data-poster='". \lib\filepath::fix($_args['video_poster']). "'";
		}

		$html .= " class='$imgClass'>";

		$html .= "<source data-src='$src' type='". a($_args, 'file_detail', 'mime'). "'>";
		$html .= "</video>";
		$html .= "</div>";

		return $html;
	}
}
?>