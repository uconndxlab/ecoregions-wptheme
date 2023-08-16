<?php

// get all locations (pods post type)

$locations = pods('location', array(
    'orderby' => 't.post_date DESC',
    'limit' => -1
));

$isEmpty = $locations->total() === 0;

if (!$isEmpty): ?>
    <ul class="region-list">
        <?php while ($locations->fetch()): ?>
            <li><a href="<?php echo $locations->display('permalink'); ?>"><?php echo $locations->display('name'); ?></a></li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <div class="alert alert-warning">
        There are no locations available.
    </div>
<?php endif; ?>

