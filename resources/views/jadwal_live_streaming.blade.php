@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-broadcast mr-2"></i>Jadwal Live Streaming</h4>
                    <button class="btn btn-light btn-sm fw-bold" id="btn-tambah"><i class="bi bi-plus-circle mr-1"></i>Tambah Jadwal</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle" id="table-jadwal">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">ID Live</th>
                                    <th>Nama Acara</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Jam</th>
                                    <th class="text-center">Platform</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAddLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form id="formJadwal" class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="ModalAddLabel"><i class="bi bi-broadcast"></i> <span>Tambah Jadwal Live Streaming</span></h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit_id_live">
            <div class="form-group mb-3">
                <label for="nama_acara" class="font-weight-bold">Nama Acara</label>
                <input type="text" class="form-control" id="nama_acara" placeholder="Masukan Nama Acara">
            </div>
            <div class="form-row mb-3">
                <div class="col-md-6 mb-2 mb-md-0">
                    <label for="tanggal" class="font-weight-bold">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal">
                </div>
                <div class="col-md-6">
                    <label for="jam" class="font-weight-bold">Jam</label>
                    <input type="time" class="form-control" id="jam">
                </div>
            </div>
            <div class="form-group mb-2">
                <label for="platform" class="font-weight-bold">Platform</label>
                <input type="text" class="form-control" id="platform" placeholder="Masukan Platform (misal: YouTube, Zoom, IG Live)">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
        <button type="button" class="btn btn-success" id="btn-simpan"><i class="bi bi-save"></i> Simpan</button>
        <button type="button" class="btn btn-success" id="btn-update"><i class="bi bi-pencil-square"></i> Update</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<!-- DataTables Buttons & dependencies -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<script>
    $(document).ready(function () {
        $.ajax({
            url: "/api/jadwal-live-streaming",
            method: "GET",
            success: function(response) {
                const data = response.data;
                let rows = '';
                data.forEach(function(item) {
                    let badge = '<span class="badge badge-info">'+item.platform+'</span>';
                    if(item.platform.toLowerCase().includes('youtube')) badge = '<span class="badge badge-danger"><i class="bi bi-youtube"></i> YouTube</span>';
                    else if(item.platform.toLowerCase().includes('zoom')) badge = '<span class="badge badge-primary"><i class="bi bi-camera-video"></i> Zoom</span>';
                    else if(item.platform.toLowerCase().includes('ig')) badge = '<span class="badge badge-pink" style="background:#e1306c"><i class="bi bi-instagram"></i> IG Live</span>';
                    rows += `
                        <tr>
                            <td class="text-center">${item.id_live}</td>
                            <td><span class="font-weight-bold">${item.nama_acara}</span></td>
                            <td class="text-center">${item.tanggal}</td>
                            <td class="text-center">${item.jam}</td>
                            <td class="text-center">${badge}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm btn-edit mr-1" data-id="${item.id_live}" title="Edit Jadwal"><i class="bi bi-pencil-square"></i></button>
                                <button type="submit" class="btn btn-danger btn-sm btn-delete" data-id="${item.id_live}" title="Hapus Jadwal"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>`;
                });
                $('#table-jadwal tbody').html(rows);
                $('#table-jadwal').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                            className: 'btn btn-success btn-sm',
                            exportOptions: {
                                columns: [0,1,2,3,4]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                            className: 'btn btn-danger btn-sm',
                            exportOptions: {
                                columns: [0,1,2,3,4]
                            },
                            orientation: 'landscape',
                            pageSize: 'A4',
                            title: 'Jadwal Live Streaming'
                        },
                        'colvis'
                    ],
                    columnDefs: [
                        { orderable: false, targets: 5 }
                    ]
                });
            },
            error: function() {
                alert("Gagal mengambil data jadwal.");
            }
        });

        $('#btn-tambah').click(function(){
            $('#ModalAdd').modal('show');
            $('#formJadwal')[0].reset();
            $('#btn-simpan').show();
            $('#btn-update').hide();
            $('#edit_id_live').val('');
            $('#ModalAddLabel span').text('Tambah Jadwal Live Streaming');
        });

        function ambildataform(){
            return{
                nama_acara: $('#nama_acara').val(),
                tanggal: $('#tanggal').val(),
                jam: $('#jam').val(),
                platform: $('#platform').val(),
            };
        }

        $('#btn-simpan').click(function(){
            var data = ambildataform();
            $.ajax({
                url: '/api/jadwal-live-streaming',
                type: 'POST',
                data: data,
                success: function(response) {
                    $('#ModalAdd').modal('hide');
                    location.reload(); 
                    alert('Data Berhasil disimpan');
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

        $('#table-jadwal').on('click', '.btn-edit', function(){
            var id = $(this).data('id');
            $.ajax({
                url: '/api/jadwal-live-streaming/' + id,
                type: 'GET',
                success: function(data){
                    $('#ModalAddLabel span').text('Edit Jadwal Live Streaming');
                    $('#ModalAdd').modal('show');
                    $('#nama_acara').val(data.nama_acara);
                    $('#tanggal').val(data.tanggal);
                    $('#jam').val(data.jam);
                    $('#platform').val(data.platform);
                    $('#btn-simpan').hide();
                    $('#btn-update').show();
                    $('#edit_id_live').val(id);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

        $('#btn-update').click(function() {
            var id = $('#edit_id_live').val();
            var data = ambildataform();
            $.ajax({
                url: '/api/jadwal-live-streaming/' + id, 
                type: 'PUT',
                data: data,
                success: function(response) {
                    $('#ModalAdd').modal('hide');
                    location.reload(); 
                    alert('Data Berhasil diupdate');
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

        $('#table-jadwal').on('click', '.btn-delete', function(){
            var id = $(this).data('id');
            var konfirmasi= confirm('Yakin ingin menghapus data ini?');
            if (!konfirmasi) { return; }
            $.ajax({
                url: '/api/jadwal-live-streaming/' + id,
                type: 'DELETE',
                success: function(response) {
                    alert('Data Berhasil Dihapus!');
                    location.reload();
                }
            });    
        });
    });
</script>
@endsection 