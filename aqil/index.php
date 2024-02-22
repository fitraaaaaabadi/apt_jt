<?php
session_start();

// Cek apakah pengguna sudah submit form login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Lakukan query ke tabel login untuk memeriksa kredensial
  $sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
  $result = $conn->query($sql);

  // Jika hasil query mengembalikan satu baris, berarti login berhasil
  if ($result->num_rows == 1) {
      // Login berhasil, simpan informasi pengguna dalam sesi
      $_SESSION['username'] = $username;
      // Redirect ke halaman dashboard
      header("Location: dashboard.php");
      exit();
  } else {
      // Jika tidak, tampilkan pesan kesalahan
      $error = "Username atau password salah.";
  }
}

// Tutup koneksi ke basis data
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<form class="form card" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="card_header">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
            <path fill="none" d="M0 0h24v24H0z"></path>
            <path fill="currentColor" d="M4 15h2v5h12V4H6v5H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6zm6-4V8l5 4-5 4v-3H2v-2h8z"></path>
        </svg>
        <h1 class="form_heading">Sign in</h1>
    </div>
    <?php if(isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>
    <div class="field">
        <label for="username">Username</label>
        <input class="input" name="username" type="text" placeholder="Username" id="username" required>
    </div>
    <div class="field">
        <label for="password">Password</label>
        <input class="input" name="password" type="password" placeholder="Password" id="password" required>
    </div>
    <div class="field">
        <button class="button" type="submit">Login</button>
    </div>
</form>
</body>
</html>
