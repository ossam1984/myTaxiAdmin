<?php 
namespace App\Helpers;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\Topics;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class PushNote {

    public function send($title,$body,$tokens,$data,$sound="default"){
      $optionBuiler = new OptionsBuilder();
$optionBuiler->setTimeToLive(60*20);

$notificationBuilder = new PayloadNotificationBuilder($title);
$notificationBuilder->setBody($body)
                    ->setSound($sound);

$dataBuilder = new PayloadDataBuilder();
$dataBuilder->addData($data);
// $dataBuilder->addData(['type' => 'order_accept']);

$option = $optionBuiler->build();
$notification = $notificationBuilder->build();
$data = $dataBuilder->build();

$token = $tokens;

$downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

$downstreamResponse->numberSuccess();
$downstreamResponse->numberFailure();
$downstreamResponse->numberModification();

//return Array - you must remove all this tokens in your database
$downstreamResponse->tokensToDelete(); 

//return Array (key : oldToken, value : new token - you must change the token in your database )
$downstreamResponse->tokensToModify(); 

//return Array - you should try to resend the message to the tokens in the array
$downstreamResponse->tokensToRetry();
return $downstreamResponse->tokensToDelete();
// return Array (key:token, value:errror) - in production you should remove from your database the tokens
    }
}
