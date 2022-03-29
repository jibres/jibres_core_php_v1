<?php
$html = '';

$list = \dash\data::sudoCheckList();

$html .= '<div class="fs14">';
{
	foreach ($list as $key => $value)
	{
		$html .= '<a class="block mb-2" href="'. \dash\url::this(). '?check='. $key. '">';
		{
			$html .= $value;
		}
		$html .= '</a>';

		$dir = __DIR__. '/part/'. $key. '.me.json';

		if(is_file($dir))
		{
			$html .= '<a class="block mb-2" href="'. \dash\url::this(). '?file='. $key. '">';
			{
				$html .= 'Download file';
			}
			$html .= '</a>';
		}
	}
}
$html .= '</div>';

echo $html;
?>