<?php
namespace content_a\sell\add;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Sale invoicing');
		$this->data->page['desc']  = '';
		// $this->data->page['desc']  = T_('Sell your product via Jibres and enjoy using integrated web base platform.');


		if(\lib\utility::get('q') && \lib\utility::get('json') === 'true')
		{
			$result = [];
			switch (\lib\utility::get('list'))
			{
				case 'customer':
					$meta         = [];
					$meta['type'] = ["IN", "('staff', 'customer', 'supplier') "];
					$resultRaw    = \lib\app\staff::list(\lib\utility::get('q'), $meta);

					foreach ($resultRaw as $key => $value)
					{
						if($value['id'])
						{
							$result[$key]['value'] = T_($value['id']);
						}
						if($value['fullname'])
						{
							$result[$key]['title'] = $value['fullname'];
						}
						if($value['mobile'])
						{
							$result[$key]['count'] = $value['mobile'];
						}
						if($value['type'])
						{
							$result[$key]['desc'] = T_($value['type']);
						}
						if($value['code'])
						{
							$result[$key]['desc2'] = T_('code') . ' '. $value['code'];
						}
					}
					break;

				default:
					break;
			}


			\lib\debug::msg("list", json_encode($result, JSON_UNESCAPED_UNICODE));
			// force show json
			$this->_processor(['force_stop' => true, 'force_json' => true]);
			// \lib\code::exit();
		}

	}
}
?>
