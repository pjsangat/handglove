<?php 
/**
 * FOR DOCUMENTATION PURPOSE ONLY.
 * 
 * This file requires input variables:
 * 
 * $this->load->view('components/scripts_render', array(...example below));
 * 
 * array(
 *  'scripts' => array(
 *    'path/to/scripts',
 *    'path/to/vendors',
 *    'path/to/cdn' => array(
 *      'attribute' => 'value',
 *      'integrity' => 'some hash code',
 *      ... 
 *    ),
 *    ...
 *  )
 * ); 
 */
?>
<?php foreach ($scripts as $key => $script): ?>
    <?php if (is_array($script)): ?>
        <script src="<?php echo $key; ?>"
        <?php foreach ($script as $attribute => $value): ?>
            <?php echo " {$attribute}=\"{$value}\" "; ?>
        <?php endforeach; ?>
        defer></script>
    <?php else: ?>
        <script src="<?php echo $script; ?>" defer></script>
    <?php endif; ?>
<?php endforeach; ?>
<?php echo view('components/scripts_global'); ?>