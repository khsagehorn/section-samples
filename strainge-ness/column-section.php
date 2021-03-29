<?php
	$margin = $fluid = $border = '';
	$swap = false;
	$blocks = mx_slider_mod::parse_blocks( return_if( $section, 'columns' ));
	$id = return_if($section, 'id');
	$section_class = return_if( $section , 'section_class');
 	if (return_if( $section, 'border' ) == 1){
		$border = 'borderline';
	}
	if (return_if( $section, 'margin' )  == 1 ){
		$margin = 'negative-margin-top';
	}
	if (return_if( $section, 'swap' )  == 1){
		$swap = true;
	}
	if (return_if( $section, 'fluid' ) == 1){
		$fluid = '-fluid';
	}
	$className = ' mx-sec mx-panel-sec  ' . return_if( $section,'section_class');
	$className.= ' '  . $margin  . ' ';
	$className.=' theme--' .return_if( $section, 'theme' , ' ' ) . ' ';
	$className.= ' position--'. return_if( $section, 'position' , 'left' );
	$video_animation = false;
	if( $animation = return_if( $section , 'video_animation' )){
		if( $video = return_if( $animation , 'video') ) {
			if( $video->type == 'external-url'){
				$video_animation  = $video->url; 
			}
		}
	}

?>
<!--==================== mx-sec Section ====================-->
<section <?= $section->_atts( $className );?>>
	<div class="sec-trigger"></div>
	<div class="container<?= $fluid; ?>">
		<div class="row flex-row-center">
			<article class="col-md-5  panel-content <?= return_if( $section, 'position' ) == 'left' ? 'order-md-2 offset-lg-1' : '';?>">
				
				<?php if ( !$swap ){
					echo Html::tag( 'div', return_if( $section, 'label'), 'display-4 label');
					echo Html::tag( $section->is_first_section ? 'h1'  : 'h2' , return_if( $section, 'header'), 'heading display-2');
				 }?>
				<?php if ( $swap ){
					Html::tag( $section->is_first_section ? 'h1'  : 'h2', return_if( $section, 'header'), 'heading display-2');
				 	echo Html::tag( 'h3', return_if( $section, 'label'), 'display-4 label');
				}?>
        		<?= markdown_content( return_if( $section, 'body' ), 'body');?>

				<?php if (return_if( $section, 'columns')){ ?>
					<div class="row columns">
						<?php foreach($blocks as $block){ ?>
							<div class="col-sm-6">
								<?= Html::tag( 'h4', return_if( $block, 'header'), 'heading display-4');?>
								<?= markdown_content( return_if( $block, 'body' ), 'col-content');?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if (return_if($section, 'cta')) { ?>
					<div class="btn-container">
		        		<?= $section->_cta('btn btn-primary btn-left' );?>
					</div>
				<?php } ?>
			</article><!-- .col-md-6 -->
			<?php if (return_if($section, 'image')){ ?>
				<figure class="panel-image col-md-5 <?= return_if( $section, 'position' ) == 'left' ? 'order-md-1' : ' offset-lg-1';?> <?= $border; ?>">
					<?= $section->_icon();?>
					<?=  $section->_image( 0 , 'large', 'tag' , 'img-fluid' , ['full']);?>
				</figure><!-- .col-md-6 -->
		<?php } else { ?>
			<div class="void col-md-5 <?= return_if( $section, 'position' ) == 'left' ? 'order-md-1' : ' offset-lg-1';?>"></div>
		<?php } ?>
		</div><!-- .row -->
	</div><!-- .container -->
	<?php if ($section_class == 'what-is-intro'){ ?>
		<video playsinline autoplay muted loop>
			<source src="<?= $video_animation ? :'/wp-content/themes/mx-theme/assets/video/SB_Mason_Jar_Animation.mp4';?>" type="video/mp4">
		</video>
	<?php } else { ?>
		<div class="featured-floater"></div>
	<?php } ?>
	<div class="vines top"></div>
	<div class="vines left"></div>
	<div class="vines right"></div>
	<?php if (return_if($section, 'section_class') == 'fermentation'){ ?>
		<video id="orange-animation" playsinline autoplay muted loop>
			<source src="<?= $video_animation ? :'/wp-content/themes/mx-theme/assets/video/SB_New_Side_Orange_Animation.mp4';?>" type="video/mp4">
		</video>
		<video id="fermentation-vines" playsinline muted>
			<source src="/wp-content/themes/mx-theme/assets/video/SB_Vine_Fermentation_Frenzy.mp4" type="video/mp4">
		</video>
	<?php } ?>
</section><!-- .mx-panel-sec -->
