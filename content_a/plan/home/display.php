<?php
$planList = \dash\data::planList();
?>


<div class="max-w-7xl mx-auto py-24 px-4 bg-white sm:px-6 lg:px-8">
    <h2 class="text-3xl tracking-tight font-bold text-gray-900 sm:text-5xl sm:tracking-tight sm:leading-none lg:text-6xl lg:tracking-tight">
        Pricing plans</h2>
    <p class="mt-6 max-w-2xl text-xl text-gray-500">Choose an affordable plan that's packed with the best features for
        engaging your audience, creating customer loyalty, and driving sales.</p>
    <div class="mb-4 mt-4 mx-auto">
        <a href="<?php echo \dash\url::current() . \dash\request::full_get(['p' => 'monthly']) ?>"
           class="<?php if (\dash\request::get('p') == 'monthly') : echo 'btn-primary'; else: echo 'btn'; endif; ?>">
            Monthly billing
        </a>
        <a href="<?php echo \dash\url::current() . \dash\request::full_get(['p' => 'yearly']) ?>"
           class="<?php if (\dash\request::get('p') == 'yearly') : echo 'btn-primary'; else: echo 'btn'; endif; ?>">
            Yearly billing
        </a>
    </div>


    <form method="post" autocomplete="off">
        <div class="mt-24 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-8">
            <?php foreach ($planList as $plan) : ?>
                <!-- Tiers -->
                <div class="relative p-8 mx-1 bg-white border border-gray-200 rounded-2xl shadow-sm flex flex-col">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-900"><?php echo $plan['title']; ?></h3>
                        <p class="mt-4 flex items-baseline text-gray-900">
                            <span class="text-5xl tracking-tight font-bold"><?php echo \dash\fit::number($plan['price']) ?> <small><?php echo $plan['currencyName']; ?></small></span>
                            <span class="ml-1 text-xl font-semibold">/<?php if (\dash\request::get('p') == 'monthly') {
                                    echo T_("month");
                                } else {
                                    echo T_("year");
                                } ?></span>
                        </p>
                        <?php if (\dash\request::get('p') != 'monthly' && $plan['price']) : ?>
                            <div class="alert-info mt-4">To month free !</div>
                        <?php endif; ?>
                        <p class="mt-6 text-gray-500">The essentials to provide your best work for clients.</p>

                        <ul role="list" class="mt-6 space-y-6">
                            <?php foreach ($plan['featureList'] as $feature) : ?>
                                <li class="flex">

                                    <svg class="flex-shrink-0 w-6 h-6 text-indigo-500"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="ml-3 text-gray-500"><?php echo $feature ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php if ($plan['isActive']) : ?>
                        <div class="alert-success"><?php echo T_("Active"); ?></div>
                    <?php endif; ?>
                    <button name="plan" value="<?php echo $plan['name']; ?>" type="submit"
                            class="bg-indigo-50 text-indigo-700 hover:bg-indigo-100 mt-8 block w-full py-3 px-6 border border-transparent rounded-md text-center font-medium">
                        Monthly billing
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (\dash\data::myBudget())
        {
            if (\dash\data::myBudget())
            {
                $html = '';
                $html .= '<div class="p-2 mt-4">';
                {
                    $html .= '<div class="switch1">';
                    {
                        $html .= '<input type="checkbox" name="use_budget" id="use_budget">';
                        $html .= '<label for="use_budget"></label>';
                        $html .= '<label for="use_budget">';
                        {
                            $html .= T_('Use from budget');
                            $html .= ' ( ';
                            {
                                $html .= \dash\fit::number(\dash\data::myBudget_budget());
                                $html .= ' ';
                                $html .= \dash\data::myBudget_currency();
                            }
                            $html .= ' )';

                        }
                        $html .= '</label>';
                    }
                    $html .= '</div>';
                }
                $html .= '</div>';
                echo $html;
            }
        } ?>

    </form>
</div>



