<html>
<head>
<meta charset="UTF-8">
</head>
<body>

<?php
$dsn='mysql:dbname=データベース名=localhost';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);

$sql="CREATE TABLE test2"
."("
."no      INT AUTO_INCREMENT PRIMARY KEY,"
."name    VARCHAR(255),"
."comment TEXT,"
."created DATETIME"
.");";
$stmt=$pdo->query($sql);

$pass=$_POST['pass3'];
if($pass=='1212'){
    if($_POST['editnum']!=NULL){
	$sql="SELECT*FROM test2 WHERE no=:no";
   	$stmt=$pdo->prepare($sql);
   	$stmt->bindParam(":no",$id,PDO::PARAM_INT);
   	$id=$_POST["editnum"];
        $sql=$pdo->prepare("SELECT*FROM test2 WHERE no=$id");
        $sql->execute();
        $DD=$_POST['editnum'];
        $row=$sql->fetch();
        $dname=$row['name'];
        $dcomment=$row['comment'];
        $stmt->execute();
}
}

?>

<form action="mission_4.php" method="post"/>
<input type="text" name="name" value="<?php echo $dname; ?>" placeholder="名前"/>
<br>
<input type="text" name="comment" value="<?php echo $dcomment; ?>" placeholder="コメント"/>
<br>
<input type="text" name="edit" value="<?php echo $DD; ?>" />
<br>
<input type="text" name="pass1" placeholder="パスワード"/>
<input type="submit" value="送信"/>
<br>
<br>
<input type="text" name="deleteNo" value="" placeholder="削除対象番号"/>
<br>
<input type="text" name="pass2" placeholder="パスワード"/>
<input type="submit" name="delete" value="削除" />
<br>
<br>
<input type="text" name="editnum" placeholder="編集対象番号"/>
<br>
<input type="text" name="pass3" placeholder="パスワード"/>
<input type="submit" value="編集" />
</form>

<?php
$dsn='mysql:dbname=データベース名;host=localhost';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);

$sql="CREATE TABLE test2"
."("
."no      INT AUTO_INCREMENT PRIMARY KEY,"
."name    VARCHAR(255),"
."comment TEXT,"
."created DATETIME"
.");";
$stmt=$pdo->query($sql);

$name=$_POST['name'];
$comment=$_POST['comment'];
$time=date('Y/m/d/H/i/s');
$pass=$_POST['pass1'];
if($_POST['name']!=NULL or $_POST['comment']!=NULL){
	if($pass=='1212'){
    		if($_POST['edit']==NULL){
        		if($_POST['comment']!=NULL||$_POST['name']!=NULL){
			        $sql=$pdo->prepare("INSERT INTO test2(name,comment,created) VALUES (:name,:comment,:created)");
				$sql->bindParam(':name',$name,PDO::PARAM_STR);
				$sql->bindParam(':comment',$comment,PDO::PARAM_STR);
				$sql->bindParam(':created',$time,PDO::PARAM_STR);
				$sql->execute();
}
}
}
}




$pass=$_POST['pass2'];
if($pass=='1212'){
	if($_POST['deleteNo']!=NULL){//deleteに中身があれば処理
   		$delete= intval($_POST["deleteNo"]);//削除する番号
   		$sql="DELETE FROM test2 WHERE no=:no";
   		$stmt=$pdo->prepare($sql);
   		$stmt->bindParam(":no",$id,PDO::PARAM_INT);
   		$id=$_POST["deleteNo"];
   		$stmt->execute();

}
}


$pass=$_POST['pass1'];
if($_POST['edit']!=NULL){
	if($_POST['name']!=NULL or $_POST['comment']!=NULL){
		if($pass=='1212'){
			$id=$_POST["edit"];
			$name=$_POST["name"];
			$comment=$_POST["comment"];
			$time=date('Y/m/d/H/i/s');
			$sql="update test2 set name='$name',comment='$comment',created='$time' where no=$id";
			$result=$pdo->query($sql);
}
}
}
			


$sql=$pdo->prepare("SELECT*FROM test2 ORDER BY no");
$sql->execute(array());
$result=$sql->fetchAll();
foreach($result as $row){
	echo $row['no'].',';
    	echo $row['name'].',';
    	echo $row['comment'].',';
    	echo $row['created'].'<br>';
} 

?>
</body>
</html>