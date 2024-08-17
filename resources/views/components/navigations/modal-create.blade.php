<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Tambah Data Navigation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Menu<span class="text-danger">*</span></label>
                            <input type="text" name="nav_title" class="form-control" id="nav_title"
                                placeholder="Masukkan nama menu" />
                        </div>
                        <div class="form-group">
                            <label>URL<span class="text-danger">*</span></label>
                            <input type="text" name="nav_url" class="form-control" id="nav_url"
                                placeholder="Masukkan url menu" />
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="nav_desc" rows="5" class="form-control" id="nav_desc" placeholder="Masukkan description menu"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" name="nav_icon" class="form-control" id="nav_icon"
                                placeholder="Masukkan icon menu" />
                        </div>
                        <div class="form-group">
                            <label>Urutan</label>
                            <input type="number" name="nav_no" class="form-control" id="nav_no"
                                placeholder="Masukkan urutan menu" />
                        </div>
                        <div class="form-group">
                            <label>Ditampilkan</label>
                            <select id="display_st" class="form-control display_st">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Induk Menu</label>
                            <select id="parent_id" class="form-control parents_id">
                                <option value=""></option>
                            </select>
                        </div>
                    </div> <!-- /.modal-col -->
                </div> <!-- /.modal-row -->
                <small class="form-text text-danger">*NB : <em><span class="text-danger">*</span> (field must be
                    filled)</em>
                </small>
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
<!-- Script -->
<script src="{{ asset('style') }}/assets/js/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    //button create post event
    $('body').on('click', '#btn-create-post', function() {
        //open modal
        $('#modal-create').modal('show');
    });

    // select2 data parents
    $(document).ready(function() {
        var _token = $('meta[name="csrf-token"]').attr('content');
        $("#parent_id").select2({
            dropdownParent: $('#modal-create'),
            placeholder: 'Choose Parent',
            ajax: {
                url: "{{ route('getNavigations') }}",
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
                    // console.log(response);
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });


    //action create post
    $('#save').click(function(e) {
        e.preventDefault();
        var token = $('meta[name="csrf-token"]').attr('content');
        var nav_title = $('#nav_title').val();
        var nav_url = $('#nav_url').val();
        var nav_icon = $('#nav_icon').val();
        var parent_id = $('#parent_id').val();
        var nav_no = $('#nav_no').val();
        var nav_desc = $('#nav_desc').val();
        var display_st = $('.display_st').val();

        // ajax
        $.ajax({
            url: `navigations`,
            type: "POST",
            cache: false,
            data: {
                "nav_title": nav_title,
                "nav_url": nav_url,
                "nav_icon": nav_icon,
                "parent_id": parent_id,
                "nav_no": nav_no,
                "nav_desc": nav_desc,
                "display_st": display_st,
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
