        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Notices</h1>
          <p class="mb-4">Add all the notices for the week here that will be displayed on the homepage till the End Date.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Notices</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Notice</th>
                      <th>End Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <!-- <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
                    </tr>
                  </tfoot> -->
                  <tbody>
                    <form class="" action="" method="post" enctype="multipart/form-data">
                    <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="notice" id="noticeInput" placeholder="Notice">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="date" class="form-control form-control-user" name="expdate" id="expdateInput" placeholder="End Date">
                        </div>
                    </td>
                    <td>
                        <button id="addNoticeButton" class="btn btn-success btn-sm btn-icon-split">
                            <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Add</span>
                        </button>
                    </td>
                    </tr>
                    <?php get_all_notices();?>
                    </form>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->