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
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Type something" />
                        </div>
                        <div class="form-group">
                            <label>URL<span class="text-danger">*</span></label>
                            <input type="text" name="url" class="form-control" id="url"
                                placeholder="Type something" />
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" rows="5" class="form-control" id="description" placeholder="Type something"></textarea>
                        </div>
                        <small class="form-text">*NB : <em><span class="text-danger">*</span> (field must be
                                filled)</em>
                        </small>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" name="icon" class="form-control" id="icon"
                                placeholder="Type something" />
                        </div>
                        <div class="form-group">
                            <label>Urutan</label>
                            <input type="number" name="sort" class="form-control" id="sort"
                                placeholder="Type something" />
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
{{-- script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
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

    //button create post event
    $('body').on('click', '#btn-create-post', function() {
        //open modal
        $('#modal-create').modal('show');
    });
    //action create post
    $('#save').click(function(e) {
        e.preventDefault();
        // define variable
        // var token = document.getElementById('token').value;
        var token = $('meta[name="csrf-token"]').attr('content');
        var name = $('#name').val();
        var url = $('#url').val();
        var icon = $('#icon').val();
        var parent_id = $('#parent_id').val();
        var sort = $('#sort').val();
        var description = $('#description').val();
        var display_st = $('.display_st').val();

        // ajax
        $.ajax({
            url: `navigations`,
            type: "POST",
            cache: false,
            data: {
                "name": name,
                "url": url,
                "icon": icon,
                "parent_id": parent_id,
                "sort": sort,
                "description": description,
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

                //clear form if not reload
                // $('#name').val('');
                // $('#url').val('');
                // $('#icon').val('');

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
