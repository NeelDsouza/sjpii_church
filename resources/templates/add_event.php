  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Events</h1>

    <div class="row">

      <div class="col-lg-12">

        <!-- Circle Buttons -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Event</h6>
          </div>
          <div class="card-body">
          <div class="row">
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Event Details</h1>
              </div>
              <?php add_event();?>
              <form class="user" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="evname" id="" placeholder="Event Name">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="date" class="form-control form-control-user" name="evstartdate" id="" placeholder="Start Date">
                  </div>
                  <div class="col-sm-6">
                    <input type="date" class="form-control form-control-user" name="evenddate" id="" placeholder="End Date">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="evvenue" id="" placeholder="Venue">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="evorganiser" id="" placeholder="Organiser">
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="evshortdesc" id="" placeholder="Short Description in 100 words">
                </div>
                <div class="form-group">
                  <textarea class="form-control form-control-user" name="evbigdesc" aria-label="With textarea" placeholder="Detailed Description..."></textarea>
                </div>
                <div class="form-group custom-file">
                  <input type="file" class="form-control form-control-user custom-file-input" id="customFile" name="evposter" >
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
                <hr>
                <!-- <a href="index.php" class="btn btn-primary btn-user btn-block">
                  <i class="fas fa-calendar-plus"></i> &nbsp;&nbsp; Add an Event
                </a> -->
                <div class="form-group btn btn-primary btn-user btn-block">
                  <i class="fas fa-calendar-plus"></i>
                  <input type="submit" class="btn" style="color: white;" name="add_event" id="" value="Add Event">
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-5 d-none d-lg-block">
            <img id="preview" src="img/no-image.jpg" alt="Event Image Preview" style="width:100%; height:100%"/>
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

      <!-- <div class="col-lg-6">

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Split Buttons with Icon</h6>
          </div>
          <div class="card-body">
            <p>Works with any button colors, just use the <code>.btn-icon-split</code> class and the markup in the examples below. The examples below also use the <code>.text-white-50</code> helper class on the icons for additional styling, but it is not required.</p>
            <a href="#" class="btn btn-primary btn-icon-split">
              <span class="icon text-white-50">
                <i class="fas fa-flag"></i>
              </span>
              <span class="text">Split Button Primary</span>
            </a>
            <div class="my-2"></div>
            <a href="#" class="btn btn-success btn-icon-split">
              <span class="icon text-white-50">
                <i class="fas fa-check"></i>
              </span>
              <span class="text">Split Button Success</span>
            </a>
            <div class="my-2"></div>
            <a href="#" class="btn btn-info btn-icon-split">
              <span class="icon text-white-50">
                <i class="fas fa-info-circle"></i>
              </span>
              <span class="text">Split Button Info</span>
            </a>
            <div class="my-2"></div>
            <a href="#" class="btn btn-warning btn-icon-split">
              <span class="icon text-white-50">
                <i class="fas fa-exclamation-triangle"></i>
              </span>
              <span class="text">Split Button Warning</span>
            </a>
            <div class="my-2"></div>
            <a href="#" class="btn btn-danger btn-icon-split">
              <span class="icon text-white-50">
                <i class="fas fa-trash"></i>
              </span>
              <span class="text">Split Button Danger</span>
            </a>
            <div class="my-2"></div>
            <a href="#" class="btn btn-secondary btn-icon-split">
              <span class="icon text-white-50">
                <i class="fas fa-arrow-right"></i>
              </span>
              <span class="text">Split Button Secondary</span>
            </a>
            <div class="my-2"></div>
            <a href="#" class="btn btn-light btn-icon-split">
              <span class="icon text-gray-600">
                <i class="fas fa-arrow-right"></i>
              </span>
              <span class="text">Split Button Primary</span>
            </a>
            <div class="mb-4"></div>
            <p>Also works with small and large button classes!</p>
            <a href="#" class="btn btn-primary btn-icon-split btn-sm">
              <span class="icon text-white-50">
                <i class="fas fa-flag"></i>
              </span>
              <span class="text">Split Button Small</span>
            </a>
            <div class="my-2"></div>
            <a href="#" class="btn btn-primary btn-icon-split btn-lg">
              <span class="icon text-white-50">
                <i class="fas fa-flag"></i>
              </span>
              <span class="text">Split Button Large</span>
            </a>
          </div>
        </div>

      </div> -->

    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
