

<div class="modal fade" id="student_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
      <div class="modal-content">
            <div class="alert-message">

            </div>
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="ajax_form" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="update" class="d-none">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control form-control-sm">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone No</label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-sm">
                        </div>
                        <div class="mb-3">
                            <label for="roll" class="form-label">Roll No</label>
                            <input type="number" name="roll" id="roll" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="reg" class="form-label">Registration No</label>
                            <input type="number" name="reg" id="reg" class="form-control form-control-sm">
                        </div>
                        <div class="mb-3" id="select_board">

                        </div>
                        <div class="mb-3">
                            <label for="session" class="form-label">Session</label>
                            <input type="text" name="session" id="session" class="form-control form-control-sm">
                        </div>
                        <div class="mb-3">
                            <label for="avater" class="form-label">Profile</label>
                            <input type="file" name="avater" id="avater" class="form-control form-control-sm">
                            <div id="pro_img"></div>
                        </div>
                    </div>
                </div>

        </div>
                <div class="modal-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" id="save-btn" class="btn btn-primary submit_btn"></button>
                </div>
           </form>
      </div>
    </div>
  </div>
