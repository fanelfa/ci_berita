<?php echo $header; ?>

<!-- Page heading -->
<div class="container p-t-4 p-b-40">
    <h2 class="f1-l-1 cl2">
        List Berita
    </h2>
</div>

<!-- Post -->
<section class="bg0 p-b-55">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 p-b-80">
                <div class="p-r-10 p-r-0-sr991">
                    <div class="m-t--40 p-b-40">
                        <!-- Item post -->
                        <?php foreach ($berita as $value) { ?>
                            <div class="flex-wr-sb-s p-t-40 p-b-15 how-bor2">
                                <a href="<?php echo $value->url_slug; ?>" class="size-w-8 wrap-pic-w hov1 trans-03 w-full-sr575 m-b-25">
                                    <img src="<?php echo $value->gambar; ?>" alt="IMG">
                                </a>

                                <div class="size-w-9 w-full-sr575 m-b-25">
                                    <h5 class="p-b-12">
                                        <a href="<?php echo $value->url_slug; ?>" class="f1-l-1 cl2 hov-cl10 trans-03 respon2">
                                            <?php echo $value->judul; ?>
                                        </a>
                                    </h5>

                                    <div class="cl8 p-b-18">
                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                            by <?php echo $this->PengirimModel->find($value->id_pengirim)->nama; ?>
                                        </a>

                                        <span class="f1-s-3 m-rl-3">
                                            -
                                        </span>

                                        <span class="f1-s-3">
                                            <?php echo $value->waktu; ?>
                                        </span>
                                    </div>

                                    <?php
                                        // echo $value->url_slug;
                                        if ($value->url_slug != null) {
                                            $char_max = 200;
                                            $link = '/berita/' . $value->url_slug;
                                            // echo $this->potong_paragraf(, 200, $link);
                                            $string = strip_tags($value->isi);
                                            if (strlen($string) > $char_max) {

                                                //potong sampai $char_max
                                                $stringCut = substr($string, 0, $char_max);
                                                $endPoint = strrpos($stringCut, ' ');

                                                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            }
                                            $str = '<p class="f1-s-1 cl6 p-b-24">';
                                            $str .= $string;
                                            $str .= '</p>';
                                            $str .= '<a href="' . $link . '" class="f1-s-1 cl9 hov-cl10 trans-03">';
                                            $str .= '    <h4><span class="label label-info">Baca Selengkapnya<i class="m-l-2 fa fa-long-arrow-alt-right"></i></span></h4>';
                                            $str .= '</a>';
                                            echo $str;
                                        } else {
                                            echo 'no slug';
                                        }
                                        ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- <a href="#" class="flex-c-c size-a-13 bo-all-1 bocl11 f1-m-6 cl6 hov-btn1 trans-03">
                        Load More
                    </!--> -->
                </div>
            </div>
        </div>
    </div>
</section>



<?php echo $footer; ?>