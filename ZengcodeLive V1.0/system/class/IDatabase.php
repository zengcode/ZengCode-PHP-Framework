<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/
defined('SYSTEM_CLASS_PATH') or die('You can not access this file directly');
Interface IDatabase
{
public function SetNumRow($numRow);
public function Select($str);
public function From($str);
public function Where($str);
public function Group($str);
public function Having($str);
public function Sort($str);
public function PrepareQueryString();
public function LimitQuery($page=1);
public function Query($cacheName=NULL);
public function RecordSet();  //return array like rs[0][id],rs[0][name]
public function Execute($query);
public function ExecuteTransaction($query_array);
public function GetNumPage();
public function GenerateInsertQuery($data);
public function GenerateUpdateQuery($data,$condition);
}
//=============================================================================================//

?>