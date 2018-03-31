<?php
function voz($texto, $idioma= "es", $genero="fm"){
$texto=str_replace('.', ' punto ', $texto);
$url = "http://vozme.com/text2voice.php";
$md5 = md5($texto);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "text=".$texto."&lang=".$idioma."&md5=".$md5."&gn=".$genero);

$s = curl_exec ($ch);//Ojo, hay un espacio en exec
curl_close($ch);

$exp_info = '!http(.+)'.$md5.'(.+)mp3!U';
preg_match_all($exp_info, $s, $original);

if(count($original)>0){
return $original[0][0];
} else {
return $s;
}
}
$mp3=voz("housemediagroup.com.co");
if (isset($_POST['enviar'])){
$mp3=voz($_POST['texto']);
}
?>