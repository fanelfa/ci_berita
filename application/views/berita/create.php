<?php echo $header; ?>

<!-- Page heading -->
<div class="container p-t-4 p-b-40">
  <h2 class="f1-l-1 cl2">
    Tambah Berita
  </h2>
</div>

<!-- Post -->
<section class="bg0 p-b-55">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 col-lg-8 p-b-30">
        <div class="p-r-10 p-r-0-sr991">

          <!-- Isi Berita -->
          <div>
            <?php echo form_open_multipart('admin/store'); ?>

            <form action="" method="">
              <input class="bo-1-rad-3 bocl13 size-a-13 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" type="text" name="judul" placeholder="Judul">

              <textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="isi" id="isi_summernote" placeholder="Isi berita"></textarea>

              <select class="bo-1-rad-3 bocl13 size-a-13 f1-s-13 cl5 plh6 p-rl-18 m-b-20" name="pengirim" id="pengirim">
                <option value="" selected disabled>Pilih Pengirim</option>
                <?php
                foreach ($pengirim as $key => $value) {
                  echo "<option value=" . $value->id . ">" . $value->nama . "</option>";
                }
                ?>
              </select>

              <select class="bo-1-rad-3 bocl13 size-a-13 f1-s-13 cl5 plh6 p-rl-18 m-b-20" name="kategori" id="kategori">
                <option value="" selected disabled>Pilih Kategori</option>
                <?php
                foreach ($kategori as $key => $value) {
                  echo "<option value=" . $value->id . ">" . $value->nama . "</option>";
                }
                ?>
              </select>
              <select class="bo-1-rad-3 bocl13 size-a-13 f1-s-13 cl5 plh6 p-rl-18 m-b-20" name="softdelete" id="softdelete">
                <option value="" selected disabled>Softdelete</option>
                <option value="true"> ya </option>
                <option value="false"> tidak </option>
              </select>

              <input class="bo-1-rad-3 bocl13 size-a-13 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" type="file" name="gambar" placeholder="Gambar">

              <input class="bo-1-rad-3 bocl13 size-a-13 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" type="text" name="" placeholder="hari ini tanggal : <?php echo date("d-m-Y"); ?>" readonly>

              <input type="submit" class="size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10" value="simpan" placeholder="Simpan">
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Script -->
<script>
  $(document).ready(function() {
    $('#isi_summernote').summernote({
      placeholder: 'Isi Berita',
      tabsize: 2,
      height: 300,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ol', 'ul', 'paragraph', 'height']],
        ['table', ['table']],
        ['insert', ['link']],
        ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
      ]
    });
  });
</script>
<?php echo $footer; ?>