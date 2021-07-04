<?php
namespace content_site\options;


class video
{
	public static function validator($_data)
	{
		if(\dash\request::files('video'))
		{
			$image_path = \dash\upload\website::upload_video('video');

			if(!\dash\engine\process::status())
			{
				return false;
			}

			return $image_path;
		}
		else
		{
			\dash\notif::error(T_("Please upload a video"));
			return false;
		}
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('video');

		if(!$default)
		{
			$default = self::default();
		}

		if($default)
		{
			$default = \lib\filepath::fix($default);
		}

		$ratio = \content_site\options\ratio::default();

		if(isset($_section_detail['preview']['ratio']))
		{
			$ratio = $_section_detail['preview']['ratio'];
		}

		\lib\ratio::data_ratio_html($ratio);

		$html = '';

		$html .= '<form method="post" autocomplete="off" >';
		{
			$html .= '<input type="hidden" name="opt_video" value="1">';
			$html .= '<div ';
			// upload attr
			$html .= ' data-uploader';
			$html .= ' data-name="video"';
			$html .= ' data-final="#finalVideo"';
			$html .= ' data-autoSend';
			$html .= ' data-file-max-size="'. \dash\data::maxFileSize().'"';
			$html .= ' '. \dash\data::ratioHtml();

			if($default)
			{
				$html .= " data-fill";
			}

			$html .= '>';

			$html .= '<input type="file" accept="image/jpeg, image/png" id="myVideo">';
			$html .= '<label for="myVideo">'. T_('Drag &amp; Drop your files or Browse'). '</label>';

			if($default)
			{
				$myExt = substr($default, -3);

				if(in_array($myExt, ['png', 'jpg', 'gif', 'svg']))
				{
					$html .= '<label for="myVideo"><img id="finalVideo" src="'. $default. '" alt="'. \dash\data::dataRow_title(). '"></label>';
				}
				else
				{
					$html .= '<label for="myVideo"><img id="finalVideo" src="" alt="'. \dash\data::dataRow_title(). '"></label>';
				}
			}
			else
			{
				$html .= '<label for="myVideo"><img id="finalVideo" alt="'. \dash\data::dataRow_title(). '"></label>';
			}

			$html .= '</div>';
		}
		$html .= '</form>';

		return $html;
	}

}
?>