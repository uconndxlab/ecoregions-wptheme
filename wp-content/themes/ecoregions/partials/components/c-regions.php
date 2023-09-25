<?php

// get all regions (which is a pods custom taxonomy)

$params = array(
    'limit' => -1,
    'orderby' => 'name ASC'
);

$regions = pods('region', $params);

$isEmpty = $regions->total() === 0;

if (!$isEmpty): ?>
<div class="dropdown my-3">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="regionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        Select Region
    </button>
    <ul class="dropdown-menu" aria-labelledby="regionDropdown">
        <?php while ($regions->fetch()): ?>
            <li><a class="dropdown-item" href="<?php echo $regions->display('permalink'); ?>"><?php echo $regions->display('name'); ?></a></li>
        <?php endwhile; ?>
    </ul>
</div>

<?php else: ?>
    <div class="alert alert-warning">
        There are no regions available.
    </div>
<?php endif; ?>
