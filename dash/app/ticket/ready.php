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
					$statuclass = 'sf-exchange';
					switch ($value)
					{
						case 'awaiting':
							$color       = null;
							$color_class = 'pain';
							$statuclass = 'sf-bullhorn fc-black';
							break;


						case 'spam':
						case 'deleted':
						case 'filter':
							$color       = 'negative';
							$color_class = 'danger';
							$statuclass = 'sf-trash-can fc-red';
							break;


						case 'close':
							$color       = 'disabled';
							$color_class = 'secondary';
							$statuclass = 'sf-archive fc-mute';
							break;

						case 'answered':
							$color       = 'positive';
							$color_class = 'success';
							$statuclass = 'sf-coffee fc-gold';
							break;
					}

					$result['statuclass'] = '<i class="'. $statuclass. '" title="'. T_($value). '"></i>';

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
						$result['filedetail'] = \lib\filepath::get_detail($value);

					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'plus':
					if(!$value)
					{
						$value = 1;
					}
					$result[$key] = $value;
					break;

				case 'content':
					$result['content_raw'] = $value;

					if($value)
					{
						$value = \lib\shortcode::make_clickable($value);
					}
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}


		$result['link'] = \lib\store::url(). '/!'. $result['id'];

		if(\dash\temp::get('isApi'))
		{
			unset($result['prettyip']);
			unset($result['ipRaw']);
			unset($result['rowColor']);
			unset($result['colorClass']);
			unset($result['statuclass']);
			unset($result['plus']);
			unset($result['gender_string']);
		}

		return $result;
	}
}
?>