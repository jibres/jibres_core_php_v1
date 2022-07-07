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
					$result['urlraw'] = \lib\store::url(). '/f/'. $value;
					$result['url'] = \lib\store::url(). '/f/'. $value;
					break;

				case 'inquirysetting':
				case 'setting':
				case 'condition':
					if($value)
					{
						$result[$key] = json_decode($value, true);
					}
					else
					{
						$result[$key] = null;
					}
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
							$status_class = 'sf-clock text-red-800';
							break;

						case 'deleted':
							$status_class = 'sf-trash-can text-red-800';
							break;

						case 'lock':
							$status_class = 'sf-lock text-red-800';
							break;

						case 'block':
							$status_class = 'sf-time text-red-800';
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
				case 'inquiryimage':
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

		if(a($result, 'slug'))
		{
			$result['url'] = \lib\store::url(). '/f/'. $result['slug'];
		}


		return $result;
	}



	public static function fields($_form_detail, $_by_key = false)
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

		foreach ($field as $field_key => $one_field)
		{
			$key = explode('_', $field_key);

			if(isset($key[1]) && is_numeric($key[1]))
			{
				if(isset($key[2]) && is_numeric($key[2]))
				{
					if(isset($load_items[$key[1]]['title']))
					{
						if(isset($load_items[$key[1]]['choice'][$key[2]]['title']))
						{
							$my_field[] = ['item_id' => $key[1], 'field' => $field_key, 'visible' => $one_field['visible'], 'title' => $load_items[$key[1]]['title']. ' - '. $load_items[$key[1]]['choice'][$key[2]]['title']];
						}
					}
				}
				else
				{
					if(isset($load_items[$key[1]]['title']))
					{
						$my_field[] = ['item_id' => $key[1], 'field' => $field_key, 'visible' => $one_field['visible'], 'title' => $load_items[$key[1]]['title']];
					}
				}
			}
			else
			{
				$my_field[] = ['field' => $field_key, 'visible' => $one_field['visible'], 'title' => $field_key];
			}

		}

		if($_by_key)
		{
			$my_field = array_combine(array_column($my_field, 'field'), $my_field);
		}

		return $my_field;
	}


}
?>