  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Forms</h1>
    <p class="mb-4">Here you can manage any feedbacks, registrations or any form data using Google Forms. Create Google Forms from <a target="_blank" href="https://www.google.com/forms/about/">here</a>. Create a new form and click on Send button. Go to the Embed option in the last. Adjust the height and width and copy the iframe code in the below textbox</p>

    <div class="row">

      <div class="col-lg-12">

        <!-- Circle Buttons -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Form</h6>
          </div>
          <div class="card-body">
              <form class="user" action="" method="post" enctype="multipart/form-data">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Form Details</h1>
                </div>
                <?php get_all_forms();?>
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Add Form</h1>
                </div>
                <div class="form-group row">
                  <div class="col-sm-9 mb-2 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="title" id="formtitle" placeholder="Form Title">
                  </div>
                  <div class="col-sm-3 mb-1 mb-sm-0">
                    <button id="addFormButton" class="btn btn-success btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                      </span>
                      <span class="text">Add</span>
                    </button>
                  </div>
                </div>
                <div class="form-group">
                  <textarea class="form-control form-control-user" name="src" id="formsrc" aria-label="With textarea" placeholder="Google Form iframe code"></textarea>
                </div>
                
              </form>
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
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
