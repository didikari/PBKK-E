<head>
	<script type="text/javascript">
		$(function () {
			$(".a-href").click(function (e) {
				e.preventDefault();
				var form = $(this);
				var formdata = false;
				var id = $(this).attr("id");
				var title = $(this).attr("title");
				var text = $(this).attr("text");

				if (window.FormData) {
					formdata = new FormData(form[0]);
				}
				swal({
						title: title,
						text: text,
						icon: "warning",
						buttons: ["Tidak", "Ya"],
					})
					.then((willDelete) => {
						if (willDelete) {
							$.ajax({
								type: 'POST',
								url: form.attr('href'),
								data: formdata ? formdata : form.serialize(),
								contentType: false,
								processData: false,
								cache: false,
								beforeSend: function () {
									$('.loading').fadeIn();
								},
								success: function (result) {
									swal(result);
									$("#tabelMahasiswa").load("<?php echo base_url('admin/tabelNavigasi/0/Mahasiswa'); ?>");
									$("#tabelDosen").load("<?php echo base_url('admin/tabelNavigasi/0/Dosen'); ?>");
									$('.loading').fadeOut();
								}
							});
						}
					});
			});

		});

		$(".form<?=$status?>").load("<?=base_url('admin/formUsers/'.$status);?>");

	</script>
</head>

<?php if (!empty($users)) {?>
<div class='table-responsive'>
<table class="table small">
	<thead>
		<tr>
			<th scope="col">Nomor Induk</th>
			<th scope="col">Nama</th>
			<th scope="col">Jurusan</th>
			<th scope="col">Konsentrasi</th>
			<th scope="col">Email</th>
			<th scope="col">No HP</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users->result() as $m):
        ?>
		<tr class="list-item tabel<?=$m->ID?> <?php if (empty($m->Password)) {
            echo 'table-warning';
        }?>">
			<td> <?=$m->ID;?> </td>
			<td><a class="a-href" title="Kirim Password?" text="Ini akan mengubah password dan akan di kirim melalui email." href="<?=base_url('Admin/sendPassword/' . $m->ID)?>"> <?=$m->Nama;?> </a></td>
			<td> <?=$m->Jurusan;?> </td>
			<td> <?=$m->Konsentrasi;?> </td>
			<td> <?=$m->Email;?> </td>
			<td> <?=$m->NoHP;?> </td>
			<td> <?php if ($m->Status === 'Daftar') {?>

				<button acc='true' type="button" id="<?=$m->ID?>" action="<?=base_url('Admin/acceptDaftar/')?>" class="acc btn-action btn-sm btn btn-outline-success"><i class="fas fa-check"></i> </button>

				<button type="button" acc='false' id="<?=$m->ID?>" action="<?=base_url('Admin/acceptDaftar/')?>" class="acc btn-action btn-sm btn btn-outline-danger"><i class="fas fa-window-close"></i> </button>

				<?php } elseif ($m->Status === 'Mahasiswa') { ?>

				<a title="Mengubah Status Mahasiswa?" text="Mahasiswa Akan Mengakses Semua Fitur Untuk Skripsi, Pastikan Semua Persyaratan Telah Terpenuhi Sebelum Mengubah Status" href="<?=base_url('Admin/statusSkripsi/'.$m->ID);?>" class="a-href" id="<?=$m->ID;?>"> <?= $m->Status; ?> </a>
				<?php } else { echo $m->Status; } ?>

			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
</div>


<div class="form<?=$status?>"></div>



<?php echo $this->ajax_pagination->create_links(); ?>
<?php } else {?>
<div class='container mt-5'>
	<div class="form<?=$status?>"></div>
	<div class='row align-items-center'>
		<div class='col-md'>
			<h2>Data <?=$status ?> tidak ditemukan.</h2>
			Data <?=$status?> tidak ditemukan. silahkan tambahkan data melalui form di atas menggunakan data valid dan email password login akan dikirimkan melalui email pengguna.
		</div>
		<div class='col-md-3'>
			<img src="<?=base_url('assets/web/sad.jpg')?>">
		</div>
	</div>
</div>
<?php }?>
