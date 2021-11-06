<?php
// 数据库数据&&数据库连接
$dbms='';           //数据库类型
$servername=''; //数据库主机名
$port='';	         //端口
$dbname='';       //使用的数据库
$username='';        //数据库连接用户名
$password='';      //对应的密码
$conn = mysqli_connect($servername, $username, $password, $dbname ,$port);
mysqli_set_charset($conn, "utf8");
if($conn->connect_error)
{
    die('Could not connect :' . $conn->connect_error);
}

$post = $_POST;
$name = $post['name'];
$number = $post['number'];
$grade = $post['grade'];
$like = implode(",", $post['like']);
$x = implode(",", $post['x']);

// 图片名称随机——————————————————————————————————
$strs="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
$ramname=substr(str_shuffle($strs),mt_rand(0,strlen($strs)-11),10);
//echo $ramname;
// ————————————————————————————————————————————

// 图片上传——————————————————————————————————————
$allowedExts = array("gif", "jpeg", "jpg", "png","GIF", "JPEG", "JPG", "PNG");
$temp = explode(".", $_FILES["img"]["name"]);
//var_dump($temp);
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["img"]["type"] == "image/gif")
|| ($_FILES["img"]["type"] == "image/jpeg")
|| ($_FILES["img"]["type"] == "image/jpg")
|| ($_FILES["img"]["type"] == "image/pjpeg")
|| ($_FILES["img"]["type"] == "image/x-png")
|| ($_FILES["img"]["type"] == "image/png"))
&& ($_FILES["img"]["size"] < 104857600)   // 小于 100 MB
&& in_array($extension, $allowedExts))
{
	if ($_FILES["img"]["error"] > 0)
	{
		echo "错误：: " . $_FILES["img"]["error"] . "<br>";
	}
	else
	{
        $_FILES["img"]["name"] = 'yunxing_' . $ramname . "." . $extension;
        $imgFileName = $_FILES["img"]["name"];
		move_uploaded_file($_FILES["img"]["tmp_name"], "upload_yunxing/" . $_FILES["img"]["name"]);
	}
}

$img='upload_yunxing/'.$imgFileName;
$time=date('y/m/d|H:i:s');

var_dump($name,$number,$grade,$like,$x,$img,$time);
echo "<br><br>";
$sql = "INSERT INTO `yunxing` (name,number,grade,like_1,x,img,time) 
VALUES ('{$name}','{$number}','{$grade}','{$like}','{$x}','{$img}','{$time}')";
echo $sql;
echo "<br><br>";
if($conn->query($sql)){
    echo "提交成功!";
}else{
    echo "FALSE!";
}
?>