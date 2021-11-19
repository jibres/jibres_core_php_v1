<?php
namespace content_site\assemble\element;


class video
{
	public static function html($_args)
	{
		$html = '';

		$src      = a($_args, 'src');
		$videoClass = a($_args, 'class');
		$videoFrameClass = 'videoFrame';
		$playerMode = a($_args, 'videoPlayer');
		if(!$playerMode)
		{
			// plyr
			// video-js
			$playerMode = 'default';
		}

		$html .= "<div";
		if(a($_args, 'videoFrameClass'))
		{
			$videoFrameClass .= ' '. a($_args, 'videoFrameClass');
		}
		$html .= ' class="'. $videoFrameClass. '"';
		$html .= ' data-player="'. $playerMode. '"';
		if(a($_args, 'video_clickable') !== false)
		{
			$html .= ' data-clickable';
		}
		$html .= ">";
		$html .= "<video ";

		if($playerMode === 'default')
		{
			$html .= "data-src='". $src. "' ";
		}

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

		if(a($_args, 'video_disablepictureinpicture'))
		{
			$html .= 'disablePictureInPicture ';
		}

		if(a($_args, 'video_poster'))
		{
			if($playerMode === 'default')
			{
				$html .= "data-poster";
			}
			else
			{
				$html .= "poster";
			}
			$html .= "='". \lib\filepath::fix($_args['video_poster']). "' ";
		}

		$html .= " class='". $videoClass. "'>";

		$html .= "<source ";
		if($playerMode === 'default')
		{
			$html .= "data-src";
		}
		else
		{
			$html .= "src";
		}
		$html .= "='". $src. "'";
		$html .= " type='". a($_args, 'file_detail', 'mime'). "'>";
		$html .= "</video>";
		$html .= "</div>";

		return $html;
	}
}
?>