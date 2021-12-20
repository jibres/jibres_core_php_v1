<?php
$html = '';

foreach (\dash\data::dataTable() as $key => $value)
{
	$my_id = 'f'. $key. 'title';
	$html .= \dash\layout\elements\form::form(['data-patch' => true, 'method' => 'post', 'id' => $my_id]);
	{
		$html .= \dash\layout\elements\input::hidden(['name' => 'id', 'value' => a($value, 'id'), 'form' => $my_id]);
	}
	$html .= \dash\layout\elements\form::_form();
}

$html .= '<div class="tblBox">';
{
	$html .= '<table class="tbl1 v1">';
	{
		$html .= '<thead>';
		{
			$html .= '<tr>';
			{
				$html .= '<th>'. T_("Title"). '</th>';
			}
			$html .= '</tr>';
		}
		$html .= '</thead>';


		$html .= '<tbody>';
		{
			foreach (\dash\data::dataTable() as $key => $value)
			{
				$html .= '<tr>';
				{
					$html .= '<td>';
					{
						$my_id = 'f'. $key. 'title';

						$html .= \dash\layout\elements\input::text(['name' => '_title', 'value' => a($value, 'title'), 'form' => $my_id, 'attr' => 'data-patch']);
						$html .= '<button class="btn" form="'. $my_id. '">'. T_("Save"). '</button>';
					}
					$html .= '</td>';
				}
				$html .= '</tr>';
			}
		}
		$html .= '</tbody>';
	}
	$html .= '</table>';

}
$html .= '</div>';



echo $html;

\dash\utility\pagination::html();

?>