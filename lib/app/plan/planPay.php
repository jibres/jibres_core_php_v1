<?php

namespace lib\app\plan;


class planPay
{
    private $plan;
    private $planPrice;
    private $needPay = false;
    private $payLink = null;

    public function __construct(plan $_plan, planPrice $_planPrice)
    {
        $this->plan      = $_plan;
        $this->planPrice = $_planPrice;
    }


    public function needPay()
    {
        return $this->needPay;
    }


    public function payLink()
    {
        return $this->payLink;
    }


    public function readyToPay(array $_data)
    {
        $price = $this->planPrice->calculatePrice(intval($_data['period']));

        $userId = $this->getUserId();

        $turnBack = $_data['turn_back'];

        if(!$turnBack)
        {
            $turnBack = \dash\url::jibres_domain();
        }
        if($price)
        {
            $this->needPay = true;
            // go to bank
            $meta =
            [
                'pay_on_jibres' => true,
                'msg_go'        => T_("Activate plan :val", ['val' => $this->plan->title()]),
                'auto_go'       => false,
                'auto_back'     => true,
                'final_msg'     => false,
                'turn_back'     => $turnBack,
                'user_id'       => $userId,
                'amount'        => $price,
                'final_fn'      => ['/lib/app/plan/pay', 'after_pay'],
                'final_fn_args' => ['plan' => $this->plan->name(), 'month' => intval($_data['period'])],
            ];

            $result_pay = \dash\utility\pay\start::api($meta);

            if(isset($result_pay['url']) && isset($result_pay['transaction_id']))
            {
                $this->payLink = $result_pay['url'];
            }
            else
            {
                // error
            }

        }
        else
        {
            $this->needPay = false;
        }
    }


    private function getUserId()
    {
        if(\dash\engine\store::inStore())
        {
            $userId = \dash\user::jibres_user();
        }
        else
        {
            $userId = \dash\user::id();
        }

        return $userId;
    }
}
