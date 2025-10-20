<html>
<head>
<title>Form Registrasi Mahasiswa Baru</title>
</head>
<body>
<h1>Form Registrasi Mahasiswa Baru</h1>
<hr>
<form action="proc_registrasi.php" method="post">
<pre>
Nama Lengkap     : <input type="text" name="nama" size="30" maxlength="50">

Jenis Kelamin    :
<input type="radio" name="jk" value="Laki-laki"> Laki-laki
<input type="radio" name="jk" value="Perempuan"> Perempuan

Program Studi    :
<select name="prodi">
<option value="Teknik Informatika">Teknik Informatika</option>
<option value="Teknik Mesin">Teknik Mesin</option>
</select>

Alamat           :<textarea name="alamat" cols="40" rows="4"></textarea>

<input type="submit" value="Daftar">
<input type="reset" value="Batal">
</pre>
</form>
</body>
</html>