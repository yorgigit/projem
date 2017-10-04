<?php
defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Breadcrumbs
 *
 * @author Kieran Graham
 * @author Ben Weller
 */
?>
<?php $c = count($breadcrumbs) ?>
<div class="col-sm-12">
<div class="breadcrumbs rcrumbs" id="breadcrumbs">
<ul>
    <?php if ($c > ($conf['min_depth'] - 1)) : ?>

        <?php foreach ($breadcrumbs as $crumb) : ?>

            <?php if ($crumb->get_url() !== NULL AND count($breadcrumbs > 1)) : ?>
                <li class="show"><a href="<?= $crumb->get_url() ?>"><?= __($crumb->get_title()) ?></a> <?= ( $c != 1 ? $conf['sep'] : ($conf['last'] == TRUE ? $conf['sep'] : '' ) ) ?></li>
            <?php else : ?>
                <li class="show"><?= __($crumb->get_title()) ?></li>
            <?php endif; ?>

            <?php $c-- ?>
        <?php endforeach; ?>

    <?php endif; ?>
</ul>
</div>
</div>
