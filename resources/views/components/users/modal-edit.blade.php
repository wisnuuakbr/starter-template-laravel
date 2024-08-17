<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit Data Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
                <input type="hidden" id="user_id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama<span class="text-danger">*</span></label>
                            <input type="text" name="user_name" class="form-control user_name"
                                placeholder="Masukkan nama" />
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                        </div>
                        <div class="form-group">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="text" name="user_mail" class="form-control icon user_mail"
                                placeholder="Masukkan email" />
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-icon"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control user_pass" name="user_pass"
                                placeholder="Masukkan password">
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label></label>
                            <input type="password" class="form-control password-confirm"
                                name="password_confirmation" autocomplete="new-password"
                                placeholder="Masukkan password konfirmasi">
                        </div>
                    </div>
                </div><!-- /.modal-body -->
                <small class="form-text text-danger">*NB : <em><span class="text-danger">*</span> (field must be
                    filled)</em>
                </small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                    TUTUP</button>
                <button type="button" class="btn btn-success" id="update"><i class="fa fa-check"></i>
                    SIMPAN</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Script -->
<script src="{{ asset('style') }}/assets/js/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    // fetch data
    $('body').on('click', '#btn-edit-post', function() {
        var user_id = $(this).data('id');
        //fetch detail post with ajax
        $.ajax({
            url: `users/show/${user_id}`,
            type: "GET",
            cache: false,
            success: function(response) {
                //open modal
                $('#modal-edit').modal('show');
                //fill data to form
                $('#user_id').val(response.data.user_id);
                $('.user_name').val(response.data.user_name);
                $('.user_mail').val(response.data.user_mail);
            }
        });
    });

    //action update
    $('#update').click(function(e) {
        e.preventDefault();
        // define variable
        var token = document.getElementById('token').value;
        var user_id = $('#user_id').val();
        var user_name = $('.user_name').val();
        var user_mail = $('.user_mail').val();
        var user_pass = $('.user_pass').val();
        // var passwordConfirmation = $('.password-confirm').val();
        // ajax
        $.ajax({
            url: `users/update/${user_id}`,
            type: "PUT",
            cache: false,
            data: {
                "user_name": user_name,
                "user_mail": user_mail,
                "user_pass": user_pass,
                // "password_confirmation": passwordConfirmation,
                "_token": token
            },
            success: function(response) {
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'Success',
                    text: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                setTimeout(function() { // wait for 1 secs(2)
                    location.reload(); // then reload the page.(3)
                }, 1000);

                //close modal
                $('#modal-edit').modal('hide');
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Cek kembali form anda!',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        });
    });
</script>
