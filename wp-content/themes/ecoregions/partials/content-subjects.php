<?php
$subjects_pod = pods('subject');
$subjects_pod->find('name ASC');
$subjects = $subjects_pod->fetch();

if (!empty($subjects)) : ?>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="subjectDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            Select Subject
        </button>
        <ul class="dropdown-menu" aria-labelledby="subjectDropdown">
            <?php while ($subjects_pod->fetch()) : ?>
                <li><a class="dropdown-item" href="<?php echo $subjects_pod->display('permalink'); ?>">
                    <?php echo $subjects_pod->field('name'); ?>
                </a></li>
            <?php endwhile; ?>
        </ul>
    </div>
<?php else : ?>
    <p class="text-white">No subjects exist.</p>
<?php endif; ?>
