<?php
$form['color']['#title'] = t('Kolor');
$form['firstname']['#title'] = t('firstname');
?>
<?php // Render the "name" and "mail" elements individually and add markup. ?>
<div class="name-and-email">
    <p><?php echo __FILE__ ?></p>
    <?php print render($form['color']); ?>
    <?php print render($form['name']); ?>
</div>
<?php // Be sure to render the remaining form items. ?> <?php print drupal_render_children($form); ?>
