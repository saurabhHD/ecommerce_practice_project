<?php

require_once("../../common_files/php/database.php");
$file = "";
$file_location = "";
$file_binary = "";
if($_FILES)
{
	$file = $_FILES['file_data'];
	$file_location = $file['tmp_name'];
	$file_binary = addslashes(file_get_contents($file_location));
}

$json_data = json_encode($_POST['css_data']);
$tmp_data = json_decode($json_data, true);
$all_data = json_decode($tmp_data, true);
$option = $all_data['options'];
$title_text = addslashes($all_data['title_text']);
$title_color = $all_data['title_color'];
$title_size = $all_data['title_size'];
$subtitle_text = addslashes($all_data['subtitle_text']);
$subtitle_color = $all_data['subtitle_color'];
$subtitle_size = $all_data['subtitle_size'];
$h_align = $all_data['h_align'];
$v_align = $all_data['v_align'];
$buttons = addslashes($all_data['buttons']);



$check_table = "SELECT COUNT(id) AS result FROM header_showcase";
$response = $db->query($check_table);
if($response)
{
	$data = $response->fetch_assoc();
	$count_rows = $data['result'];
	if($count_rows < 3)
	{
	if($option == "Choose title")
		{
	$insert_data = "INSERT INTO header_showcase(title_image,title_text,title_color,title_size,subtitle_text,subtitle_color,subtitle_size,h_align,v_align,buttons)VALUES('$file_binary','$title_text','$title_color','$title_size','$subtitle_text','$subtitle_color','$subtitle_size','$h_align','$v_align','$buttons')";
		if($db->query($insert_data))
		{
			echo "success";
		}
		else
		{
			echo "faild to insert data in showcase_header table";
		}
		}
		else
		{
			if($file == "")
			{
				$update_data = "UPDATE header_showcase SET title_text='$title_text',title_color='$title_color',title_size='$title_size',subtitle_text='$subtitle_text',subtitle_color='$subtitle_color',subtitle_size='$subtitle_size',h_align='$h_align',v_align='$v_align',buttons='$buttons' WHERE id='$option'";
				$response = $db->query($update_data);
				if($response)
				{
					echo "data edit success";
				}
				else
				{
					echo "data edit faild";
				}
			}
			else
			{
				$update_data = "UPDATE header_showcase SET title_image='$file_binary',title_text='$title_text',title_color='$title_color',title_size='$title_size',subtitle_text='$subtitle_text',subtitle_color='$subtitle_color',subtitle_size='$subtitle_size',h_align='$h_align',v_align='$v_align',buttons='$buttons' WHERE id='$option'";
				$response = $db->query($update_data);
				if($response)
				{
					echo "data edit success";
				}
				else
				{
					echo "data edit faild";
				}
			}

		}
	}
	else if($count_rows >= 3)
	{
		if($option == "Choose title")
		{
		echo "Limit full";
		}
		else
		{

			if($file == "")
			{
				$update_data = "UPDATE header_showcase SET title_text='$title_text',title_color='$title_color',title_size='$title_size',subtitle_text='$subtitle_text',subtitle_color='$subtitle_color',subtitle_size='$subtitle_size',h_align='$h_align',v_align='$v_align',buttons='$buttons' WHERE id='$option'";
				$response = $db->query($update_data);
				if($response)
				{
					echo "data edit success";
				}
				else
				{
					echo "data edit faild";
				}
			}
			else
			{
				$update_data = "UPDATE header_showcase SET title_image='$file_binary',title_text='$title_text',title_color='$title_color',title_size='$title_size',subtitle_text='$subtitle_text',subtitle_color='$subtitle_color',subtitle_size='$subtitle_size',h_align='$h_align',v_align='$v_align',buttons='$buttons' WHERE id='$option'";
				$response = $db->query($update_data);
				if($response)
				{
					echo "data edit success";
				}
				else
				{
					echo "data edit faild";
				}
			}
		}
	}
}
else
{
	$create_table = "CREATE TABLE header_showcase(
	id INT(11) NOT NULL AUTO_INCREMENT,
	title_image MEDIUMBLOB,
	title_text VARCHAR(255),
	title_color VARCHAR(20),
	title_size VARCHAR(10),
	subtitle_text VARCHAR(255),
	subtitle_color VARCHAR(20),
	subtitle_size VARCHAR(10),
	h_align VARCHAR(10),
	v_align VARCHAR(10),
	buttons MEDIUMTEXT,
	PRIMARY KEY(id)
	)";

	if($db->query($create_table))
	{
		$insert_data = "INSERT INTO header_showcase(title_image,title_text,title_color,title_size,subtitle_text,subtitle_color,subtitle_size,h_align,v_align,buttons)VALUES('$file_binary','$title_text','$title_color','$title_size','$subtitle_text','$subtitle_color','$subtitle_size','$h_align','$v_align','$buttons')";
		if($db->query($insert_data))
		{
			echo "success";
		}
		else
		{
			echo "faild to insert data in table";
		}
	}
	else
	{
		echo "unable to create header_showcase table";
	}
}



?>