<?php
$html = '';


if(\dash\request::get('status') === 'moneylow')
{
    $notSentSMSCount = \lib\app\sms\get::notSentSMSCount();
    if($notSentSMSCount)
    {
        $html .= '<div class="alert-info">';
        {
            $html .= T_("You have :val not sent sms", ['val' => \dash\fit::number($notSentSMSCount)]);

            $html .= '<div class="row">';
            {
                $html .= '<div class="c-auto">';
                {
                    $html .= '<div class="btn-secondary">'. T_("Archive all"). '</div>';
                }
                $html .= '</div>';
                $html .= '<div class="c-auto">';
                {
                    $html .= '<div class="btn-success">'. T_("Resend all"). '</div>';

                }
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        $html .= '</div>';

    }
}



echo $html;
