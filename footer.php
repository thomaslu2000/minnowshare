<br>
<hr>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script>
    $(function(){
//        $('.search_file_type').hide();
       $(".search_type").on('change', function() {
           if($(this).val()=='files'){
               $('.search_file_type').show();
           } else{
               $('.search_file_type').hide();
           }
        }); 
    });
</script>
<footer id="pagefooter";>
<div id="f-content">
<div id="credits">
<small class="sitecredit"> 2018. Created with Bootstrap.</small>
<br>
<br>
</div>
</div>
</footer>
</body>
</html>