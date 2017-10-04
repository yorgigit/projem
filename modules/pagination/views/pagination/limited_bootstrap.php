<ul class="pagination">
    <?php if ($first_page !== FALSE): ?>
        <li>
            <a href="<?php echo HTML::chars($page->url($first_page)) ?>"
               rel="first"><?php echo __('ilk') ?></a>
        </li>
    <?php else: ?>
        <li class="disabled">
            <a href="javascript:;" rel="first"><?php echo __('ilk') ?></a>
        </li>
    <?php endif ?>

    <?php if ($previous_page !== FALSE): ?>
        <li>
            <a href="<?php echo HTML::chars($page->url($previous_page)) ?>" rel="prev">
                <?php echo __('onceki') ?></a>
        </li>
    <?php else: ?>
        <li class="disabled">
            <a href="javascript:;" rel="prev"><?php echo __('onceki') ?></a>
        </li>
    <?php endif ?>

    <?php
    /* max left links */
    $offset = $total_pages - ($total_pages - $current_page);

    $left = $offset > $max_left_pages ? $max_left_pages : $offset;

    if ($offset > 1)
        for ($i = $offset - $left + 1; $i < $offset; $i++):
            ?>
            <li>
                <a href="<?php echo HTML::chars($page->url(abs($i))) ?>">
                    <?php echo abs($i) ?></a>
            </li>

        <?php endfor ?>

    <?php
    /* max right links */
    $right = $current_page + $max_right_pages;

    for ($i = $current_page; $i <= $right && $i <= $total_pages; $i++):
        ?>

        <?php if ($i == $current_page): ?>
            <li class="active">
                <a href="#<?php echo $i ?>"><strong><?php echo $i ?></strong></a>
            </li>
        <?php else: ?>
            <li>
                <a href="<?php echo HTML::chars($page->url($i)) ?>">
                    <?php echo $i ?></a>
            </li>
        <?php endif ?>

    <?php endfor ?>

    <?php if ($next_page !== FALSE): ?>
        <li>
            <a href="<?php echo HTML::chars($page->url($next_page)) ?>" rel="next">
                <?php echo __('sonraki') ?></a>
        </li>
    <?php else: ?>
        <li class="disabled">
            <a href="javascript:;" rel="next"><?php echo __('sonraki') ?></a>
        </li>
    <?php endif ?>

    <?php if ($last_page !== FALSE): ?>
        <li>
            <a href="<?php echo HTML::chars($page->url($last_page)) ?>" rel="last">
                <?php echo __('son') ?></a>
        </li>
    <?php else: ?>
        <li class="disabled">
            <a href="javascript:;" rel="last"><?php echo __('son') ?></a>
        </li>
    <?php endif ?>

</ul>