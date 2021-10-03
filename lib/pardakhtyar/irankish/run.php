<?php
namespace lib\irankish;


class run
{


    public static function run($_args = [])
    {
        // if soap is not exist return false
        if(!class_exists("soapclient"))
        {
            \dash\log::set('payment:parsian:soapclient:not:install');
            \dash\notif::error(T_("Can not connect to parsian gateway. Install it!"));
            // return false;
        }

        // try
        {
            $soap_meta =
            [
                'soap_version' => 'SOAP_1_1',
                'cache_wsdl'   => WSDL_CACHE_NONE ,
                'encoding'     => 'UTF-8',
                'exceptions'   => true,
            ];

            $client = @new \SoapClient('http://185.79.62.20/Services/DefineMerchant?wsdl',$soap_meta);


            // $result = $client->Login("RoozAndishKavirPeyma", "Aa@123456");
            $my_result = [];

            $login = $client->login(["username" => "RoozAndishKavirPeyma", "password" => "Aa@123456"]);
            $my_result['login'] = $login;
            $my_token = null;
            if(isset($login->LoginResult->Data))
            {
             $my_token = $login->LoginResult->Data;
            }

            // $my_result['GetBankID'] = $client->GetBankID();
            // $my_result['GetProvinceID'] = $client->GetProvinceID();
            // $my_result['GetCityID'] = $client->GetCityID(['ProvinceId' => 1]);
            // $my_result['GetCountryID'] = $client->GetCountryID();
            // $my_result['GetBusinessID'] = $client->GetBusinessID();

            // $my_result['GetActivityID'] = $client->GetActivityID(['BusinessID' => 277]);

            $add_acceptor =
            [
                'Acceptor' =>
                [
                    'AcceptorTypeID'     => 1,
                    'Qty'                => 1,
                    'Identifier'         => 59470001,
                    'Token'              => $my_token,
                    'EnamadVerified'     => 1,
                    'Website'            => 'https://bitty.ir',
                    'IPAddress'          => '2.182.154.172',
                    // 'EnamadCategory'  => 2,
                    // 'EnamadType'      => 2,
                    'IPGTechnicalName'   => "رضا",
                    'IPGTechnicalFamily' => "محیطی",
                    'IPGTechnicalPhone'  => "09109610612",
                    'IPGTechnicalEEmail' => "reza@jibres.com",
                    'MerchantName'       => "فروشگاه بیتی",
                    'ZipCode'            => "3714816445",
                    'Phone'              => "02536505281",
                    'Mobile'             => "09109610612",
                    'Email'              => "reza@jibres.com",
                    'LatinMerchantName'  => "Bitty",
                    'ProvinceId'         => "159", // get from api
                    // 'AreaId'          => null,
                    'OwnerShipType'      => 2,
                    'Address'            => "قم خیابان هفت تیر کوچه یک پلاک 38",
                    'BankId'             => 6837, // get from api

                    'AcceptorAccountNo'  => '104941821',
                    'AcceptorIbanNo'     => 'IR780700001000114904182001',
                ],
                'Customer' =>
                [
                    'Name'                 => "رضا",
                    'Family'               => "محیطی",
                    'LatinName'            => "Reza",
                    'LatinFamily'          => "Mohiti",
                    'FatherName'           => "احمد",
                    'LatinFatherName'      => "Ahmad",
                    'NationalCode'         => "4440032109",
                    'Birthdate'            => "1370/01/16",
                    'Gender'               => 2, // 1 = female 2 = male
                    'CountryId'            => 5,
                    // 'ProvinceId'           => null,
                    // 'CityID'               => null,
                    // 'RegisterNumber'       => null,
                    // 'LicenceNumber'        => null,
                    // 'ForeigneCode'         => null,
                    'LegalType'            => 1,
                    // 'ForeignLicenceNo'     => null,
                    // 'PassportValidity'     => null,
                    // 'PassportNo'           => null,
                    // 'ForeignLicenseIssuer' => null,
                    // 'FoundationDate'       => null,
                    // 'CompanyName'          => null,
                    // 'EnCompanyName'        => null,
                    'VitalStatus'          => 1,
                    // 'CommercialCode'       => null,
                ],
                'FileAttachment' => []
            ];

            // $my_result['AddAcceptorPardakhtYar'] = $client->AddAcceptorPardakhtYar(['acceptor' => $add_acceptor, 'token' => $my_token]);
            // $my_result['AddAcceptorPardakhtYar'] = $client->AddAcceptorPardakhtYar([$add_acceptor, $my_token]);
            // $my_result['AddAcceptorPardakhtYar'] = $client->AddAcceptorPardakhtYar($add_acceptor);

            // $my_result['Inquery'] = $client->Inquery(['trackid' => null, 'token' => null]);



            var_dump($my_result);
            exit();
            self::$payment_response = $result;

            $status = $result->SalePaymentRequestResult->Status;
            $token  = $result->SalePaymentRequestResult->Token;
            $msg    = self::msg($status);

            if ($status === 0 && $token > 0)
            {
                $url = "https://pec.shaparak.ir/NewIPG/?Token=" . $token;
                return $url;
            }
            else
            {
                \dash\log::set('payment:parsian:error');
                \dash\notif::error($msg);
                return false;
            }
        }
        // catch (\Exception $e)
        // {
        //     \dash\log::set('payment:parsian:error:load:web:services');
        //     \dash\notif::error(T_("Error in load web services"));
        //     return false;
        // }
    }





}
?>