<?php
$smsPack = false;
if(\lib\app\plugin\business::is_activated('sms_pack'))
{
    $smsPack = true;
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

<?php if(!$smsPack) {?>
    <div class="alert-info">
        <div class="row">
            <div class="c-auto">
                <?php echo T_("You must get SMS plugin to send sms"); ?>
            </div>
            <div class="c"></div>
            <div class="c-auto">

                <a class="btn-success" href="<?php echo \dash\url::kingdom(). '/a/plugin/view/sms_pack' ?>">
                    <?php echo T_("Buy now") ?>
                </a>
            </div>
        </div>
    </div>
<?php  }else{ ?>
    <div class="box">
        <div class="body">
            <div class="row align-center">
                <div class="c">
                    <?php if($resendAll) {?>
                        <?php echo T_("You have :val not sent sms", ['val' => \dash\fit::number($notSentSMSCount)]); ?>
                    <?php }else{ ?>
                        <?php echo T_("This message not sent because your sms balance is low."); ?>
                        <br>
                        <?php echo T_("You can resend message if have new sms pack or archive it"); ?>
                        <br>
                    <?php } //endif ?>

                </div>

                <div
                data-ajaxify
                data-data='{"status": "recend"}'
                class="btn-success
                <?php
                if(!$smsPack)
                {
//                        echo ' disabled';
                }
                ?>
                "
                >
                <?php if($resendAll) { echo T_("Recend All"); }else{ echo T_("Resend");} ?>
            </div>
            <div class="c-auto c-xs-6">
            </div>

            <div class="c-auto c-xs-6">
                <div
                data-ajaxify
                data-data='{"status": "archive"}'
                class="btn-secondary">
                <?php if($resendAll) { echo T_("Archive All"); }else{ echo T_("Archive");} ?>
            </div>
        </div>
    </div>

</div>
</div>
<?php } // endif ?>
