<?php
include 'connection.php';
$data = json_decode(file_get_contents("php://input"));

if($data){
    $name = $data->name;
	$email = $data->email;
	$password = $data->password;
    $token = time().rand(111,999).md5($email);
    $image = "";
    if($data->image){
        $dir="Authentication/User/";
        list($type, $imgdata) = explode(';', $data->image);
        list(, $imgdata)      = explode(',', $imgdata);
        /* to get image type like jpg, png */
        $fileType = explode("image/", $type);
        $image_type = $fileType[1];

        $imagedata = base64_decode($imagedata);
        $image_name = $dir.uniqid().rand(111,999) .".".$image_type;
        file_put_contents($image_name,$imagedata);
        $image = $image_name;
    }
    $rdata = array();
    $sql ="insert into `user` set name='$name', email='$email', image='$image',password='$password', token='$token'";
    $result = $db->query($sql);

    if($result)
        echo json_encode(array("message" => "Successful register"));
    else
        echo json_encode( array("message" => "Login Failed."));
}