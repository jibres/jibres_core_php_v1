<?php
namespace content_site\options\socialnetwork;


class socialnetwork
{
	public static function validator($_data)
	{
		$new_data                         = [];
		$new_data['use_as_socialnetwork'] = \dash\validate::enum(a($_data, 'use_as_socialnetwork'), false, ['enum' => ['business_socialnetwork', 'custom_socialnetwork']]);

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

			$name = 'use_as_socialnetwork';

			$radio_html = '';

			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'business_socialnetwork', T_("Business Social Networks"), (($use_as_socialnetwork === 'business_socialnetwork')? true : false));
			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'custom_socialnetwork', T_("Custom"), (($use_as_socialnetwork === 'custom_socialnetwork')? true : false));


			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);



			$data_response_hide = 'data-response-hide';

			if($use_as_socialnetwork === 'business_socialnetwork')
			{
				$data_response_hide = null;
			}

			$html .= "<div data-response='use_as_socialnetwork' data-response-where='business_socialnetwork' $data_response_hide>";
			{
				$html .= '<nav class="items long mT20"><ul>';
				{
			   		$html .= '<li>';
			   		{
			   			$url = \lib\store::admin_url(). '/a/setting/social';
			      		$html .= "<a target='_blank' class='item f' href='$url'>";
			      		{
			        		$html .= '<img alt="socialnetwork" class="bg-gray-100 hover:bg-gray-200 p-2" src="'. \dash\utility\icon::url('Affiliate'). '">';
			        		$html .= '<div class="key">'. T_("Manage socialnetwork"). '</div>';
			        		$html .= '<div class="go"></div>';
			      		}
			      		$html .= '</a>';
			   		}
			   		$html .= '</li>';
				}
				$html .= '</ul></nav>';
			}
			$html .= '</div>';


			$data_response_hide = 'data-response-hide';

			if($use_as_socialnetwork === 'custom_socialnetwork')
			{
				$data_response_hide = null;
			}

			$html .= "<div data-response='use_as_socialnetwork' data-response-where='custom_socialnetwork' $data_response_hide>";
			{
  				$html .= \content_site\options\generate::text('telegram', 'tg', 'tg');

			}
			$html .= '</div>';
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>