<?php 
//Koneksi
$connect_db=mysqli_connect("localhost", "id20489939_rootnya", "7KNg0}3GZEw7WV|Z","id20489939_palasari");

function query($query){
    global $connect_db; //untuk mengakses variabel connect_db yang ada diluar fungsi
    
    $result_buku =mysqli_query($connect_db, $query);
    $barisan =[];

    while($baris = mysqli_fetch_assoc($result_buku)){
        $barisan[]=$baris;
    }
    return $barisan;
}

function ubah($data){
    global $connect_db;

        // =====Keamanan=====
    // htmlspecialchars() artinya data html yang ada pada database akan dianggap data biasa

    //ambil data dari element
    $id =htmlspecialchars($data["id"]);
    $nama_buku =htmlspecialchars($data["nama_buku"]);
    $harga =htmlspecialchars($data["harga"]);

    $gambarLama =$data["gambar_lama"];

    //cek apakah user mengupload gambar baru
    $gambar =htmlspecialchars($data["gambar"]);
    if ($_FILES["gambar"]["error"] === 4) {
        $gambar = $gambarLama;
    }else {
        $gambar = upload();
    }

    //Query menambahkan
    $query="UPDATE buku SET 
            nama_buku='$nama_buku',
            harga='$harga',
            gambar='$gambar'
            WHERE id='$id'
            ";


    mysqli_query($connect_db, $query);

    return mysqli_affected_rows($connect_db);

}

function tambah($data){
    global $connect_db;

    // =====Keamanan=====
    // htmlspecialchars() artinya data html yang ada pada database akan dianggap data biasa

    //ambil data dari element
    $nama_buku =htmlspecialchars($data["nama_buku"]);
    $harga =htmlspecialchars($data["harga"]);
    
    $gambar=upload();
    if (!$gambar) {
        return false;
    }
    //Query menambahkan
    $query="INSERT INTO buku
            VALUES
            ('', '$nama_buku', '$harga', '$gambar');
        ";

    mysqli_query($connect_db, $query);

    return mysqli_affected_rows($connect_db);

}

function upload(){
    $namaGambar = $_FILES['gambar']['name'];
    $ukuranGambar = $_FILES['gambar']['size'];
    $errorGambar = $_FILES['gambar']['error'];
    $tmpName= $_FILES['gambar']['tmp_name'];

    // cek ada tidaknya gambar
    if($errorGambar === 4){
        echo "<script>
                alert('Pilih gambar terlebih dahulu!');
            </script>
            ";
        return false;
    }

    //cek tipe gambar
    $tipeGambarYangValid =['jpg', 'jpeg', 'png'];

    $tipeGambar = explode('.', $namaGambar); //memecah string $namaGambar menjadi array berisi ['namanya', 'tipe']
    $tipeGambar = strtolower(end($tipeGambar)); //mengambil element terakhir dari array
    if (!in_array($tipeGambar, $tipeGambarYangValid)) {
        echo "<script>
                alert('Yang anda masukkan bukan gambar!');
            </script>
    ";
    }

    // cek ukuran
    if ($ukuranGambar > 1000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar!');
            </script>
            ";
            return false;
    }


    //Generate nama baru agar tidak ada nama yang sama
    $namaBaru=uniqid();
    $namaBaru .= '.';
    $namaBaru .= $tipeGambar;

    //Simpan
    move_uploaded_file($tmpName, '../img/'.$namaBaru);

    return $namaBaru .= $tipeGambar;

}



function hapus($id)
{
    global $connect_db;
    mysqli_query($connect_db, "DELETE FROM buku WHERE id =$id");

    return mysqli_affected_rows($connect_db);

}




function cari($keyword){
    $querynya = "SELECT FROM buku WHERE 
        nama_buku LIKE '%$keyword%'  OR
        harga LIKE '%$keyword%' OR     
    ";

    return query($querynya);
}

function registrasi($data){
    global $connect_db;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($connect_db, $data["password"]);
    $password2 = mysqli_real_escape_string($connect_db, $data["password2"]);

    //cek username
    $result_konfirmasi_username =mysqli_query($connect_db, "SELECT username FROM users WHERE username ='$username'");

    if(mysqli_fetch_assoc($result_konfirmasi_username) ) {
        echo "<script>
                alert('Username yang anda masukkan sudah ada');
            </script>
        ";
        return false;
    }

    //cek konfirmasi pasword
    if($password !== $password2){
        echo "<script>
                alert('Password yang dikonfirmasi berbeda dengan pasword');
            </script>
        ";
        return false;
    }

    $password =password_hash($password, PASSWORD_DEFAULT); //enkripsi password

    mysqli_query($connect_db, "INSERT INTO users VALUES('', '$username', '$password')");

    return mysqli_affected_rows($connect_db);

}


?>