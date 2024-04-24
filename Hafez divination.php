<?php 

ob_start();

$token = 'token';
##------------------------------##
define('API_KEY',$token);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>$text,
 'parse_mode'=>$mode
 ]);
 }
 function sendphoto($chat_id, $photo, $caption){
 bot('sendphoto',[
 'chat_id'=>$chat_id,
 'photo'=>$photo,
 'caption'=>$caption,
 ]);
 }
 function sendaction($chat_id, $action){
 bot('sendchataction',[
 'chat_id'=>$chat_id,
 'action'=>$action
 ]);
 }
 //====================ᵗᶦᵏᵃᵖᵖ======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$text = $message->text;
//====================ᵗᶦᵏᵃᵖᵖ======================//
if(preg_match('/^\/([Ss]tart)/',$text)){
sendaction($chat_id, typing);
        bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' =>"ربات فال حافظ در خدمت شماست
 
 اول نیت کن و بعد اشاره کن😎 
 بزن روی دستور /fal",
            ]);
        }
elseif($text == "/fal"){
sendaction($chat_id, upload_photo);
          file_put_contents("fal.jpg",file_get_contents("http://api.updl.tk/fal/"));
    sendphoto($chat_id , new CURLFile('fal.jpg'), "اینم فال شما👆 \n فال مجدد /fal");
    unlink("fal.jpg");
    }
    ?>