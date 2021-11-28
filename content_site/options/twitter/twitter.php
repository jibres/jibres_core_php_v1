<?php
namespace content_site\options\twitter;


class twitter
{
	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'other','title' => T_("Other"),];
		$enum[] = ['key' => 'myself', 'title' => T_("My self"),];
		return $enum;
	}



	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key')]);
		return $data;
	}

	public static function extends_option()
	{
		return
		[
			'twitter',
			'twitter_link',
		];
	}


	public static function default()
	{
		return 'myself';
	}



	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('twitter');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Twitter");

		$this_range = array_column(self::enum(), 'key');

		$name       = 'opt_'. \content_site\utility::className(__CLASS__);

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= "<label>$title</label>";


			$radio_html = '';
			foreach (self::enum() as $key => $value)
			{
				if(isset($value['hide']) && $value['hide'])
				{
					continue;
				}

				$selected = false;

				if($default === $value['key'])
				{
					$selected = true;
				}

				$radio_html .= \content_site\options\generate::radio_line_itemText($name, $value['key'], $value['title'], $selected);
			}

			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html, true);
		}
		$html .= \content_site\options\generate::_form();


		$html .= '<div data-response="'.$name.'" data-response-where="myself" '.(($default === 'myself') ? null : 'data-response-hide').'>';
		{
			$twitter_username = \lib\store::social('twitter', true);

			$twitter_last_fetch = \lib\app\twitter\business::last_fetch();

			if(!$twitter_username)
			{
				$html .= '<a target="_blank" class="btn-primary leading-6 block" href="'. \lib\store::admin_url(). '/a/setting/tw">'. T_("Connect to your twitter"). ' <i class="sf-external-link pLa5"></i> </a>';
			}
			else
			{
				if($twitter_last_fetch)
				{
					$html .= '<div class="alert2">'. T_("Last fetch"). ': '. \dash\fit::date_human($twitter_last_fetch). '</div>';
				}

				$json =
				[
					'ig_action'   => 'fetch',
				];

				$json = json_encode($json);

				$html .= '<div target="_blank" data-method="post" data-data=\'{"tw_action": "fetch"}\' class="btn-primary leading-6 block" data-ajaxify=\''.$json.'\' data-action="'. \lib\store::admin_url(). '/a/setting/tw">'. T_("Fetch posts now"). ' <i class="sf-external-link pLa5"></i> </div>';

				$html .= '<a target="_blank" class="btn-link leading-6 block" href="'. \lib\store::admin_url(). '/a/setting/tw">'. T_("Manage"). ' <i class="sf-external-link pLa5"></i> </a>';
			}
		}
		$html .= '</div>';


		$html .= '<div data-response="'.$name.'" data-response-where="other" '.(($default === 'other') ? null : 'data-response-hide').'>';
		{
			$html .= twitter_link::admin_html();
		}
		$html .= '</div>';


		return $html;
	}

}
?>