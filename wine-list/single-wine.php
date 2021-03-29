<?php



  // if the post exists on the section
  if( $post = return_if($section, "wine", return_if( $section , 'post')) ) {
    // get the post from the supplied post ID, parse post fields
    $post = Atw_app::parse_archive_wine( $post );
  }
?>

<section class="single-wine" style="background-color:<?= $post->background_color; ?>" id="<?= $post->post_name; ?>">
  <div class="container horiz">
    <article>
      <?= Html::tag('h2', $post->post_title); ?>
      <div class="content">
        <?= Html::tag('p', $post->post_content); ?>
      </div>
      <!-- <a href="/retail-locations" class="btn">Where to buy</a> -->
      <figure class="animal">
        <?= $post->animal_wine->_get( 'medium', 'tag');?>
      </figure>
    </article>

    <figure class="bottle">
      <?= $post->image->_get( 'medium_large', 'tag');?>
      <?php if(strlen($post->status_badge) > 12){ ?>
      <div class="out-of-stock sans-serif">
        <span><?= mxf::is_toggled($post, 'status_badge'); ?></span>
      </div>
    <?php } ?>
    </figure>
    <aside>
      <input type="checkbox" class="toggler" id="panel-<?= $post->post_name; ?>">
      <label class="toggler" for="panel-<?= $post->post_name; ?>"><span class="small sans-serif bold">More Info</span></label>
      <div class="toggle-target">
        <div class="details fancy-border">
          <h3 class="small sans-serif bold">Varietal</h3>
          <?= Html::tag('p', return_if($post, 'varietal'), 'italic'); ?>
          <h3 class="small sans-serif bold">Region</h3>
          <?= Html::tag('p', return_if($post, 'region'), 'italic'); ?>
          <h3 class="small sans-serif bold">Alcohol by Volume</h3>
          <?= Html::tag('p', return_if($post, 'abv'), 'italic'); ?>
        </div>
        <div class="pair">
          <h3 class="small sans-serif bold">Pair With</h3>
          <?= Html::tag('p', return_if($post, 'pair_with'), 'pair-copy sans-serif'); ?>
        </div>
      </div>
    </aside>
  </div>
</section>



<?php /**

<!-- SCHEMA
  {
    "id": "single-product",
    "label": "Single Wine Section",
    "description": "This section features a single wine, with all of its associated information and imagery.",
    "fields": [
      {"name": "legend", "type": "legend", "label": "Choose a Wine"},
      {"name": "wine", "type": "posts", "label": "wines", "options": {"post_type": "wine"}}
    ]
  }
 // SCHEMA -->
**/ ?>
