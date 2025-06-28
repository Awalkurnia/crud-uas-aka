@extends('layouts.app')

@section('content')
    <h3>Data Mahasiswa</h3>
    <button class="btn btn-success mb-3" id="btn-tambah">Tambah Mahasiswa</button>
    <table class="table table-bordered" id="table-mahasiswa">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Jurusan</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody> 
    </table>
<!-- Modal -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAddLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form id="formMahasiswa" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalAddLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <Input type="hidden" id="edit_nim">
            <div class="mb-2">
                <label for="">Nim</label>
                <input type="text" class="form-control" id="nim" placeholder="Masukan NIM">
            </div>
            <div class="mb-2">
                <label for="">Nama</label>
                <input type="text" class="form-control" id="nama" placeholder="Masukan Nama">
            </div>
            <div class="mb-2">
                <label for="">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="mb-2">
                <label for="">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tgl_lahir">
            </div>
            <div class="mb-2">
                <label for="">Jurusan</label>
                <select name="jurusan" id="jurusan" class="form-control">
                    <option value="">Pilih Jurusan</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="MI">Manajemen Informatika</option>
                    <option value="Hukum">Hukum</option>
                    <option value="Manajemen">Manajemen</option>
                    <option value="Teknik Mesin">Teknik Mesin</option>
                    <option value="Teknik Elektro">Teknik Elektro</option>
                    <option value="Teknik Sipil">Teknik Sipil</option>
                    <option value="Teknik Industri">Teknik Industri</option>
                    <option value="Akuntansi">Akuntansi</option>
                </select>
            </div>
            <div class="mb-2">
                <label for="">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukan Alamat"></textarea>
            </div>
        </Input>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-simpan">Save Data</button>
        <button type="button" class="btn btn-primary" id="btn-update">Edit Data</button>
      </div>
    </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $.ajax({
            url: "/api/mahasiswa",
            method: "GET",
            success: function(response) {
                const data = response.data;
                let rows = '';
                data.forEach(function(item) {
                    rows += `
                        <tr>
                            <td>${item.nim}</td>
                            <td>${item.nama}</td>
                            <td>${item.jk}</td>
                            <td>${item.tgl_lahir}</td>
                            <td>${item.jurusan}</td>
                            <td>${item.alamat}</td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-edit" data-id="${item.nim}">Edit</button>
                                <button type="submit" class="btn btn-danger btn-sm btn-delete" data-id="${item.nim}">Hapus</button>
                            </td>
                        </tr>`;
                });
                $('#table-mahasiswa tbody').html(rows);
                $('#table-mahasiswa').DataTable(); 
            },
            error: function() {
                alert("Gagal mengambil data mahasiswa.");
            }
        });

        $('#btn-tambah').click(function(){
            // alert('test');
           $('#ModalAddLabel').text('Tambah Mahasiswa');
            $('#ModalAdd').modal('show');
            $('#formMahasiswa')[0].reset();
            $('#btn-simpan').show();
            $('#btn-update').hide();
            $('#edit_nim').val('');
            $('#nim').prop('readonly', false);
        });

        function ambildataform(){
            return{
                nim: $('#nim').val(),
                nama: $('#nama').val(),
                jk: $('#jk').val(),
                tgl_lahir: $('#tgl_lahir').val(),
                jurusan: $('#jurusan').val(),
                alamat: $('#alamat').val(),
            };
        }

       $('#btn-simpan').click(function(){
        var data = ambildataform();
        $.ajax({
            url: '/api/mahasiswa',
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


       $('#table-mahasiswa').on('click', '.btn-edit', function(){
    var nim = $(this).data('id');
    $.ajax({
        url: '/api/mahasiswa/' + nim,
        type: 'GET',
        success: function(data){
            $('#ModalAddLabel').text('Edit Mahasiswa');
            $('#ModalAdd').modal('show');
            $('#nim').val(data.nim).prop('readonly', true);
            $('#nama').val(data.nama);
            $('#jk').val(data.jk);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jurusan').val(data.jurusan);
            $('#alamat').val(data.alamat);
            $('#btn-simpan').hide();
            $('#btn-update').show();
            $('#edit_nim').val(nim);
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});

    $('#btn-update').click(function() {
    var nim = $('#edit_nim').val();
    var data = ambildataform();

    $.ajax({
        url: '/api/mahasiswa/' + nim, 
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
$('#table-mahasiswa').on('click', '.btn-delete', function(){
    var nim = $(this).data('id');
    var konfirmasi= confirm('Are you sure?');

    if (!konfirmasi) { return; }
    $.ajax({
        url: '/api/mahasiswa/' + nim,
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
