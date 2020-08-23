<?php
require_once("../../common_files/database/database.php");
session_start();
$email = $_POST['email'];
$password = md5($_POST['password']);

$check = "SELECT * FROM users WHERE email='$email'";

$response = $db->query($check);
if($response)
{
	if($response->num_rows != 0)
	{
		$data = $response->fetch_assoc();
		$status = $data['status'];
		$real_username = $data['email'];
		$real_password = $data['password'];
		if($status == "panding")
		{
			$mobile = $data['mobile'];
			require("sendsms.php");

		}
		else
		{
			if($password == $real_password && $email == $real_username)
			{
				
				$_SESSION['username'] = $email;
				$cookie_data = base64_encode($email);
				$cookie_time = time()+(60*60*24*365);
				setcookie('_au_',$cookie_data,$cookie_time,'/');
				echo "login success";
			}
			else
			{
				echo "<b>Wrong password</b>";
			}
		}
	}
	else
	{
		echo "user not found";
	}
}
else
{
	echo "table not found";
}

?>