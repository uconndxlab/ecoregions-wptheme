<?php
$habitats_pod = pods('habitat');
$habitats_pod->find('name ASC');
$habitats = $habitats_pod->fetch();

if (!empty($habitats)) : ?>
    <div class="btn-group" role="group" aria-label="Habitats">
        <?php while ($habitats_pod->fetch()) : ?>
            <button type="button" class="btn btn-secondary">
                <?php echo $habitats_pod->field('name'); ?>
            </button>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <p class="text-white">No habitats exist.</p>
<?php endif; ?>
