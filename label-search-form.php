<?php
/*
Template Name: Label search form
*/

get_header(); ?>

    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div class="search-wrapper">
                    <form method="post" action="<?php bloginfo('url'); ?>/label-page">
                        <input
                                type="text"
                                id="label-search"
                                name="label-search"
                                placeholder="Start typing..."
                                value="">

                        <div class="form-fieldset">
                            <div class="label-field">
                                <label for="used-before">Använd före</label>
                            </div>

                            <input id="used-before"
                                   name="used-before"
                                   type="date"
                                   value=""
                            />
                        </div>
                        <div class="form-fieldset">
                            <div class="label-field">
                                <label for="manufacturing-date">Tillverkningsdatum</label>
                            </div>

                            <input id="manufacturing-date"
                                   name="manufacturing-date"
                                   type="date"
                                   value=""
                            />
                        </div>
                        <div class="form-fieldset">
                            <div class="label-field">
                                <label for="neto-weight">Nettovikt</label>
                            </div>

                            <input id="neto-weight"
                                   name="neto-weight"
                                   type="text"
                                   value=""
                            />
                        </div>
                        <button type="submit" id="label-submit">Submit</button>
                    </form>
                </div>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php get_sidebar(); ?>
    </div><!-- .wrap -->

<?php get_footer();