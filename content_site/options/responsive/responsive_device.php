<?php
namespace content_site\options\responsive;


class responsive_device
{

	public static function device()
	{
		$device   = [];
		$device[] = ['key' => 'all', 'title' => T_('All')];
		$device[] = ['key' => 'desktop', 'title' => T_('Desktop')];
		$device[] = ['key' => 'mobile', 'title' => T_('Mobile')];

		return $device;
	}


	public static function mobile()
	{
		$mobile   = [];
		$mobile[] = ['key' => 'all', 'title' => T_('All')];
		$mobile[] = ['key' => 'browser', 'title' => T_('Browser')];
		$mobile[] = ['key' => 'pwa', 'title' => T_('PWA')];
		// $mobile[] = ['key' => 'application', 'title' => T_('Application')];

		return $mobile;
	}


	public static function os()
	{
		$os   = [];
		$os[] = ['key' => 'all', 'title' => T_('All')];
		$os[] = ['key' => 'windows', 'title' => T_('Windows')];
		$os[] = ['key' => 'linux', 'title' => T_('Linux')];
		$os[] = ['key' => 'mac', 'title' => T_('MAC')];
		// $os[] = ['key' => 'android', 'title' => T_('Android')];

		return $os;
	}


	public static function validator($_data)
	{
		$new_data           = [];
		$new_data['device'] =  \dash\validate::enum(a($_data, 'device'), true, ['enum' => array_column(static::device(), 'key'), 'field_title' => T_('Effect')]);
		$new_data['mobile'] =  \dash\validate::enum(a($_data, 'mobile'), true, ['enum' => array_column(static::mobile(), 'key'), 'field_title' => T_('Effect')]);
		$new_data['os']     =  \dash\validate::enum(a($_data, 'os'), true, ['enum' => array_column(static::os(), 'key'), 'field_title' => T_('Effect')]);

		return $new_data;

		// \content_site\update_record::need_update_record_field($new_data);
	}


	public static function admin_html()
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();


		$device = a($currentSectionDetail, 'preview', 'device');
		$mobile = a($currentSectionDetail, 'preview', 'mobile');
		$os     = a($currentSectionDetail, 'preview', 'os');


		if(!$device)
		{
			$device = 'all';
		}

		if(!$mobile)
		{
			$mobile = 'all';
		}


		if(!$os)
		{
			$os = 'all';
		}


		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::opt_hidden(get_called_class());
			$html .= \content_site\options\generate::multioption();

			$html .= '<p class="jalert alert-info p-3 text-sm ">';
			{
				$html  .= T_("You can restrict this section to a specific device or operating system that is only visible on that device and operating system");
			}
			$html .= '</p>';

			$title = T_("Device");
			$html .= "<label>$title</label>";

			$radio_html = '';

			foreach (static::device() as $key => $value)
			{
				$selected = false;

				if($device === $value['key'])
				{
					$selected = true;
				}

				$radio_html .= \content_site\options\generate::radio_line_itemText('device', $value['key'], $value['title'], $selected);
			}

			$html .= \content_site\options\generate::radio_line_add_ul('device', $radio_html);

			$data_response_hide = null;

			if($device !== 'mobile')
			{
				$data_response_hide = 'data-response-hide';
			}

			// $html .= "<div data-response='device' data-response-where='mobile' $data_response_hide>";
			// {


			// 	$title = T_("Mobile");
			// 	$html .= "<label>$title</label>";

			// 	$radio_html = '';

			// 	foreach (static::mobile() as $key => $value)
			// 	{
			// 		$selected = false;

			// 		if($mobile === $value['key'])
			// 		{
			// 			$selected = true;
			// 		}

			// 		$radio_html .= \content_site\options\generate::radio_line_itemText('mobile', $value['key'], $value['title'], $selected);
			// 	}

			// 	$html .= \content_site\options\generate::radio_line_add_ul('mobile', $radio_html);

			// }
			// $html .= '</div>';


			$title = T_("OS");
			$html .= "<label>$title</label>";

			$radio_html = '';

			foreach (static::os() as $key => $value)
			{
				$selected = false;

				if($os === $value['key'])
				{
					$selected = true;
				}

				$radio_html .= \content_site\options\generate::radio_line_itemText('os', $value['key'], $value['title'], $selected);
			}

			$html .= \content_site\options\generate::radio_line_add_ul('os', $radio_html);

		}
		$html .= \content_site\options\generate::_form();


		return $html;

	}
}
?>