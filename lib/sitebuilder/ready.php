<?php
namespace lib\sitebuilder;


class ready
{
	public static function section_list($_data)
	{
		$result = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'body':
				case 'preview':
					if(is_string($value))
					{
						$value = json_decode($value, true);
					}

					if(!is_array($value))
					{
						$value = [];
					}


					if(isset($value['key']) && is_string($value['key']))
					{
						$default = [];

						$detail  = [];

						$namespace = '\\content_site\\section\\'. $value['key']. '\\chante';

						if(is_callable([$namespace, 'detail']))
						{
							$detail = call_user_func([$namespace, 'detail']);
							if(!is_array($detail))
							{
								$detail = [];
							}
						}

						if(is_callable([$namespace, 'default']))
						{
							$default = call_user_func([$namespace, 'default']);
							if(!is_array($default))
							{
								$default = [];
							}
						}

						$value = array_merge($detail, $default, $value);


					}


					$result[$key] = $value;
					break;

				// hide this field
				case 'duplicate':
				case 'titlesetting':
				case 'background':
				case 'avand':
				case 'margin':
				case 'padding':
				case 'radius':
				case 'ratio':
				case 'meta':
				case 'ifloginshow':
				case 'ifpermissionshow':
				case 'type':
				case 'puzzle':
				case 'infoposition':
				case 'effect':
				case 'detail':
				case 'text':
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