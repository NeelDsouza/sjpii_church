  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Gallary</h1>
    <p class="mb-4">Here you can manage all the images that will shown in the <a target="_blank" href="../photos.php">website's photo</a> section.</p>

    <div class="row">

      <div class="col-lg-12">

        <!-- Circle Buttons -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Image</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group custom-file" style="display: flex;">
                <div class="col-sm-10 mb-6 mb-sm-3">
                  <input type="file" class="form-control form-control-user custom-file-input" id="addImageFile">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
                <div class="col-sm-2 mb-6 mb-sm-3">              
                <button id="addImageButton" class="btn btn-success btn-icon-split">
                  <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                  </span>
                  <span class="text">Add Image</span>
                </button>
              </div>
            </div>
            <div class="row" style="width:100%;margin: 0;padding: 0.5%;">
              <?php get_all_images_in_admin();?>
              
            </div>
          </div>
        </div>
      </div>

      </div>

      
      <!-- Delete Modal -->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content bg-gradient-danger">
            <div class="modal-header">
              <h5 class="modal-title text-white" id="deleteModalLabel">Delete</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-white">
              Are you sure you want to permanently delete this?
            </div>
            <div class="modal-footer">
              <input type="text" value="" id="imageidDeleteModal" hidden/>
              <button type="button" class="btn btn-link text-white" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-white ml-auto" onclick="window.location.assign('index.php?delete_image_id=' + $('#imageidDeleteModal').val());">Yes, Delete it!</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Delete Modal Ends -->
      
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
