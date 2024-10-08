<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Tambah Data Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullname">Nama Lengkap<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="user_alias" id="user_alias"
                                placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="form-group">
                            <label for="name">Username<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="user_name" id="user_name"
                                placeholder="Masukkan username">
                        </div>
                        <div class="form-group">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="user_mail" id="user_mail"
                                placeholder="Masukkan email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Role</label>
                            <select id="role_id" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="user_pass" id="user_pass"
                                placeholder="Masukkan password">
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm Password<span
                                    class="text-danger">*</span></label></label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" autocomplete="new-password"
                                placeholder="Masukkan confirm password">
                        </div>
                    </div>
                </div>
                <small class="form-text text-danger">*NB : <em><span class="text-danger">*</span> (field must be
                    filled)</em>
                </small>
            </div><!-- /.modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                    TUTUP</button>
                <button type="button" class="btn btn-success" id="save"><i class="fa fa-check"></i>
                    SIMPAN</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Script -->
<script src="{{ asset('style') }}/assets/js/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // button show modals
    $('body').on('click', '#btn-create-post', function() {
        //open modal
        $('#modal-create').modal('show');
    });

    // get roles
    $(document).ready(function() {
        var _token = $('meta[name="csrf-token"]').attr('content');
        $("#role_id").select2({
            dropdownParent: $('#modal-create'),
            placeholder: 'Pilih Roles',
            ajax: {
                url: "{{ route('getRoles') }}",
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        token: _token,
                        search: params.term // search term
                    };
                },
                processResults: function(response) {
                    console.log(response);
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });

    // action create post
    $('#save').click(function(e) {
        e.preventDefault();
        // define variable
        var token                = $('meta[name="csrf-token"]').attr('content');
        var user_alias           = $('#user_alias').val();
        var user_name            = $('#user_name').val();
        var role_id              = $('#role_id').val();
        var user_mail            = $('#user_mail').val();
        var user_pass            = $('#user_pass').val();
        var passwordConfirmation = $('#password-confirm').val();
        // ajax
        $.ajax({
            url: `users/store`,
            type: "POST",
            cache: false,
            data: {
                "user_alias": user_alias,
                "user_name": user_name,
                "role_id": role_id,
                "user_mail": user_mail,
                "user_pass": user_pass,
                "password_confirmation": passwordConfirmation,
                "_token": token
            },
            success: function(response) {
                // show success message
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

                // close modal
                $('#modal-create').modal('hide');
            },
            error: function(response) {
                if(response.status === 422) {
                    // Clear previous errors
                    $('.text-danger').remove();
                    $('input').removeClass('is-invalid');

                    // Show validation errors
                    $.each(response.responseJSON, function (key, value) {
                        var inputField = $('#' + key);

                        // Save original placeholder and value
                        var originalPlaceholder = inputField.attr('placeholder');
                        var originalValue = inputField.val();

                        // Display error as placeholder
                        inputField.val('');
                        inputField.addClass('is-invalid').attr('placeholder', value[0]).addClass('error-placeholder');

                        // Remove errors and reset placeholder after 3 seconds
                        setTimeout(function() {
                            inputField.removeClass('is-invalid error-placeholder');
                            inputField.attr('placeholder', originalPlaceholder).val(originalValue);
                        }, 2000); // 2000 ms = 2 seconds
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Cek kembali form anda!',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            }
        });
    });
</script>
