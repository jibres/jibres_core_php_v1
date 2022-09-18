<?php


if(!isset($notSentSMSCount))
{
	$notSentSMSCount = 0;
}


if(isset($resendAll) && $resendAll)
{
	$resendAll = true;
}
else
{
	$resendAll = false;
}

?>



<div class="box">
    <div class="body">
        <div class="row align-center">
            <div class="c">
				<?php if($resendAll) { ?>
					<?php echo T_("You have :val not sent sms", ['val' => \dash\fit::number($notSentSMSCount)]); ?>
				<?php } else { ?>
					<?php echo T_("This message not sent because your sms balance is low."); ?>
                    <br>
					<?php echo T_("You can resend message if have new sms pack or archive it"); ?>
                    <br>
				<?php } //endif ?>

            </div>

            <div
                    data-ajaxify
                    data-data='{"status": "resend"}'
                    class="btn-success"
            >
				<?php if($resendAll)
				{
					echo T_("Resend All");
				}
				else
				{
					echo T_("Resend");
				} ?>
            </div>
            <div class="c-auto c-xs-6">
            </div>

            <div class="c-auto c-xs-6">
                <div
                        data-ajaxify
                        data-data='{"status": "archive"}'
                        class="btn-secondary">
					<?php if($resendAll)
					{
						echo T_("Archive All");
					}
					else
					{
						echo T_("Archive");
					} ?>
                </div>
            </div>
        </div>

    </div>
</div>
