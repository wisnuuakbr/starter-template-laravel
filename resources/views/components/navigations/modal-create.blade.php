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
                <div class="form-group">
                    <label>Nama Menu</label>
                    <input type="text" name="name" class="form-control" id="name"
                        placeholder="Type something" />
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                </div>
                <div class="form-group">
                    <label>URL</label>
                    <input type="text" name="url" class="form-control" id="url"
                        placeholder="Type something" />
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-url"></div>
                </div>
                <div class="form-group">
                    <label>Icon</label>
                    <input type="text" name="icon" class="form-control" id="icon"
                        placeholder="Type something" />
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-icon"></div>
                </div>
                <div class="form-group">
                    <label>Parent</label>
                    <select id="parent_id" class="form-control parents_id">
                        <option value=""></option>
                    </select>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-parent"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="save">SIMPAN</button>
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
        let name = $('#name').val();
        let url = $('#url').val();
        let icon = $('#icon').val();
        let parent_id = $('#parent_id').val();

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
