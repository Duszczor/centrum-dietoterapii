<?php
$posts_page_id = (int) get_option('page_for_posts');
$posts_page_url = $posts_page_id > 0 ? get_permalink($posts_page_id) : home_url('/blog/');
$posts_page_url = is_string($posts_page_url) ? $posts_page_url : home_url('/blog/');
$posts_page_url = trailingslashit($posts_page_url);

$blog_title = 'Blog dietetyczny';
$blog_intro = 'Rzetelne artykuły o odżywianiu, zdrowiu metabolicznym i praktycznych zmianach, które da się wdrożyć w codziennym życiu.';

if (is_search()) {
    $blog_title = sprintf('Wyniki wyszukiwania: %s', get_search_query());
    $blog_intro = 'Sprawdź wyniki i wybierz materiał, który najlepiej odpowiada na Twoje pytanie.';
} elseif (is_category() || is_tag() || is_author() || is_date()) {
    $blog_title = wp_strip_all_tags(get_the_archive_title());
    $archive_description = wp_strip_all_tags(get_the_archive_description());

    if (!empty($archive_description)) {
        $blog_intro = $archive_description;
    }
}

$category_chips = get_categories([
    'taxonomy'   => 'category',
    'hide_empty' => true,
    'number'     => 8,
]);

$is_all_posts_context = is_home() && !is_search() && !is_category() && !is_tag() && !is_author() && !is_date();
$is_filtered_blog_context = is_search() || is_category() || is_tag() || is_author() || is_date();
$current_category_id = is_category() ? (int) get_queried_object_id() : 0;

$is_first_posts_page = (int) get_query_var('paged', 1) <= 1;
$featured_post = null;

if (is_home() && !is_search() && $is_first_posts_page) {
    $featured_posts = get_posts([
        'posts_per_page' => 2,
        'post_type'      => 'post',
    ]);

    if (count($featured_posts) > 1) {
        $featured_post = $featured_posts[0];
    }
}
?>

<main id="main-content" class="blog-index">
    <section class="blog-index__hero">
        <div class="container blog-index__hero-inner">
            <p class="blog-index__kicker">Strefa wiedzy</p>
            <h1 class="blog-index__title"><?php echo esc_html($blog_title); ?></h1>
            <p class="blog-index__intro"><?php echo esc_html($blog_intro); ?></p>

            <form class="blog-index__search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <label class="screen-reader-text" for="blog-search-input">Szukaj na blogu</label>
                <div class="blog-index__search-field">
                    <span class="blog-index__search-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </span>
                    <input
                        id="blog-search-input"
                        class="blog-index__search-input"
                        type="search"
                        name="s"
                        value="<?php echo esc_attr(get_search_query()); ?>"
                        placeholder="Szukaj tematów, np. insulinooporność, PCOS, odchudzanie">
                    <button
                        class="blog-index__search-clear"
                        type="button"
                        aria-label="Wyczyść pole wyszukiwania"
                        data-search-clear>
                        <img src="<?php echo esc_url(dietitian_get_asset_uri('images/icon-x-grey.svg')); ?>" alt="">
                    </button>
                </div>
                <input type="hidden" name="post_type" value="post">
                <button class="blog-index__search-button" type="submit">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16" focusable="false">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                    Szukaj
                </button>
            </form>

            <div class="blog-index__chips" id="blog-categories" aria-label="Popularne tematy">
                <?php
                $all_posts_chip_classes = ['blog-index__chip', 'blog-index__chip--all'];

                if ($is_filtered_blog_context) {
                    $all_posts_chip_classes[] = 'blog-index__chip--return';
                }

                if ($is_all_posts_context) {
                    $all_posts_chip_classes[] = 'is-current';
                }
                ?>
                <a
                    class="<?php echo esc_attr(implode(' ', $all_posts_chip_classes)); ?>"
                    href="<?php echo esc_url($posts_page_url); ?>"
                    <?php if ($is_all_posts_context) : ?>aria-current="page" <?php endif; ?>>
                    Wszystkie wpisy
                </a>

                <?php foreach ($category_chips as $chip) : ?>
                    <?php
                    $chip_classes = ['blog-index__chip'];
                    $is_current_chip = $current_category_id > 0 && (int) $chip->term_id === $current_category_id;

                    if ($is_current_chip) {
                        $chip_classes[] = 'is-current';
                    }
                    ?>
                    <a
                        class="<?php echo esc_attr(implode(' ', $chip_classes)); ?>"
                        href="<?php echo esc_url(get_category_link($chip->term_id)); ?>"
                        <?php if ($is_current_chip) : ?>aria-current="page" <?php endif; ?>>
                        <?php echo esc_html($chip->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php if ($featured_post instanceof WP_Post) : ?>
        <?php
        $featured_category = get_the_category($featured_post->ID);
        $featured_category_name = !empty($featured_category) ? $featured_category[0]->name : 'Poradnik';
        $featured_excerpt = get_the_excerpt($featured_post->ID);
        $featured_read_time = dietitian_get_read_time($featured_post->ID);
        ?>
        <section class="blog-featured" aria-label="Wyrozniony artykul">
            <div class="container">
                <article class="blog-featured__card">
                    <a class="blog-featured__media" href="<?php echo esc_url(get_permalink($featured_post)); ?>" aria-label="<?php echo esc_attr(get_the_title($featured_post)); ?>">
                        <?php if (has_post_thumbnail($featured_post)) : ?>
                            <?php echo get_the_post_thumbnail($featured_post, 'large', ['loading' => 'eager']); ?>
                        <?php else : ?>
                            <span class="blog-featured__placeholder" aria-hidden="true"></span>
                        <?php endif; ?>
                    </a>
                    <div class="blog-featured__body">
                        <p class="blog-featured__kicker"><?php echo esc_html($featured_category_name); ?></p>
                        <h2 class="blog-featured__title">
                            <a href="<?php echo esc_url(get_permalink($featured_post)); ?>"><?php echo esc_html(get_the_title($featured_post)); ?></a>
                        </h2>
                        <p class="blog-featured__meta">
                            <time datetime="<?php echo esc_attr(get_the_date('c', $featured_post)); ?>"><?php echo esc_html(get_the_date('j F Y', $featured_post)); ?></time>
                            <span aria-hidden="true">•</span>
                            <span><?php echo esc_html($featured_read_time); ?> min czytania</span>
                        </p>
                        <?php if (!empty($featured_excerpt)) : ?>
                            <p class="blog-featured__excerpt"><?php echo esc_html(wp_trim_words($featured_excerpt, 30)); ?></p>
                        <?php endif; ?>
                        <a class="btn btn--ghost blog-featured__cta" href="<?php echo esc_url(get_permalink($featured_post)); ?>">Czytaj artykul</a>
                    </div>
                </article>
            </div>
        </section>
    <?php endif; ?>

    <section class="blog-list" id="blog-posts" aria-label="Najnowsze artykuly">
        <div class="container">
            <div class="blog-list__header">
                <h2 class="blog-list__title"><?php echo esc_html(is_home() ? 'Najnowsze artykuły' : $blog_title); ?></h2>
            </div>

            <?php if (have_posts()) : ?>
                <div class="blog-list__grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php if ($featured_post instanceof WP_Post && get_the_ID() === $featured_post->ID) continue; ?>
                        <?php
                        $post_category = get_the_category();
                        $post_category_name = !empty($post_category) ? $post_category[0]->name : 'Poradnik';
                        $post_read_time = dietitian_get_read_time(get_the_ID());
                        ?>
                        <article class="blog-card">
                            <a class="blog-card__media" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', ['loading' => 'lazy']); ?>
                                <?php else : ?>
                                    <span class="blog-card__placeholder" aria-hidden="true"></span>
                                <?php endif; ?>
                            </a>
                            <div class="blog-card__content">
                                <p class="blog-card__kicker"><?php echo esc_html($post_category_name); ?></p>
                                <h3 class="blog-card__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <p class="blog-card__meta">
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                                    <span aria-hidden="true">•</span>
                                    <span><?php echo esc_html($post_read_time); ?> min</span>
                                </p>
                                <p class="blog-card__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php
                $pagination = paginate_links([
                    'type'      => 'list',
                    'prev_text' => 'Poprzednia',
                    'next_text' => 'Nastepna',
                    'mid_size'  => 1,
                ]);
                ?>

                <?php if (!empty($pagination)) : ?>
                    <nav class="blog-list__pagination" aria-label="Paginacja artykulow">
                        <?php echo wp_kses_post($pagination); ?>
                    </nav>
                <?php endif; ?>
            <?php else : ?>
                <div class="blog-list__empty">
                    <h2>Brak artykulow</h2>
                    <p>Nie znaleziono wpisow dla wybranych kryteriow. Wroc do listy wszystkich tematow.</p>
                    <a class="btn btn--primary" href="<?php echo esc_url($posts_page_url); ?>">Wszystkie artykuly</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if (!is_search()) : ?>
        <?php
        $popular_query = new WP_Query([
            'post_type'           => 'post',
            'posts_per_page'      => 3,
            'ignore_sticky_posts' => true,
            'orderby'             => 'comment_count',
            'order'               => 'DESC',
        ]);
        ?>
        <?php if ($popular_query->have_posts()) : ?>
            <section class="blog-popular" id="blog-popular" aria-label="Popularne artykuly">
                <div class="container">
                    <h2 class="blog-popular__title">Popularne tematy</h2>
                    <div class="blog-popular__list">
                        <?php while ($popular_query->have_posts()) : $popular_query->the_post(); ?>
                            <article class="blog-popular__item">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?></p>
                            </article>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

    <section class="blog-cta" aria-label="Konsultacja dietetyczna">
        <div class="container blog-cta__inner">
            <p class="blog-cta__kicker">Potrzebujesz planu dla siebie?</p>
            <h2 class="blog-cta__title">Nie musisz zgadywac co zadziala - umow konsultacje.</h2>
            <p class="blog-cta__text">Jezeli temat jest bardziej zlozony, przejdziemy go krok po kroku i ulozymy plan dopasowany do Ciebie.</p>
            <a class="btn btn--primary" href="<?php echo esc_url(home_url('/#contact')); ?>">Umow konsultacje</a>
        </div>
    </section>
</main>