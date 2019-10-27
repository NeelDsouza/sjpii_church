        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Events</h1>
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All Events</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Event Name</th>
                      <th>Start date</th>
                      <th>End date</th>
                      <th>Poster</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php get_all_events();?>
                    
                  </tbody>
                </table>
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
                  <input type="text" value="" id="eventidDeleteModal" hidden/>
                  <button type="button" class="btn btn-link text-white" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-white ml-auto" onclick="window.location.assign('index.php?delete_event_id=' + $('#eventidDeleteModal').val());">Yes, Delete it!</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Delete Modal Ends -->

        </div>
        <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->