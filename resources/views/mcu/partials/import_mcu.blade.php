<div class="modal fade" id="modal-import-mcu">
    <div class="modal-dialog modal-lg">
        <form action="/mcu/program-mcu/detail/import-excel-mcu" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="company_id" value="{{ $company_id }}">
            <input type="hidden" name="mcu_program_id" value="{{ $mcu_program_id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import Data MCU</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>File Excel MCU</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="import_file" id="customFile">
                            <label class="custom-file-label" for="customFile">File Excel</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function() {
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
