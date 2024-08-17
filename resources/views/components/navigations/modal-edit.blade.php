<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit Data Navigation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
                <input type="hidden" id="nav_id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Menu<span class="text-danger">*</span></label>
                            <input type="text" name="nav_title" class="form-control nav_title" id="nav_title"
                                placeholder="Masukkan nama menu" />
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                        </div>
                        <div class="form-group">
                            <label>URL<span class="text-danger">*</span></label>
                            <input type="text" name="nav_url" class="form-control nav_url" id="nav_url"
                                placeholder="Masukkan menu" />
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-url"></div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="nav_desc" rows="5" class="form-control nav_desc" id="nav_desc"
                                placeholder="Masukkan menu"></textarea>
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-description"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" name="nav_icon" class="form-control nav_icon" id="nav_icon"
                                placeholder="Masukkan menu" />
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-icon"></div>
                        </div>
                        <div class="form-group">
                            <label>Urutan</label>
                            <input type="number" name="nav_no" class="form-control nav_no" id="nav_no"
                                placeholder="Masukkan menu" />
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-icon"></div>
                        </div>
                        <div class="form-group">
                            <label>Ditampilkan</label>
                            <select id="display_st" class="form-control display_st">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-parent"></div>
                        </div>
                        <div class="form-group">
                            <label>Induk Menu</label>
                            <select id="parent_id" class="form-control parent_id">
                                <option value=""></option>
                            </select>
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-parent"></div>
                        </div>
                    </div>
                </div>
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
    // select2
    $(document).ready(function() {
        // select display_st
        $('.display_st').select2();

        // select parents
        var _token = $('meta[name="csrf-token"]').attr('content');
        $(".parent_id").select2({
            placeholder: 'Choose Parent',
            dropdownParent: $('#modal-edit'),
            allowClear: true,
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
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });

    // fetch data
    $('body').on('click', '#btn-edit-post', function() {
        var nav_id = $(this).data('id');
        //fetch detail post with ajax
        $.ajax({
            url: `navigations/${nav_id}`,
            type: "GET",
            cache: false,
            success: function(response) {
                // console.log(response);
                //fill data to form
                $('#nav_id').val(response.data.nav_id);
                $('.nav_title').val(response.data.nav_title);
                $('.nav_url').val(response.data.nav_url);
                $('.nav_icon').val(response.data.nav_icon);
                $('.nav_no').val(response.data.nav_no);
                $('.nav_desc').val(response.data.nav_desc);
                $('.display_st').val(response.data.display_st).trigger('change');
                // Fetch the parent's name based on the parent_id
                var parentName = '';
                if (response.data.parent_id !== null) {
                    var parentItem = response.parent_items.find(function(item) {
                        return item.nav_id === response.data.parent_id;
                    });

                    if (parentItem) {
                        parentName = parentItem.nav_title;
                    }
                }
                // Update the Select2 dropdown options
                var $parentDropdown = $(".parent_id");
                $parentDropdown.empty();
                // Add the options to the Select2 dropdown
                $.each(response.parent_items, function(index, item) {
                    var option = new Option(item.nav_title, item.nav_id);
                    $parentDropdown.append(option);
                });
                // Set the selected value of the Select2 dropdown
                $parentDropdown.val(response.data.parent_id).trigger('change');
                //open modal
                $('#modal-edit').modal('show');
            }
        });
    });

    //action update
    $('#update').click(function(e) {
        e.preventDefault();
        // define variable
        var token = document.getElementById('token').value;
        var nav_id = $('#nav_id').val();
        var nav_title = $('.nav_title').val();
        var nav_url = $('.nav_url').val();
        var nav_icon = $('.nav_icon').val();
        var parent_id = $('.parent_id').val();
        var nav_no = $('.nav_no').val();
        var nav_desc = $('.nav_desc').val();
        var display_st = $('.display_st').select2('data')[0].id;

        // ajax
        $.ajax({
            url: `navigations/${nav_id}`,
            type: "PUT",
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
