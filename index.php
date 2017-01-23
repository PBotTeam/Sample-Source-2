<?php
ob_start();
define('API_KEY','300149810:AAGLgFdtQqZqnyIkA52emC-gmeN45RKmuyU');
$admin =  "264882979";
$update = json_decode(file_get_contents('php://input'));
$from_id = $update->message->from->id;
$name = $update->message->from->first_name;
$chat_id = $update->message->chat->id;
$chatid = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$text = $update->message->text;
$message_id = $update->callback_query->message->message_id;
$message_id_feed = $update->message->message_id;
$al = file_get_contents("al.txt");
function coding($method,$datas=[]){
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
if(preg_match('/^\/([Ss]tart)/',$text)){
coding('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"سلام.انتخاب کنید",
    'parse_mode'=>'html',
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
	 [
	 ['text'=>'اعضای تیم پی بات تیم','callback_data'=>'fl']
         ]
		 ]
		])
  ]);
}
  elseif ($data == "fl") {
  coding('editMessagetext',[
  'chat_id'=>$chatid,
  'message_id'=>$message_id,
  'text'=>"سازنده: سید میکائیل",
  'parse_mode'=>'html',
  'reply_markup'=>json_encode([
  'inline_keyboard'=>[
  [
   ['text'=>"ورود به پروفایل",url=>"https://telegram.me/MikailVigeo"]
        ]
      ]
    ])
  ]);
 }
elseif(preg_match('/^\/([Ss]tats)/',$text) and $from_id == $admin){
    $user = file_get_contents('members.txt');
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
    coding('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"تعداد کل اعضا: $member_count",
      'parse_mode'=>'HTML'
    ]);
}unlink("error_log");
$user = file_get_contents('members.txt');
    $members = explode("\n",$user);
    if (!in_array($chat_id,$members)){
      $add_user = file_get_contents('members.txt');
      $add_user .= $chat_id."\n";
     file_put_contents('members.txt',$add_user);
    }
	?>
elseif(preg_match('/^\/([Ss]tats)/',$text) and $from_id == $admin){
    $user = file_get_contents('members.txt');
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
    coding('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"تعداد کل اعضا: $member_count",
      'parse_mode'=>'HTML'
    ]);
}unlink("error_log");
$user = file_get_contents('members.txt');
    $members = explode("\n",$user);
    if (!in_array($chat_id,$members)){
      $add_user = file_get_contents('members.txt');
      $add_user .= $chat_id."\n";
     file_put_contents('members.txt',$add_user);
    }
	?>
