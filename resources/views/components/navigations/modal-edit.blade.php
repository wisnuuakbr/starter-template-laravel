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
                            <input type="text" name="name" class="form-control name" id="name"
                                placeholder="Type something" />
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                        </div>
                        <div class="form-group">
                            <label>URL<span class="text-danger">*</span></label>
                            <input type="text" name="url" class="form-control url" id="url"
                                placeholder="Type something" />
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-url"></div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" rows="5" class="form-control description" id="description"
                                placeholder="Type something"></textarea>
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-description"></div>
                        </div>
                        <small class="form-text">*NB : <em><span class="text-danger">*</span>
                                field must be filled</em>
                        </small>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" name="icon" class="form-control icon" id="icon"
                                placeholder="Type something" />
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-icon"></div>
                        </div>
                        <div class="form-group">
                            <label>Urutan</label>
                            <input type="number" name="sort" class="form-control sort" id="sort"
                                placeholder="Type something" />
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
{{-- script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                $('#nav_id').val(response.data.id);
                $('.name').val(response.data.name);
                $('.url').val(response.data.url);
                $('.icon').val(response.data.icon);
                $('.sort').val(response.data.sort);
                $('.description').val(response.data.description);
                $('.display_st').val(response.data.display_st).trigger('change');
                // Fetch the parent's name based on the parent_id
                var parentName = '';
                if (response.data.parent_id !== null) {
                    var parentItem = response.parent_items.find(function(item) {
                        return item.id === response.data.parent_id;
                    });

                    if (parentItem) {
                        parentName = parentItem.name;
                    }
                }
                // Update the Select2 dropdown options
                var $parentDropdown = $(".parent_id");
                $parentDropdown.empty();
                // Add the options to the Select2 dropdown
                $.each(response.parent_items, function(index, item) {
                    var option = new Option(item.name, item.id);
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
        var name = $('.name').val();
        var url = $('.url').val();
        var icon = $('.icon').val();
        var parent_id = $('.parent_id').val();
        var sort = $('.sort').val();
        var description = $('.description').val();
        var display_st = $('.display_st').val();

        // ajax
        $.ajax({
            url: `navigations/${nav_id}`,
            type: "PUT",
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
