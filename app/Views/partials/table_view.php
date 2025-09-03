    <?= $this->extend("layouts/base"); ?>
	<?= $this->section("content"); ?>
	

	 <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Portfolio Details</li>
        </ol>
        <h2>Portfolio Details</h2>

      </div>
    </section><!-- End Breadcrumbs -->
	
	<!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-12">
		  <h2>Subjects List</h2>
			<ul>
			<?php //print_r($lht_data); ?>
											
				<?php
				if (!empty($lht_data)) {
						  echo "<table id = 'example' class = 'display' style = 'width:100%'>
									<thead class='table-thead'>
									<tr>
										<th>MSS.Id</th>
										<th>AMAR Id</th>
										<th>State</th>
										<th>Script</th>
										<th>Title</th>
										<th>Author</th>
									</tr></thead>";
						  // output data of each row
						  foreach($lht_data as $lht) {
							echo "<tr><td><a href='./manuscript_view.php?mss_id=".$lht->book_id."' target='_blank'>".$lht->book_id."</a></td>".
											"<td>".$lht->book_id."</td>".
											"<td>".$lht->book_id."</td>".
											"<td>".$lht->book_id."</td>".
											"<td><a href='./manuscript_view.php?mss_id=".$lht->book_id."' target='_blank'>".$lht->book_id."</a></td>".
											"<td>".$lht->book_id."</td>
								 </tr>";
						  }
						  echo "</table>";
						} else {
						  echo "0 results";
						}
						?>
			</ul>
			
		  </div>
		  
		</div>
	   </div>
	</section>
	
	 <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="<?=base_url(); ?>/public/assets/img/portfolio/portfolio-1.jpg" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="<?=base_url(); ?>/public/assets/img/portfolio/portfolio-2.jpg" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="<?=base_url(); ?>/public/assets/img/portfolio/portfolio-3.jpg" alt="">
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Project information</h3>
              <ul>
                <li><strong>Category</strong>: Web design</li>
                <li><strong>Client</strong>: ASU Company</li>
                <li><strong>Project date</strong>: 01 March, 2020</li>
                <li><strong>Project URL</strong>: <a href="#">www.example.com</a></li>
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>This is an example of portfolio detail</h2>
              <p>
                Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia. Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->  
	
	<?= $this->endSection(); ?>
		
		



	

	