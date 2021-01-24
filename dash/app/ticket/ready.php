<?php
namespace dash\app\ticket;

class ready
{

	public static function row($_data)
	{
		$result = [];

		if(!$_data)
		{
			return $result;
		}

		$_data = \dash\app::fix_avatar($_data);

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
					$statuclass = 'detail';
					switch ($value)
					{
						case 'awaiting':
							$color       = null;
							$color_class = 'pain';
							$statuclass = 'detail';
							break;


						case 'spam':
						case 'deleted':
						case 'filter':
							$color       = 'negative';
							$color_class = 'danger';
							$statuclass = 'stop nok';
							break;


						case 'close':
							$color       = 'disabled';
							$color_class = 'secondary';
							$statuclass = 'ban nok';
							break;

						case 'answered':
							$color       = 'positive';
							$color_class = 'success';
							$statuclass = 'check ok';
							break;
					}

					$result['statuclass'] = $statuclass;

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


		$result['link'] = \lib\store::url(). '/!'. $result['id'];

		return $result;
	}
}
?>