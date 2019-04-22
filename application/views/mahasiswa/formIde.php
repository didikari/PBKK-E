<?php $sesi = 'Proposal';?>
<form method="POST" action="<?= base_url('Mahasiswa/sendIde') ;?>">
	<div class="form-group">
		<textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="deskripsi" minlength="200" rows="16" value=''>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto a possimus voluptates? Tenetur temporibus repellendus ipsam dolorum at nobis fugiat id culpa! Dolores, repudiandae consectetur. Vero maiores quia quibusdam! Eveniet.</textarea>
		<small>Minimal 200 Kata</small>
	</div>
	<div class="form-row">
		<div class="form-group col-md">
			<input class="form-control form-control-sm" type="text" name="judul" id="judul" placeholder="Judul Skripsi" required>
		</div>
		<div class="form-group mr-3">
					<form method="post" id="mydata"  enctype="multipart/form-data">
						<div class="input-group">
							<div class="custom-file">
								<input id="upload" type="file" name="<?= $sesi ?>" class="custom-file-input col custom-file-control" required>
								<label class="custom-file-label">Upload  <?= $sesi ?></label>					
							</div>
							<div class="input-group-append"> 
								<button class="btn btn-outline-primary" type="submit" required> Submit </button>					
							</div>
						</div>
						<small> File harus berbentuk PDF </small>
					</form>		
				</div>
	</div>
</form>	