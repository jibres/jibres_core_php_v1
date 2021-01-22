<?php
namespace dash\app\ticket;

class ready
{

	public static function row($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'ip':
					if($value)
					{
						$result['prettyip'] = \dash\fit::number(long2ip($value));
						$result['ipRaw']    = long2ip($value);
					}
					$result[$key] = $value;
					break;

				case 'status':
					$color       = null;
					$color_class = null;
					switch ($value)
					{
						case 'awaiting':
							$color       = null;
							$color_class = 'pain';
							break;

						case 'unapproved':
							$color       = 'warning';
							$color_class = 'warn';
							break;

						case 'spam':
						case 'deleted':
						case 'filter':
							$color       = 'negative';
							$color_class = 'danger';
							break;

						case 'close':
							$color       = 'disabled';
							$color_class = 'secondary';
							break;

						case 'answered':
							$color       = 'positive';
							$color_class = 'success';
							break;
					}

					if(isset($_data['plus']) && $_data['plus'])
					{
						if($value === 'awaiting')
						{
							$color = 'active';
						}
					}

					$result['rowColor']   = $color;
					$result['colorClass'] = $color_class;
					$result[$key]         = $value;
					break;
				case 'id':
					$result[$key] = $value;
					$datecreated = isset($_data['datecreated']) ? $_data['datecreated'] : null;
					if($datecreated)
					{
						$result['code'] =  md5((string) $value. '^_^-*_*)JIBRES));))__'. $datecreated);
					}
					break;

				case 'user_in_ticket':
					if($value)
					{
						$explode = explode(',', $value);
						$result[$key] = array_map(['\dash\coding', 'encode'], $explode);
					}
					else
					{
						$result[$key] = [];
					}
					break;
				case 'user_id':
				case 'term_id':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'avatar':
				case 'file':
					if(isset($value))
					{
						$result[$key] = \lib\filepath::fix($value);
					}
					else
					{
						$result[$key] = null;
					}
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