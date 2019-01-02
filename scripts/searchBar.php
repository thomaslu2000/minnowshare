<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
   <div class="form-group mr-2">
        <select class="form-control custom-select custom-select-sm search_file_type" name="file_type" id="search_file_type">
          <option value="public">Public Files</option>
          <option value="private" <?php if(!$logged_in) echo 'disabled';?>>Private Files</option> 
          <option value="friends" <?php if(!$logged_in) echo 'disabled';?>>Friends' Files</option>
        </select>
    </div>
    <div class="form-group mr-3">
        <select class="form-control-xs custom-select custom-select-sm search_type" name="search_type" id="search_type">
          <option value="users">Search Usernames</option>
          <option value="files">Search File Titles</option>
        </select>
    </div>
  <input class="form-control-xs mr-sm-2" type="search" name="q" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
</form>