<?php
namespace content_a\thirdparty;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of third Parties');
		$this->data->page['desc']  = T_('You can search in all type of third parties like thirdpartys, customers and suppliers.');

		$meta         = [];
		$meta['type'] = ["IN", "('staff', 'customer', 'supplier') "];

		$this->data->thirdparty_list = \lib\app\thirdparty::list(\lib\utility::get('q'), $meta);

		if(\lib\utility::get('json') === 'true')
		{
			\lib\debug::msg("list", json_encode($this->data->thirdparty_list, JSON_UNESCAPED_UNICODE));
			// return;
			// echo json_encode($this->data->thirdparty_list, JSON_UNESCAPED_UNICODE);
			$this->_processor(['force_stop' => true, 'force_json' => true]);
			\lib\code::exit();
		}

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}


	}
}
?>
