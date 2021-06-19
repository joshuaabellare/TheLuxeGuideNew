	<?php
	global $base_url;
	global $user;
	$path = drupal_get_path_alias('node/' . $node->nid);
	$current_alias = drupal_get_path_alias('node/' . $node->nid);
	$admin = array_intersect(array('administrator', 'website admin'), array_values($user->roles));
	$img_style = 'full_width_banner';
	$image_default_uri = "public://LXVAnonDefaultImage.jpg";
	$image_banner_default = image_style_url($img_style, $image_default_uri);
	if(!empty($content['field_image'])) {
		$image_banner = image_style_url($img_style, $node->field_image[LANGUAGE_NONE][0]['uri']);
	}
	$current_year = date("Y");
	$old_str = [" in @AREA,", " @AREA,", " in @AREA", " @AREA", " @COUNTRY", " @YEAR"];
	$new_str = ["", "", "", "", "", " $current_year"];
?>
<?php if (empty($admin) ? FALSE : TRUE) : ?>
	<div class="position-fixed z-index-above no-right">
		<div class="align-center padding-20">
			<div class="inline-block">
				<a class="btn btn-mod btn-deep-sky-blue btn-small btn-circle scroll" target="_blank" href="<?php print $base_url; ?>/node/<?php print $node->nid; ?>/edit">Edit Page</a>
			</div>
		</div>
	</div>
<?php endif; ?>
<div class="bg-white align-center padding-30 border-bottom-grey">
	<h2 class="no-margin fw-600"><?php print($title);?></h2>
	<?php /*
		$block = module_invoke('menu', 'block_view', 'menu-category');
		$menu = '';
		$menuItems = menu_tree_page_data('menu-category'); 
		foreach($menuItems as $key => $m) {
		   if ($m['link']['in_active_trail'] && $menuItems[$key]['below']) {
		       $menu = menu_tree_output($menuItems[$key]['below']);
		   }  
		}
	*/ ?>
	<!-- <div><?php print render($block['content']); ?></div> -->
</div>
<?php if(!empty($content['field_category_tab'])) : ?>
	<div class="border-bottom-grey">
		<ul class="bg-white uppercase custom-nav-bars nav nav-tabs align-center font-size-12 no-padding" role="tablist">
			<li class="active"><a href="<?php print  $base_url . '/' . $path ;?>">Home</a></li>
			<?php
				$items = field_get_items('node', $node, 'field_category_tab');
			?>
			
			<?php if (in_array_r("2", $items)): ?>
				<li><a href="<?php print  $base_url . '/' . $path . '/media' ;?>">Magazine</a></li>
			<?php endif; ?>
			<?php if (in_array_r("9", $items)): ?>
				<li><a href="<?php print  $base_url . '/' . $path . '/premium-brands' ;?>">Best brands</a></li>
			<?php endif; ?>
			<?php if (in_array_r("3", $items)): ?>
				<li><a href="<?php print  $base_url . '/' . $path . '/professionals' ;?>">Professionals</a></li>
			<?php endif; ?>
			<?php if (in_array_r("4", $items)): ?>
				<li><a href="<?php print  $base_url . '/' . $path . '/for-sale' ;?>">For Sale</a></li>
			<?php endif; ?>
			<?php if (in_array_r("5", $items)): ?>
				<li><a href="<?php print  $base_url . '/' . $path . '/for-rent' ;?>">For Rent</a></li>
			<?php endif; ?>
			<?php if (in_array_r("7", $items)): ?>
				<li><a href="<?php print  $base_url . '/' . $path . '/experience' ;?>">Experiences</a></li>
			<?php endif; ?>
			<?php if (in_array_r("8", $items)): ?>
				<li><a href="<?php print  $base_url . '/' . $path . '/events' ;?>">Agenda</a></li>
			<?php endif; ?>
		</ul>
	</div>
<?php endif; ?>
<br>
<div class="container">
	<?php 
		$breadcrumb = module_invoke("views", "block_view", "view_block-breadcrumbs_directory");
		print render($breadcrumb['content']);
	?>
	<br>
	<br>
	<?php if((!empty($content['field_title'])) || (!empty($content['body']))) : ?>
		<div class="bg-white border-radius-3 box-shadow">
			<?php if(!empty($content['field_title'])) : ?>
				<?php $title_field = trim(render($content['field_title'])); ?>
				<?php
					$str_replace_title = str_replace($old_str, $new_str, $title_field);
					$new_title = substr($str_replace_title, strpos($str_replace_title, $title_field));
				?>
				<h1 class="no-margin font-alt font-size-24 fw-600 border-bottom-grey padding-15 padding-left-30 padding-right-30"><?php print $new_title; ?></h1>
			<?php endif; ?>
			<?php if(!empty($content['body'])) : ?>
				<?php $description_field = trim(render($content['body'])); ?>
				<?php
					$str_replace_description = str_replace($old_str, $new_str, $description_field);
					$new_description = substr($str_replace_description, strpos($str_replace_description, $description_field));
				?>
				<div class="padding-30"><?php print $new_description; ?></div>
			<?php endif; ?>
			<div class="padding-15 jump-nav-area">
				<div class="row clearfix align-center">
					<div class="col-md-3 col-centered no-float align-left">
						<?php
							$block = module_invoke('views', 'block_view', 'view_block-jump_nav');
							print render($block['content']);
						?>
						<br>
					</div>
				</div>
			</div>
		</div>
		<br>
		<br>
		<br>
	<?php endif; ?>
	<?php
		$block = module_invoke('views', 'block_view', 'directory-featured_listing_deals_experiences');
		if ($block):
	?>
		<div class="row clearfix">
			<div class="col-md-9 col-sm-9 col-xs-9"><h3 class="no-margin font-alt font-size-24 fw-600">Latest Listings for Experiences</h3></div>
			<div class="col-md-3 col-sm-3 col-xs-3 align-right"><a href="<?php print  $base_url . '/' . $path . '/experience' ;?>" class="fw-600">See All <i class="fa fa-angle-double-right"></i></a></div>
		</div>
		<br>
		<div class="align-center"><?php print render($block['content']); ?></div>
		<br>
		<div class="border-bottom-custom"></div>
		<br>
		<br>
		<br>
	<?php endif; ?>
	
	<?php
		$block = module_invoke('views', 'block_view', 'directory-featured_listing_sale');
		if ($block):
	?>
		<div class="row clearfix">
			<div class="col-md-9 col-sm-9 col-xs-9"><h3 class="no-margin font-alt font-size-24 fw-600">Latest Listings for Sale</h3></div>
			<div class="col-md-3 col-sm-3 col-xs-3 align-right"><a href="<?php print  $base_url . '/' . $path . '/for-sale' ;?>" class="fw-600">See All <i class="fa fa-angle-double-right"></i></a></div>
		</div>
		<br>
		<div class="align-center"><?php print render($block['content']); ?></div>
		<br>
		<div class="border-bottom-custom"></div>
		<br>
		<br>
		<br>
	<?php endif; ?>
	<?php
		$block = module_invoke('views', 'block_view', 'directory-featured_listing_rent');
		if ($block):
	?>
		<div class="row clearfix">
			<div class="col-md-9 col-sm-9 col-xs-9"><h3 class="no-margin font-alt font-size-24 fw-600">Latest Listings for Rent</h3></div>
			<div class="col-md-3 col-sm-3 col-xs-3 align-right"><a href="<?php print  $base_url . '/' . $path . '/for-rent' ;?>" class="fw-600">See All <i class="fa fa-angle-double-right"></i></a></div>
		</div>
		<br>
		<div class="align-center"><?php print render($block['content']); ?></div>
		<br>
		<div class="border-bottom-custom"></div>
		<br>
		<br>
		<br>
	<?php endif; ?>

	<?php
		$block = module_invoke('views', 'block_view', 'directory-featured_pro');
		if ($block):
	?>
		<div class="row clearfix">
			<div class="col-md-9 col-sm-9 col-xs-9"><h3 class="no-margin font-alt font-size-24 fw-600"><h3 class="no-margin font-alt font-size-24 fw-600">Latest Professionals</h3></div>
			<div class="col-md-3 col-sm-3 col-xs-3 align-right"><a href="<?php print  $base_url . '/' . $path . '/professionals' ;?>" class="fw-600">See All <i class="fa fa-angle-double-right"></i></a></div>
		</div>
		<br>
		<div class="align-center"><?php print render($block['content']); ?></div>
		<br>
		<div class="border-bottom-custom"></div>
		<br>
		<br>
		<br>
	<?php endif; ?>
	
	
	<?php
		$block = module_invoke('views', 'block_view', 'directory-latest_article');
		if ($block):
	?>
		<div class="row clearfix">
			<div class="col-md-9 col-sm-9 col-xs-9"><h3 class="no-margin font-alt font-size-24 fw-600">Latest News</h3></div>
			<div class="col-md-3 col-sm-3 col-xs-3 align-right"><a href="<?php print  $base_url . '/' . $path . '/media' ;?>" class="fw-600">See All <i class="fa fa-angle-double-right"></i></a></div>
		</div>
		<br>
		<div class="align-center"><?php print render($block['content']); ?></div>
		<br>
		<div class="border-bottom-custom"></div>
		<br>
		<br>
		<br>
	<?php endif; ?>
	<?php if(!empty($content['field_middle_content'])) : ?>
		<div class="bg-white border-radius-3 box-shadow">
			<?php $middle_content_field = trim(render($content['field_middle_content'])); ?>
			<?php
				$str_replace_middle_content = str_replace($old_str, $new_str, $middle_content_field);
				$new_middle_content = substr($str_replace_middle_content, strpos($str_replace_middle_content, $middle_content_field));
			?>
			<div class="padding-30"><?php print $new_middle_content; ?></div>
		</div>
		<br>
		<br>
		<br>
	<?php endif; ?>
	<div class="bg-white border-radius-3 padding-15 box-shadow">
		<div class="row clearfix">
			<div class="col-md-5 col-centered no-float vertical-align-middle">
				<img style="" typeof="foaf:Image" src="https://www.theluxeguide.com/sites/default/files/general/TLGLogoWhite.jpeg" alt="Register at The Luxe Guide" title="">
			</div>
			<div class="col-md-7 col-centered no-float vertical-align-middle padding-15">
				<h3 class="uppercase no-margin rtecenter fw-500 padding-10 no-padding-top no-padding-left no-padding-right">Register on The Luxe Guide</h3>
				<br>
				<p class="align-center">Be part of The Luxe Guide and experience the world of luxury. For more details email us at <span class="fw-600"><a href="mailto:contact@theluxeguide.com">contact@theluxeguide.com</a></span></p>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<?php if(!empty($content['field_lower_content'])) : ?>
		<div class="bg-white border-radius-3 box-shadow">
			<?php $lower_content_field = trim(render($content['field_lower_content'])); ?>
			<?php
				$str_replace_lower_content = str_replace($old_str, $new_str, $lower_content_field);
				$new_lower_content = substr($str_replace_lower_content, strpos($str_replace_lower_content, $lower_content_field));
			?>
			<div class="padding-30"><?php print $new_lower_content; ?></div>
		</div>
		<br>
		<br>
		<br>
	<?php endif; ?>
	<?php
		$block = module_invoke('views', 'block_view', 'article_unique_content-category');
		if ($block):
	?>
		<?php print render($block['content']); ?>
		<br>
		<br>
		<br>
	<?php endif; ?>
	<!-- Contact Us Entity Form -->
	<div class="bg-white padding-15 border-radius-3 box-shadow">
		<div id="inquire">
			<div class="row clearfix align-center">
				<div class="col-md-10 col-centered no-float align-left">
					<div class="padding-60 no-padding-left no-padding-right">
						<h4 class="no-margin-top uppercase no-margin font-size-20 align-center">Request - Inquiry</h4>
						<p class="padding-10 no-padding-left no-padding-right no-padding-bottom font-size-12 align-center">If you didn't find the right information on this page, you can also send us an inquiry that we will share to all our partners.</p>
						<br>
						<?php
							$contact_us = module_invoke('entityform_block', 'block_view', 'request_contact');
							print render($contact_us['content']);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End of Contact Us Entity Form -->
	<br>
	<br>
	<br>
	<?php
		$block = module_invoke('views', 'block_view', 'directory-ph_area_directory_link');
		if ($block):
	?>
		<div class="bg-white no-padding-bottom border-radius-3 box-shadow">
			<h3 class="no-margin font-alt font-size-24 fw-600 border-bottom-grey padding-15 padding-left-30 padding-right-30">Philippines</h3>
			<div class="padding-30">
				<div class="font-size-18"><a href="<?php print $base_url . '/' . $path . '/philippines'; ?>">Go to Philippines page <i class="fa fa-angle-double-right"></i></a></div>
				<br>
				<?php print render($block['content']); ?>	
			</div>
		</div>
		<br>
		<br>
		<br>
	<?php endif;?>
	<?php /*
		$block = module_invoke('views', 'block_view', 'directory-country_directory_link');
		if ($block):
	?>
		<div class="bg-white no-padding-bottom border-radius-3 box-shadow">
			<h3 class="no-margin font-alt font-size-24 fw-600 border-bottom-grey padding-15 padding-left-30 padding-right-30">Choose a Country</h3>
			<div class="padding-30"><?php print render($block['content']); ?></div>
		</div>
		<br>
		<br>
		<br>
	<?php endif; */ ?>
</div>