<?php

// get all explorations (pods post type)

$explorations = pods('exploration', array(
    'orderby' => 't.post_date DESC',
    'limit' => -1
));

$isEmpty = $explorations->total() === 0;

if (!$isEmpty): ?>
    <ul class="region-list mt-4">
        <?php while ($explorations->fetch()): ?>
            <li><a
            hx-get="<?php echo $explorations->display('permalink'); ?>"
            hx-target="#results"
            hx-push-url="true"
            href="<?php echo $explorations->display('permalink'); ?>"><?php echo $explorations->display('name'); ?></a></li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <div class="alert alert-warning">
        There are no regions available.
    </div>
<?php endif; ?>

