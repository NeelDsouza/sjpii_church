  <!-- Begin Page Content -->
  <div class="container-fluid">
  <?php 
  if(isset($_GET['eventid'])) {
    $query = query("SELECT * FROM events WHERE eventid = " . escape_string($_GET['eventid']) . " ");
    confirm($query);
    $rows = mysqli_num_rows($query);
    if($rows>0){
    while($row = fetch_array($query)) {
      $evname = escape_string($row['evname']);
      $evshortdesc = escape_string($row['evshortdesc']);
      $evbigdesc = escape_string($row['evbigdesc']);
      $evstartdate = escape_string($row['evstartdate']);
      $evenddate = escape_string($row['evenddate']);
      $evvenue = escape_string($row['evvenue']);
      $evorganiser = escape_string($row['evorganiser']);
      $evposter = escape_string($row['evposter']);
    edit_event(escape_string($_GET['eventid']));
    }
    } else
    echo "<script> window.location.assign('404.html'); </script>";   
  } else
    echo "<script> window.location.assign('404.html'); </script>";  

  ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Events</h1>

    <div class="row">

      <div class="col-lg-12">

        <!-- Circle Buttons -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Event</h6>
          </div>
          <div class="card-body">
          <div class="row">
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Event Details</h1>
              </div>
              <form class="user" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="evname" value="<?php echo $evname?>" placeholder="Event Name">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="date" class="form-control form-control-user" name="evstartdate" value="<?php echo $evstartdate?>" placeholder="Start Date">
                  </div>
                  <div class="col-sm-6">
                    <input type="date" class="form-control form-control-user" name="evenddate" value="<?php echo $evenddate?>" placeholder="End Date">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="evvenue" value="<?php echo $evvenue?>" placeholder="Venue">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="evorganiser" value="<?php echo $evorganiser?>" placeholder="Organiser">
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="evshortdesc" value="<?php echo $evshortdesc?>" placeholder="Short Description in 100 words">
                </div>
                <div class="form-group">
                  <textarea class="form-control form-control-user" name="evbigdesc" aria-label="With textarea" placeholder="Detailed Description..."><?php echo $evbigdesc?></textarea>
                </div>
                <div class="form-group custom-file">
                  <input type="file" class="form-control form-control-user custom-file-input" id="customFile" name="evposter" >
                  <label class="custom-file-label" for="customFile"><?php echo $evposter?></label>
                </div>
                <hr>
                <!-- <a href="index.php" class="btn btn-primary btn-user btn-block">
                  <i class="fas fa-calendar-plus"></i> &nbsp;&nbsp; Add an Event
                </a> -->
                <div class="form-group btn btn-primary btn-user btn-block">
                  <i class="fas fa-calendar-plus"></i>
                  <input type="submit" class="btn" style="color: white;" name="edit_event" id="" value="Edit Event">
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-5 d-none d-lg-block">
            <img id="preview" src="../../resources/uploads/<?php echo $evposter?>" alt="Event Image Preview" style="width:100%; height:100%"/>
          </div>
        </div>
          </div>
        </div>

        <!-- Brand Buttons -->
        <!-- <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Brand Buttons</h6>
          </div>
          <div class="card-body">
            <p>Google and Facebook buttons are available featuring each company's respective brand color. They are used on the user login and registration pages.</p>
            <p>You can create more custom buttons by adding a new color variable in the <code>_variables.scss</code> file and then using the Bootstrap button variant mixin to create a new style, as demonstrated in the <code>_buttons.scss</code> file.</p>
            <a href="#" class="btn btn-google btn-block"><i class="fab fa-google fa-fw"></i> .btn-google</a>
            <a href="#" class="btn btn-facebook btn-block"><i class="fab fa-facebook-f fa-fw"></i> .btn-facebook</a>

          </div>
        </div> -->

      </div>

    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
