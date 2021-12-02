<?php
namespace content_site\options\socialnetwork;


class socialnetwork
{
	public static function validator($_data)
	{
		$new_data                         = [];
		$new_data['use_as_socialnetwork'] = \dash\validate::enum(a($_data, 'use_as_socialnetwork'), false, ['enum' => ['business_socialnetwork', 'custom_socialnetwork']]);

		$all_social_list = \lib\store::all_social_list();

		foreach ($all_social_list as $key => $value)
		{
			if($key === 'email')
			{
				$new_data[$key] = \dash\validate::email(a($_data, $key), false);
			}
			elseif($key === 'whatsapp')
			{
				$new_data[$key] = \dash\validate::mobile(a($_data, $key), false);
			}
			else
			{
				$new_data[$key] = \dash\validate::socialnetwork(a($_data, $key), false);
			}
		}

		return $new_data;
	}



	public static function admin_html()
	{

		$use_as_socialnetwork = \content_site\section\view::get_current_index_detail('use_as_socialnetwork');


		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);

			$title = T_("Social Networks");

			$name = 'use_as_socialnetwork';



			$html .= '<div class="flex">';
			{
				$html .= '<div class="flex-1">';
				{
					$html .= "<label>$title</label>";
				}
				$html .= '</div>';

				$data_response_hide = null;

				if($use_as_socialnetwork === 'custom_socialnetwork')
				{
					$data_response_hide = 'data-response-hide';
				}

				// open data-response and close after heading input
				$html .= "<div data-response='$name' data-response-where='business_socialnetwork' $data_response_hide>";
				{
					$html .= '<a target="_blank" class="link-secondary text-xs leading-6 block" href="'. \lib\store::admin_url(). '/a/setting/general">'. T_("Manage"). ' <i class="sf-external-link pLa5"></i> </a>';
				}
				$html .= '</div>';

			}
			$html .= '</div>';


			$radio_html = '';

			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'business_socialnetwork', T_("Business"), (($use_as_socialnetwork === 'business_socialnetwork')? true : false));
			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'custom_socialnetwork', T_("Custom"), (($use_as_socialnetwork === 'custom_socialnetwork')? true : false));


			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);

			$data_response_hide = 'data-response-hide';

			if($use_as_socialnetwork === 'custom_socialnetwork')
			{
				$data_response_hide = null;
			}

			$html .= "<div data-response='use_as_socialnetwork' data-response-where='custom_socialnetwork' $data_response_hide>";
			{
				$all_social_list = \lib\store::all_social_list();
				foreach ($all_social_list as $key => $value)
				{
					$myKey = $key;
					$username = \content_site\section\view::get_current_index_detail($myKey);
  					$html .= \content_site\options\generate::text($myKey, $username, a($value, 'title'), null, 'ltr');
				}

			}
			$html .= '</div>';
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>