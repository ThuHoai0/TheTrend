<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

function uploadFile($file, $folderUpload = 'admin/uploads/') {
    // Thêm time() vào để chống trùng file name
    $fileName = time() . $file['name'];
    $pathStorage = $folderUpload . $fileName;
    // echo $pathStorage;
    // die();

    $from   = $file['tmp_name'];
    $to     = $pathStorage; // Đường dẫn tuong đối

    // function move_uploaded_file(string $from, string $to): bool { }
    // @param string $from — The filename of the uploaded file.
    // @param string $to — The destination of the moved file.
    // @return bool
    // If filename is not a valid upload file, then no action will occur, and move_uploaded_file will return false.
    // @link https://php.net/manual/en/function.move-uploaded-file.php
    if (move_uploaded_file($from, $to)) {
        return $fileName; // Trả về đường dẫn để lưu DB
    }

    return null; // Upload fail trả về null
}