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

			$html .= '<div class="example">';
			{
				$html .= '<input type="file" name="video" accept="video/*" id="myVideo">';

				$html .= '<div class="txtRa">';
				{
					$html .= '<button class="btn" type="submit">Upload</button>';
				}
				$html .= '</div>';

			}
			$html .= '</div>';

			if($default)
			{
				$html .= '<video width="" height="240" controls>';
				{
					$html .= '<source src="'.$default.'" type="video/mp4">';
				}
				$html .= '</video>';
			}
		}
		$html .= '</form>';

		return $html;
	}

}
?>