<?php
namespace lib\app\form\form;


class ready
{

	public static function row($_data)
	{
		if(!is_array($_data))
		{
			$_data = [];
		}

		$result     = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
					$result[$key] = $value;
					$result['url'] = \lib\store::url(). '/f/'. $value;
					break;

				case 'status':
					$result[$key] = $value;
					$status_class = null;
					switch ($value)
					{
						case 'draft':
							$status_class = 'sf-edit fc-blue';
							break;

						case 'publish':
							$status_class = 'sf-check fc-green';
							break;

						case 'expire':
							$status_class = 'sf-clock fc-red';
							break;

						case 'deleted':
							$status_class = 'sf-trash-can fc-red';
							break;

						case 'lock':
							$status_class = 'sf-lock fc-red';
							break;

						case 'block':
							$status_class = 'sf-time fc-red';
							break;


						case 'awaiting':
						case 'filter':
						case 'close':
						case 'full':
						default:
							$status_class = 'sf-database';
							break;
					}
					$result['status_class'] = $status_class;
					break;

				case 'file':
					if($value)
					{
						$value = \lib\filepath::fix($value);
					}

					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}


		return $result;
	}



	public static function fields($_form_detail)
	{
		$field = isset($_form_detail['analyzefield']) ? $_form_detail['analyzefield'] : null;
		if(!$field)
		{
			return [];
		}
		if(is_string($field))
		{
			$field = json_decode($field, true);
		}

		if(!is_array($field))
		{
			$field = [];
		}

		if(!$field)
		{
			return [];
		}

		$load_items = \lib\app\form\item\get::items($_form_detail['id']);
		if(!is_array($load_items))
		{
			$load_items = [];
		}

		$load_items = array_combine(array_column($load_items, 'id'), $load_items);

		$my_field = [];

		foreach ($field as $one_field)
		{
			$key = explode('_', $one_field);

			if(isset($key[1]) && is_numeric($key[1]))
			{
				if(isset($key[2]) && is_numeric($key[2]))
				{
					if(isset($load_items[$key[1]]['title']))
					{
						if(isset($load_items[$key[1]]['choice'][$key[2]]['title']))
						{
							$my_field[] = ['item_id' => $key[1], 'field' => $one_field, 'title' => $load_items[$key[1]]['title']. ' - '. $load_items[$key[1]]['choice'][$key[2]]['title']];
						}
					}
				}
				else
				{
					if(isset($load_items[$key[1]]['title']))
					{
						$my_field[] = ['item_id' => $key[1], 'field' => $one_field, 'title' => $load_items[$key[1]]['title']];
					}
				}
			}
			else
			{
				$my_field[] = ['field' => $one_field, 'title' => $one_field];
			}

		}

		return $my_field;
	}


}
?>