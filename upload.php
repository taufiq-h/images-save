<?php
include 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $file=$_FILES['image'];
    $fileName=basename($file['name']);
    $targetDir="uploads/";
    $targetFile=$targetDir . $fileName;
    $uploadOk=1;
    $imageFileType=strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    $check=getimagesize($file['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Filenya bukan image bang....";
        $uploadOk = 0;
    }

    if($file['size'] > 500000) {
        echo "Bang, plis ukurannya kegedean...";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType !="jpeg" && $imageFileType != "gif") {
        echo "maaf nih ye bang, cuma jpg, png, jpeg, ama gif doang yang bisa diupload";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "maaf bang, file abang blm keupload...";
    } else {
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $stmt = $conn->prepare("INSERT INTO images (filename) VALUES (?)");
            $stmt->bind_param("s",$fileName);
            if ($stmt->execute()) {
                echo "File " . htmlspecialchars($fileName) . " telah diupload.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "maaf nih bang, ada error jd gak bisa upload";
        }
    }
}
?>