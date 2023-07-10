<?php

namespace App\Helpers;

use App\Models\Bank;
use App\Helpers\Shop;
use App\Helpers\Price;
use Cookie;
use URL;

class BankPayment
{
    /**
     * @var string
     */
    public $ccname;

    /**
     * @var int
     */
    public $ccno;

    /**
     * @var int
     */
    public $ccmonth;

    /**
     * @var int
     */
    public $ccyear;

    /**
     * @var int
     */
    public $cvv;

    /**
     * Credit card basic information.
     *
     * @param  string $ccname
     * @param  int    $ccno
     * @param  int    $ccmonth
     * @param  int    $ccyear
     * @param  int    $cvv
     * @return void
     */
    public function creditCard($ccname, $ccno, $ccmonth, $ccyear, $cvv)
    {
        $this->ccname = $ccname;
        $this->ccno = $ccno;
        $this->ccmonth = $ccmonth;
        $this->ccyear = $ccyear;
        $this->cvv = $cvv;
    }

    /**
     * Garanti Bank
     *
     * @param  int    $installment
     * @param  float  $amount
     * @param  string $reference
     * @param  string $email
     * @return string
     */
    public function garanti($installment, $amount, $reference, $email)
    {
        $bank = Bank::findOrFail(1);

        if ($installment == '0') {
            $installment = '';
        };

        $strMode = "PROD";
        $strVersion = "v0.01";
        $strTerminalID = $bank->customer_number;
        $strTerminalID_ = "0".$bank->customer_number;
        $strProvUserID = "PROVAUT";
        $strProvisionPassword = $bank->password;
        $strUserID = $reference;
        $strMerchantID = $bank->merchant_number;
        $strIPAddress = $_SERVER['REMOTE_ADDR'];
        $strEmailAddress = $email;
        $strOrderID = $reference;
        $strInstallmentCnt = $installment;
        $strNumber = $this->ccno;
        $strExpireDate = $this->ccmonth.$this->ccyear;
        $strCVV2 = $this->cvv;
        $strAmount = $amount;
        $strType = "sales";
        $strCurrencyCode = "949";
        $strCardholderPresentCode = "0";
        $strMotoInd = "N";
        $strHostAddress = "https://sanalposprov.garanti.com.tr/VPServlet";
        $SecurityData = strtoupper(sha1($strProvisionPassword.$strTerminalID_));
        $HashData = strtoupper(sha1($strOrderID.$strTerminalID.$strNumber.$strAmount.$SecurityData));
        $xml= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
        <GVPSRequest>
        <Mode>$strMode</Mode><Version>$strVersion</Version>
        <Terminal><ProvUserID>$strProvUserID</ProvUserID><HashData>$HashData</HashData><UserID>$strUserID</UserID>
        <ID>$strTerminalID</ID><MerchantID>$strMerchantID</MerchantID></Terminal>
        <Customer><IPAddress>$strIPAddress</IPAddress><EmailAddress>$strEmailAddress</EmailAddress></Customer>
        <Card><Number>$strNumber</Number><ExpireDate>$strExpireDate</ExpireDate><CVV2>$strCVV2</CVV2></Card>
        <Order><OrderID>$strOrderID</OrderID><GroupID></GroupID><AddressList><Address><Type>S</Type>
        <Name></Name><LastName></LastName><Company></Company><Text></Text><District></District><City></City>
        <PostalCode></PostalCode><Country></Country><PhoneNumber></PhoneNumber></Address></AddressList>
        </Order><Transaction><Type>$strType</Type><InstallmentCnt>$strInstallmentCnt</InstallmentCnt>
        <Amount>$strAmount</Amount><CurrencyCode>$strCurrencyCode</CurrencyCode><CardholderPresentCode>$strCardholderPresentCode</CardholderPresentCode><MotoInd>$strMotoInd</MotoInd>
        <Description></Description><OriginalRetrefNum></OriginalRetrefNum></Transaction>
        </GVPSRequest>";

        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $strHostAddress);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1) ;
        curl_setopt($ch, CURLOPT_POSTFIELDS, "data=".$xml);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $results = curl_exec($ch);
        curl_close($ch);

        $xml_parser = xml_parser_create();
        xml_parse_into_struct($xml_parser, $results, $vals, $index);
        xml_parser_free($xml_parser);

        $strReasonCodeValue = $vals[$index['REASONCODE'][0]]['value'];

        if ($strReasonCodeValue == "00") {
            $resultProcess = 'success';
        } else {
            $resultProcess = 'error';
        }
                
        return $resultProcess;
    }

    /**
     * Akbank Bank
     *
     * @param  int    $installment
     * @param  float  $amount
     * @param  string $reference
     * @param  string $email
     * @return string
     */
    public function akbank($installment, $amount, $reference, $email)
    {
        $bank = Bank::findOrFail(2);

        if ($installment == '0') {
            $installment = '';
        };

        $name = $bank->username;
        $password = $bank->password;
        $clientid = $bank->merchant_number;
        $lip = $_SERVER['REMOTE_ADDR'];
        $oid = $reference;
        $type = "Auth";

        $request= "DATA=<?xml version=\"1.0\" encoding=\"ISO-8859-9\"?>
        <CC5Request>
        <Name>{NAME}</Name>
        <Password>{PASSWORD}</Password>
        <ClientId>{CLIENTID}</ClientId>
        <IPAddress>{IP}</IPAddress>
        <Email>{EMAIL}</Email>
        <Mode>P</Mode>
        <OrderId>{OID}</OrderId>
        <GroupId></GroupId>
        <TransId></TransId>
        <UserId></UserId>
        <Type>{TYPE}</Type>
        <Number>{CCNO}</Number>
        <Expires>{CCTAR}</Expires>
        <Cvv2Val>{CV2}</Cvv2Val>
        <Total>{TUTAR}</Total>
        <Currency>949</Currency>
        <Taksit>{TAKSIT}</Taksit>
        <BillTo>
        <Name></Name>
        <Street1></Street1>
        <Street2></Street2>
        <Street3></Street3>
        <City></City>
        <StateProv></StateProv>
        <PostalCode></PostalCode>
        <Country></Country>
        <Company></Company>
        <TelVoice></TelVoice>
        </BillTo>
        <ShipTo>
        <Name></Name>
        <Street1></Street1>
        <Street2></Street2>
        <Street3></Street3>
        <City></City>
        <StateProv></StateProv>
        <PostalCode></PostalCode>
        <Country></Country>
        </ShipTo>
        <Extra></Extra>
        </CC5Request>";

        $request=str_replace("{NAME}", $name, $request);
        $request=str_replace("{PASSWORD}", $password, $request);
        $request=str_replace("{CLIENTID}", $clientid, $request);
        $request=str_replace("{IP}", $lip, $request);
        $request=str_replace("{OID}", $oid, $request);
        $request=str_replace("{TYPE}", $type, $request);
        $request=str_replace("{CCNO}", $this->ccno, $request);
        $request=str_replace("{CCTAR}", $this->ccmonth."/".$this->ccyear, $request);
        $request=str_replace("{CV2}", $this->cvv, $request);
        $request=str_replace("{TUTAR}", $amount, $request);
        $request=str_replace("{TAKSIT}", $installment, $request);
        $request=str_replace("{EMAIL}", $email, $request);

        $url = "https://www.sanalakpos.com/servlet/cc5ApiServer";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            print curl_error($ch);
        } else {
            curl_close($ch);
        }

        $Response = "";
        $OrderId = "";
        $AuthCode = "";
        $ProcReturnCode = "";
        $ErrMsg ="";
        $HOSTMSG  ="";

        $response_tag="Response";
        $posf = strpos($result, ("<" . $response_tag . ">"));
        $posl = strpos($result, ("</" . $response_tag . ">")) ;
        $posf = $posf+ strlen($response_tag) +2 ;
        $Response = substr($result, $posf, $posl - $posf) ;

        $response_tag="OrderId";
        $posf = strpos($result, ("<" . $response_tag . ">"));
        $posl = strpos($result, ("</" . $response_tag . ">")) ;
        $posf = $posf+ strlen($response_tag) +2 ;
        $OrderId = substr($result, $posf, $posl - $posf) ;

        $response_tag="AuthCode";
        $posf = strpos($result, "<" . $response_tag . ">");
        $posl = strpos($result, "</" . $response_tag . ">") ;
        $posf = $posf+ strlen($response_tag) +2 ;
        $AuthCode = substr($result, $posf, $posl - $posf) ;

        $response_tag="ProcReturnCode";
        $posf = strpos($result, "<" . $response_tag . ">");
        $posl = strpos($result, "</" . $response_tag . ">") ;
        $posf = $posf+ strlen($response_tag) +2 ;
        $ProcReturnCode = substr($result, $posf, $posl - $posf) ;

        $response_tag="ErrMsg";
        $posf = strpos($result, "<" . $response_tag . ">");
        $posl = strpos($result, "</" . $response_tag . ">") ;
        $posf = $posf+ strlen($response_tag) +2 ;
        $ErrMsg = substr($result, $posf, $posl - $posf) ;

        if ($Response==="Approved") {
            $resultProcess='success';
        } else {
            $resultProcess='error';
        }

        return $resultProcess;
    }

    /**
     * Kuveytturk Bank
     *
     * @param  float  $amount
     * @param  string $reference
     * @return void
     */
    public function kuveytturk($amount, $reference)
    {
        $bank = Bank::findOrFail(3);

        $APIVersion = "1.0.0";
        $Type = "Sale";
        $Amount = $amount*100;
        $CurrencyCode = "0949";
        $MerchantOrderId = $reference;
        $CustomerId = $bank->customer_number;
        $MerchantId = $bank->merchant_number;
        $OkUrl = URL::to('odeme/kart/dogrulama/success');
        $FailUrl = URL::to('odeme/kart/dogrulama/error');
        $UserName = $bank->username;
        $Password = $bank->password;
        $HashedPassword = base64_encode(sha1($Password, "ISO-8859-9"));
        $HashData = base64_encode(sha1($MerchantId.$MerchantOrderId.$Amount.$OkUrl.$FailUrl.$UserName.$HashedPassword,
                    "ISO-8859-9"));
        $TransactionSecurity=3;
        $xml= '<KuveytTurkVPosMessage xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
        xmlns:xsd="http://www.w3.org/2001/XMLSchema">'
                .'<APIVersion>1.0.0</APIVersion>'
                .'<OkUrl>'.$OkUrl.'</OkUrl>'
                .'<FailUrl>'.$FailUrl.'</FailUrl>'
                .'<HashData>'.$HashData.'</HashData>'
                .'<MerchantId>'.$MerchantId.'</MerchantId>'
                .'<CustomerId>'.$CustomerId.'</CustomerId>'
                .'<UserName>'.$UserName.'</UserName>'
                .'<CardNumber>'.$this->ccno.'</CardNumber>'
                .'<CardExpireDateYear>'.$this->ccyear.'</CardExpireDateYear>'
                .'<CardExpireDateMonth>'.$this->ccmonth.'</CardExpireDateMonth>'
                .'<CardCVV2>'.$this->cvv.'</CardCVV2>'
                .'<CardHolderName>'.$this->ccname.'</CardHolderName>'
                .'<CardType>MasterCard</CardType>'
                .'<BatchID>0</BatchID>'
                .'<TransactionType>'.$Type.'</TransactionType>'
                .'<InstallmentCount>0</InstallmentCount>'
                .'<Amount>'.$Amount.'</Amount>'
                .'<DisplayAmount>0</DisplayAmount>'
                .'<CurrencyCode>'.$CurrencyCode.'</CurrencyCode>'
                .'<MerchantOrderId>'.$MerchantOrderId.'</MerchantOrderId>'
                .'<TransactionSecurity>3</TransactionSecurity>'
                .'<TransactionSide>Sale</TransactionSide>'
                .'</KuveytTurkVPosMessage>';
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml',
                                                       'Content-length: '. strlen($xml)));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_URL, 'https://boa.kuveytturk.com.tr/sanalposservice/Home/ThreeDModelPayGate');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            curl_close($ch);
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $data;
    }

    /**
     * Payu Payment Center
     *
     * @param  int    $installment
     * @param  string $reference
     * @param  string $name
     * @param  string $surname
     * @param  string $email
     * @param  string $phone
     * @return string
     */
    public function payu($installment, $reference, $name, $surname, $email, $phone)
    {
        $bank = Bank::findOrFail(4);

        $cart_number = Cookie::get('cart');
        $carts = Shop::cart($cart_number);
        $total = Shop::cartDetail($cart_number);

        $url = "https://secure.payu.com.tr/order/alu/v3";
 
        $secretKey = $bank->password;

        $arParams['MERCHANT'] = $bank->merchant_number;
        $arParams['ORDER_REF'] = $reference;
        $arParams['ORDER_DATE'] = gmdate('Y-m-d H:i:s');

        foreach ($carts as $key => $cart) {
            $arParams["ORDER_PNAME[$key]"] = $cart->name;
            $arParams["ORDER_PCODE[$key]"] = $cart->product_id;
            $arParams["ORDER_PINFO[$key]"] = '-';
            $arParams["ORDER_PRICE[$key]"] = $cart->price;
            $arParams["ORDER_QTY[$key]"] = $cart->stock;
        }

        $arParams['PRICES_CURRENCY'] = "TRY";
        $arParams['PAY_METHOD'] = "CCVISAMC";
        $arParams['SELECTED_INSTALLMENTS_NUMBER'] = $installment;
        $arParams['CC_NUMBER'] = $this->ccno;
        $arParams['EXP_MONTH'] = $this->ccmonth;
        $arParams['EXP_YEAR'] = $this->ccyear;
        $arParams['CC_CVV'] = $this->cvv;
        $arParams['CC_OWNER'] = $this->ccname;
        $arParams['BACK_REF'] = "#";
        $arParams['CLIENT_IP'] = "127.0.0.1";
        $arParams['BILL_LNAME'] = $name;
        $arParams['BILL_FNAME'] = $surname;
        $arParams['BILL_EMAIL'] = $email;
        $arParams['BILL_PHONE'] = $phone;
        $arParams['BILL_COUNTRYCODE'] = "TR";
        $arParams['ORDER_SHIPPING'] = Price::estbank($total->cargoPrice);
        $arParams['DISCOUNT'] = Price::estbank($total->couponDiscount);
 
        ksort($arParams);
        $hashString = "";
        foreach ($arParams as $key=>$val) {
            $hashString .= strlen($val) . $val;
        }
        $arParams["ORDER_HASH"] = hash_hmac("md5", $hashString, $secretKey);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($arParams));
        $response = curl_exec($ch);
        $curlerrcode = curl_errno($ch);
        $curlerr = curl_error($ch);
 
        if (empty($curlerr) && empty($curlerrcode)) {
            $parsedXML = @simplexml_load_string($response);
            if ($parsedXML !== false) {
                $payuTranReference = $parsedXML->REFNO;
                if ($parsedXML->STATUS == "SUCCESS") {
                    if (($parsedXML->RETURN_CODE == "3DS_ENROLLED") && (!empty($parsedXML->URL_3DS))) {
                        header("Location:" . $parsedXML->URL_3DS);
                        die();
                    }
 
            // echo "SUCCES [PayU reference number: " . $payuTranReference . "]";

            $resultProcess = 'success';
                } else {
                    // echo "FAILED: " . $parsedXML->RETURN_MESSAGE . " [" . $parsedXML->RETURN_CODE . "]";
            $resultProcess = 'error';

                    if (!empty($payuTranReference)) {
                        // echo " [PayU reference number: " . $payuTranReference . "]";
                    }
                }
            }
        } else {
            // echo "cURL error: " . $curlerr;
        $resultProcess = 'error';
        };

        return $resultProcess;
    }
}
