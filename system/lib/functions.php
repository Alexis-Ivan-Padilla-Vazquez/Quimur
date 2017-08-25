<?php
/* Days of the week */
if(!function_exists('debug')){
function debug( $var, $msg = null ){
//if($_REQUEST['debug']){
echo '<pre>';
echo $msg;
ob_start();
var_dump( $var );
$debug = ob_get_contents();
ob_end_clean();
$debug = htmlentities( $debug );
echo str_replace( "=>\n", "=>", $debug );
echo '</pre>';
//}
}
}
if(!function_exists("f_day_of_the_week"))
{
	function f_day_of_the_week($day = 'mon', $lang = 0){
		$days_of_the_week['mon'][0] = 'Monday';
		$days_of_the_week['mon'][1] = 'Lunes';
		$days_of_the_week['tue'][0] = 'Tuesday';
		$days_of_the_week['tue'][1] = 'Martes';
		$days_of_the_week['wed'][0] = 'Wednesday';
		$days_of_the_week['wed'][1] = 'Miércoles';
		$days_of_the_week['thu'][0] = 'Thursday';
		$days_of_the_week['thu'][1] = 'Jueves';
		$days_of_the_week['fri'][0] = 'Friday';
		$days_of_the_week['fri'][1] = 'Viernes';
		$days_of_the_week['sat'][0] = 'Saturday';
		$days_of_the_week['sat'][1] = 'Sábado';
		$days_of_the_week['sun'][0] = 'Sunday';
		$days_of_the_week['sun'][1] = 'Domingo';
		return $days_of_the_week[$day][$lang];
	}
}
/* Format a string of the form '08:15:01', to the form '8:15' */
if(!function_exists("f_format_time"))
{
	function f_format_time($time = '00:00:00'){
		$time = explode( ':', $time );
		return (int)$time[0] . ':' . $time[1];
	}
}
if(!function_exists("cortaPalabras"))
{
function cortaPalabras($longitud,$cadena){
	$temporal = explode(" ",$cadena);
	for($i=0;$i<=count($temporal)-1;$i++){
	if(strlen($final)+strlen($temporal[$i]<=$longitud))
	$final=$final." ".$temporal[$i];
	else
	break;
	}
	return $final;
	}
}
/*  Cut a string to a max length, without cutting the last word   */
	
if(!function_exists("f_cut_string"))
{
	function f_cut_string($string, $max_length){
	if( strlen($string) > $max_length ) {
	$string = substr($string, 0, $max_length-3);
	$last_ch = strlen($string)-1;
	while( $string[$last_ch] != " " ) {
	$string = substr($string, 0, $last_ch);
	$last_ch--;
	}
	$string .= "...";
	}
	return $string;
	}
	
}
if(!function_exists("f_blank_song"))
{
	/*  Get a default image for the Top Songs   */
	function f_blank_song(){
	return '/images/pixel_transp.gif';
	}
}
	/*  Get a default image for the Shows   */
	
if(!function_exists("f_blank_show"))
{
	function f_blank_show(){
	return '/images/pixel_transp.gif';
	}
}
if(!function_exists("f_blank_columnist"))
{
	/*  Get a default image for the Columnists   */
	function f_blank_columnist(){
	return '/images/pixel_transp.gif';
	}
}
	/*  Get the default news image  */
	
if(!function_exists("f_blank_news"))
{
	function f_blank_news(){
	return '/images/pixel_transp.gif';
	}
}
	/*  Get the default video image  */
if(!function_exists("f_blank_video"))
{
	function f_blank_video(){
	return '/images/blank.png';
	}
}
	/*  Get the default image for the "Images" box */
if(!function_exists("f_blank_picture"))
{
	function f_blank_picture(){
	return '/images/blank.png';
	}
}
	/* spiffy corners for top tags ( Nota, Videos, Fotos ) */
if(!function_exists("f_tags"))
{
		function f_tags($tags,$activeTag,$tag_width) {
		$shown_tags = 0;
		for ($i=0; $i<count($tags); $i++) {
		if ( $tags[$i] != "" ) {
		$shown_tags++;
		if ($activeTag == $i)  f_tags_spiffyFirstTop($tag_width);
		else  f_tags_spiffySecondTop($tag_width);
		echo "<t class=\"spiffyBluefg box_text\">".$tags[$i]."</t>";
		f_tags_bottom();
		}
		}
		echo "<br style='clear:both;' />
		<div>
		<b class='spiffyBlue2_'>
		<b class='spiffyBlue2_1' style='margin-left:0px; padding-left:0px; border-left:0px;'><b></b></b>
		<b class='spiffyBlue2_2' style='margin-left:0px; padding-left:0px; border-left:0px;'><b></b></b>
		<b class='spiffyBlue2_3' style='margin-left:0px; padding-left:0px; border-left:0px;'></b>
		<b class='spiffyBlue2_4' style='margin-left:0px; padding-left:0px; border-left:0px;'></b>
		<b class='spiffyBlue2_5' style='margin-left:0px; padding-left:0px; border-left:0px;'></b></b>
		</div>";
	}
}
/* end Spiffy Corners */
// highlight a set of keywords ( claves ) inside a string
if(!function_exists("f_tags"))
{
	function f_claves_bold(&$texto, $claves) {
	if ( !isset($texto) || empty($texto) ) return;
	foreach ( $claves as $key=>$word ) {
	if ( ($word != " ") && ($word != "") ) {
	$word2 = '<b>'.$word.'</b>'; 
	$texto = stri_replace( $word, $word2, $texto );
	}
	}
	}
}
// Classified Ads
/* Get the names of the parents of a given ad-category */
/* Returns an array with all the ad categories ( name and number of ads )  that have a given  parent_id  */
// get the number of ads in a category ( and its sub-categories ) . Called by the function f_ad_categories
if(!function_exists('genericTitle')){
function genericTitle($string)
{
	$n_palabras = 10;
	$tofind = "�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�, ";
	$replac = "A,A,A,A,A,A,a,a,a,a,a,a,O,O,O,O,O,O,o,o,o,o,o,o,E,E,E,E,e,e,e,e,C,c,I,I,I,I,i,i,i,i,U,U,U,U,u,u,u,u,y,N,n,-";
	$base = " | Peri&oacute;dico Sintesis | Portal de Noticias  de Puebla, Tlaxcala, Hidalgo";
	$stringTMP = str_replace(array(',','.',':',';','"',"'","%","&","$","!","#","/","\\","(",")","=","?","�","�","{","}"),'',$string) . "";
	$stringTMP = strtr(trim($stringTMP),$tofind,$replac);
	$arrString=explode('-',$stringTMP);
	if(count($arrString)<=$n_palabras){
		return $string.$base;
	}else{
		$substr = substr($string,0,strpos($string," ".$arrString[$n_palabras]));
		return $substr.$base;
}
//15 palabras
//65 caracteres
}
}
if(!function_exists('cleanString')){
	function cleanString($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
   // return utf8_encode($cadena);
	return $cadena;
	}
}
if(!function_exists('getFriendlyNameUrl')){
function getFriendlyNameUrl($id,$seccion,$string){
		$string = strtolower($string);	
		$string = str_replace(array(',','.',':',';','"',"'","%","&","$","?","�","!","�","/","\\",'"'),'',$string) . "";			
		$string = str_replace(array(' ','á','é','í','ó','ú','ñ'),array('-','a','e','i','o','u','n'),$string);
		$string = trim($string);
			
		$url 	= ABS_HTTP_URL.$id."/".$seccion."/".$string."/";		
		return $url;
	}
}
if(!function_exists('getURLAmigable')){
function getURLAmigable($record,$seccion)
{
$tofind = "�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�, ,|";
$replac = "A,A,A,A,A,A,a,a,a,a,a,a,O,O,O,O,O,O,o,o,o,o,o,o,E,E,E,E,e,e,e,e,C,c,I,I,I,I,i,i,i,i,U,U,U,U,u,u,u,u,y,N,n,-,-";
foreach($record as $element){
	$id = $element['id'];
	$nombre = strtr(trim($element['name']),$tofind,$replac);
	$nombre = str_replace(array(',','.',':',';','"',"'","%","&","$","?","�","!","�","/","\\",'"'),'',utf8_decode($nombre)) . "";
	$url .= '/'.$id.'/'.$nombre;
}
return $url;
}
}
define('HEAD_NEW_URL',47);
if(!function_exists('adjustPATH')){
	function adjustPATH(){
		$parser = explode('/',$url);
		$n = count($parser)-1;
		$path = '';
	for($i=0;$i<$n;$i++)$path .= '../';
		return $path;
	}
}
if(!function_exists("getWords"))
{
function getWords($cadena,$longitud, $strEnd = ''){
	$words=explode(" ",trim($cadena));
	for($i=0;$i<=count($words)-1;$i++){
		$lngPalabra=strlen($words[$i]);
	if($lngPalabra+$lngTotal <=$longitud){
		$cadenaFinal=$cadenaFinal." ".$words[$i];
		$lngTotal=strlen($cadenaFinal);
}
else{
	return $cadenaFinal . $strEnd;
	}
}
	return $cadenaFinal;
}
}
if(!function_exists("resaltar"))
{
function resaltar($palabra, $texto) {
		$aux=$reemp=str_ireplace($palabra,'%s',$texto);
		$veces=substr_count($reemp,'%s');
		if($veces==0)return $texto;
			$palabras_originales=array();
		for($i=0;$i<$veces;$i++){
			$palabras_originales[]='<strong style="background-color:#dceaf7">'.substr($texto,strpos($aux,'%s'),strlen($palabra)).'</strong>';
			$aux=substr($aux,0,strpos($aux,'%s')).$palabra.substr($aux,strlen(substr($aux,0,strpos($aux,'%s')))+2);
	}
		return vsprintf($reemp,$palabras_originales);
	} 
}
/*
function f_resize(&$width, &$height, $maxWidth, $maxHeight) {
if ( ($width<=$maxWidth) && ($height<=$maxHeight) ){
$width2 = $width;   $height2 = $height;
}
elseif ( ($maxWidth/$width) <= ($maxHeight/$height) ){
$width2 = $maxWidth;   $height2 = round($height*$maxWidth/$width);
}
else {
$height2 = $maxHeight;   $width2 = round($width*$maxHeight/$height);
}
$width = $width2;   $height = $height2;
}
*/
/* Proportionally adjusts the dimensions of an image, to  maxWidth  and  maxHeight  */
if(!function_exists("f_resize"))
{
	function f_resize(&$width, &$height, $maxWidth, $maxHeight) {
		if ( ($width<=$maxWidth) && ($height<=$maxHeight) ){
			$width2 = $width;   $height2 = $height;
		}
		elseif ( ($maxWidth/$width) <= ($maxHeight/$height) ){
			$width2 = $maxWidth;   $height2 = round($height*$maxWidth/$width);
		}
		else {
			$height2 = $maxHeight;   $width2 = round($width*$maxHeight/$height);
		}
		$width = $width2;   $height = $height2;
	}
}
if(!function_exists("encriptar"))
{	
	function encriptar($string){
	$size=strlen($string);
	$size_1=round($size/2);
	$size_2=$size-$size_1;
	$cry_1="";
	for($i=0;$i<$size_1;$i++)$cry_1.=chr((ord(substr($string,$i,1))+7));
	$cry_1=strrev($cry_1);
	$cry_2="";
	for($i=$size_1;$i<$size;$i++)$cry_2.=chr((ord(substr($string,$i,1))+13));
	$encrypt = $cry_1.$cry_2;
	$encrypt=str_replace("'","''",$encrypt);
	return $encrypt;
	}
}
if(!function_exists("encriptar"))
{
	function desencriptar($encrypt){
		$size=strlen($encrypt);
		$size_2=round($size/2);
		$size_1=$size-$size_2;
		$str_2="";
		for($i=0;$i<$size_2;$i++)$str_2.=chr((ord(substr($encrypt,$i,1))-7));
		$str_2=strrev($str_2);
		$str_1="";
		for($i=$size_2;$i<$size;$i++)$str_1.=chr((ord(substr($encrypt,$i,1))-13));
		$string=$str_2.$str_1;
		return $string;
	}
}
if(!function_exists("encriptar"))
{
	function formateaHora($hora){
		if($hora=="")
			return "";
		$temp=explode(" ",$hora);
		$temp2=explode("-",$temp[0]);
		$temp3=explode(":",$temp[1]);	
		$fecha['dia']= date("d-m-Y", mktime(0, 0, 0, $temp2[1], $temp2[2], $temp2[0]));
		$fecha['hora']= date("h:i", mktime($temp3[0], $temp3[1], $temp3[2], $temp2[1], $temp2[2], $temp2[0]));
		$fecha['am']= date("a", mktime($temp3[0], $temp3[1], $temp3[2], $temp2[1], $temp2[2], $temp2[0]));
		return $fecha;
	 }
}
if(!function_exists("strip_css"))
{
	function strip_css($mystring) {
		$pos = strpos($mystring, '</style>');				
		$noticia = substr($mystring,$pos);
		$noticia = strip_tags($noticia,'<p><a><font>'); 
		return $noticia; 
	}
}
if(!function_exists("resizeAndDisplay"))
{
   function resizeAndDisplay( $file, $new_w, $new_h ){
		set_time_limit( 0 );
		$src_img = open_image( $file );
		$old_w=imageSX($src_img);
		$old_h=imageSY($src_img);
		$thumb_w = $old_w;
		$thumb_h = $old_h;
		$new_w = (empty($new_w) || !is_numeric($new_w)) ? $thumb_w : $new_w;
		$new_h = (empty($new_h) || !is_numeric($new_h)) ? $thumb_h : $new_h;
		if( $thumb_w > $new_w) {
			$thumb_h = round(($thumb_h*$new_w)/$thumb_w);
			$thumb_w = $new_w;
		}
		if( $thumb_h > $new_h ){
			$thumb_w = round(($thumb_w*$new_h)/$thumb_h);
			$thumb_h = $new_h;
		}
//		if ( $old_w <= $new_w && $old_h <= $new_h ){
//			// If the original image is smaller than the requested size, don't enlarge it, just present the original
//			$this->_view( $file );
//			return;
//		}
		//
		$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w, $thumb_h,$old_w,$old_h);
		header('Content-type: image/jpeg');
		imagejpeg($dst_img);
		imagedestroy( $dst_img );
		die();
	}
}
if(!function_exists("open_image"))
{
	function open_image($file) {
//		ini_set( "memory_limit", "32M" );
		$im = @imagecreatefromjpeg($file);
		if ($im !== false) { return $im; }
		# GIF:
		$im = @imagecreatefromgif($file);
		if ($im !== false) { return $im; }
		# PNG:
		$im = @imagecreatefrompng($file);
		if ($im !== false) { return $im; }
		# GD File:
		$im = @imagecreatefromgd($file);
		if ($im !== false) { return $im; }
		# GD2 File:
		$im = @imagecreatefromgd2($file);
		if ($im !== false) { return $im; }
		# WBMP:
		$im = @imagecreatefromwbmp($file);
		if ($im !== false) { return $im; }
		# XBM:
		$im = @imagecreatefromxbm($file);
		if ($im !== false) { return $im; }
		# XPM:
		$im = @imagecreatefromxpm($file);
		if ($im !== false) { return $im; }
		# Try and load from string:
		$im = @imagecreatefromstring(file_get_contents($file));
		if ($im !== false) { return $im; }
		return false;
	}
}
if(!function_exists("returnDate"))
{
	function returnDate($date){
//anio-mes-dia
	list($ano, $mes, $dia) =split ('[-]', $date);
			  //echo $fecha['dia'];
			  $meses = array("01"=>"Enero",
							 "02"=>"Febrero",
							"03"=>"Marzo",
						    "04"=>"Abril",
						    "05"=>"Mayo",
						    "06"=>"Junio",
						    "07"=>"Julio",
						    "08"=>"Agosto",
						    "09"=>"Septiembre",
						    "10"=>"Octubre",
						    "11"=>"Noviembre",
						    "12"=>"Diciembre");
		  return $meses[$mes]." ". $dia.", ".$ano;
    }
}
if(!function_exists("returnDate2"))
{
function returnDate2($date){
//anio-mes-dia
	list($dia, $mes, $ano) =split ('[-]', $date);
			  //echo $fecha['dia'];
			  $meses = array("01"=>"Enero",
							 "02"=>"Febrero",
							"03"=>"Marzo",
						    "04"=>"Abril",
						    "05"=>"Mayo",
						    "06"=>"Junio",
						    "07"=>"Julio",
						    "08"=>"Agosto",
						    "09"=>"Septiembre",
						    "10"=>"Octubre",
						    "11"=>"Noviembre",
						    "12"=>"Diciembre");
		  return $ano." de ". $meses[$mes]." de ".$dia;
}
}
if(!function_exists("returnDate2"))
{
	function getTimeFromCalendarParams($mes,$anio){
		$calendar_events_prev_month = $_REQUEST['calendar_events_prev_month'];
		$calendar_events_next_month = $_REQUEST['calendar_events_next_month'];
		$dCalendar = (!empty($_REQUEST["DCalendar"]))?$_REQUEST["DCalendar"]:date("Y-m-d");
		$month = (!empty($_REQUEST["calendar_events_month"]))?$_REQUEST["calendar_events_month"]:$mes;
		$year = (!empty($_REQUEST["calendar_events_year"]))?$_REQUEST["calendar_events_year"]:$anio;		if( $calendar_events_next_month ){
			$time = mktime(0,0,0,($month+1),1,$year);
		}elseif( $calendar_events_prev_month ){
			$time = mktime(0,0,0,($month-1),1,$year);
		}else{
			$time = mktime(0,0,0,$month,1,$year);
		}
		return $time;
	}
}
	
if(!function_exists("getMKDate"))
	{
	function getMKDate($date){
	$fecha=explode("-",$date);
	return mktime(0,0,0,$fecha[1],$fecha[2],$fecha[0]);
	}
}
if(!function_exists("GetMonthName"))
	{
	function GetMonthName( $month, $lang = "SP" ){
			$month = (!is_numeric( $month ) || $month < 1 || $month >12) ? 1 : $month;
			$monthsSP = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			$monthsEN = array("January","February","March","April","May","June","July","August","September","Octuber","November","December");
			$months = $lang == "SP" ? $monthsSP : $monthsEN; 
			return $months[ ($month-1) ];
		}
	}
	
if(!function_exists("FormatDate"))
	{
function FormatDate($lang, $year, $month, $day)
                {
                               if($lang == 'SP'){
                                               $meses = array("Enero",             "Febrero",          "Marzo",                             "Abril",                 "Mayo",                                "Junio", 
                                                                                                 "Julio",              "Agosto",            "Septiembre", "Octubre",          "Noviembre",                 "Diciembre");
                                               return $day . " de " . $meses[(intval($month)-1)] . " de " . $year . "";
                               }else{
                                               return date('F jS, Y',mktime($hour,$minute,$second,$month,$day,$year));
                               }
                }
	}
	
if(!function_exists("dameURL"))
	{
	function dameURL(){
	
	$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	return $url;
	}
	}
	
	if(!function_exists("chop_string"))
	{
	function chop_string($str, $val) 
	
	{				
if(strlen($str) > $val) 
	{
	$str = substr($str,0,($val-2));
	return str_pad($str,($val+2),'...',STR_PAD_RIGHT);
	} 
	else 
	{
	return $str;
	}
}
	}
	
	
	
	
if(!function_exists("stri_replace"))
	{
function stri_replace( $find, $replace, $string ) 
{ 
$parts = explode( strtolower($find), strtolower($string) ); 
$pos = 0; 
	foreach( $parts as $key=>$part ) 
	{ 
	$parts[ $key ] = substr($string, $pos, strlen($part)); 
	$pos += strlen($part) + strlen($find); 
	} 
return( join( $replace, $parts ) ); 
} 
	}
	
	
if(!function_exists("str_lower"))
{
	function str_lower($cadena){
		$cadena = ucwords($cadena); 
		$cadena = ucwords(strtolower($cadena));
		return $cadena;
	}
}
if(!function_exists('spaces_friendly'))
{
function spaces_friendly($cadena,$long)
{
$html = array("�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","/");
$new_html = array("A","A","A","A","A","A","a","a","a","a","a","a","O","O","O","O","O","O","o","o","o","o","o","o","E","E","E","E","e","e","e","e","C","c","I","I","I","I","i","i","i","i","U","U","U","U","u","u","u","u","y","N","n","-");
$cadena = str_replace($html,$new_html,$cadena);
$cadena = split(" ",trim($cadena));
for($i=0;$i<=$long-1;$i++)
{
	$cadena_nueva .= $cadena[$i]."-";
}
return trim(substr($cadena_nueva,0,-1));
}
}
if(!function_exists("paginatorR"))
{
function paginatorR($total,$pp,$st,$url,$style) {
if($total>$pp) {
$resto=$total%$pp;
if($resto==0) {
$pages=$total/$pp;
} else {
$pages=(($total-$resto)/$pp)+1;
}
if($pages>10) {
$current_page=($st/$pp)+1;
if($st==0) {
$first_page=0;
$last_page=10;
}else if($current_page>=5 && $current_page<=($pages-5)) {
$first_page=$current_page-5;
$last_page=$current_page+5;
} else if($current_page<5) {
$first_page=0;
$last_page=$current_page+5+(5-$current_page);
} else {
$first_page=$current_page-5-(($current_page+5)-$pages);
$last_page=$pages;
}
} else {
$first_page=0;
$last_page=$pages;
}
for($i=$first_page;$i< $last_page;$i++) {
$pge=$i+1;
$nextst=$i*$pp;
if($st==$nextst) {
$page_nav .= '   <td valign="middle">&nbsp;[<b  class="'.$style.'">'.$pge.'</b>] &nbsp;</td>  ';
} else {
$page_nav .= '  <td valign="middle"> &nbsp;<a href="'.$url.$nextst.'" class="'.$style.'">'.$pge.'</a> &nbsp; </td> ';
}
}
if($st==0) { $current_page = 1; } else { $current_page = ($st/$pp)+1; }
if($current_page< $pages) {
$page_last = ' <b><a href="'.$url.($pages-1)*$pp.'" class="'.$style.'"> &#9658;| </a> ';
$page_next = ' <td valign="middle"> &nbsp;<a href="'.$url.$current_page*$pp.'" class="'.$style.'"> >> </a> &nbsp;</td>  ';
}
if($st>0) {
$page_first = '  <b><a href="'.$url.'0" class="'.$style.'"> |&#9668; </a></a></b>  ';
$page_previous = ' <td valign="middle"> &nbsp;<a href="'.$url.''.($current_page-2)*$pp.'" class="'.$style.'"> << </a> &nbsp; </td> ';
}
}
return "<table border='0' cellpadding='0' cellspacing='0'><tr>$page_previous  $page_nav  $page_next </tr></table> ";
}
} 
if(!function_exists("validString"))
	{
function validString($cadena, $adScapeFrom = array(), $adScapeTo = array() ){
            $tofind = explode(",","�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�");
            $replac = explode(",","A,A,A,A,A,A,a,a,a,a,a,a,O,O,O,O,O,O,o,o,o,o,o,o,E,E,E,E,e,e,e,e,C,c,I,I,I,I,i,i,i,i,U,U,U,U,u,u,u,u,y");
            $result = str_replace($tofind,$replac,$cadena);
            
            $result = ( !empty($adScapeFrom) &&  !empty($adScapeTo) && (count($adScapeFrom) == count($adScapeTo)) ) 
            ? str_replace($adScapeFrom,$adScapeTo,$result) : $result;
            
            
            $tofind = explode(",","À,�?,Â,Ã,Ä,Å,� ,á,â,ã,ä,å,Ò,Ó,Ô,Õ,Ö,Ø,ò,ó,ô,õ,ö,ø,È,É,Ê,Ë,è,é,ê,ë,Ç,ç,Ì,�?,Î,�?,ì,�-,î,ï,Ù,Ú,Û,Ü,ù,ú,û,ü,ÿ");
            $replac = explode(",","A,A,A,A,A,A,a,a,a,a,a,a,O,O,O,O,O,O,o,o,o,o,o,o,E,E,E,E,e,e,e,e,C,c,I,I,I,I,i,i,i,i,U,U,U,U,u,u,u,u,y");
            $result = str_replace($tofind,$replac,$cadena);
            
            $result = ( !empty($adScapeFrom) &&  !empty($adScapeTo) && (count($adScapeFrom) == count($adScapeTo)) ) 
            ? str_replace($adScapeFrom,$adScapeTo,$result) : $result;
            
            
            
            return $result;
      }
	}
if(!function_exists("validStringForUrl"))
	{
function validStringForUrl($cad, $scapeUnderLine = false){
            
            //$cad = getWords($cad,40);
            
            $str = validString($cad, 
            array(" ", "/",'"', "'",",",'"',"'","?","¿" ),
            array("-", "",  "",  "","", "", "","" ,""  )
            );
            
            $str = $scapeUnderLine ? str_replace("_","",$str) : $str;
            
            $adScapeFrom = array('"',"'", ","," ","!","�",chr(194),chr(195).chr(177),"�");
            $adScapeTo = array('','', "", "-","","","","�","n");
            if( $scapeUnderLine){
                  $adScapeFrom[] = "_";
                  $adScapeTo[] = ""; 
            }
            
            $result = validString( $str, $adScapeFrom, $adScapeTo, false);
            
            $result = str_replace(array(',',':',';','"',"'","%","&","$"),'',$result) . "";
            
            $tofind = "�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�, ";
            $replac = "A,A,A,A,A,A,a,a,a,a,a,a,O,O,O,O,O,O,o,o,o,o,o,o,E,E,E,E,e,e,e,e,C,c,I,I,I,I,i,i,i,i,U,U,U,U,u,u,u,u,y,N,n,-";
            $result = strtr($result,$tofind,$replac);
            $result = str_replace(array(',',':',';','"',"'","%","&","$"),'',$result) . "";
            $result = str_replace("A".chr(141),"I",$result);
            
            return empty($result) ? 'sintitulo' : $result;
            
      }
	}
if(!function_exists("saveFile"))
	{
function saveFile($uploaddir, $ID, $file, $tmp_file, $table, $field,$llavePrincipal) {
	// *** Copy file
	$archivo = validStringForUrl($file);
	$uploadnamefile =  $ID."_".date(mdY)."_".basename($archivo);
	$uploadfile = $uploaddir.$uploadnamefile;
	//debug($uploadfile);
	if(file_exists($uploadfile))
		unlink($uploadfile);
	$enviar = move_uploaded_file($tmp_file, $uploadfile);
	//debug($enviar);
	//die();
	//chmod($uploadfile, 755);
	// *** Update Database
	$StrFILE = "UPDATE ".$table."";
	$StrFILE .= " SET ".$field." = '".$uploadnamefile."'";
	$StrFILE .= " WHERE ".$llavePrincipal." = ".$ID;	
	mysql_query($StrFILE)or die ("Error Update Image $StrFILE");
	if($enviar)
	{
	return true;
	}
	else
	{
	return false;
	}
}
}
if(!function_exists("deleteRegistro"))
{
function deleteRegistro($tabla,$campo,$id){
if(!empty($id)){
$sql = "DELETE FROM `$tabla` WHERE `$campo` = $id LIMIT 1";
mysql_query($sql);
}else return false;
}
}
if(!function_exists("updateRegistro"))
{
function updateRegistro($table,$registro,$pk){
$sql = "UPDATE `$table` "
. "SET ";
foreach($registro as $key => $valor){
if($key != $pk) $sql .= "`$key` = '$valor',";
}
$sql = substr($sql,0,-1);
$sql .= " WHERE `$pk` = " . $registro[$pk];
$sql .= " LIMIT 1";
//echo $sql;
mysql_query($sql);
return $registro[$pk];
}
}
if(!function_exists("redimVideos"))
{
function redimVideos($codigo,$ancho,$alto)
							{
	
								$cad = preg_replace('/width="([0-9]+)"/i', "width=".$ancho."", $codigo);
								$cad =  preg_replace('/height="([0-9]+)"/i', "height=".$alto."", $cad);
								$codigo = $cad;
								return $codigo;
							}
}
if(!function_exists("f_resize")){							
	function f_resize(&$width, &$height, $maxWidth, $maxHeight) {
		if ( ($width<=$maxWidth) && ($height<=$maxHeight) ){
			$width2 = $width;   $height2 = $height;
		}
		elseif ( ($maxWidth/$width) <= ($maxHeight/$height) ){
			$width2 = $maxWidth;   $height2 = round($height*$maxWidth/$width);
		}
		else {
			$height2 = $maxHeight;   $width2 = round($width*$maxHeight/$height);
		}
		$width = $width2;   $height = $height2;
	}
}
if(!function_exists("paginacion"))
{
function paginacion($total,$pp,$st,$url) {
if($total>$pp) {
$resto=$total%$pp;
if($resto==0) {
$pages=$total/$pp;
} else {
$pages=(($total-$resto)/$pp)+1;
}
if($pages>10) {
$current_page=($st/$pp)+1;
if($st==0) {
$first_page=0;
$last_page=10;
}else if($current_page>=5 && $current_page<=($pages-5)) {
$first_page=$current_page-5;
$last_page=$current_page+5;
} else if($current_page<5) {
$first_page=0;
$last_page=$current_page+5+(5-$current_page);
} else {
$first_page=$current_page-5-(($current_page+5)-$pages);
$last_page=$pages;
}
} else {
$first_page=0;
$last_page=$pages;
}
for($i=$first_page;$i< $last_page;$i++) {
$pge=$i+1;
$nextst=$i*$pp;
if($st==$nextst) {
$path = adjustPATH();
$path_1 = $path."ima/home/bgrojo.gif";
$page_nav .= '   <td width="20" background="'.$path_1.'" class="gris12"><b><div align="center">'.$pge.'</div></b></td>  ';
} else {
$path = adjustPATH();
$path_1 = $path."ima/home/bg.gif";
$page_nav .= ' <td width="20" background="'.$path_1.'" class="gris12"><div align="center"><a href="'.$url.$nextst.'" class="gris12">'.$pge.'</a></div></td>  ';
}
}
if($st==0) { $current_page = 1; } else { $current_page = ($st/$pp)+1; }
if($current_page< $pages) {
$path = adjustPATH();
$path_1 = $path."ima/home/bg.gif";
$page_last = ' <td width="20" background="'.$path_1.'"><div align="center" class="gris12"><a href="'.$url.($pages-1)*$pp.'" class="gris12"> &#9658;| </a> </div></td>';
$page_next = ' <td width="20" background="'.$path_1.'"><div align="center" class="gris12"><a href="'.$url.$current_page*$pp.'" class="gris12"> &#9658; </a></div></td>  ';
}
if($st>0) {
$path = adjustPATH();
$path_1 = $path."ima/home/bg.gif";
$page_first = '  <td width="20" background="'.$path_1.'"><div align="center" class="gris12"><a href="'.$url.'0" class="gris12" > |&#9668; </a></a></div></td> ';
$page_previous = '  <td width="20" background="'.$path_1.'"><div align="center" class="gris12"><a href="'.$url.''.($current_page-2)*$pp.'" class="gris12"> &#9668; </a> </div></td> ';
}
}
return "$page_first  $page_previous  $page_nav  $page_next  $page_last ";
}
}
if(!function_exists("comprobar_mail")){
function comprobar_mail($mail){
  if (!ereg("^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})$",$mail)){
      return FALSE;
  } else {
       return TRUE;
  }
} 
}
if(!function_exists("ReadFolderDirectory")){
function ReadFolderDirectory($dir)
    {
        $listDir = array();
        if($handler = opendir($dir)) {
            while (($sub = readdir($handler)) !== FALSE) {
                if ($sub != "." && $sub != ".." && $sub != "Thumb.db") {
                    if(is_file($dir."/".$sub)) {
                        $listDir[] = $sub;
                    }elseif(is_dir($dir."/".$sub)){
                        $listDir[$sub] = $this->ReadFolderDirectory($dir."/".$sub);
                    }
                }
            }   
            closedir($handler);
        }
        return $listDir;   
    } 
}
if(!function_exists("dameURL"))
{	
	function dameURL(){
	$url="http://".$_SERVER['HTTP_HOST'];
	return $url;
	}
}
if(!function_exists("getNameActualScript"))
	{
		function getNameActualScript(){
			$z = explode('/',$_SERVER['SCRIPT_NAME']);
			return $script = $z[(count($z)-1)];
	}
}

if(!function_exists("getActualLink"))
	{
		function getActualLink($complete = false){
			$host = ($complete)? "http://".$_SERVER[HTTP_HOST] : "";			
			return $actual_link = $host.$_SERVER[REQUEST_URI];
	}
}

if(!function_exists("textByHyperlink")){
	function textByHyperlink($string){
			$host = "([a-z\d][-a-z\d]*[a-z\d]\.)+[a-z][-a-z\d]*[a-z]";
			$port = "(:\d{1,})?";
			$path = "(\/[^?<>\#\"\s]+)?";
			$query = "(\?[^<>\#\"\s]+)?";
			return preg_replace("#((ht|f)tps?:\/\/({$host}){$port}{$path}{$query})#i", "<a class='news_hyp' target='_blanck' href='$1'>$1</a>", $string);
	}
}	
if(!function_exists("GetStates")){
function GetStates($selectName, $id, $CSSclass, $defaultText){
		$states = array();
   		$states[ 'Aguascalientes' ] = array( 'state_short_name' => 'Aguascalientes', 'name'=> 'Aguascalientes', 'zone'=>0);
        $states[ 'Baja California' ] = array( 'state_short_name' => 'Baja California', 'name'=> 'Baja California', 'zone'=>0);
		$states[ 'Baja California Sur' ] = array( 'state_short_name' => 'Baja California Sur', 'name'=> 'Baja California Sur', 'zone'=>0);
		$states[ 'Campeche' ] = array( 'state_short_name' => 'Campeche', 'name'=> 'Campeche', 'zone'=>0);
		$states[ 'Chiapas' ] = array( 'state_short_name' => 'Chiapas', 'name'=> 'Chiapas', 'zone'=>0);
		$states[ 'Chihuahua' ] = array( 'state_short_name' => 'Chihuahua', 'name'=> 'Chihuahua', 'zone'=>0);
		$states[ 'Coahuila' ] = array( 'state_short_name' => 'Coahuila', 'name'=> 'Coahuila', 'zone'=>0);
		$states[ 'Colima' ] = array( 'state_short_name' => 'Colima', 'name'=> 'Colima', 'zone'=>0);
		$states[ 'Distrito Federal'  ] = array( 'state_short_name' => 'Distrito Federal',  'name'=> 'Distrito Federal', 'zone'=>0);
		$states[ 'Durango' ] = array( 'state_short_name' => 'Durango', 'name'=> 'Durango', 'zone'=>0);
		$states[ 'Guanajuato' ] = array( 'state_short_name' => 'Guanajuato', 'name'=> 'Guanajuato', 'zone'=>0);
		$states[ 'Guerrero' ] = array( 'state_short_name' => 'Guerrero', 'name'=> 'Guerrero', 'zone'=>0);
		$states[ 'Hidalgo' ] = array( 'state_short_name' => 'Hidalgo', 'name'=> 'Hidalgo', 'zone'=>0);
		$states[ 'Jalisco' ] = array( 'state_short_name' => 'Jalisco', 'name'=> 'Jalisco', 'zone'=>0);
		$states[ 'Estado de México' ] = array( 'state_short_name' => 'Estado de México', 'name'=> 'Estado de México', 'zone'=>0);
		$states[ 'Michoacán' ] = array( 'state_short_name' => 'Michoacán', 'name'=> 'Michoacán', 'zone'=>0);
		$states[ 'Morelos' ] = array( 'state_short_name' => 'Morelos', 'name'=> 'Morelos', 'zone'=>0);		
		$states[ 'Nayarit' ] = array( 'state_short_name' => 'Nayarit', 'name'=> 'Nayarit', 'zone'=>0); 
		$states[ 'Nuevo León' ] = array( 'state_short_name' => 'Nuevo León', 'name'=> 'Nuevo León', 'zone'=>0); 
		$states[ 'Oaxaca' ] = array( 'state_short_name' => 'Oaxaca', 'name'=> 'Oaxaca', 'zone'=>0); 
		$states[ 'Puebla' ] = array( 'state_short_name' => 'Puebla', 'name'=> 'Puebla', 'zone'=>0); 
		$states[ 'Querétaro' ] = array( 'state_short_name' => 'Querétaro', 'name'=> 'Querétaro', 'zone'=>0); 
		$states[ 'Quintana Roo' ] = array( 'state_short_name' => 'Quintana Roo', 'name'=> 'Quintana Roo', 'zone'=>0); 
		$states[ 'San Luis Potosí' ] = array( 'state_short_name' => 'San Luis Potosí', 'name'=> 'San Luis Potosí', 'zone'=>0); 
		$states[ 'Sinaloa' ] = array( 'state_short_name' => 'Sinaloa', 'name'=> 'Sinaloa', 'zone'=>0); 
		$states[ 'Sonora' ] = array( 'state_short_name' => 'Sonora', 'name'=> 'Sonora', 'zone'=>0); 
		$states[ 'Tabasco' ] = array( 'state_short_name' => 'Tabasco', 'name'=> 'Tabasco', 'zone'=>0); 
		$states[ 'Tamaulipas' ] = array( 'state_short_name' => 'Tamaulipas', 'name'=> 'Tamaulipas', 'zone'=>0); 
		$states[ 'Tlaxcala' ] = array( 'state_short_name' => 'Tlaxcala', 'name'=> 'Tlaxcala', 'zone'=>0); 
		$states[ 'Veracruz' ] = array( 'state_short_name' => 'Veracruz', 'name'=> 'Veracruz', 'zone'=>0); 
		$states[ 'Yucatán' ] = array( 'state_short_name' => 'Yucatán', 'name'=> 'Yucatán', 'zone'=>0); 
		$states[ 'Zacatecas' ] = array( 'state_short_name' => 'Zacatecas', 'name'=> 'Zacatecas', 'zone'=>0); 
		
		$html = '<select name="' . $selectName . '" id="' . $id . '" class="' . $CSSclass . '" >';
		
			if( $defaultText != ''){
				$html .= "<option class='" . $CSSclass . "' value='". $defaultValue."'>". $defaultText ."</option>";
			}
			
			foreach( $states as $code => $state ){
				
				$name = $state["state_short_name"];
				
				$selected = ( $selectedCountry == $code || $selectedCountry == $name ) ? 'selected="selected"' : '';
				$html .= '<option class="' . $CSSclass . '" value="' . $code . '" ' . $selected .' >' . $state["name"] . '</option>';
			}
		$html .= '</select>';
		
		
		return $html;
		
   
		
	}
}
?>