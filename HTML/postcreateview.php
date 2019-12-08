<div class="container">

  <form method = "post" action = "DOMAINLOGIC/createpost.dom.php">
    <input type="hidden" name="albumID" id="albumID" value="<?php echo $_GET["albumID"] ?>" required>
    <input type="hidden" name="albumTitle" id="albumTitle" value="<?php echo $_GET["albumTitle"] ?>" required>

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

</div>
