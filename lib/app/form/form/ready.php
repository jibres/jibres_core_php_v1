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



}
?>