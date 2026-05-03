<?php
get_header();

$posts_page_id = (int) get_option('page_for_posts');
$posts_page_url = $posts_page_id > 0 ? get_permalink($posts_page_id) : home_url('/blog/');
$posts_page_url = is_string($posts_page_url) ? $posts_page_url : home_url('/blog/');
?>

<main id="main-content" class="blog-single">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php
            $category_list = get_the_category();
            $primary_category_name = !empty($category_list) ? $category_list[0]->name : 'Poradnik';
            $read_time = dietitian_get_read_time(get_the_ID());
            ?>

            <header class="blog-single__hero">
                <div class="container blog-single__hero-inner">
                    <a class="blog-single__back-link" href="<?php echo esc_url($posts_page_url); ?>">Wróć do bloga</a>
                    <p class="blog-single__kicker"><?php echo esc_html($primary_category_name); ?></p>
                    <h1 class="blog-single__title"><?php echo esc_html(get_the_title()); ?></h1>
                    <p class="blog-single__meta">
                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('j F Y')); ?></time>
                        <span aria-hidden="true">•</span>
                        <span><?php echo esc_html($read_time); ?> min czytania</span>
                    </p>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <section class="blog-single__cover" aria-label="Obraz wyrozniajacy wpisu">
                    <div class="container">
                        <figure class="blog-single__cover-frame">
                            <?php the_post_thumbnail('large', ['loading' => 'eager']); ?>
                        </figure>
                    </div>
                </section>
            <?php endif; ?>

            <section class="blog-single__content-wrap">
                <div class="container">
                    <article class="blog-single__content">
                        <?php the_content(); ?>

                        <?php
                        $post_tags = get_the_tags();
                        if (!empty($post_tags)) :
                        ?>
                            <div class="blog-single__tags" aria-label="Tagi wpisu">
                                <?php foreach ($post_tags as $tag) : ?>
                                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"><?php echo esc_html($tag->name); ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                </div>
            </section>

            <?php
            $current_post_id = get_the_ID();
            $category_ids = wp_get_post_categories($current_post_id);

            $related_query_args = [
                'post_type'           => 'post',
                'posts_per_page'      => 3,
                'post__not_in'        => [$current_post_id],
                'ignore_sticky_posts' => true,
            ];

            if (!empty($category_ids)) {
                $related_query_args['category__in'] = $category_ids;
            }

            $related_query = new WP_Query($related_query_args);
            ?>

            <?php if ($related_query->have_posts()) : ?>
                <section class="blog-single__related" aria-label="Powiązane artykuły">
                    <div class="container">
                        <h2 class="blog-single__related-title">Powiązane artykuły</h2>
                        <div class="blog-single__related-grid">
                            <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                <article class="blog-card">
                                    <a class="blog-card__media" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium_large', ['loading' => 'lazy']); ?>
                                        <?php else : ?>
                                            <span class="blog-card__placeholder" aria-hidden="true"></span>
                                        <?php endif; ?>
                                    </a>
                                    <div class="blog-card__content">
                                        <p class="blog-card__kicker">
                                            <?php
                                            $related_category = get_the_category();
                                            echo esc_html(!empty($related_category) ? $related_category[0]->name : 'Poradnik');
                                            ?>
                                        </p>
                                        <h3 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>
                                        <p class="blog-card__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?></p>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

            <section class="blog-cta" aria-label="Konsultacja dietetyczna">
                <div class="container blog-cta__inner">
                    <p class="blog-cta__kicker">Masz podobny problem?</p>
                    <h2 class="blog-cta__title">Przejdziemy to krok po kroku na konsultacji.</h2>
                    <p class="blog-cta__text">Artykul to dobry start. Jezeli potrzebujesz planu dopasowanego do Twojej sytuacji zdrowotnej, umowmy spotkanie.</p>
                    <a class="btn btn--primary" href="<?php echo esc_url(home_url('/#contact')); ?>">Umow konsultacje</a>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>