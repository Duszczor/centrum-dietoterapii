<?php

/**
 * Development seed tools for blog content preview.
 * Temporary utility intended for local/staging use only.
 */

function dietitian_dev_seed_is_allowed(): bool
{
    return current_user_can('manage_options') && wp_get_environment_type() !== 'production';
}

function dietitian_dev_get_or_create_term(string $taxonomy, string $name, string $slug): int
{
    $existing_term = get_term_by('slug', $slug, $taxonomy);

    if ($existing_term instanceof WP_Term) {
        return (int) $existing_term->term_id;
    }

    $created_term = wp_insert_term($name, $taxonomy, [
        'slug' => $slug,
    ]);

    if (is_wp_error($created_term)) {
        return 0;
    }

    return (int) ($created_term['term_id'] ?? 0);
}

function dietitian_dev_get_seed_posts_data(): array
{
    return [
        [
            'title'    => 'Insulinoopornosc: od czego zaczac pierwsze zmiany',
            'slug'     => 'insulinoopornosc-od-czego-zaczac-pierwsze-zmiany',
            'category' => 'insulinoopornosc',
            'tags'     => ['insulinoopornosc', 'nawyki', 'plan-startowy'],
            'excerpt'  => 'Praktyczny plan na pierwsze 7 dni bez rewolucji i bez skrajnych zalecen.',
            'content'  => '<p>Insulinoopornosc nie wymaga perfekcji od pierwszego dnia. Najczesciej najlepsze efekty daje uporzadkowanie rytmu posilkow, zwiekszenie sycacego bialka i ograniczenie przypadkowego podjadania miedzy posilkami.</p><p>W praktyce warto zaczac od trzech prostych ruchow: regularnych por posilkow, spaceru po obiedzie i lepszego komponowania sniadan. To zmiany, ktore realnie obnizaja chaos w glodzie i pomagaja odzyskac przewidywalnosc energii w ciagu dnia.</p><p>Dopiero na tym fundamencie warto dokladac kolejne elementy, takie jak planowanie zakupow, wieksza ilosc warzyw czy praca nad snem. Bez bazy nawet dobra dieta szybko staje sie trudna do utrzymania.</p>',
        ],
        [
            'title'    => '5 sycacych sniadan przy insulinoopornosci',
            'slug'     => '5-sycacych-sniadan-przy-insulinoopornosci',
            'category' => 'insulinoopornosc',
            'tags'     => ['sniadanie', 'insulinoopornosc', 'przepisy'],
            'excerpt'  => 'Pomysly na szybkie sniadania, ktore pomagaja ograniczyc wilczy glod przed poludniem.',
            'content'  => '<p>Dobre sniadanie przy insulinoopornosci powinno laczyc bialko, blonnik i tluszcz. Taki zestaw stabilizuje sygnaly glodu i zmniejsza ryzyko, ze po dwoch godzinach pojawi sie potrzeba siegniecia po cos slodkiego.</p><p>W praktyce dobrze sprawdzaja sie kanapki z pasta jajeczna, owsianka z jogurtem skyr i pestkami, omlet warzywny czy twarozek z pieczywem zytnim. Nie chodzi o idealna liste produktow, ale o strukture posilku.</p><p>Jesli rano trudno Ci jesc, zacznij od mniejszej porcji i zwroc uwage na to, jak zmienia sie koncentracja oraz sytnosc do lunchu. To czesto daje szybki i odczuwalny efekt.</p>',
        ],
        [
            'title'    => 'Czy spacer po posilku naprawde pomaga?',
            'slug'     => 'czy-spacer-po-posilku-naprawde-pomaga',
            'category' => 'insulinoopornosc',
            'tags'     => ['ruch', 'glikemia', 'nawyki'],
            'excerpt'  => 'Krótki ruch po jedzeniu potrafi byc prostszy i skuteczniejszy niz kolejna restrykcja.',
            'content'  => '<p>Po posilku organizm pracuje nad wykorzystaniem dostepnej energii. Krótki spacer moze wspierac ten proces i poprawiac samopoczucie bez koniecznosci wdrazania intensywnych treningow.</p><p>Najwazniejsza jest regularnosc, nie perfekcja. Nawet 10-15 minut spokojnego marszu po obiedzie lub kolacji moze byc latwiejsze do utrzymania niz ambitny plan cwiczen trzy razy w tygodniu.</p><p>To dobra strategia zwlaszcza wtedy, gdy masz siedzący tryb pracy, duzo stresu i malo przestrzeni na rozbudowany plan aktywnosci.</p>',
        ],
        [
            'title'    => 'PCOS i apetyt na slodkie: co zwykle nie dziala',
            'slug'     => 'pcos-i-apetyt-na-slodkie-co-zwykle-nie-dziala',
            'category' => 'pcos',
            'tags'     => ['pcos', 'slodycze', 'apetyt'],
            'excerpt'  => 'Restrykcyjne odciecie slodyczy rzadko jest rozwiazaniem. Lepsza jest praca na przyczynach.',
            'content'  => '<p>Przy PCOS apetyt na slodkie czesto nasila sie wtedy, gdy w ciagu dnia jest za malo regularnosci, zbyt malo bialka lub zbyt duzy deficyt energii. Sam zakaz jedzenia slodyczy nie rozwiazuje problemu.</p><p>Dużo lepiej dziala analiza dnia: ile jest realnych posilkow, jak wyglada sen i czy glod nie narasta przez kilka godzin bez jedzenia. Gdy fundament jest stabilniejszy, ochota na slodkie zazwyczaj maleje.</p><p>Warto tez pracowac nad tym, by slodki smak nie byl jedynym sposobem na ulge po stresujacym dniu. To czesto element szerszego obrazu, nie kwestia braku silnej woli.</p>',
        ],
        [
            'title'    => 'PCOS a regularnosc posilkow w zabieganym tygodniu',
            'slug'     => 'pcos-a-regularnosc-posilkow-w-zabieganym-tygodniu',
            'category' => 'pcos',
            'tags'     => ['pcos', 'organizacja', 'posilki'],
            'excerpt'  => 'Jak ulozyc jedzenie tak, zeby plan byl realny w pracy, podrozy i pomiedzy obowiazkami.',
            'content'  => '<p>Regularnosc nie oznacza jedzenia co do minuty. Oznacza raczej przewidywalny rytm, dzieki ktoremu glod nie wymyka sie spod kontroli pod wieczor.</p><p>Przy zabieganym tygodniu dobrze sprawdza sie plan awaryjny: gotowe przekaski, dwa szybkie sniadania rotacyjne i lista produktow, z ktorych w 10 minut da sie zlozyc sycacy posilek.</p><p>To podejscie jest mniej efektowne niz gotowy jadlospis na siedem dni, ale zwykle o wiele bardziej utrzymywalne na dluzsza mete.</p>',
        ],
        [
            'title'    => 'Badania przy PCOS: ktore wyniki warto omowic z dietetykiem',
            'slug'     => 'badania-przy-pcos-ktore-wyniki-warto-omowic-z-dietetykiem',
            'category' => 'pcos',
            'tags'     => ['pcos', 'badania', 'konsultacja'],
            'excerpt'  => 'Nie chodzi o zbieranie wszystkich badan, tylko o umiejetne polaczenie danych z objawami.',
            'content'  => '<p>W pracy dietetycznej najwazniejsze jest laczenie wynikow badan z codziennym funkcjonowaniem: poziomem energii, sytnoscia, cyklem, snem i stresem. Sam wynik poza kontekstem niewiele mowi.</p><p>Dlatego przed konsultacja warto uporzadkowac nie tylko dokumentacje, ale tez zapisac swoje obserwacje. Kiedy pojawia sie glod? Jak wyglada poranek? Czy jest spadek energii po obiedzie? Takie dane bardzo ulatwiaja dobranie strategii.</p><p>Dobra interpretacja badan ma sluzyc decyzjom, a nie budowaniu poczucia, ze trzeba od razu kontrolowac wszystko naraz.</p>',
        ],
        [
            'title'    => 'Odchudzanie bez liczenia kazdej kalorii',
            'slug'     => 'odchudzanie-bez-liczenia-kazdej-kalorii',
            'category' => 'odchudzanie',
            'tags'     => ['odchudzanie', 'nawyki', 'bez-liczenia'],
            'excerpt'  => 'W wielu przypadkach lepiej dziala struktura posilkow niz ciagle sledzenie liczb.',
            'content'  => '<p>Liczenie kalorii nie jest jedyną droga do redukcji masy ciala. Dla wielu osob bardziej pomocne okazuje sie ustalenie prostych ram: regularnych posilkow, wiekszej objetosci warzyw, lepszego planu zakupow i sensownych porcji bialka.</p><p>Taki system daje mniej zmeczenia decyzyjnego i latwiej go utrzymac takze po intensywnym dniu pracy. Nie eliminuje to swiadomosci jedzenia, ale przesuwa nacisk z kontroli na powtarzalne zachowania.</p><p>Jesli celem jest dlugofalowa zmiana, prostota i przewidywalnosc bardzo czesto wygrywaja z perfekcyjnym planem.</p>',
        ],
        [
            'title'    => 'Co jesc przed spotkaniem, zeby nie wpasc w wilczy glod wieczorem',
            'slug'     => 'co-jesc-przed-spotkaniem-zeby-nie-wpasc-w-wilczy-glod-wieczorem',
            'category' => 'odchudzanie',
            'tags'     => ['odchudzanie', 'glod', 'planowanie'],
            'excerpt'  => 'Wieczorne napady glodu czesto zaczynaja sie duzo wczesniej, niz sie wydaje.',
            'content'  => '<p>Gdy od rana jesz za malo albo zbyt nieregularnie, wieczor zwykle staje sie trudny. Organizm nadrabia deficyt energii i wtedy trudniej zatrzymac sie na jednej porcji.</p><p>Dobrym zabezpieczeniem jest wczesniej zaplanowany posilek lub przekaska z bialkiem i blonnikiem. To moze byc jogurt wysokobialkowy, kanapka z twarozkiem albo porcja obiadu przed wyjsciem.</p><p>Nie chodzi o jedzenie na zapas, tylko o to, by nie wchodzic w wymagajaca sytuacje z rosnacym glodem i mala iloscia energii.</p>',
        ],
        [
            'title'    => 'Jak wyglada redukcja, ktora nie rozwala weekendow',
            'slug'     => 'jak-wyglada-redukcja-ktora-nie-rozwala-weekendow',
            'category' => 'odchudzanie',
            'tags'     => ['odchudzanie', 'weekend', 'elastycznosc'],
            'excerpt'  => 'Plan redukcji powinien dzialac takze wtedy, gdy pojawia sie wyjscia i spotkania.',
            'content'  => '<p>Jesli plan dziala tylko od poniedzialku do piatku, to nie jest jeszcze dobry plan. Weekend nie powinien byc "wyjatkiem", ale normalna czescia zycia, dla ktorej tez warto miec strategie.</p><p>Dobrze sprawdza sie myslenie o najwazniejszych kotwicach: sniadaniu, nawodnieniu, przewidywalnym obiedzie i elastycznym miejscu na przyjemnosc. To pomaga utrzymac kierunek bez poczucia utraty kontroli.</p><p>Najwazniejsze jest odejscie od schematu restrykcja - odreagowanie. Bez tego kazdy kolejny tydzien zaczyna sie od "naprawiania" weekendu.</p>',
        ],
        [
            'title'    => 'Wzdecia po zdrowych produktach: skad sie biora',
            'slug'     => 'wzdecia-po-zdrowych-produktach-skad-sie-biora',
            'category' => 'jelita',
            'tags'     => ['jelita', 'wzdecia', 'trawienie'],
            'excerpt'  => 'Nie kazda zdrowa zmiana jest od razu dobrze tolerowana przez uklad pokarmowy.',
            'content'  => '<p>Wzdecia po zwiekszeniu ilosci warzyw, straczkow czy produktow pelnoziarnistych nie musza oznaczac, ze te produkty sa dla Ciebie zle. Czasem problemem jest tempo zmian, wielkosc porcji albo ogolny poziom stresu.</p><p>Jelita zwykle lepiej reaguja na stopniowe budowanie tolerancji niz na nagla rewolucje pod haslem zdrowego odzywiania. Pomaga tez obserwacja konkretnych kombinacji posilkow, a nie ocenianie pojedynczego skladnika w oderwaniu od reszty.</p><p>W praktyce duzo daje spokojniejsze tempo jedzenia, prostsze skladniki na kilka dni i porzadne nawodnienie.</p>',
        ],
        [
            'title'    => 'Jak prowadzic dzienniczek objawow jelitowych, zeby mial sens',
            'slug'     => 'jak-prowadzic-dzienniczek-objawow-jelitowych-zeby-mial-sens',
            'category' => 'jelita',
            'tags'     => ['jelita', 'obserwacja', 'objawy'],
            'excerpt'  => 'Chaotyczne notatki rzadko pomagaja. Dobrze prowadzona obserwacja daje konkretne wnioski.',
            'content'  => '<p>Dzienniczek objawow ma sens wtedy, gdy zbiera kilka prostych informacji: godziny posilkow, glowne skladniki, poziom stresu, sen i charakter objawow. Nie musi byc perfekcyjny, ale powinien byc czytelny.</p><p>Najwiekszym bledem jest notowanie wszystkiego bez zadnego klucza. Wtedy trudno zauwazyc wzorce i odroznic powtarzalny problem od jednorazowej reakcji.</p><p>Przy analizie objawow liczy sie takze kontekst: tempo jedzenia, wyjscie do restauracji, dluższa przerwa miedzy posilkami czy intensywny tydzien. To czesto zmienia interpretacje.</p>',
        ],
        [
            'title'    => '3 sygnaly, ze Twoje jelita potrzebuja prostszego jadlospisu na chwile',
            'slug'     => '3-sygnaly-ze-twoje-jelita-potrzebuja-prostszego-jadlospisu-na-chwile',
            'category' => 'jelita',
            'tags'     => ['jelita', 'jadlospis', 'prostota'],
            'excerpt'  => 'Czasem mniej bodzcow w diecie daje wiecej informacji i szybsza ulge w objawach.',
            'content'  => '<p>Gdy objawy jelitowe sa nasilone, dokladanie kolejnych zdrowych produktow, suplementow i eksperymentow rzadko pomaga. Znacznie bezpieczniej jest na kilka dni uproscic jadlospis i obserwowac reakcje.</p><p>Takie uproszczenie nie oznacza ubogiej diety na zawsze. To raczej narzedzie diagnostyczne i uspokajajace, ktore pozwala lepiej zrozumiec, co sluzy, a co nasila dyskomfort.</p><p>Najczesciej dobrze dziala plan z przewidywalnymi posilkami, mniejsza iloscia mieszanek skladnikow i ograniczeniem jedzenia w biegu.</p>',
        ],
    ];
}

function dietitian_dev_seed_test_posts(): int
{
    $category_map = [
        'insulinoopornosc' => dietitian_dev_get_or_create_term('category', 'Insulinoopornosc', 'insulinoopornosc'),
        'pcos'             => dietitian_dev_get_or_create_term('category', 'PCOS', 'pcos'),
        'odchudzanie'      => dietitian_dev_get_or_create_term('category', 'Odchudzanie', 'odchudzanie'),
        'jelita'           => dietitian_dev_get_or_create_term('category', 'Jelita', 'jelita'),
    ];

    $created_posts = 0;
    $seed_posts = dietitian_dev_get_seed_posts_data();

    foreach ($seed_posts as $index => $post_data) {
        $existing_post = get_page_by_path((string) $post_data['slug'], OBJECT, 'post');

        if ($existing_post instanceof WP_Post) {
            continue;
        }

        $publish_date = gmdate('Y-m-d H:i:s', strtotime('-' . (count($seed_posts) - $index) . ' days 09:00:00'));
        $post_id = wp_insert_post([
            'post_type'     => 'post',
            'post_status'   => 'publish',
            'post_title'    => (string) $post_data['title'],
            'post_name'     => (string) $post_data['slug'],
            'post_excerpt'  => (string) $post_data['excerpt'],
            'post_content'  => (string) $post_data['content'],
            'post_date'     => get_date_from_gmt($publish_date),
            'post_date_gmt' => $publish_date,
        ]);

        if (is_wp_error($post_id) || $post_id === 0) {
            continue;
        }

        $category_slug = (string) ($post_data['category'] ?? '');
        $category_id = (int) ($category_map[$category_slug] ?? 0);

        if ($category_id > 0) {
            wp_set_post_terms($post_id, [$category_id], 'category');
        }

        if (!empty($post_data['tags']) && is_array($post_data['tags'])) {
            wp_set_post_terms($post_id, $post_data['tags'], 'post_tag');
        }

        update_post_meta($post_id, '_dietitian_seeded_test_post', '1');
        $created_posts++;
    }

    return $created_posts;
}

function dietitian_dev_delete_seed_test_posts(): int
{
    $seeded_posts = get_posts([
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'meta_key'       => '_dietitian_seeded_test_post',
        'meta_value'     => '1',
    ]);

    $deleted_posts = 0;

    foreach ($seeded_posts as $post_id) {
        if (wp_delete_post((int) $post_id, true) instanceof WP_Post) {
            $deleted_posts++;
        }
    }

    return $deleted_posts;
}

function dietitian_dev_handle_seed_actions(): void
{
    if (!is_admin() || !dietitian_dev_seed_is_allowed()) {
        return;
    }

    if (isset($_GET['dietitian_seed_posts'])) {
        $created_posts = dietitian_dev_seed_test_posts();
        wp_safe_redirect(add_query_arg('dietitian_seed_result', (string) $created_posts, admin_url()));
        exit;
    }

    if (isset($_GET['dietitian_clear_seed_posts'])) {
        $deleted_posts = dietitian_dev_delete_seed_test_posts();
        wp_safe_redirect(add_query_arg('dietitian_clear_seed_result', (string) $deleted_posts, admin_url()));
        exit;
    }
}

add_action('admin_init', 'dietitian_dev_handle_seed_actions');

function dietitian_dev_seed_admin_notice(): void
{
    if (!is_admin() || !dietitian_dev_seed_is_allowed()) {
        return;
    }

    if (isset($_GET['dietitian_seed_result'])) {
        $created_posts = max(0, (int) $_GET['dietitian_seed_result']);
        echo '<div class="notice notice-success is-dismissible"><p>Utworzono testowe wpisy blogowe: ' . esc_html((string) $created_posts) . '.</p></div>';
    }

    if (isset($_GET['dietitian_clear_seed_result'])) {
        $deleted_posts = max(0, (int) $_GET['dietitian_clear_seed_result']);
        echo '<div class="notice notice-warning is-dismissible"><p>Usunieto testowe wpisy blogowe: ' . esc_html((string) $deleted_posts) . '.</p></div>';
    }
}

add_action('admin_notices', 'dietitian_dev_seed_admin_notice');
