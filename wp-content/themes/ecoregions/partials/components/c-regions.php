<?php

// get all regions (which is a pods custom taxonomy)

$params = array(
    'limit' => -1,
    'orderby' => 'name ASC'
);

$regions = pods('region', $params);

$isEmpty = $regions->total() === 0;

if (!$isEmpty): ?>
    <ul class="region-list">
        <?php while ($regions->fetch()): ?>
            <li><a 
            hx-get="<?php echo $regions->display('permalink'); ?>"
            hx-target="#results"
            hx-push-url = "true"
            href="<?php echo $regions->display('permalink'); ?>"><?php echo $regions->display('name'); ?></a></li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <div class="alert alert-warning">
        There are no regions available.
    </div>
<?php endif; ?>
