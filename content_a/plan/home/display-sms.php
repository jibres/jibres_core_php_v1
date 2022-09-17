<?php
$planList = \dash\data::planList();
?>
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-gray-100">
    <div class="pt-12 sm:pt-16 lg:pt-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl"><?php echo T_("SMS"); ?></h2>
                <p class="mt-4 text-xl text-gray-600">

            </div>
        </div>
    </div>
    <div class="mt-8 bg-white pb-16 sm:mt-12 sm:pb-20 lg:pb-28">
        <div class="relative">
            <div class="absolute inset-0 h-1/2 bg-gray-100"></div>
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-lg overflow-hidden rounded-lg shadow-lg lg:flex lg:max-w-none">
                    <div class="flex-1 bg-white px-6 py-8 lg:p-12">
                        <h3 class="text-2xl font-bold text-gray-900 sm:text-3xl sm:tracking-tight"><?php echo T_("The charge amount of your SMS account") ?></h3>
                        <div class="mt-6 text-xl">
                            <div><?php echo T_("Current charge"); ?></div>
                            <div class="font-bold">
								<?php echo \dash\fit::number(\dash\data::mySMSCharge_charge()) ?>
                            </div>

                            <small><?php echo \dash\data::mySMSCharge_currency() ?></small>
                        </div>
                    </div>
                    <div class="bg-gray-50 py-8 px-6 text-center lg:flex lg:flex-shrink-0 lg:flex-col lg:justify-center lg:p-12">


                        <div class="mt-6">
                            <div class="rounded-md shadow">
                                <a href="<?php echo \dash\url::here() . '/sms/charge'; ?>"
                                   class="flex items-center justify-center rounded-md border border-transparent bg-gray-800 px-5 py-3 text-base font-medium text-white hover:bg-gray-900"><?php echo T_("Increase Charge"); ?>
                                </a>
                            </div>
                        </div>


                        <p class="mt-4 text-sm">
                            <a href="<?php echo \dash\url::here() . '/sms/history' ?>"
                               class="font-medium text-gray-500 underline"><?php echo T_("History"); ?></a>
                        </p>
                        <p class="mt-4 text-sm">
                            <a href="<?php echo \dash\url::here() . '/sms/transactions' ?>"
                               class="font-medium text-gray-500 underline"><?php echo T_("Transactions"); ?></a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
