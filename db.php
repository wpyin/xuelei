<?php
	require dirname(__FILE__)."/dbconfig.php";//引入配置文件

class db{
	public $conn =null;

	public function __construct($config){
		$conn=mysql_connect($config['host'],$config['username'],$config['password']) or die(mysql_error());
		mysql_select_db($config['database'],$conn) or die(mysql_error());
		mysql_query("set names".$config['charset']) or die(mysql_error());

	}
	//根据传入的sql语句 查询mysql结果集
	public function getResult($sql){
		$resource=mysql_query($sql,$conn) or die(mysql_error());
		$res=array();
		while (($row=mysql_fetch_assoc($resource))!=false) {
			$res[]=$row;
		}
		return $res;
	}

	public function getDataByWeek(){
		$sql="select ID,XINGMING,ROOM,CLASS from kecheng where WEEK=".$week." order by CLASS";
		$res=self::getResult($sql);
		return $res;
	} 

}

?>