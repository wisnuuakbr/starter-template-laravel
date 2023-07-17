<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Tambah Data Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {{-- <input type="hidden" id="token" value="{{ csrf_token() }}"> --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required id="name"
                                placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" required id="email"
                                placeholder="Enter email">
                        </div>
                        <small class="form-text">*NB : <em><span class="text-danger">*</span> (field must be
                                filled)</em>
                        </small>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required id="password"
                                placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm Password<span
                                    class="text-danger">*</span></label></label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Enter confirm password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                        TUTUP</button>
                    <button type="button" class="btn btn-success" id="save"><i class="fa fa-check"></i>
                        SIMPAN</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
{{-- script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    //button create post event
    $('body').on('click', '#btn-create-post', function() {
        //open modal
        $('#modal-create').modal('show');
    });
    //action create post
    $('#save').click(function(e) {
        e.preventDefault();
        // define variable
        var token = $('meta[name="csrf-token"]').attr('content');
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var passwordConfirmation = $('#password-confirm').val();
        // ajax
        $.ajax({
            url: `users/store`,
            type: "POST",
            cache: false,
            data: {
                "name": name,
                "email": email,
                "password": password,
                "password_confirmation": passwordConfirmation,
                "_token": token
            },
            success: function(response) {
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'Success',
                    text: 'Data berhasil ditambah!',
                    showConfirmButton: false,
                    timer: 3000
                });
                setTimeout(function() { // wait for 1 secs(2)
                    location.reload(); // then reload the page.(3)
                }, 1000);

                //close modal
                $('#modal-create').modal('hide');
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
