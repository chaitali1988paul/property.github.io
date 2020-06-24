	<?php include'header.php'; ?>

	<?php
	$mysqli=new mysqli('localhost','root','','phone');
	  if($mysqli->connect_error){
	  	printf("can not connect database %s\n",$mysqli->connect_error);
	  	exit();
	  }
	  if(isset($_GET['posts'])){

	  	$id=$_GET['posts'];
	  	$query2="SELECT * FROM shama where id=$id";
	  	$show=$mysqli->query($query2);
	  }

	?>
	<div class="container">
		
		<table class="table table-hover">
	  <thead>
	    <tr>
	      
	      <th>Address</th>
	      <th>Access</th>
	      <th>Floor Space</th>
	      <th>Utility</th>
	      <th>Description</th>
	      <th>Rooms</th>
	    </tr>
	  </thead>
      <tbody>
      	<?php while ($row= $show ->fetch_assoc() ) { ?>
      	<tr>

	      <td><?php echo $row['address']?></td>
	      <td><?php echo $row['access']?></td>
	      <td><?php echo $row['floor']?></td>
	      <td><?php echo $row['utility']?></td>
	      <td><?php echo $row['descrip']?></td>
	      <td><?php

	         $images_name="SELECT * FROM

                               shama as p
	                          join details  as d
	                          on p.id =d.period where d.period =".$row['id'];
	                          $read1=$mysqli->query($images_name);

	                          foreach ( $read1 as $value) { ?>
	                          
	                          <img src="upload/<?php echo  $value['images'];?>">
	                        <?php  }   ?>
	    
	   <?php       	}  ?>  	
</td>
</tr>
	    
   </tbody>
	</table>
	</div>
	<?php include'footer.php'; ?>



