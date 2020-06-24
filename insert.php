  <?php include'header.php'; ?>

  <?php
  $mysqli=new mysqli('localhost','root','','phone');
    if($mysqli->connect_error){
    	printf("can not connect database %s\n",$mysqli->connect_error);
    	exit();
    }

    if(isset($_POST['submit'])){

    	 $name  = $_POST['name'];
       $monthly= $_POST['monthly'];
       $address = $_POST['address'];
       $access = $_POST['access'];
       $floor = $_POST['floor'];
       $utility= $_POST['utility'];
       $descrip= $_POST['descrip'];


       $target_dir="upload/";
       $target_file=$target_dir . basename($_FILES["images"]["name"]);
       $temp_file=$_FILES["images"]["name"];
       move_uploaded_file($_FILES["images"]["tmp_name"],$target_file);


    $query="INSERT INTO  shama (name,monthly,address,access,floor,utility,descrip,images) VALUES('$name','$monthly','$address','$access','$floor','$utility','$descrip','$temp_file')";
   $insert=$mysqli->query( $query);
   $last_id = $mysqli->insert_id;
   $c=count($_FILES['img']['name']);

   if($insert){

    if($c < 10){

      for ($i=0; $i <$c; $i++) {
          $img_name=$_FILES['img']['name'][$i];
          move_uploaded_file($_FILES['img']['tmp_name'][$i],"upload/" .$img_name);
          $query_multi="INSERT INTO details(images,period)VALUES('$img_name','$last_id')";
          $ins=$mysqli->query($query_multi);
          // else{

          //   echo "MAX LIMIT EXCEED";

          // }
    

        
      }



    }



  }




    }


    
  ?>


  <div class="container">
  	<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
  <fieldset>
      <legend>Add a Property</legend>
      
      <div class="form-group">
        <label for="InputEmail" class="col-lg-2 control-labl">Name of Property</label>
        <div class="col-lg-10">
        <input type="text"  name="name" class="form-control" placeholder="Name of Property">
      </div>
    </div>
      <div class="form-group">
      <label for="InputEmail" class="col-lg-2 control-labl">Monthly Charges</label>
        <div class="col-lg-10">
        <input type="text" class="form-control" name="monthly" placeholder="Monthly Charges">
      </div>

         <div class="form-group">
            <label for="InputEmail" class="col-lg-2 control-labl">Address</label>
        <div class="col-lg-10">
        <textarea class="form-control" name="address" rows="3"></textarea>
      </div>
      <div class="form-group">
         <label for="InputEmail" class="col-lg-2 control-labl">Access</label>
        <div class="col-lg-10">
        <input type="text" class="form-control" name="access" placeholder="Access">
      </div>
      <div class="form-group">
         <label for="InputEmail" class="col-lg-2 control-labl">Floor Space</label>
        <div class="col-lg-10">
        <input type="text" class="form-control" name="floor" placeholder="Floor">
      </div>
      <div class="form-group">
         <label for="InputEmail" class="col-lg-2 control-labl">Utility</label>
        <div class="col-lg-10">
        <input type="text" class="form-control" name="utility" placeholder="Utility">
      </div> 
      <div class="form-group">
            <label for="InputEmail" class="col-lg-2 control-labl">Description</label>
        <div class="col-lg-10">
        <textarea class="form-control" name="descrip" rows="3"></textarea>
      </div>
      <div class="form-group">
            <label for="InputEmail" class="col-lg-2 control-labl">Featured Images</label>
        <div class="col-lg-10">
        <input type="file" name="images">
      </div>
      </div>
      <div class="form-group">
            <label for="textarea" class="col-lg-2 control-labl">Room Images</label>
        <div class="col-lg-10">
        <input type="file" name="img[]"multiple>
      </div>
      </div>
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">

      <button type="reset" class="btn btn-danger">Cancel</button>
     <button type="submit" name="submit" class="btn btn-primary">Submit</button>
   </div>
  </div>
  </form>
  </div>
  <?php include 'footer.php';?>