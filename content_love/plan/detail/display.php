<?php
$data = \dash\data::dataRow();
$html = '';
$html .= '<nav class="items ltr">';
{
    $html .= '<ul>';
    {
        foreach ($data as $field => $value) {
            $html .= '<li>';
            {
                $html .= '<a class="f item">';
                {
                    $html .= '<div class="key">';
                    {
                        $html .= $field;
                    }
                    $html .='</div>';
                    $html .= '<div class="value font-bold">';
                    {

                        $html .= $value;
                    }
                    $html .= '</div>';
                }
                $html .= '</a>';

                $html .= $field;
                $html .= ' <b>';
                {
                    $html .= $value;
                }
                $html .= '</b>';
            }
            $html .= '</li>';
        }
    }
    $html .= '</ul>';
}
$html .= '</nav>';


echo $html;
?>

