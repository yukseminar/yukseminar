
<!-- Akhir jumbotron -->
<section class="batas-section" style="background: #edf5ff; position: relative;">
	<!-- Container -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card border-top-yukseminar shadow mb-4">
					<div class="card-header">
           
              <div class="row">
                <div class="col-lg-12">
                  <h4 class="m-0" style="font-weight: 600;"><b>Daftar Peserta</b></h4>
                </div>
              </div>
            
          </div>
					<div class="card-body">
						<!-- TABEL BARU -->
		<div class="table-wrapper">
	
		            <input type="hidden" name="" readonly="" id="id_seminar" value="<?= $dataseminar['id_seminar'] ?>">

		    <table id="listPeserta" class="table table-striped">
		    	<thead>
		    	<tr>
		            <th>#</th>
		            <th>Nim</th>
					<th>Nama Peserta</th>
					<th>No. HP</th>
					<th>Universitas</th>
					<th>Jurusan</th>
		            <th>Status</th>
					<th>Hadir</th>
		         </tr>
		         </thead>
		        <tbody id="barisData">
		         </tbody>
		         
		    </table>
		

		</div>
		<!-- AKHIR TABEL BARU -->
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<!-- Akhir container -->
	<script type="text/javascript">
		//AJAX DAFTAR PESERTA
	$(document).ready( function () {
	
	
		readAllPeserta();

		$('#listPeserta').dataTable()

		
	
	

	});
	var base_url = "<?= base_url(); ?>";
	var id_seminar = $('#id_seminar').val();

	function readAllPeserta(){
		var dataHandler = $('#barisData');
	    dataHandler.html("");
	    
	    $.ajax({
	      type: 'post',
	      data: "id_seminar="+id_seminar,
	      url: base_url+'user/getAllPeserta',
	      success: function(result) {
	      	
	        var objResult=JSON.parse(result);
	        var nomor = 1;
	        $.each(objResult, function(key, val){
	          var barisBaru = $("<tr>");
	          console.log(val);
	          setTimeout(readAllPeserta(), 1000);

	          if(val.nim_user == 0 && val.konfirmasi_peserta == 0 && val.hadir == null){
	          	barisBaru.html("<td>"+nomor+"</td><td>Tidak ada NIM</td><td>"+val.nama_user+"</td><td>"+val.phone_user+"</td><td>"+val.universitas+"</td><td>"+val.jurusan+"</td><td><span class='badge badge-warning'>Pending</span></td><td><span class='badge badge-warning'>Belum Hadir</span></td>");
	          }

	          if(val.nim_user != 0 && val.konfirmasi_peserta == 0 && val.hadir == null){
	          	barisBaru.html("<td>"+nomor+"</td><td>"+val.nim_user+"</td><td>"+val.nama_user+"</td><td>"+val.phone_user+"</td><td>"+val.universitas+"</td><td>"+val.jurusan+"</td><td><span class='badge badge-warning'>Pending</span></td><td><span class='badge badge-warning'>Belum Hadir</span></td>");
	          }

	          if(val.nim_user != 0 && val.konfirmasi_peserta == 1 && val.hadir == null){
	          	barisBaru.html("<td>"+nomor+"</td><td>"+val.nim_user+"</td><td>"+val.nama_user+"</td><td>"+val.phone_user+"</td><td>"+val.universitas+"</td><td>"+val.jurusan+"</td><td><span class='badge badge-success'>Diterima</span></td><td><span class='badge badge-warning'>Belum Hadir</span></td>");
	          }

	          if(val.nim_user == 0 && val.konfirmasi_peserta == 1 && val.hadir == null){
	          	barisBaru.html("<td>"+nomor+"</td><td>Tidak ada NIM</td><td>"+val.nama_user+"</td><td>"+val.phone_user+"</td><td>"+val.universitas+"</td><td>"+val.jurusan+"</td><td><span class='badge badge-success'>Diterima</span></td><td><span class='badge badge-warning'>Belum Hadir</span></td>");
	          }

	          if(val.nim_user == 0 && val.konfirmasi_peserta == 1 && val.hadir == 1){
	          	barisBaru.html("<td>"+nomor+"</td><td>Tidak ada NIM</td><td>"+val.nama_user+"</td><td>"+val.phone_user+"</td><td>"+val.universitas+"</td><td>"+val.jurusan+"</td><td><span class='badge badge-success'>Diterima</span></td><td><span class='badge badge-primary'>Sudah Hadir</span></td>");
	          }
	          if(val.nim_user !=0 && val.konfirmasi_peserta == 1 && val.hadir == 1){
	          	barisBaru.html("<td>"+nomor+"</td><td>"+val.nim_user+"</td><td>"+val.nama_user+"</td><td>"+val.phone_user+"</td><td>"+val.universitas+"</td><td>"+val.jurusan+"</td><td><span class='badge badge-success'>Diterima</span></td><td><span class='badge badge-primary'>Sudah Hadir</span></td>");
	          }

	          
	          var dataHandler = $('#barisData');
	          dataHandler.append(barisBaru);
	          nomor++;
	        })

	      },error: function(result){
	        alert("gagal");
	      }

	    });
	    
    }




//AKHIR AJAX DAFTAR PESERTA
	</script>
</section>
