<div class="card mt-4" style="width:30rem; align:center; display:inline-block; border-color:black">


  <!-- UPLOAD IMAGES-->
  <form method="post" action="./DOMAINLOGIC/upload.dom.php" enctype="multipart/form-data">

    <div class="form-group">
      <label for="Name">Titre</label>
      <input type="Name" class="form-control" name="Name" id="Name" required />
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>

    <div class="form-group">
      <label for="Media">Media</label>
      <input type="file" class="form-control" name="Media" id="Media" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>

    <div class="form-group">
      <label>Description</label> <br>
      <textarea name="description" id="description" > </textarea>
    </div>

    <button class="btn btn-success" type="submit">Upload</button>

  </form>


    <!-- OLD CODE TO POST A COMMENT
  <form method="post" action="DOMAINLOGIC/createpost.dom.php">
    <input type="hidden" name="albumID" id="albumID" value="<?php // echo $_GET["albumID"] ?>" required>
    <input type="hidden" name="albumTitle" id="albumTitle" value="<?php // echo $_GET["albumTitle"] ?>" required>

    <div class="form-group">
      <textarea class="form-control" rows="5" name="content" id="content" placeholder="Got something to say, punk?" required></textarea>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>

    <div class="btn-group">
      <button class="btn btn-success btn-lg mb-4" type="submit">Post that stuff!</button>
      <button class="btn btn-warning btn-lg mb-4" type="reset">Actually, nevermind!</button>
    </div>


  </form>

-->
</div>