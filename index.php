<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gambar Penyimpanan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Upload Gambar</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <input type="submit" value="Upload Gambar" name="submit">
    </form>

    <h2>Gambar Tersimpan</h2>
    <div class="gallery">
        <?php
        include 'config.php';

        $sql = "SELECT * FROM images ORDER BY uploaded_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="gallery-item">';
                echo '<img src="uploads/' . htmlspecialchars($row['filename']) . '" alt="Gambar" />';
                echo '</div>';
            }
        } else {
            echo "Tidak ada gambar untuk ditampilkan";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>