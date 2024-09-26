<?php

class SmsSender
{
    private $user;
    private $password;
    private $baseurl;

    // Constructor to initialize user credentials and base URL
    public function __construct()
    {
        $this->user = "94767078650";
        $this->password = "3199";
        $this->baseurl = "https://www.textit.biz/sendmsg";
    }

    // Function to send SMS
    public function sendSms($to, $text)
    {
        // URL encode the message
        $text = urlencode($text);

        // Construct the URL for sending the message
        $url = "$this->baseurl/?id=$this->user&pw=$this->password&to=$to&text=$text";
        
        // Send the request and capture the response
        $ret = @file($url);
        
        if ($ret === false) {
            return [
                'status' => 'error',
                'message' => 'Failed to connect to the SMS service'
            ];
        }

        // Process the response
        $res = explode(":", $ret[0]);

        if (trim($res[0]) == "OK") {
            return [
                'status' => 'success',
                'message' => 'Message Sent - ID: ' . $res[1]
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Sent Failed - Error: ' . $res[1]
            ];
        }
    }
}

// Usage example
if(isset($_POST['to']) && $_POST['to']!="" && isset($_POST['message']) && $_POST['message']!=""){
	$smsSender = new SmsSender();
	$response = $smsSender->sendSms("94000000000", "This is an example message");

	// Output the response
	if ($response['status'] == 'success') {
	    echo $response['message'];
	} else {
	    echo $response['message'];
	}
}

?>
