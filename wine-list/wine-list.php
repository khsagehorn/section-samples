<?php
  $mx_page = mx_page_for_archive('wine');
  $wine_nav = '';
  $mx_page->sections = return_if( $mx_page, 'sections', ( object ) [ 'rows' => []]);
  $rows = [];
  if ($posts){
    foreach ($posts as &$post){
      $post = Atw_app::parse_archive_wine( $post );
      $row = ( object ) ['post' => $post  ];
      $row = mx_slider_mod::stub_section( 'single-wine-section' , $row );
      $rows[]= $row;
      unset($post);
    }
  }
  // add the posts rows to the end of the sections
  mx_slider_mod::insert_sections_at( $mx_page->sections , $rows );

  // get the "rows" from sections where "above_content"
  $disruptors = mx_slider_mod::get_sections_by( $mx_page->sections , 'above_content'  , true   );

  // add the $disruptors at the middle.
  mx_slider_mod::insert_sections_at( $mx_page->sections , $disruptors->rows  , floor( count( $mx_page->sections->rows)  / 2 )  );
	get_header();
?>
<section class="wine-archive">

<!-- Build the wine navigation -->
<?= Html::tag( 'h1', mxf::is_toggled( $mx_page, 'toggle_and_title' , $mx_page->post_title ), 'super-jumbo ');?>
  <?php if ($posts ) { ?>
  <div class="nav-outer">
    <div class="container">
      <?php // prx($posts); ?>
      <ul class="wine-nav horiz count-<?= count($posts) ?>">
        <?php foreach ($posts as $k => &$post){ ?>
          <li class="wine-btn k-<?= $k?>" >
            <a href="#<?= $post->post_name; ?>" title="Scroll to <?= $post->post_title?>">
              <figure class="animal vertical-align">
                <?= is_object($post->animal_grapes) ? $post->animal_grapes->_get( 'medium', 'tag') : '';?>
              </figure>
              <div class="background" style="background-color:<?= $post->background_color; ?>">
              </div>
              <p class="sans-serif text-center h3"><?= $post->post_title; ?></p>
            </a>
          </li><!-- .wine-btn -->
        <?php  } ?>
      </ul><!-- .wine-nav -->
      <div class="wine-nav-copy italic">
        <?= Html::tag('p', return_if($mx_page, 'post_content')); ?>
      </div><!-- .wine-nav-copy -->
    </div><!-- .container -->
  </div><!-- .nav-outer -->

  <?= mx_slider_mod::render_sections(  return_if( $mx_page, 'sections' ) , $mx_page );?>

    <div class = 'd-none'>
    <?php } ?>
  </div>
</section>
<?php get_footer(); ?>
