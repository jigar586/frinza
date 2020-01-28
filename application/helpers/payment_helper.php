<?php
function payForOrder($walletpay,$bill,$ship,$msg = '',$pay_method)
{
	$CI =& get_instance();
	if (!isset($_SESSION['loggedUser']) || $bill == 0) {
		redirect(base_url('login'));
	}
	$CI->db->where('address_id',$bill);
	$addressData = $CI->db->get('address_mst')->result_array();
	if (!count($addressData)) {
		redirect(base_url('checkout'));
	}
	$postData = $_POST;
	$data['firstname'] = $addressData[0]['name'];
	$data['email'] = $addressData[0]['email'];
	$data['phone'] = $addressData[0]['contact'];
	$data['productinfo'] = 'Frinza Order';
	$data['txnid'] = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
	$data['surl'] = base_url('user/confirmorder');
	$data['furl'] = base_url('checkout');
	$data['curl'] = base_url('checkout');
	$data['service_provider'] = 'payu_paisa';
	$data['udf1'] = $bill;
	$data['udf2'] = $ship;
	$data['udf3'] = $msg;
	$data['udf4'] = '';
	$data['udf5'] = $pay_method;
	$data['udf6'] = '';
	$data['udf7'] = '';
	$data['udf8'] = '';
	$data['udf9'] = '';
	$data['udf10'] = '';
	
	$totalAmount = getShippingTotal() + getCartTotal();
	$wallet = redeemAmount($totalAmount);

	if ($walletpay) {
		if ($totalAmount >= $walletpay) {
			if ($walletpay > $wallet) {
	        	$amount = $totalAmount - $wallet;
	        	$udf10 = $wallet;
	        }else{
	        	$amount = $totalAmount - $walletpay;
	        	$udf10 = $walletpay;
	        }
		}else{
			if ($totalAmount >= $wallet) {
				$udf10 = $wallet;
				$amount = $totalAmount - $wallet;
			}else{
				$udf10 = $totalAmount;
				$amount = 0;
			}
		}
	}else{
		$amount = $totalAmount;
		$udf10 = 0;
	}
	if ($amount <= 0) {
		$_POST['udf1'] = $data['udf1'];
		$_POST['udf2'] = $data['udf2'];
		$_POST['udf3'] = $data['udf3'];
		$_POST['udf4'] = $udf10;
		$_POST['amount'] = 0;
		return true;
	}else{
	    $data['amount'] = $amount;
		$data['udf4'] = $udf10;
		
    // 	$data['billing_address'] = $_POST['billing']['address_1'].$_POST['billing']['address_2'];
    // 	$data['shipping_address'] = $_POST['shipping']['address_1'].$_POST['shipping']['address_2'];
    // 	$data['billing_name'] = $_POST['billing']['name'];
    // 	$data['billing_city'] = $_POST['billing']['city'];
    // 	$data['billing_state'] = $_POST['billing']['state'];
    // 	$data['billing_zip'] = $_POST['billing']['pin_code'];
    // 	$data['billing_tel'] = $_POST['billing']['contact'];
    // 	$data['billing_email'] = $_POST['billing']['email'];
    // 	$data['billing_country'] = 'India';
    	    	
    // 	$data['shipping_name'] = $_POST['shipping']['name'];
    // 	$data['shipping_city'] = $_POST['shipping']['city'];
    // 	$data['shipping_state'] = $_POST['shipping']['state'];
    // 	$data['shipping_zip'] = $_POST['shipping']['pin_code'];
    // 	$data['shipping_tel'] = $_POST['shipping']['contact'];
    // 	$data['shipping_email'] = $_POST['shipping']['email'];
		if($pay_method == 'payu'){
			paymentViaCurl($data,$postData);
		} else {
			print_r($data); die;
			return false;
		}
		return false;
	}
	redirect(base_url('checkout'));
}
function validatePayment($params)
{
	$CI =& get_instance();
	$status=$params["status"];
	$firstname=$params["firstname"];
	$amount=$params["amount"];
	$txnid=$params["txnid"];
	$posted_hash=$params["hash"];
	$key=$params["key"];
	$email=$params["email"];
	$productinfo=$params["productinfo"];
	$udf10 = $params["udf10"];
	$udf9 = $params["udf9"];
	$udf8 = $params["udf8"];
	$udf7 = $params["udf7"];
	$udf6 = $params["udf6"];
	$udf5 = $params["udf5"];
	$udf4 = $params["udf4"];
	$udf3 = $params["udf3"];
	$udf2 = $params["udf2"];
	$udf1 = $params["udf1"];
	
	$salt="yVIDqF7RoW";

	if ($params['udf5'] != 'test') {
	
		if(isset($params["additionalCharges"])) {
	      	$additionalCharges=$params["additionalCharges"];
	       	$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|'.$udf10.'|'.$udf9.'|'.$udf8.'|'.$udf7.'|'.$udf6.'|'.$udf5.'|'.$udf4.'|'.$udf3.'|'.$udf2.'|'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
	  	} else {
	    	$retHashSeq = $salt.'|'.$status.'|'.$udf10.'|'.$udf9.'|'.$udf8.'|'.$udf7.'|'.$udf6.'|'.$udf5.'|'.$udf4.'|'.$udf3.'|'.$udf2.'|'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
		}
		$hash = (hash("sha512", $retHashSeq));
	   if ($hash != $posted_hash) {
	   		$CI->session->set_flashdata('txnError','Invalid Transaction!');
	       redirect(base_url('checkout'));
		}
	}
	if ($status != 'success') {
		$CI->session->set_flashdata('txnError','Transaction Failed!');
		redirect(base_url('checkout'));
	}
}
//  Custom Payment Funcction
function paymentViaCurl($params,$postData)
{
//     $merchant_id = '213792';
//     $access_code = 'AVXO84GD39AB15OXBA';
// 	$working_key = '450AF60F2C9E76880A4EF1DB01B7E338';
//     $currency = 'INR';
    ?>
	<!--<html>-->
	<!--	<head>-->
	<!--	<title> CCAvenue Payment Gateway Integration kit</title>-->
	<!--	</head>-->
	<!--	<body>-->
	<!--<center>-->
	<?php
// 	$data ='order_id='.$params['udf1'].'&amount='.$params['amount'].'&merchant_id='.$merchant_id.'&currency='.$currency.'&billing_address='.$params['billing_address'].'&shipping_address='.$params['shipping_address'].'&billing_name='.$params['billing_name'].'&billing_city='.$params['billing_city'].'&billing_state'.$params['billing_state'].'&billing_zip='.$params['billing_zip'].'&billing_tel='.$params['billing_tel'].'&billing_email='.$params['billing_email'].'&billing_country='.$params['billing_country'];	
// 	$merchant_data = '';
	
// 	foreach($postData as $key=>$value){
// 		$merchant_data = $merchant_data.$key.'='.urlencode($value).'&';
// 	}
// 	$merchant_data = $merchant_data.$data;
    // print_r($merchant_data);
    // exit;
// 	$encryptedData = encrypt($merchant_data,$working_key);

	?>
	<!--<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> -->
	<?php
// 		echo "<input type=hidden name=encRequest value=$encryptedData>";
// 		echo "<input type=hidden name=access_code value=$access_code>";
	?>
	<!--</form>-->
	<!--</center>-->
	<!--	<script language='javascript'>document.redirect.submit();</script>-->
	<!--</body>-->
	<!--</html>-->
	<?php
	$MERCHANT_KEY = $params['key'] = "iv4QGyUB";
	$SALT  = "yVIDqF7RoW";
	$myData['service_provider'] = 'payu_paisa';
	// Merchant Key and Salt as provided by Payu.

	 //$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
	$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode
	// $PAYU_BASE_URL = "https://test.payu.in";
	$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($params[$hash_var]) ? $params[$hash_var] : '';
      $hash_string .= '|';
    }
    $hash_string .= $SALT;
    $hash = strtolower(hash('sha512', $hash_string));

    $params['hash'] = $hash;
    $action = $PAYU_BASE_URL . '/_payment';
    echo '<form  action="'.$action.'" method="post" name="payuForm">';
    foreach ($params as $key => $pramval) {
    	echo '<input type="hidden" name="'.$key.'" value="'.$pramval.'" />';
    }
    echo '</form><script>
			document.addEventListener("DOMContentLoaded", function(event) {
					var payuForm = document.forms.payuForm;
					payuForm.submit();
                });
			  </script>';
		exit;
}

function encrypt($plainText,$key)
{
	$secretKey = hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $encryptedText = openssl_encrypt($plainText, "AES-128-CBC", $secretKey, OPENSSL_RAW_DATA, $initVector);
    $encryptedText = bin2hex($encryptedText);
    return $encryptedText;
}

function decrypt($encryptedText,$key)
{
    $secretKey         = hextobin(md5($key));
    $initVector         =  pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $encryptedText      = hextobin($encryptedText);
    $decryptedText         =  openssl_decrypt($encryptedText,"AES-128-CBC", $secretKey, OPENSSL_RAW_DATA, $initVector);
    return $decryptedText;
}

function hextobin($hexString) 
 { 
	$length = strlen($hexString); 
	$binString="";   
	$count=0; 
	while($count<$length) 
	{       
	    $subString =substr($hexString,$count,2);           
	    $packedString = pack("H*",$subString); 
	    if ($count==0)
	    {
			$binString=$packedString;
	    } 
	    
	    else 
	    {
			$binString.=$packedString;
	    } 
	    
	    $count+=2; 
	} 
        return $binString; 
  } 
  
function pkcs5_pad ($plainText, $blockSize)
{
   $pad = $blockSize - (strlen($plainText) % $blockSize);
   return $plainText . str_repeat(chr($pad), $pad);
}