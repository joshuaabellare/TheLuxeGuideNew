<?php print render($form['field_pro_parent_category']); ?>
<?php print render($form['field_full_name']); ?>
<?php print render($form['field_email']); ?>
<?php print render($form['field_contact_number']); ?>
<?php print render($form['field_website']); ?>
<?php print render($form['field_professional_terms']); ?>
<div class="align-center">
	<br>
	<?php print drupal_render($form['actions']['captcha']);?>
	<br>
	<div class="padding-5 no-padding-left no-padding-right no-padding-bottom"><?php print drupal_render($form['actions']['submit']); ?></div>
</div>
<div class="hide">
	<?php print drupal_render_children($form); ?>
</div>