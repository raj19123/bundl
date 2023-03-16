<main class="main-contents text-page">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="container">
		<div class="section-title">
			<h1>
				<?= $this->lang->line('footer_terms_condition');?>
				<span class="add-icon"></span>
			</h1>
		</div>
		<div class="career-desc">
			<?php 
			if($terms):
				foreach ($terms as $key => $term):
					?>
						<h4><?= $this->lang->line('summ'); ?></h4>
						<p><?= $term['summary_'.$language] ;?></p>
						<h4><?= $this->lang->line('terms_of_use'); ?></h4>
						<p><?= $term['detail_'.$language] ;?></p>
					<?php
				endforeach;
			endif;
			?>
		</div>
		<br />
		<div class="button-row">
			<a href="#" onclick="window.history.back();" class="process-link">< <?= $this->lang->line('go_back'); ?> ></a>
		</div>
		<br />
	</div>
</main>