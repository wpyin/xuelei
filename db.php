<?php
	//require dirname(__FILE__)."/dbconfig.php";
     require_once("./dbconfig.php"); 
class db{
	public $conn =null;

	public function __construct($config){
		$this->conn = mysql_connect($config['host'],$config['username'],$config['password']);
		mysql_select_db($config['database'],$this->conn);
		//mysql_query("set names".$config['charset']); 此种学法有待商量
		mysql_query("set names utf8");
		
	}
	//根据传入的sql语句 查询mysql结果集
	public function getResult($sql){
		$resource = mysql_query($sql,$this->conn);
		$arr=array();
		while ($row = mysql_fetch_assoc($resource)) {
			$arr[]=$row;
		}
	   //print_r($arr);die;
		return $arr;
	}

	public function getDataByWeek($jieci){
		$sql="select * from kebiao where jieci='$jieci'";
		$res=self::getResult($sql);

		return $res;
	} 

}
//上面是时学磊 用类的方法实现调用数据库


?>