<?php get_header();?>/* Вывод шапки сайта */

    <div id="lpblock">

        <div class="breadcrumb">/* Хлебные крошки */

            <?php
            the_breadcrumb();
            ?>

        </div>
    </div>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <!-- Begin .postBox -->

    <article class="singlecont">

        <h1><?php the_title(); ?></h1>/*Заголовок поста */

        <div class="infocont"><span> <?php the_author(); ?> / <?php the_time('M') ?>.<?php the_time('j') ?>.<?php the_time('Y') ?>. / <?php comments_popup_link('Нет комментариев', '1 комментарий ', 'Комментариев: %'); ?></span></a></div>/* Информация о посте */

        <div class="cont">
            <?php the_content(); ?>/* Вывод текста записи */
        </div>

        <div class="postTags"><?php the_tags($before, '', $sep, $after); ?></div>/* Вывод меток записи */

        <?php comments_template(); ?> /* Вывод шаблона комментариев */

    </div>

<?php endwhile; else: ?>

    <p>Извините, но Вы ищете то чего здесь нет.</p>

<?php endif; ?>

    </article><!-- Конец .синглконтент -->

    <!-- Конец #colLeft -->

<?php get_footer(); ?>