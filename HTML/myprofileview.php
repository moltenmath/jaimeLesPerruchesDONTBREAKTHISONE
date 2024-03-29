<div class="container" style="margin-top:30px">
  <h1>My Profile</h1>
  <div class="row">

    <div class="col-sm-4">

      <div class="container align-middle border mb-sm-5">
        <h3>Update Infos</h3>
        <form method="post" action="./DOMAINLOGIC/updateinfo.dom.php">

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email"><br>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>

          <div class="form-group">
            <label for="username">username:</label>
            <input type="text" class="form-control" name="username" id="username"><br>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>

          <button class="btn btn-success mb-sm-3" type="submit">Update profile</button>
        </form>
      </div>


      <div class="container align-middle border mb-sm-5">
        <h3>Change Password</h3>
        <form method="post" action="./DOMAINLOGIC/updatepw.dom.php">

          <div class="form-group">
            <label for="pwd">password:</label>
            <input type="password" class="form-control" name="oldpw" id="oldpw" required><br>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>

          <div class="form-group">
            <label for="pwd">new password:</label>
            <input type="password" class="form-control" name="newpw" id="newpw" required><br>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>

          <div class="form-group">
            <label for="pwd">new password validation:</label>
            <input type="password" class="form-control" name="pwValidation" id="pwValidation" required><br>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>

          <button class="btn btn-success mb-sm-3" type="submit">Change Password</button>
        </form>
      </div>
      <!--Image-->
      <div class="container align-middle border mb-sm-5">
        <h3>Modifier image profile</h3>
        <form method="post" action="./DOMAINLOGIC/ModifierImageProfil.dom.php" enctype="multipart/form-data">

          <div class="form-group">
            <label for="newImg">new Image:</label>
            <input type="file" class="form-control" name="newImg" id="newImg" required><br>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>

          <button class="btn btn-success mb-sm-3" type="submit">Change image</button>
        </form>
      </div>

    </div>
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
    
      <div class="container align-middle border mb-sm-5 ml-sm-15">  
         <h3>Info profil</h3>  
          <?php
          //Afficher limage du profil du user courrent
           echo "Image du profil : <img  width='320' height='240' src='./MEDIA/PP/" . $_SESSION["userEmail"] .".jpg'> <br>";
           echo "Couriel : "."<br>".$_SESSION["userEmail"]."<br>";
           echo "Pseudo  : "."<br>".$_SESSION["userName"];
          ?>
      </div>
    </div>


  </div>