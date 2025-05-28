<?php  
    $hostname = "localhost";
    $username = "ingkunge_mbahoerip";
    $password = "Aman12345%";
    $database = "ingkunge_mbahoerip";
    
//sebelum menulis query harus menyertakan variabel ini terlebih dahulu
    $conn = mysqli_connect($hostname, $username, $password, $database);
    if (!$conn) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }
?>