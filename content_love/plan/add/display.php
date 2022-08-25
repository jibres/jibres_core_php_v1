<?php
$data    = \dash\data::dataRow();
$html    = '';
$storeId = \dash\data::dataRow_id();

$html .= '<form method="post" autocomplete="off">';
{

    $html .= "<div class='avand'>";
    {
        $html .= "<div class='box'>";
        {
            $html .= "<div class='pad'>";
            {
                $html .= $storeId;

                $html .= '<br>';

                $html .= '<label for="plan">' . T_("Plan") . '</label>';

                $html .= '<select name="plan" class="select22" id="plan">';
                {
                    foreach (\dash\data::planList() as $item) {
                        $html .= '<option value="' . $item . '">' . $item . '</option>';
                    }
                }
                $html .= '</select>';

                $html .= '<label for="periodtype">' . T_("Period") . '</label>';

                $html .= '<select name="periodtype" class="select22" id="periodtype">';
                {
                    $html .= '<option value="yearly">' . T_("Yearly") . '</option>';
                    $html .= '<option value="monthly">' . T_("Monthly") . '</option>';
                    $html .= '<option value="custom">' . T_("Custom") . '</option>';
                }
                $html .= '</select>';

                $html .= '<div data-response="periodtype" data-response-where="custom" data-response-hide>';
                {
                    $html .= '<label for="days">' . T_("Days") . '</label>';
                    $html .= '<div class="input">';
                    {
                        $html .= '<input type="tel" name="days" placeholder="' . T_("Days") . '">';
                    }
                    $html .= '</div>';

                }
                $html .= '</div>';

                $html .= '<div class="txtRa mt-2">';
                {
                    $html .= '<button type="submit" class="btn-success">' . T_("Set plan") . '</button>';
                }
                $html .= '</div>';

            }
            $html .= "</div>";
        }
        $html .= "</div>";
    }
    $html .= "</div>";

}
$html .= '</form>';

echo $html;
?>


