<?php

use PHPUnit\Framework\Constraint\IsEmpty;

use function PHPUnit\Framework\isEmpty;

class DB{

public $serverName ="localhost";
public $databaseUser="root";
public $databasename="alnajah";
//public $table ="post"; 
public $conn;

function __construct(){
    $this->conn =  new mysqli($this->serverName, $this->databaseUser,'',$this->databasename);
}

    function getINFO($table,$id=null){
        if($table=='student'){
            if($id==null){
                $sql="SELECT * FROM `student`";
                return $result=$this->conn->query($sql);
            }else{
                $sql="SELECT * FROM `student` WHERE `std_id`=$id;"; 
            }
            
        }elseif($table=='course'){
            if($id==null){
                $sql="SELECT * FROM `course`";
                return $result=$this->conn->query($sql);
            }else{
                $sql="SELECT * FROM `course` WHERE `cour_id`=$id;"; 
            }
           
        }else{
        if($id==null){
            $sql="SELECT * FROM `register_in`";
            return $result=$this->conn->query($sql);
        }else{
            $sql="SELECT * FROM `register_in` WHERE `reg_id`=$id;"; 
        }
       
        $result=$this->conn->query($sql);
        return $result->fetch_assoc();
        }
        $result=$this->conn->query($sql);
        return $result->fetch_row();
    }
   
    function addcertifica($cerNO,$date,$regid=NULL){
      if($regid!=null){
        $sql="INSERT INTO `certificat` (`certfcatNO`,`dateofgenrat`, `reg_id` ) VALUES ('$cerNO', '$date' , '$regid');";

      }else{
         $sql="INSERT INTO `certificat` (`certfcatNO`,`dateofgenrat` ) VALUES ('$cerNO', '$date');";

      }
 
 return $this->conn->query($sql);
  
 }
 
 function getLstcertfactNO(){
$sql="SELECT `certfcatNO` FROM certificat ORDER BY `certfcatNO` DESC LIMIT 1; ";
$result=$this->conn->query($sql);
return $result->fetch_column();
 }  

    function getcertfact(array $Search=[]){
        $searchKey='';
        $search=0;
       
      
        if(!empty($Search[0])){
            $searchKey=" where certfcatNO ='$Search[0]'";
            $search+1;
        }elseif(!empty($Search[1])){
            if($search==0){
                $searchKey=" where dateofgenrat ='$Search[2]'";
            }else{
                 $searchKey .=" and dateofgenrat ='$Search[2]'";
            }
        }
        $sql="SELECT * FROM `certificat`$searchKey ";
        $result=$this->conn->query($sql);
        return $result;
    }  

    function getreginfo($id,){
       
        $sql="SELECT `stud_id` ,`cour_id` FROM `register_in` WHERE `reg_id`=$id; ";
        $result=$this->conn->query($sql);
        $info= $result->fetch_row();
        $sql="SELECT `name_Ar` FROM `student` WHERE `std_id`=$info[0]; ";
        $result=$this->conn->query($sql);
        $info[0]=$result->fetch_column();
        $sql="SELECT `cour_name` FROM `course` WHERE `cour_id`=$info[1]; ";
        $result=$this->conn->query($sql);
        $info[1]=$result->fetch_column();
       return $info;
        
    }  
    function getstudentbynam($sudentname){
        $sql="SELECT `std_id` FROM `student` WHERE `name_Ar`='$sudentname'; ";
        $result=$this->conn->query($sql);
        $studID=$result->fetch_column();
        $sql="SELECT `stud_id` ,`cour_id` FROM `register_in` WHERE `reg_id`=$studID; ";
        $result=$this->conn->query($sql);
        $info= $result->fetch_row();
        $sql="SELECT `name_Ar` FROM `student` WHERE `std_id`=$info[0]; ";
        $result=$this->conn->query($sql);
        $info[0]=$result->fetch_column();
        $sql="SELECT `cour_name` FROM `course` WHERE `cour_id`=$info[1]; ";
        $result=$this->conn->query($sql);
        $info[1]=$result->fetch_column();
       return $info;
        
    }  

    function getstudentinfo($sudentname){
        $sql="SELECT * FROM `student` WHERE `name_Ar`='$sudentname'; ";
        $result=$this->conn->query($sql);
        $stud=$result->fetch_row();
       
       return $stud;
        
    }  
    function dropcertfcat($id){
       $sql="DELETE FROM certificat WHERE `certfcatNO` = '$id'";
       $this->conn->query($sql);
       
    }
    function getdiblomainfo($diplomname=null){
        if($diplomname==null){
            $sql="SELECT * FROM `diplome`";
            return $this->conn->query($sql);
        }else{
        $sql="SELECT * FROM `diplome`  WHERE `dip_id`=$diplomname";
        $result=$this->conn->query($sql);
        return $result->fetch_row();
    }
       
        
     }

     function getcourse($id=null){
        if($id==null){
            $sql="SELECT * FROM `course` ";
            
        }else{
             $sql="SELECT `cour_name`,`cour_id` FROM `course` WHERE `diplom_id`=$id";
        }
       
        return $this->conn->query($sql);
        
     }
     function getstudentName($id){
        $arr_studNames=[];
            $sql="SELECT `stud_id` FROM `register_in` WHERE `cour_id` =$id; ";
            $result=$this->conn->query($sql);
            while($stud_ids=$result->fetch_array()){
                 $sql="SELECT `name_Ar` FROM `student` WHERE `std_id`=$stud_ids[0]; ";
                 $result2=$this->conn->query($sql);
                 array_push($arr_studNames,$result2->fetch_column());

            }
    return $arr_studNames; 
     }

     function checkExistCertfcat($id){
        $sql="SELECT count(`id`) FROM `certificat` WHERE `reg_id` =$id; ";
        $result=$this->conn->query($sql);
        return $result->fetch_column();
     }
     function check($name,$course_Id){
        $sql="SELECT `std_id` FROM `student` WHERE `name_Ar`='$name'; ";
        $result=$this->conn->query($sql);
        $stud_id= $result->fetch_column();
        $sql="SELECT `reg_id`, `isComlpted`,`isConfirm`,`ispay` FROM `register_in` WHERE `stud_id`='$stud_id' and `cour_id`='$course_Id'; ";
        $result=$this->conn->query($sql);
        $reg= $result->fetch_row();
        if($reg!=null){
             if (!$reg[1]) {
            return ;
           }
           if( !$reg[2]) {
            return false;
           }
           if (!$reg[3]) {
            return false;
           }

           return true; 
        }else{
            return false;
        }
      
     }
}

 /* $db= new DB();
$x='';
$y='';
$result=$db->getcertfact([null,null]);
var_dump($result->fetch_assoc());  */
// $t->getLstcertfactNO();
// $t->addcertfact("1","1","2021-12-12");
//echo $result=$db->checkExistCertfcat(3);
