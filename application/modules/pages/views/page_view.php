<?php 
//capitalize each word
$title = ucwords($content['title']);
?>
<h5 class="widget-name"><i class="icon-th-list"></i><?php echo $title; ?></h5>

<div class="widget">
<ul class="options-bar" style="padding:10px">
<?php echo $content['content']; ?>
</ul>
</div>