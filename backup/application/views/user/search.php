<main class="main-contents search-page">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="container">
		<section class="about-bundl">
			<div class="section-title sm-width">
				<h1>
					<?= $this->lang->line('result_text'); ?>
					<span class="add-icon"></span>
				</h1>
			</div>
			<?php //print_r($result); ?>
			<?php if($result): ?>

				<?php if(isset($result['items'])): ?>
					<h2><?= $this->lang->line('items'); ?></h2>
					<?php foreach ($result['items'] as $key => $item):?>
						<div class="desc">
							<p class="highlight"><a href="<?= base_url('custom?search=') . $item['id']; ?>"><?= $item['name_'.$language]; ?></a></p>
							<?php if(isset($item['description_'.$language])): ?>
								<p><?= $item['description_'.$language]; ?></p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>

				<?php if(isset($result['packages'])): ?>
					<h2><?= $this->lang->line('packages'); ?></h2>
					<?php foreach ($result['packages'] as $key => $package): ?>
						<div class="desc">
							<p class="highlight"><a href="<?= base_url(); ?>"><?= $package['name_'.$language]; ?></a></p>
							<?php if(isset($item['description_'.$language])): ?>
								<p><?= $item['description_'.$language]; ?></p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>

				<?php if(isset($result['pages'])): ?>
					<h2><?= $this->lang->line('pages'); ?></h2>
					<?php foreach ($result['pages'] as $page => $url): ?>
						<div class="desc">
							<p class="highlight"><a href="<?= base_url($url); ?>"><?= $page; ?></a></p>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>

			<?php else: ?>
				<div class="alert alert-success alert-dismissible">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong><?= $this->lang->line('result_info'); ?></strong> <?= $this->lang->line('result_noresult_found'); ?>
				</div>
			<?php endif; ?>

		</section>
	</div>
</main>