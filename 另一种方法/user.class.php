<?php
     require_once("./db.class.php");

 

  class User{

   public $name = NULL;

   public $password = NULL;

   

   /**
    * 构造函数
    */

   public function __construct($name,$password){

    $this->name = $name;

    $this->password = $password;

    }
    /**
   * 向数据库表中插入数据
   * @param：$table,表名
   * @param：$columns,包含表中所有字段名的数组。默认空数组，则是全部有序字段名
   * @param：$values,包含对应所有字段的属性值的数组
   */
   public function insert(){

    $db = new DB();

       $resultid = $db->insertData("user",array(),array('',$this->name,$this->password)); 

       return $resultid;

    }

  

   public static function getUserById($uid){

     $db = new DB();

     return $db->getDataByAtr("user",'uid',$uid);

     }

 

   public static function getUserByName($name){

     $db = new DB();

     @$data = $db->getObjListBySql($name);

     if(count($data)!=0)return $data;

     else return null;

     }

  public static function getAllUser(){

     $db = new DB();

      @$data = $db->getObjListBySql("SELECT * FROM user");

      if(count($data)!=0) return $data;

      else return null;

     }

     

   public static function deleteByUid($uid){

     $admin = Admin::getAdminById($uid);

     $db = new DB();

     if($db->delete("user","uid",$uid)) return true;

     else return false;

     }

   }  

   

?>