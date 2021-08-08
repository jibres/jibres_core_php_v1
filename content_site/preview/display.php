<?php
$preview  = \dash\data::myPreviewDetail();
$html = '';
$html .= '<div class="pointer-events-none">';
{
	$html .= a($preview, 'preview_html');
}
$html .= '</div>';

echo $html;
?>