<?php
//koneksi ke database
$conn = mysqli_connect("localhost","root","","kasir");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function add($data){
    //ambil data dari tiap elemen dalam form
    global $conn;
    $produk = htmlspecialchars($data["produk"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);

    // upload gambar
    $image = upload();
    if (!$image) {
        return false;
    }

    //query insert data
    $query = "INSERT INTO items VALUES ('', '$image', '$produk', '$harga', '$stok')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function delete($id){
    global $conn;

     if ($id <= 0) {
        return 0;
    }

    // ambil nama gambar dulu
    $result = mysqli_query($conn, "SELECT image FROM kasir WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // hapus file gambar
    if ($row && $row['image'] && file_exists('img/' . $row['image'])) {
        unlink('img/' . $row['image']);
    }

    mysqli_query($conn, "DELETE FROM items WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function edit ($data){
    global $conn;

    if (!isset($data['id'])) {
        return 0;
    }

    $id = $data["id"];
    $produk = htmlspecialchars($data["produk"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user upload gambar baru
    if ($_FILES['image']['error'] === 4) {
        $image = $gambarLama;
    } else {
        $image = upload();
        if (!$image) {
            return false;
        }

        // GAGAL UPLOAD
        if (!$image) {
            return 0;
        }

        if ($gambarLama && file_exists('img/' . $gambarLama)) {
        unlink('img/' . $gambarLama);
    }
    }


    //query insert data
    $query = "UPDATE items SET 
        image = '$image',
        produk = '$produk',
        harga = '$harga',
        stok = '$stok'
        WHERE id = $id";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function upload() {
    $namaFile = $_FILES['image']['name'];
    $ukuranFile = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    // tidak upload gambar
    if ($error === 4) {
        return false;
    }

    // validasi ekstensi
    $ekstensiValid = ['jpg','jpeg','png','webp'];
    $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    if (!in_array($ekstensi, $ekstensiValid)) {
        return false;
    }

    // validasi ukuran (2MB)
    if ($ukuranFile > 2000000) {
        return false;
    }

    // nama unik
    $namaFileBaru = uniqid() . '.' . $ekstensi;

    // simpan ke folder img
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

?>