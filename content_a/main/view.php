<?php
namespace content_a\main;


class view extends \mvc\view
{
	public function repository()
	{
		$this->data->bodyclass = 'fixed unselectable siftal';
		$this->include->chart  = true;

		$this->data->display['admin'] = 'content_a/main/layout.html';
		$this->data->site['title']    = \lib\store::name();
		$this->data->store            = \lib\store::detail();


		// set shortkey for all badges is this content
		$this->data->page['badge']['shortkey'] = 123;
	}


	public static function make_sort_link($_field, $_url)
	{
		$get = \lib\utility::get(null, 'raw');
		if(!is_array($get))
		{
			$get = [];
		}

		$default_get =
		[
			'q'     => null,
			'sort'  => null,
			'order' => null,
		];

		$get          = array_merge($default_get, $get);
		$get['order'] = mb_strtolower($get['order']);
		$get['sort']  = mb_strtolower($get['sort']);

		$link = [];

		foreach ($_field as $key => $field)
		{
			$temp_link         = [];
			$temp_link['sort'] = $field;

			if($field === $get['sort'])
			{
				$temp_link['order'] = 'asc';
				if($get['order'] === 'asc')
				{
					$temp_link['order'] = 'desc';
				}
				$link[$field]['order'] = $temp_link['order'] === 'asc' ? 'desc' : 'asc';
			}
			else
			{
				$temp_link['order']    = 'asc';
				$link[$field]['order'] = null;
			}

			$temp_link['q']    = $get['q'];

			if(is_array(\lib\utility::get(null , 'raw')))
			{
				foreach (\lib\utility::get(null , 'raw') as $query_key => $query_value)
				{
					if(!in_array($query_key, ['q', 'sort', 'order']))
					{
						$temp_link[$query_key] = $query_value;
					}
				}
			}

			$link[$field]['link'] = $_url . '?'.  http_build_query($temp_link);
		}
		return $link;
	}
}
?>
