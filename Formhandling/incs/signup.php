<?php
if (isset($_POST['regin'])) {

    require 'conn.php';
    $UserName = $_POST['uname'];
    $Email = $_POST['uemail'];
    $PassWord = $_POST['upassword'];
    $RPassWord = $_POST['urepassword'];

    if (empty($UserName) || empty($Email) || empty($PassWord) || empty($RPassWord)) {
        header("location:../index.php?erroe=emptyfields&uUname=" . $UserName . "&uemail=" . $Email);
        exit();
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $UserName)) {
        header("location:../index.php?error=emailuname");
        exit();
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        header("location:../index.php?error=email=&uname=" . $UserName);
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $UserName)) {
        header("location:../index.php?error=uname=&uemail=" . $Email);
        exit();
    } elseif ($PassWord !== $RPassWord) {
        header("location:../index.php?error=passwordsmatch&uname=" . $UserName . "&email=" . $Email);
        exit();
    } else {
        $sql = "SELECT Uname FROM auth WHERE Uname=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $UserName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../index.php?error=usertaken&uemail=" . $Email);
                exit();
            } else {
                $sql = 'INSERT INTO auth (Uname , email, upassword) values (? ,? , ?)' ;
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                } else {
                    $hashedPwd = password_hash($PassWord, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt,'sss', $UserName, $Email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../index.php?signup=success");
                    exit();

                }
            }
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../index.php");
}