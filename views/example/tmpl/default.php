<?php
// administrator\components\com_blog\views\example\tmpl\default.php
defined('_JEXEC') or die;

echo '<br> This is tmpl/default.php';
?>

<h1>Example Template</h1>
<h2><?php echo $this->item->title; ?></h2>
<p><?php echo $this->item->content; ?> in <?php echo $this->item->date; ?></p>
<hr>
<h2><?php echo $this->title; ?></h2>
<p><?php echo $this->content; ?> in <?php echo $this->date->format('Y-m-d', true); ?></p>
<hr>
<h2><?php echo $this->flower->title; ?></h2>
<hr>
<h2><?php echo $this->sakura->title; ?></h2>
