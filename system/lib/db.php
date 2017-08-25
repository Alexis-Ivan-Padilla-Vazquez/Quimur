<?php
//Interface functions 
function DB_INTERFACE_Delete($table_name, $table_id, $id){
   return delete( $table_name, $table_id .' = ' . db_escape_string($id) );
}
function DB_INTERFACE_Save( $table, $fields = array(), $fieldIds = array() ){
   dbEscapeArray($fields);
   dbEscapeArray($fieldIds);
   save( $table, $fields, $fieldIds);

}

function DB_INTERFACE_LoadById($table,$tableId,$id){
$extra_contidions = array();
$extra_contidions[] = array('condition'=>$tableId . '= %s','condition_values'=>array($id) );
//debug($extra_contidions);
$reg = DB_INTERFACE_Select($table,array('*'),$extra_contidions,array(),1,1 );
return is_array($reg) && !empty($reg) ? $reg[0] : array();
}
function DB_INTERFACE_Select($table,$fields=array(), 
                     $extraConditions, $order ='', 
                     $p = 1, $k =1,
                     $count = false){
   
   //call_user_func_array("db_escape_string",$fields);
   $limit = $k >= 0 ? ( ($p-1) * $k) . ',' . $k : '';
   
   //debug($order);
   
   $order = printf_array( $order['order'], $order['order_values'] );
   
   
   $where= '';
   $And = false;
   foreach($extraConditions as $extraCondition){
      if( $And ){$where .= ' AND ';}else{$And = true;}
      $where .= ' ( ' . printf_array($extraCondition['condition'], $extraCondition['condition_values']) . ' ) ';

   }
   //dbEscapeArray($fields);
   
   

   return select($table,$fields, $where, $limit,$order, $count);
}
//DATABASES General Functions
function db_connect(){
   mysql_connect(DB_HOST,DB_USER,DB_PWD) or die('die-Conexion DB');
   mysql_query("SET NAMES 'utf8'");
   db_select();
}
function printf_array($format, $arr)
{
   call_user_func_array("db_escape_string",$arr);
    return call_user_func_array('sprintf', array_merge((array)$format, $arr));
} 
function dbEscapeArray(&$arrItem,$escapeId  = true){
   foreach($arrItem as $key => $val){
      $arrItem[db_escape_string($key)] = db_escape_string($val);
   }
   
}
function db_escape_string($str){
   return mysql_real_escape_string($str);
}
function db_select(){
   mysql_select_db(DB_DB);
}

function save( $table, $fields = array(), $fieldIds = array() ){
   //check possible update
   $w = '';
   foreach( $fieldIds as $field => $value) {
      if( !empty( $value)) {
         $w = (!empty($w) ? ' AND ' : '') . $field . ' = ' . $value;
      }
   }
   if( !empty($w) ){
         update( $table, $fields, $w);
   }else{

     insert( $table, $fields);
   }
   if(DEBUG){
      echo mysql_error();
   }
}

function insert( $table, $fields=array() ){
   $sql = 'INSERT INTO ' . $table . ' SET ';
   $comma = false;
   foreach( $fields as $field => $value){
      if( $comma)
      { $sql.= ',';
      }else{$comma=true;}
      //$sql .= $field . ' = CONVERT(_latin1"'.(utf8_decode($value) ).'" USING utf8) ';
      //$sql .= $field . ' = "'.$value.'" ';
      $sql .= $field . ' = "'. $value .'" ';

   }

   return query( $sql );

}

function query( $sql ){
   //debug($sql);
   //die;
   if(DEBUG_SQL){debug($sql);}
//debug($sql);
   return mysql_query( $sql );
}


function update( $table, $fields=array(), $where = '' ){
   $sql = 'UPDATE ' . $table . ' SET ';
   $comma = false;
   foreach( $fields as $field => $value){
      if( $comma){ $sql.= ',';}else{$comma=true;}
      $sql .= $field . ' = "'.$value.'" ';
   }
   $sql .= empty($where) ? '' : ' WHERE ' . $where;


   return query( $sql );
}
function delete( $table, $where ){
   $sql = 'DELETE FROM ' . $table ;
   $sql .= empty($where) ? '' : ' WHERE ' . $where;
   return query( $sql );
}
function select($table,$fields=array(), $where= '', $limit = '',$order ='', $count = false){
   $f = $count ? 'COUNT(*)' : join(',',$fields);
   $sql = 'SELECT ' . $f . ' FROM ' . $table;

   $sql .= empty($where) ? '' : ' WHERE ' . $where;
   $sql .= empty($order) ? '' : ' ORDER BY ' . $order;
   $sql .= empty($limit) || !empty($count)  ? '' : ' LIMIT ' . $limit;
   //debug($sql);
   $r = query( $sql );
   $result = array();
   if( $r ){
      if($count){
         $re = mysql_fetch_array($r);
         $result = $re[0];
      }else{
         while($re = mysql_fetch_assoc($r) ){$result[] = $re;}
      }
   }else{
      $result = $count ? 0 : array();
   }
   
   return $result;


}
?>
