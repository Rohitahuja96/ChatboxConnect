<?php
session_start();
include "connect.php";
if(isset($_FILES['file']))
{
	$id=$_SESSION['id'];
	$file=$_FILES['file'];
	//print_r($file);
	$file_name=$file['name'];
	$file_tmp=$file['tmp_name'];
	$file_error=$file['error'];
	$file_size=$file['size'];
	$file_ext=explode('.',$file_name);
	//print_r($file_ext);
	$file_ext=strtolower(end($file_ext));
	//print_r($file_ext);
	$allowed=array('png','jpg','jpeg');
	if(in_array($file_ext,$allowed))
	{
		if($file_error===0)
		{
			if($file_size<=205172)
			{
				$file_new_name=$id.'_DP'.'.'.$file_ext;
				//print_r(file_new_name);
				$file_destination="images/".$file_new_name;
				if(move_uploaded_file($file_tmp,$file_destination))
				{
					$q1="update about set image='$file_destination' where id=$id";
					$r1=mysqli_query($con,$q1);
					//if($r1)
					echo "$file_destination";
					header("location:about.php");
				}
			}
		}
	}
}
?>