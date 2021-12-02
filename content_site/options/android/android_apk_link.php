<?php
namespace content_site\options\android;


class android_apk_link
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, self::db_key()));
		return $data;
	}


	public static function db_key()
	{
		return 'show_android_apk_link';
	}


	public static function admin_html()
	{
		$html = '';
		// if(\lib\store::android_apk_url())
		{
			$default = \content_site\section\view::get_current_index_detail(self::db_key());
			$html .= \content_site\options\generate::form();
			{
				$html .= \content_site\options\generate::multioption();
				$html .= \content_site\options\generate::opt_hidden(get_called_class());
				$html .= \content_site\options\generate::checkbox(self::db_key() , T_('Display APK download link'), $default);
			}
  			$html .= \content_site\options\generate::_form();
		}
		$html .= '<a target="_blank" class="link-secondary text-xs leading-6 block mb-5" href="'.\lib\store::admin_url(). '/a/android">'.T_("Manage application").' <i class="sf-external-link pLa5"></i></a>';



		return $html;
	}

}
?>