<?php include("header.php"); ?>


<br>
<fieldset align=center style="width: calc(250px + 30vw); margin:auto;">
   <div class="jumbotron" align=center>
        <h1>Upload</h1>
    </div>
    <form action=".\scripts\uploadFile.php" method="post" enctype="multipart/form-data">
       
<!--       file-->
        <div class="form-group">
            <label for="file1">Upload File [max size 500mb]</label>
            <input type="file" class="form-control-file" name='file' id="file1" required>
          </div>
          
<!--          title-->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name='title' class="form-control" id="title" placeholder="Enter Title" maxlength="40" required>
        </div>
    
        <!--          short description-->
        <div class="form-group">
            <label for="short">Short Description [optional]</label>
            <textarea name='short' class="form-control" id="short" rows="2" placeholder="Enter Short Description" maxlength="255"></textarea>
        </div>    
         
<!--         description-->
         <div class="form-group">
            <label for="description">Description [optional]</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description"></textarea>
          </div>
          
         <!--        sharing-->
        <div class="form-group">
           <label for="sharetype">Who can access the file?</label>
            <select class="form-control" name="sharetype" id="sharetype">
              <option value="private">Just Me</option>
              <option value="friends all">All My Friends</option>
              <option value="friends">Chosen Friends</option>
              <option value="public">Anyone Can Access</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="file2">Photo for file [optional]</label>
            <input type="file" class="form-control-file" name='photo' id="file2">
          </div>
      <input type="hidden" name="submitted" value="True">
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</fieldset>

<?php include("footer.php"); ?>