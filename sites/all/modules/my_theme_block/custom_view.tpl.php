<h1><?php echo $mycustomblock['subject']?></h1>
<div>Person: <?php echo $mycustomblock['person']?></div>
<ul>

    <?php foreach ($mycustomblock['list'] as $list):?>
    <li>
        <?php echo $list; ?>
    </li>
   <?php endforeach;?>
</ul>