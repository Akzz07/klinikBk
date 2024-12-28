<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="login.css">
   
</head>
<body>
   
    <div class="container" id="signup" style="display:none;">
      <h1 class="form-title">Register Pasien</h1>
      <form method="post" action="registerpas.php">
        <div class="input-group">
           <i class="fas fa-id-badge"></i>
           <input type="text" name="id" id="id" placeholder="id" required>
           <label for="fname">id</label>
        </div>
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="nama" id="nama" placeholder="Masukan Nama" required>
            <label for="nama">Nama</label>
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="text" name="alamat" id="alamat" placeholder="alamat" required>
            <label for="alamat">alamat</label>
        </div>
        <div class="input-group">
            <i class="fas fa-phone-alt"></i>
            <input type="text" name="no_ktp" id="no_ktp" placeholder="masukan no ktp" required>
            <label for="no_ktp">no_ktp</label>
        </div>
        <div class="input-group">
            <i class="fas fa-phone-alt"></i>
            <input type="text" name="no_hp" id="no_hp" placeholder="masukan no hp" required>
            <label for="no_hp">no_hp</label>
        </div>
        <!-- <div class="input-group">
            <i class="fas fa-clinic-medical"></i>
            <input type="text" name="no_rm" id="no_rm" placeholder="No Rm" required>
            <label for="no_rm">no_rm</label>
        </div> -->
       <input type="submit" class="btn" value="Sign Up" name="signUp">
      </form>
      
      <div class="links">
        <p>Already Have Account ?</p>
        <button id="signInButton">Sign In</button>
      </div>
    </div>

    <div class="container" id="signIn">
        <h1 class="form-title">Sign In Pasien</h1>
        <form method="post" action="registerpas.php">
          <div class="input-group">
              <i class="fas fa-envelope"></i>
              <input type="text" name="id" id="id" placeholder="masukan id" required>
              <label for="id">id</label>
          </div>
          <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password" required>
              <label for="password">Password</label>
          </div>
          <p class="recover">
            <a href="#">Recover Password</a>
          </p>
         <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        
        <div class="links">
          <p>Don't have account yet?</p>
          <button id="signUpButton">Sign Up</button>
        </div>
      </div>
      <script src="script.js"></script>
</body>
</html>
