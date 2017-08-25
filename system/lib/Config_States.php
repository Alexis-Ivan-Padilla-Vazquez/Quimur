<?php
function GetCountries(){
	$mx_options = array(
		array('id' => 'MEX','value' => 'MX', 'label' => 'Mexico')
		);
	return $mx_options;
}
function GetMXStates(){
/*	$mx_options = array(
	array('id' => 'MEX-AGS','value' => 'AGS', 'label' => 'Aguascalientes (AGS)'),
	array('id' => 'MEX-BCN','value' => 'BCN', 'label' => 'Baja California Norte (BCN)'),
	array('id' => 'MEX-BCS','value' => 'BCS', 'label' => 'Baja California Sur (BCS)'),
	array('id' => 'MEX-CAM','value' => 'CAM', 'label' => 'Campeche (CAM)'),
	array('id' => 'MEX-CHIS','value' => 'CHIS', 'label' => 'Chiapas (CHIS)'),
	array('id' => 'MEX-CHIH','value' => 'CHIH', 'label' => 'Chihuahua (CHIH)'),
	array('id' => 'MEX-COAH','value' => 'COAH', 'label' => 'Coahuila (COAH)'),
	array('id' => 'MEX-COL','value' => 'COL', 'label' => 'Colima (COL)'),
	array('id' => 'MEX-DF','value' => 'DF', 'label' => 'Distrito Federal (DF)'),
	array('id' => 'MEX-DGO','value' => 'DGO', 'label' => 'Durango (DGO)'),
	array('id' => 'MEX-GTO','value' => 'GTO', 'label' => 'Guanajuato (GTO)'),
	array('id' => 'MEX-GRO','value' => 'GRO', 'label' => 'Guerrero (GRO)'),
	array('id' => 'MEX-HGO','value' => 'HGO', 'label' => 'Hidalgo (HGO)'),
	array('id' => 'MEX-JAL','value' => 'JAL', 'label' => 'Jalisco (JAL)'),
	array('id' => 'MEX-EDM','value' => 'EDM', 'label' => 'México - Estado de (EDM)'),
	array('id' => 'MEX-MICH','value' => 'MICH', 'label' => 'Michoacán (MICH)'),
	array('id' => 'MEX-MOR','value' => 'MOR', 'label' => 'Morelos (MOR)'),
	array('id' => 'MEX-NAY','value' => 'NAY', 'label' => 'Nayarit (NAY)'),
	array('id' => 'MEX-NL','value' => 'NL', 'label' => 'Nuevo León (NL)'),
	array('id' => 'MEX-OAX','value' => 'OAX', 'label' => 'Oaxaca (OAX)'),
	array('id' => 'MEX-PUE','value' => 'PUE', 'label' => 'Puebla (PUE)'),
	array('id' => 'MEX-QRO','value' => 'QRO', 'label' => 'Querétaro (QRO)'),
	array('id' => 'MEX-QROO','value' => 'QROO', 'label' => 'Quintana Roo (QROO)'),
	array('id' => 'MEX-SLP','value' => 'SLP', 'label' => 'San Luis Potosí (SLP)'),
	array('id' => 'MEX-SIN','value' => 'SIN', 'label' => 'Sinaloa (SIN)'),
	array('id' => 'MEX-SON','value' => 'SON', 'label' => 'Sonora (SON)'),
	array('id' => 'MEX-TAB','value' => 'TAB', 'label' => 'Tabasco (TAB)'),
	array('id' => 'MEX-TAMPS','value' => 'TAMPS', 'label' => 'Tamaulipas (TAMPS)'),
	array('id' => 'MEX-TLAX','value' => 'TLAX', 'label' => 'Tlaxcala (TLAX)'),
	array('id' => 'MEX-VER','value' => 'VER', 'label' => 'Veracruz (VER)'),
	array('id' => 'MEX-YUC','value' => 'YUC', 'label' => 'Yucatán (YUC)'),
	array('id' => 'MEX-ZAC','value' => 'ZAC', 'label' => 'Zacatecas (ZAC)'),
	);
	*/
	$mx_options = array(
		array('id' => 'MEX-AGS','value' => 'AGS', 'label' => 'Aguascalientes'),
		array('id' => 'MEX-BCN','value' => 'BCN', 'label' => 'Baja California Norte'),
		array('id' => 'MEX-BCS','value' => 'BCS', 'label' => 'Baja California Sur'),
		array('id' => 'MEX-CAM','value' => 'CAM', 'label' => 'Campeche'),
		array('id' => 'MEX-CHIS','value' => 'CHIS', 'label' => 'Chiapas'),
		array('id' => 'MEX-CHIH','value' => 'CHIH', 'label' => 'Chihuahua'),
		array('id' => 'MEX-COAH','value' => 'COAH', 'label' => 'Coahuila'),
		array('id' => 'MEX-COL','value' => 'COL', 'label' => 'Colima'),
		array('id' => 'MEX-DF','value' => 'DF', 'label' => 'Distrito Federal'),
		array('id' => 'MEX-DGO','value' => 'DGO', 'label' => 'Durango'),
		array('id' => 'MEX-GTO','value' => 'GTO', 'label' => 'Guanajuato'),
		array('id' => 'MEX-GRO','value' => 'GRO', 'label' => 'Guerrero'),
		array('id' => 'MEX-HGO','value' => 'HGO', 'label' => 'Hidalgo'),
		array('id' => 'MEX-JAL','value' => 'JAL', 'label' => 'Jalisco'),
		array('id' => 'MEX-EDM','value' => 'EDM', 'label' => 'México - Estado de'),
		array('id' => 'MEX-MICH','value' => 'MICH', 'label' => 'Michoacán'),
		array('id' => 'MEX-MOR','value' => 'MOR', 'label' => 'Morelos'),
		array('id' => 'MEX-NAY','value' => 'NAY', 'label' => 'Nayarit'),
		array('id' => 'MEX-NL','value' => 'NL', 'label' => 'Nuevo León'),
		array('id' => 'MEX-OAX','value' => 'OAX', 'label' => 'Oaxaca'),
		array('id' => 'MEX-PUE','value' => 'PUE', 'label' => 'Puebla'),
		array('id' => 'MEX-QRO','value' => 'QRO', 'label' => 'Querétaro'),
		array('id' => 'MEX-QROO','value' => 'QROO', 'label' => 'Quintana Roo'),
		array('id' => 'MEX-SLP','value' => 'SLP', 'label' => 'San Luis Potosí'),
		array('id' => 'MEX-SIN','value' => 'SIN', 'label' => 'Sinaloa'),
		array('id' => 'MEX-SON','value' => 'SON', 'label' => 'Sonora'),
		array('id' => 'MEX-TAB','value' => 'TAB', 'label' => 'Tabasco'),
		array('id' => 'MEX-TAMPS','value' => 'TAMPS', 'label' => 'Tamaulipas'),
		array('id' => 'MEX-TLAX','value' => 'TLAX', 'label' => 'Tlaxcala'),
		array('id' => 'MEX-VER','value' => 'VER', 'label' => 'Veracruz'),
		array('id' => 'MEX-YUC','value' => 'YUC', 'label' => 'Yucatán'),
		array('id' => 'MEX-ZAC','value' => 'ZAC', 'label' => 'Zacatecas'),
	);
	
	return $mx_options;
}
?>