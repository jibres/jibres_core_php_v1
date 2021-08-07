<?php
namespace content_site\options\file;


trait file
{
	public static function validator($_data)
	{
		if(\dash\request::files(self::option_key()))
		{
			$image_path = \dash\upload\website::upload_image(self::option_key());

			if(!\dash\engine\process::status())
			{
				return false;
			}

			return $image_path;
		}
		else
		{
			if(a($_data, 'deletefile'))
			{
				return null;
			}
			else
			{
				\dash\notif::error(T_("Please upload a file"));
				return false;
			}
		}
	}


	public static function default()
	{
		return null;
	}


	public static function option_key()
	{
		return 'file';
	}


	public static function admin_html($_section_detail = null)
	{

		$option_key = self::option_key();

		$default = \content_site\section\view::get_current_index_detail($option_key);

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
			$html .= '<input type="hidden" name="'.$option_key.'" value="1">';
			$html .= '<div ';
			// upload attr
			$html .= ' data-uploader';
			$html .= ' data-name="'.$option_key.'"';
			$html .= ' data-final="#finalImage"';
			$html .= ' data-autoSend';
			$html .= ' data-file-max-size="'. \dash\data::maxFileSize().'"';

			$html .= ' data-ratio-free';
			$html .= ' '. \dash\data::ratioHtml();

			if($default)
			{
				$html .= " data-fill";
			}

			$html .= '>';

			$html .= '<input type="file" accept="image/jpeg, image/png" id="myfile">';
			$html .= '<label for="myfile">'. T_('Drag &amp; Drop your files or Browse'). '</label>';

			if($default)
			{
				$myExt = substr($default, -3);

				if(in_array($myExt, ['png', 'jpg', 'gif', 'svg']))
				{
					$html .= '<label for="myfile"><img id="finalImage" src="'. $default. '" alt="'. \dash\data::dataRow_title(). '"></label>';
				}
				else
				{
					$html .= '<label for="myfile"><img id="finalImage" src="" alt="'. \dash\data::dataRow_title(). '"></label>';
				}
			}
			else
			{
				$html .= '<label for="myfile"><img id="finalImage" alt="'. \dash\data::dataRow_title(). '"></label>';
			}

			if($default)
			{
				$html .= '<span class="imageDel" data-confirm data-data=\'{"'.$option_key.'" : 1, "multioption" : "multi", "deletefile" : 1}\'></span>';
			}

			$html .= '</div>';
		}
		$html .= '</form>';

		return $html;
	}

}
?>