<?php
 //print_r($lht_details);
//exit();
?>
    <?= $this->extend("layouts/base"); ?>
	<?= $this->section("content"); ?>
	
	
	
		
	
	 <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="<?=base_url(); ?>">Home</a></li>
          <li>LHT Details</li>
        </ol>
        <h2>LHT Details</h2>

      </div>
    </section><!-- End Breadcrumbs -->
	
	<!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-12">
		  
			<ul>
			<?php //print_r($lht_details); ?>
											
				<?php
				
						
						if (!empty($lht_details)) {
							foreach($lht_details as $lht) {
							$lht_id=$lht->lht_id;
							$bot_name=$lht->botanical_name_source;
							$family=$lht->family;
							$local_name=$lht->local_name;
							$sanskrit_name=$lht->official_app_sanskrit_name;
							$parts_used=$lht->parts_used;
							$disease=$lht->disease;
							$use_reports=$lht->number_of_use_reports;
							$mode_of_use=$lht->mode_of_use;
							$tribe_ethnic_community=$lht->tribe_ethnic_community;
							$location=$lht->location;
							$state=$lht->state;
							$bibliography=$lht->bibliography;
							$citation=$lht->citation;
						  }
						} else {
							echo "0 results";
						}
						
						?>
			</ul>
			
				<div class="row">
					<!--Introductory-->
					  <div class="col-md-12">
						<h4 class="text-left h4title table-thead">&nbsp;Introductory</h4>
						<div class="table-responsive">
								<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
									<tr><th class="col-md-3">LHT ID :</th><td class="col-md-3"><?php echo $lht_id; ?></td>
										<th class="col-md-3">BOTANICAL NAME :</th><td class="col-md-3"><?php echo $bot_name; ?></td></tr>
									<tr><th class="col-md-3">FAMILY :</th><td class="col-md-3"><?php echo $family; ?></td>
										<th class="col-md-3">LOCAL NAME :</th><td class="col-md-3"><?php echo $local_name; ?></td></tr>
									<tr><th class="col-md-3">OFFICIAL APP SANSKRIT NAME :</th><td class="col-md-3"><?php echo $sanskrit_name; ?></td>
										<th class="col-md-3">PARTS USED :</th><td class="col-md-3"><?php echo $parts_used; ?></td></tr>
									<tr><th class="col-md-3">DISEASE :</th><td class="col-md-3"><?php echo $disease; ?></td>
										<th class="col-md-3">No.of USE REPORTS:</th><td class="col-md-3"><?php echo $use_reports; ?></td>
									</tr>
									<tr><th class="col-md-3">MODE OF USE :</th><td class="col-md-3"><?php echo $mode_of_use; ?></td>
										<th class="col-md-3">COMMUNITY:</th><td class="col-md-3"><?php echo $tribe_ethnic_community; ?></td>
									</tr>
									<tr><th class="col-md-3">LOCATION :</th><td class="col-md-3"><?php echo $location; ?></td>
										<th class="col-md-3">STATE:</th><td class="col-md-3"><?php echo $state; ?></td>
									</tr>
									<tr><th class="col-md-3">BIBLIOGRAPHY :</th><td class="col-md-3"><?php echo $bibliography; ?></td>
										<th class="col-md-3">CITATION:</th><td class="col-md-3"><?php echo $citation; ?></td>
									</tr>
								</table>
						</div>
					  </div>
				</div>
		  
		</div>
	   </div>
	</section>
	
	 <!-- ======= Portfolio Details Section ======= --
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
		
		



	

	