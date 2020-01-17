<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserSection extends CI_Controller {

	function __construct() 
	{ 
         parent::__construct();
         $this->load->library('user');
         $this->load->library('google');
   }
   	function createUser()
   	{
   		$first_name = $this->input->post('FirstName');
   		$last_name = $this->input->post('LastName');
   		$user_email = $this->input->post('email');
   		$user_pwd = md5($this->input->post('password'));
         $user_contact = $this->input->post('contact');
   		$doesExist = $this->user->checkUser($user_email);
   		if (count($doesExist) != 0) {
   			echo "<p style='color:red'>You are Already Registered as ".$doesExist[0]->first_name."</p>";
   		}else{
   			$data = array('first_name' => $first_name,
   							'last_name' => $last_name,
   							'user_email' => $user_email,
   							'user_pwd' => $user_pwd,
                        'user_contact' => $user_contact);
   			$result = $this->user->createUser($data);
   			if ($result) {
   				echo "<p style='color:green'> Congratulations!! You can Login Now!!</p>";
               $reciever_email = $this->input->post('email');
               $reciever_email = $user_email;
               $subject = 'Welcome to Frinza. You have successfully completed the sign up process. Let\'s start exploring.';
               $emailTemplate['username'] = $first_name.' '.$last_name;
               $msg = $this->load->view('email_templates/register',$emailTemplate,TRUE);
               SendEmail($reciever_email,$subject,$msg);
               sendSMS(@$user_contact,smsTemplate('register',@$reciever_email));
   			}else{
   				echo "<p style='color:red'> You have Entered Incorrect Data!!</p>";
   			}
   		}
   	}
      function loginUser()
      {
         $data['user_email'] = $this->input->post('email');
         $data['user_pwd'] = md5($this->input->post('pass'));
         $result = $this->user->loginUser($data);
         if (count($result) != 0) {
            $_SESSION['loggedUser'] = $result[0]->uid;
            echo "<p style='color:green'>Welcome back to Our Website ".$result[0]->first_name."!</p>";
         }
         else{
            echo 0;
         }
      }
      function logoutUser()
      {
         if (@$_SESSION['oauth'] == 'facebook') {
            $this->session->unset_userdata('fb_access_token');
            unset($_SESSION['oauth']);
         }elseif (@$_SESSION['oauth'] == 'google') {
            $this->google->revokeToken();
            unset($_SESSION['oauth']);
       }elseif (@$_SESSION['oauth']) {
         unset($_SESSION['oauth']);
       }
         unset($_SESSION['loggedUser']);
         redirect(base_url('login'));
      }
      function facebookAuth()
      {
         $this->load->library('Facebook');
         $userData = array();
         if ($this->facebook->is_authenticated()) {
            $fbUserProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,picture');
               $userData['oauth_provider'] = 'facebook';
               $userData['oauth_uid'] = $fbUserProfile['id'];
               $userData['first_name'] = $fbUserProfile['first_name'];
               $userData['last_name'] = $fbUserProfile['last_name'];
               $userData['user_email'] = $fbUserProfile['email'];
               $userData['user_picture'] = $fbUserProfile['picture']['data']['url'];
               $userID = $this->user->checkFacebookAuth($userData);
               if (!empty($userID)) {
                  $_SESSION['loggedUser'] = $userID;
                  $_SESSION['oauth'] = 'facebook';
               }
         }
         redirect(base_url('login'));
      }
      function googleAuth()
      {
         if (isset($_GET['code'])) {
            $this->google->getAuthenticate();
            $userData = $this->google->getUserInfo();
            $data = array();
            $data['oauth_provider'] = 'google';
            $data['oauth_uid'] = $userData['id'];
            $data['first_name'] = $userData['given_name'];
            $data['last_name'] = $userData['family_name'];
            $data['user_email'] = $userData['email'];
            $data['user_picture'] = $userData['picture'];
            $userID = $this->user->checkFacebookAuth($data);
            if (!empty($userID)) {
               $_SESSION['loggedUser'] = $userID;
               $_SESSION['oauth'] = 'google';
            }
         }
         redirect(base_url('login'));
      }
      function guestLogin()
      {
         $first_name = $this->input->post('FirstName');
         $last_name = $this->input->post('LastName');
         $user_email = $this->input->post('email');
         $user_contact = $this->input->post('contact');
         $doesExist = $this->user->checkUser($user_email);
         if (count($doesExist) != 0) {
            echo "<p style='color:red'>You are Already Registered as ".@$doesExist[0]->first_name."</p>";
         }else{
            $data = array('first_name' => $first_name,
                        'last_name' => $last_name,
                        'user_email' => $user_email,
                        'oauth_provider' => 'guest',
                        'user_contact' => $user_contact );
            $result = $this->user->createUser($data);
            $_SESSION['loggedUser'] = $this->db->insert_id();
            $_SESSION['oauth'] = 'guest';
            if ($result) {
               echo "<p style='color:green'> Welcome to our Website!!</p>";
            }else{
               echo "<p style='color:red'> You have Entered Incorrect Data!!</p>";
            }
         }
      }
      function sendToCorporate()
      {
         /* Send Email */
         $name = $this->input->post('name');
         $user_email = $this->input->post('email');
         $user_contact = $this->input->post('contact');
         $company = $this->input->post('company');
         $address = $this->input->post('address');
         $user_subject = $this->input->post('subject');
         $subject = $user_subject;
         $message = $this->input->post('message');
         // if ($this->input->post('mailtype') == 'career') {
         //    $reciever_email = 'hr@frinza.com';
         //    // $reciever_email = 'frinzacare@gmail.com';
         // }elseif ($this->input->post('mailtype') == 'contact') {
         //    $reciever_email = 'support@frinza.com';
            
         // } else{
         //    $reciever_email = 'corporate@frinza.com';
         //  }
          $reciever_email = 'frinzacare@gmail.com';
         $msg= "<div>Dear " . $reciever_email . ",
                  <br><br>Contacted Person Name:".$name.",
                  <br><br><p>Contacted Person Email:" .$user_email.",
                  <br><br><p>Contacted Person Company:" .$company.",
                  <br><br><p>Contacted Person Address:" .$address.",
                  <br><br><p>Contacted Person Contact number:".$user_contact.",
                  <br><br><p>Subject:".$user_subject.",
                  <br><br><p>Contacted Person Message:".$message."
                  <br><br><br></p>Regards,<br> Admin.</div>";
         SendEmail($reciever_email,$subject,$msg,0);
          echo "Email sent successfully.";
      }
      function sendToFranchise()
      {
         /* Send Email */
         $name = $this->input->post('name');
         $user_email = $this->input->post('email');
         $user_contact = $this->input->post('contact');
         $company = $this->input->post('company');
         $user_subject = $this->input->post('subject');
         $address = $this->input->post('address');
         $subject = $user_subject;
         $message = $this->input->post('comment');
         // $reciever_email = 'corporate@frinza.com';
          $reciever_email = 'frinzacare@gmail.com';
         $msg= "<div>Dear " . $reciever_email . ",<br><br>
               <p>Contacted Person Name:".$name.",
               <br><br>Contacted Person Email:".$user_email.",
               <br><br>Contacted Person Contact number:".$user_contact.",
               <br><br>Subject:".$user_subject.",
               <br><br>Company: ".$company."
               <br><br>Address: ".$address."
               <br><br>Contacted Person Message:".$message."
               <br><br><br></p>Regards,<br> Admin.</div>";
         if(SendEmail($reciever_email,$subject,$msg,0)){
            echo "Email sent successfully."; 
         }
         else {
            echo "Error in sending Email."; 
         }
      }
      function forgotPassword()
      {
         $returnArray = array();
         $type = $this->input->post('type');
         $value = $this->input->post('email');
         if ($type == 'email') {
            $userData = $this->user->checkUser($value);
            if (count($userData) == 0) {
               $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Email Address not found!'
               );
               goto showResonse;
            }
            $name = @$userData[0]->first_name.' '.@$userData[0]->last_name;
            $reciever_email = @$userData[0]->user_email;
            $subject = 'Reset Password';
            $randPass = mt_rand(100000,999999);
            $this->session->set_userdata('forgot_otp',$randPass);
            $this->session->set_userdata('forgot_user',$userData[0]->uid);
            $msg= "<div><center><a title='Frinza' href='".base_url()."'><img alt='Frinza' src='".FOLDER_ASSETS_TEMPLATEDATA."images/logo.png' width='150px' height='80px'> </a></center><br><br> Dear $name !<br> You have requested to reset your password, Please Enter Following OTP to reset password.<br> $randPass</div>";

            //$data = SendEmail($reciever_email,$subject,$msg);
            if(SendEmail($reciever_email,$subject,$msg)){ 
               $returnArray = array(
                        'class' => 'text-success',
                        'stepClass' => 'forgotOTP',
                        'step' => 'otp',
                        'msg' => 'Please check Email for OTP.'
               );
               goto showResonse;
            }
            else {
               $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Error in sending Email.'
               );
               goto showResonse;
            }
         }elseif ($type == 'otp') {
            $otp = $this->session->userdata('forgot_otp');
            if ($otp == '') {
               $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Invalid OTP!'
               );
               goto showResonse;
            }elseif ($value == $otp) {
               $this->session->unset_userdata('forgot_otp');
               $returnArray = array(
                        'class' => 'text-success',
                        'stepClass' => 'forgotPass',
                        'step' => 'pass',
                        'msg' => 'OTP has been verified!'
               );
               goto showResonse;
            }else{
               $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotOTP',
                        'step' => 'otp',
                        'msg' => 'Invalid OTP!'
               );
               goto showResonse;
            }
         }elseif ($type == 'pass') {
            $user = $this->session->userdata('forgot_user');
            $otp = $this->session->userdata('forgot_otp');
            $this->session->unset_userdata('forgot_user');
            if ($user == '') {
                $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Invalid Password!'
               );
               goto showResonse;
            }elseif ($value != '' && $otp == '') {
               $updatePassword['user_pwd'] = md5($value);
               $updateCond['uid'] = $user;
               $changePass = $this->user->updateUser($updateCond,$updatePassword);
               if ($changePass) {
                  $returnArray = array(
                        'class' => 'text-success',
                        'stepClass' => 'forgotPass',
                        'step' => 'finish',
                        'msg' => 'Password has been changed!'
                  );
                  goto showResonse;
               }else{
                  $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Invalid Password!'
                  );
                  goto showResonse;
               }
            }else{
               $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Invalid Password!'
               );
               goto showResonse;
            }
         }else{
             $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Invalid Inputs!'
               );
               goto showResonse;
         }
         showResonse:
         echo json_encode($returnArray);
         die();
      }
      function changeContact()
      {
         $usrContact = $this->input->post('contact');
         $returnArray = array();
         if (strlen($usrContact) != 10 || !is_numeric($usrContact)) {
            $returnArray['class'] = 'text-danger';
            $returnArray['msg'] = 'Invalid contact number!';
            goto displayOutput;
         }
         $updateCond['uid'] = $this->session->userdata('loggedUser');
         $updateData['user_contact'] = $usrContact;
         $updateResponse = $this->shop->updateUser($updateCond,$updateData);
         if ($updateResponse) {
            $returnArray['class'] = 'text-success';
            $returnArray['msg'] = 'Contact Number has been Updated!';
            goto displayOutput;
         }else{
            $returnArray['class'] = 'text-danger';
            $returnArray['msg'] = 'Invalid contact number!';
            goto displayOutput;
         }
         displayOutput:
         echo json_encode($returnArray);
         die();
      }
}