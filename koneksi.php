<?php

$conn = mysqli_connect('localhost', 'root', '', 'db_latihanlsp');



function read($query){
    global $conn;
    $result = mysqli_query($conn,$query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}

function register ($data){
    global $conn;
    
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $username =strtolower(stripslashes(htmlspecialchars($data["username"])));
    $password =mysqli_real_escape_string ($conn, htmlspecialchars($data["password"])) ;


    //cek username
    $result = mysqli_query($conn, " SELECT username FROM tbl_user WHERE username ='$username'");

    if (mysqli_fetch_assoc($result)){
        echo" <script>
                alert ('username sudah terdaftar !');
                document.location.href ='tampilandata.php';
              </script>";

        exit;        
    }





    //mengacak password
    $password = password_hash($password, PASSWORD_DEFAULT);


   $query = "INSERT INTO tbl_user VALUES ('','$nama','$email','$username','$password')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);


}


function hapus ($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM tbl_user WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah ($data){
    global $conn;

    $id = htmlspecialchars($data["id"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);

    
    $query = "UPDATE tbl_user SET

            nama = '$nama',
            email = '$email',
            username = '$username',
            password = '$password'
        WHERE id = $id
        ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
 ?>