<?php
$html = '';

$list = \dash\data::sudoCheckList();

$html .= '<div class="fs14">';
{
	foreach ($list as $key => $value)
	{
		$html .= '<a class="block mB10" href="'. \dash\url::this(). '?check='. $key. '">';
		{
			$html .= $value;
		}
		$html .= '</a>';
	}
}
$html .= '</div>';

echo $html;
?>