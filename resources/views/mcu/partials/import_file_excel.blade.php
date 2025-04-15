<div class="modal fade" id="modal-upload-rekap">
    <div class="modal-dialog modal-lg">
        <form action="/mcu/program-mcu/detail/import-excel-anamnesa" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="company_id" value="{{ $company_id }}">
            <input type="hidden" name="mcu_program_id" value="{{ $mcu_program_id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import Pemeriksaan MCU</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis Pemeriksaan</label>
                        <select class="form-control select2 selectJenisPemeriksaan" name="examination_type" style="width: 100%;">
                            <option selected="selected" value="">- Pilih Jenis Pemeriksaan -</option>
                            @foreach ($examination_type as $e)
                                <option value="{{ $e->examination_type_id }}">
                                    {{ $e->examination_type_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
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
        $('.selectJenisPemeriksaan').select2();
        $('.selectJenisPemeriksaan').select2().on('change', function() {
            console.log($(this).val());
        });


        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $('#tglMcuImport').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            icons: { time: 'far fa-clock' }
        });
    });
</script>
