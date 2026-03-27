<?php
date_default_timezone_set("asia/Tashkent");
ob_start();
set_time_limit(0);
define("API_KEY","LITE_TOKEN");
$admin = "LITE_ID";
$bot = bot(getMe)->result->username;

mkdir("set");

$me=📲;

function joinchat($id,$f="menu=home"){
$array = array("inline_keyboard");
$get = file_get_contents("set/kanal.txt");
$ex = explode("\n",$get);
$soni = substr_count($get,"@");
if($get == null){
return true;
}else{
for($i=0;$i<=count($ex)-1;$i++){
$first_line = $ex[$i];
$kanall=str_replace("@","",$first_line);
$ret = bot("getChatMember",[
"chat_id"=>$first_line,
"user_id"=>$id,
]);
$stat = $ret->result->status;
if((($stat=="creator" or $stat=="administrator" or $stat=="member"))){
$array['inline_keyboard'][$i][0]['text']="✅ ".$first_line;
$array['inline_keyboard'][$i][0]['callback_data']="null";
}else{
$array['inline_keyboard'][$i][0]['text'] = "❌ ".$first_line;
$array['inline_keyboard'][$i][0]['url'] = "https://t.me/$kanall";
$uns = true;
}}
$array['inline_keyboard'][$i][0]['text'] = "🔄 Tekshirish";
$array['inline_keyboard'][$i][0]['callback_data'] ="$f";
if($uns == true){
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"<b>⚠️ Botdan to'liq foydalanish uchun quyidagi kanallarimizga obuna bo'ling!</b>",
'parse_mode'=>html,
'reply_markup'=>json_encode($array),
]);
exit();
return false;
}else{
return true;
}}}

function rmdirPro($path){
$scan = array_diff(scandir($path), ['.','..']);
foreach($scan as $value){
if(is_dir("{$path}/{$value}"))
rmdirPro("{$path}/{$value}");
else
unlink("{$path}/{$value}");
}
rmdir($path);
}

function sms($id,$text,$m){
return bot('sendMessage',[
'chat_id'=>$id,
'text'=>"<b>$text</b>",
"parse_mode"=>HTML,
"reply_markup"=>$m,
]);
}

function edit($id,$mid,$tx,$m){
return bot('editMessageText',[
'chat_id'=>$id,
'message_id'=>$mid,
'text'=>"<b>$tx</b>",
'parse_mode'=>"HTML",
'reply_markup'=>$m,
]);
}

function del(){
global $cid,$mid,$fromid,$mesid;
return bot('deleteMessage',[
'chat_id'=>$fromid.$cid,
'message_id'=>$mesid.$mid,
]);
}

function addstat($id){
$check = file_get_contents("stat.txt");
$rd = explode("\n",$check);
if(!in_array($id,$rd)){
file_put_contents("stat.txt","\n".$id,FILE_APPEND);
}}

if(get("set/ref")){
}else{
put("set/ref",0);
}

if(get("set/foiz")){
}else{
put("set/foiz",20);
}

if(get("set/rub")){
}else{
put("set/rub",170);
}

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
}}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$tx = $message->text;
$text = $message->text;
$type = $update->message->chat->type;
$mid = $message->message_id;
$fid= $message->chat->id;
$cid = $message->chat->id;
$data = $update->callback_query->data;
$qid = $update->callback_query->id;
$fromid = $update->callback_query->message->chat->id;
$mesid = $update->callback_query->message->message_id;
$callname = $update->callback_query->from->first_name;
$calluser = $update->callback_query->from->username;
$mmid = $update->callback_query->inline_message_id;
$gid = $update->callback_query->message->chat->id;
$name = $update->message->from->first_name;
$username = $message->from->username;

mkdir("step");
mkdir("user");

if(file_get_contents("user/$cid.pul")){
}else{
file_put_contents("user/$cid.pul",0);
}

if(file_get_contents("user/refsum")){
}else{
file_put_contents("user/refsum",0);
}

$refsum=get("user/refsum");

if(file_get_contents("user/$cid.dav")){
}else{
file_put_contents("user/$cid.dav","40|Uzbekistan|any");
}

function get($id){
return file_get_contents($id);
}

function put($h,$r){
file_put_contents($h,$r);
}

if(isset($message)){
$ban=get("user/$cid.ban");
if($ban=="ban"){
exit();
}}

if(isset($update)){
$ban=get("user/$fromid.ban");
if($ban=="ban"){
exit();
}}

$step=get("step/".$cid.".txt");
$cstep=get("step/".$fromid.".txt");
$pul=get("user/$fromid.pul");
$simkey=get("set/api_key");

$menu=json_encode([
'inline_keyboard'=>[
[['text'=>"🔢 Raqam sotib olish",'callback_data'=>"menu=raqam"]],
[['text'=>"🌍 Davlatlar",'callback_data'=>"menu=davlat"],['text'=>"📡 Operatorlar",'callback_data'=>"menu=operator"]],
[['text'=>"💰 Hisobim",'callback_data'=>"menu=balans"],['text'=>"💳 Pul ishlash",'callback_data'=>"menu=earn"]],
]
]);

$menu1=json_encode([
'inline_keyboard'=>[
[['text'=>"🔢 Raqam sotib olish",'callback_data'=>"menu=raqam"]],
[['text'=>"🌍 Davlatlar",'callback_data'=>"menu=davlat"],['text'=>"📡 Operatorlar",'callback_data'=>"menu=operator"]],
[['text'=>"💰 Hisobim",'callback_data'=>"menu=balans"],['text'=>"💳 Pul ishlash",'callback_data'=>"menu=earn"]],
[['text'=>"🗄 Boshqaruv paneli",'callback_data'=>"boshqaruv"]],
]]);

$panel=json_encode([
'inline_keyboard'=>[
[['text'=>"🗄️ Boshqarish",'callback_data'=>"boshqaruv"]],
]]);

if($data=="rKurs"){
$json3=json_decode(file_get_contents("https://cbu.uz/uz/arkhiv-kursov-valyut/json/"),1);
foreach($json3 as $json4){
if($json4['Ccy']=="RUB"){
$rate=$json4['Rate'];
break;
}
}
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"1₽ - $rate so'm",
'show_alert'=>true,
]);
}

$ass=json_encode([
'inline_keyboard'=>[
[['text'=>"🔑 API sozlamalari",'callback_data'=>kalit_s],['text'=>"🔗 Taklif narxi",'callback_data'=>taklif],],
[['text'=>"📢 Kanal sozlamalari",'callback_data'=>"majburiy"]],
[['text'=>"💵 Kursni o‘rnatish",'callback_data'=>kurs],['text'=>"⚖️ Foizni o‘rnatish",'callback_data'=>foiz]],
[['text'=>"🗄️ Boshqarish",'callback_data'=>"boshqaruv"]],
]]);

if($data=="majburiy" and $fromid==$admin){
edit($fromid,$mesid,"📎 Majburiy obunalar",json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Qo‘shish",'callback_data'=>"kanal=add"]],
[['text'=>"*️⃣ Ro‘yxat",'callback_data'=>"kanal=list"],['text'=>"🗑️ O'chirish",'callback_data'=>"kanal=dl"]],
[['text'=>"🗄️ Boshqarish",'callback_data'=>"boshqaruv"]],
]]));
}

if((stripos($data,"kanal=")!==false)){
$rp=explode("=",$data)[1];
if($rp=="list"){
$ops=get("set/kanal.txt");
if(empty($ops)){
sms($fromid,"🤷‍♂️ Kanallar topilmadi!",null);
}else{
$s=explode("\n",$ops);
$soni = substr_count($ops,"\n");
for($i=0;$i<=count($s)-1;$i++){
$k[]=['text'=>$s[$i],'url'=>"t.me/".str_replace("@","",$s[$i])];
}
$keyboard2=array_chunk($k,2);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
sms($fromid,"Ulangan kanallar ro'yxati ⤵️",$keyboard);
}
}elseif($rp=="dl"){
$ops=get("set/kanal.txt");
if(empty($ops)){
sms($fromid,"🤷‍♂️ Kanallar topilmadi!",null);
}else{
$s=explode("\n",$ops);
$soni = substr_count($ops,"\n");
for($i=0;$i<=count($s)-1;$i++){
$k[]=['text'=>$s[$i],'callback_data'=>"kanal=del".$s[$i]];
}
$keyboard2=array_chunk($k,2);
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
sms($fromid,"🗑️ O‘chiriladigan kanalni tanlang:",$keyboard);
}
}elseif(mb_stripos($rp,"del@")!==false){
$d=explode("@",$rp)[1];
$ops=get("set/kanal.txt");
$soni = explode("\n",$ops);
if(count($soni)==1){
unlink("set/kanal.txt");
}else{
$ss="@".$d;
$ops=str_replace("\n".$ss."","",$ops);
put("set/kanal.txt",$ops);
}
del();
sms($fromid,"✅ O‘chirildi",null);
}elseif($rp=="add"){
del();
sms($fromid,"
📢 Kerakli kanalni manzilini yuboring:

Namuna: @HaydarovUz",json_encode([
'inline_keyboard'=>[
[['text'=>"🗄️ Boshqaruv",'callback_data'=>"boshqaruv"]],
]
]));
put("step/$fromid.txt","kanal_add");
}
}

if($step=="kanal_add"){
if(mb_stripos($text,"@")!==false){
$kanal=get("set/kanal.txt");
sms($cid,"$text - kanal qo'shildi",json_encode([
'inline_keyboard'=>[
[['text'=>"🗄️ Boshqarish",'callback_data'=>"boshqaruv"]],
]
]));
if($kanal==null){
file_put_contents("set/kanal.txt",$text);
}else{
file_put_contents("set/kanal.txt","$kanal\n$text");
}
unlink("step/$fromid.txt");
}
}


if($data=="kalit_s" and $fromid==$admin){
$urla = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getBalance");
if($urla=="BAD_KEY" or $urla=="NO_KEY"){
$hisob="Mavjud emas!";
$tugma="➕ Yangi API kiritish";
edit($fromid,$mesid,"<b>📄 API ma'lumotlari: 
➖➖➖➖➖➖➖➖➖➖➖ 
Ulangan sayt:</b>
<code>sms-activate.org</code>
 
<b>API kalit:</b> Kirtilmagan!

<b>API hisob:</b> Mavjud emas!
➖➖➖➖➖➖➖➖➖➖➖",json_encode([
'inline_keyboard'=>[
[['text'=>"$tugma",'callback_data'=>kalit]],
[['text'=>"🗄️ Boshqarish",'callback_data'=>"boshqaruv"]],
]]));
}else{
$h=explode(":",$urla)[1];
$hisob="$h ₽";
$tugma="♻️ APIni yangilash";
edit($fromid,$mesid,"<b>📄 API ma'lumotlari: 
➖➖➖➖➖➖➖➖➖➖➖ 
Ulangan sayt:</b>
<code>sms-activate.org</code>
 
<b>API kalit:</b>
<code>$simkey</code>

<b>API hisob:</b> $hisob
➖➖➖➖➖➖➖➖➖➖➖",json_encode([
'inline_keyboard'=>[
[['text'=>"$tugma",'callback_data'=>kalit]],
[['text'=>"🗄️ Boshqarish",'callback_data'=>"boshqaruv"]],
]]));
}}

if($data=="boshqaruv" and $fromid==$admin){
edit($fromid,$mesid,"
🗄️ Assalomu alaykum admin panelga xush kelibsiz!

Quyidagi sozlamalardan birini tanlang:",json_encode([
'inline_keyboard'=>[
[['text'=>"⚙️ Asosiy sozlamalar",'callback_data'=>"panel=asosiy"]],
[['text'=>"🇺🇿 Rubl kursi",'callback_data'=>rKurs],['text'=>"📊 Statistika",'callback_data'=>"panel=stat"]],
[['text'=>"🔎 Foydalanuvchini boshqarish",'callback_data'=>"panel=control"]],
[['text'=>"📨 Xabarnoma",'callback_data'=>"panel=send"],['text'=>"◀️ Orqaga",'callback_data'=>"menu=home"]],
]]));
unlink("step/$fromid.txt");
}


if($data=="kurs" and $fromid==$admin){
edit($fromid,$mesid,"
💵 1 ₽ narxini kiriting:

♻️ Joriy narx: ".get("set/rub")." so‘m",$panel);
put("step/$fromid.txt","updRub");
}

if($step=="updRub"){
if(is_numeric($text)){
sms($cid,"✅ Saqlandi!",$panel);
put("set/rub",$text);
}
unlink("step/$cid.txt");
}

if($data=="taklif" and $fromid==$admin){
edit($fromid,$mesid,"
🔗 Taklif narxini kiriting

♻️ Joriy narx: ".get("user/refsum")." so‘m",$panel);
put("step/$fromid.txt","updT");
}

if($step=="updT"){
if(is_numeric($text)){
sms($cid,"✅ Saqlandi!",$panel);
put("user/refsum",$text);
}
unlink("step/$cid.txt");
}



if($data=="kalit" and $fromid==$admin){
edit($fromid,$mesid,"🔑 API kalitni yuboring

API kalit olish manzili: sms-activate.org",$panel);
put("step/$fromid.txt","updAPI");
}

if($step=="updAPI"){
if(isset($text)){
$urla = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$text&action=getBalance");
if($urla=="BAD_KEY" or $urla=="NO_KEY"){
sms($cid,"⚠️ Noma'lum API kalit

Qaytadan urining",$panel);
}else{
sms($cid,"✅ Saqlandi!",$panel);
put("set/api_key",$text);
}
unlink("step/$cid.txt");
}
}

if($data=="foiz" and $fromid==$admin){
edit($fromid,$mesid,"
⭐ Xizmatlar uchun foizni kiriting

♻️ Joriy foiz: ".get("set/foiz")."%",$panel);
put("step/$fromid.txt","updFoiz");
}

if($step=="updFoiz" and $text>0){
if(is_numeric($text)){
sms($cid,"✅ Saqlandi!",$panel);
put("set/foiz",$text);
}
unlink("step/$cid.txt");
}

if((stripos($data,"panel=")!==false)){
$res=explode("=",$data)[1];
if($res=="stat"){
$stat=substr_count(get("stat.txt"),"\n");
edit($fromid,$mesid,"📊 Bot obunachilari: $stat ta",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga", 'callback_data'=>"boshqaruv"]],
]]));
}elseif($res=="send"){
edit($fromid,$mesid,"👇 Xabaringizni kiriting:",json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga", 'callback_data'=>"boshqaruv"]],
]]));
file_put_contents("step/$fromid.txt","sendPost");
}elseif($res=="asosiy"){
edit($fromid,$mesid,"<b>⚙ Asosiy sozlamalar bo'limiga xush kelibsiz!</b>

<i>Nimani o'zgartiramiz?</i>",$ass);
}elseif($res == control){
edit($fromid,$mesid,"<b>Kerakli foydalanuvchining ID raqamini kiriting:</b>",$panel);
file_put_contents("step/$fromid.txt",'iD');
}}

$saved = file_get_contents("user/us.id");

if($step == "iD"){
if($cid == $admin){
if(file_exists("user/$text.pul")){
file_put_contents("user/us.id",$text);
$pul = file_get_contents("user/$text.pul");
$ban = file_get_contents("user/$text.ban");
if($ban == null){
$bans = "🔔 Banlash";
}
if($ban == "ban"){
$bans = "🔕 Bandan olish";
}
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qidirilmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$mid + 1,
        'text'=>"<b>Qidirilmoqda...</b>",
       'parse_mode'=>'html',
]);
bot('editMessageText',[
      'chat_id'=>$cid,
     'message_id'=>$mid + 1,
'text'=>"<b>Foydalanuvchi topildi!

ID:</b> <a href='tg://user?id=$text'>$text</a>
<b>Balans: $pul so‘m</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"$bans",'callback_data'=>"ban"]],
[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]]
]
])
]);
unlink("user/$cid.step");

}else{
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Foydalanuvchi topilmadi.</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
}
}
}

if($data == "plus"){
bot('sendMessage',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul qo'shmoqchisiz?</b>",
'parse_mode'=>"html",
	'reply_markup'=>$panel,
]);
file_put_contents("step/$fromid.txt",'plus');
}

if($step == "plus"){
if($cid == $admin){
if(is_numeric($text)=="true"){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Adminlar tomonidan hisobingiz $text so‘m to'ldirildi</b>",
'parse_mode'=>"html",
'reply_markup'=>$menu,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobiga $text so‘m qo'shildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$pul = file_get_contents("user/$saved.pul");
$miqdor = $pul + $text;
file_put_contents("user/$saved.pul",$miqdor);
unlink("step/$cid.txt");

}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);

}
}
}

if($data == "minus"){
bot('sendMessage',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"<a href='tg://user?id=$saved'>$saved</a> <b>ning hisobiga qancha pul qo'shmoqchisiz?</b>",
'parse_mode'=>"html",
	'reply_markup'=>$panel,
]);
file_put_contents("step/$fromid.txt",'minus');
}

if($step == "minus"){
if($cid == $admin){
if(is_numeric($text)==true){
bot('sendMessage',[
'chat_id'=>$saved,
'text'=>"<b>Adminlar tomonidan hisobingizdan $text so‘m olindi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$menu,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobidan $text so‘m olindi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$pul = file_get_contents("user/$saved.pul");
$miqdor = $pul - $text;
file_put_contents("user/$saved.pul",$miqdor);
unlink("step/$cid.txt");

}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
}
}
}

if($data=="ban"){
$ban = file_get_contents("user/$saved.ban");
if($admin!=$saved){
if($ban == "ban"){
unlink("user/$saved.ban");
bot('sendMessage',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"<b>Foydalanuvchi ($saved) bandan olindi!</b>",
'parse_mode'=>"html",
	'reply_markup'=>$panel,
]);
}else{
file_put_contents("user/$saved.ban",'ban');
bot('sendMessage',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"<b>Foydalanuvchi ($saved) banlandi!</b>",
'parse_mode'=>"html",
	'reply_markup'=>$panel,
]);
}
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Bloklash mumkin emas!",
'show_alert'=>true,
]);
}
}

if(mb_stripos($text,"/start")!==false){
$refid=explode(" ",$text)[1];
if(strlen($refid)>0 and is_numeric($refid)){
$us=get("stat.txt");
if($refid==$cid and joinchat($cid,"menu=home")==1){
sms($cid,"☝️ <b>Hurmatli foydalanuvchi!</b>

Botga o'zingizni taklif qila olmaysiz!",null);
}else{
$us=file_get_contents("stat.txt");
if(mb_stripos($us,$cid)!==false and joinchat($cid,"menu=home")==1){
sms($cid,"<b>Hurmatli foydalanuvchi!</b>

Doʻstingiz sizni taklif qila olmaydi!",$menu);
}else{
file_put_contents("user/".$cid.".ref",$refid);
if(joinchat($cid,"menu=home")==1) {
$refname=bot('getChat',[chat_id=>$refid])->result->first_name;
sms($cid,"🔔 Sizni: $refname taklif etdi",null);
addstat($refid);
sms($refid,"🔔 Sizning balansingizga $refsum so‘m qo‘shildi",null);
$refpul=get("user/$refid.pul");
file_put_contents("user/$refid.pul",$refpul+$refsum);
file_put_contents("user/$cid.ref","\n".$refid,FILE_APPEND);
}
}
}
}else{
if($cid==$admin){
$menu=$menu1;
}else{
$menu=$menu;
}
sms($cid,"
🤖 Assalomu alaykum @$bot'ga xush kelibsiz!

Siz ushbu botimiz bilan turli tarmoqlarga arzon narxda nomerlar sotib olishingiz mumkin.",$menu);
}
}


addstat($cid);

if((stripos($data,"menu=")!==false and joinchat($fromid)==1)){
if($fromid==$admin){
$menu=$menu1;
}else{
$menu=$menu;
}
unlink("step/$fromid.txt");
$res=explode("=",$data)[1];
if($res=="balans"){
edit($fromid,$mesid,"
💰 Sizning balans: ".get("user/$fromid.pul")." so‘m

🌍 Sizning joriy davlat: ".explode("|",get("user/$fromid.dav"))[1]."
",$menu);
}elseif($res=="davlat") {
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries"), true);
$urla = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries");
if($urla=="BAD_KEY" or $urla=="NO_KEY"){
bot('answerCallbackQuery',[show_alert=>1,
'callback_query_id'=>$qid,
'text'=>"⚠️ Botga API kalit ulanmagan!",
]);
}else{
$key = [];
for ($i = 0; $i < 39; $i++) {
$key[] = ["text" => $url["$i"]['eng'], 'callback_data' => "davl=".$url["$i"]['id']."=".$url["$i"]['eng']];
}
$key1 = array_chunk($key,3);
$key1[]=[["text"=>"1/5","callback_data"=>"null"],['text'=>"▶️",'callback_data'=>"davlat2"]];
$key1[]=[['text'=>"⬇️ Orqaga",'callback_data'=>"menu=home"]];
bot('editMessageText',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"🌍 Davlatlar ro'yxati
👇 Kerakli davlatni tanlang", 
'parse_mode'=>'markdown',
'reply_markup' => json_encode([
 'inline_keyboard'=>$key1,
 ]),
]);
}
}elseif($res=="operator") {
$urla = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries");
if($urla=="BAD_KEY" or $urla=="NO_KEY"){
bot('answerCallbackQuery',[show_alert=>1,
'callback_query_id'=>$qid,
'text'=>"⚠️ Botga API kalit ulanmagan!",
]);
}else{
$coid=explode("|",get("user/$fromid.dav"))[0];
$key = [];
$url = json_decode(file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getOperators&country=$coid"), true);
for ($i = 0; $i<count($url['countryOperators'][$coid]); $i++) {
$key[] = ["text" =>"📞 ".$url['countryOperators'][$coid][$i], 'callback_data' =>"operator=".$url['countryOperators'][$coid][$i]];
}
$key1 = array_chunk($key,3);
$key1[]=[['text'=>"📞 any",'callback_data'=>"operator=any"]];
$key1[]=[['text'=>"◀️ Orqaga",'callback_data'=>"menu=home"]];
edit($fromid,$mesid,"
🌍 Sizning davlat: ".explode("|",get("user/$fromid.dav"))[1]."

📲 Kerakli operatorni tanlang:",json_encode([inline_keyboard=>$key1]));
}
}elseif($res=="home" and joinchat($fromid,"menu=home")==1){
edit($fromid,$mesid,"🤖 Assalomu alaykum @$bot'ga xush kelibsiz!

Siz ushbu botimiz bilan turli tarmoqlarga arzon narxda nomerlar sotib olishingiz mumkin.",$menu);
$refs=get("user/$fromid.ref");
sms($refs,"🔔 Sizning balansingizga $refsum so‘m qo‘shildi",null);
$refpul=get("user/$refs.pul");
file_put_contents("user/$refs.pul",$refpul+$refsum);
unlink("user/$fromid.ref");
exit();
}elseif($res=="raqam" and joinchat($fromid,"menu=raqam")==1){
$urla = file_get_contents("https://api.sms-activate.org/stubs/handler_api.php?api_key=$simkey&action=getCountries");
if($urla=="BAD_KEY" or $urla=="NO_KEY"){
bot('answerCallbackQuery',[show_alert=>1,
'callback_query_id'=>$qid,
'text'=>"⚠️ Botga API kalit ulanmagan!",
]);
}else{
bot('editMessageText',[
'chat_id'=>$fromid,
'message_id'=>$mesid,
'text'=>"👇O‘zingizga kerakli tarmoqni tanlang: ",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$me Telegram",'callback_data'=>"buy_tg"],['text'=>"$me Instagram",'callback_data'=>"buy_ig"]],
