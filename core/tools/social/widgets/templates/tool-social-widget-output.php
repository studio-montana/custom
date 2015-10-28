<div class="widget-content">

	<?php 
	$social_item_class = "social-item";
	if (!empty($backgrounded) && $backgrounded == 'on'){
		$social_item_class .= " backgrounded";
	}
	?>

	<?php if (!empty($facebook_url)){ ?>
	<div class="<?php echo $social_item_class; ?> facebook-url">
		<a target="_blank" href="<?php echo $facebook_url; ?>" title="<?php echo esc_attr(__("facebook", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-facebook"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($twitter_url)){ ?>
	<div class="<?php echo $social_item_class; ?> twitter-url">
		<a target="_blank" href="<?php echo $twitter_url; ?>" title="<?php echo esc_attr(__("twitter", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-twitter"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($googleplus_url)){ ?>
	<div class="<?php echo $social_item_class; ?> googleplus-url">
		<a target="_blank" href="<?php echo $googleplus_url; ?>" title="<?php echo esc_attr(__("google+", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-google-plus"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($linkedin_url)){ ?>
	<div class="<?php echo $social_item_class; ?> linkedin-url">
		<a target="_blank" href="<?php echo $linkedin_url; ?>" title="<?php echo esc_attr(__("linkedin", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-linkedin"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($behance_url)){ ?>
	<div class="<?php echo $social_item_class; ?> behance-url">
		<a target="_blank" href="<?php echo $behance_url; ?>" title="<?php echo esc_attr(__("behance", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-behance"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($pinterest_url)){ ?>
	<div class="<?php echo $social_item_class; ?> pinterest-url">
		<a target="_blank" href="<?php echo $pinterest_url; ?>" title="<?php echo esc_attr(__("pinterest", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-pinterest-p"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($instagram_url)){ ?>
	<div class="<?php echo $social_item_class; ?> instagram-url">
		<a target="_blank" href="<?php echo $instagram_url; ?>" title="<?php echo esc_attr(__("instagram", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-instagram"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($vimeo_url)){ ?>
	<div class="<?php echo $social_item_class; ?> vimeo-url">
		<a target="_blank" href="<?php echo $vimeo_url; ?>" title="<?php echo esc_attr(__("vimeo", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-vimeo"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($youtube_url)){ ?>
	<div class="<?php echo $social_item_class; ?> youtube-url">
		<a target="_blank" href="<?php echo $youtube_url; ?>" title="<?php echo esc_attr(__("youtube", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-youtube-play"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($dribbble_url)){ ?>
	<div class="<?php echo $social_item_class; ?> dribbble-url">
		<a target="_blank" href="<?php echo $dribbble_url; ?>" title="<?php echo esc_attr(__("dribbble", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-dribbble"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($tumblr_url)){ ?>
	<div class="<?php echo $social_item_class; ?> tumblr-url">
		<a target="_blank" href="<?php echo $tumblr_url; ?>" title="<?php echo esc_attr(__("tumblr", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-tumblr"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($flickr_url)){ ?>
	<div class="<?php echo $social_item_class; ?> flickr-url">
		<a target="_blank" href="<?php echo $flickr_url; ?>" title="<?php echo esc_attr(__("flickr", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-flickr"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($soundcloud_url)){ ?>
	<div class="<?php echo $social_item_class; ?> soundcloud-url">
		<a target="_blank" href="<?php echo $soundcloud_url; ?>" title="<?php echo esc_attr(__("soundcloud", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-soundcloud"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($mail_url)){ ?>
	<div class="<?php echo $social_item_class; ?> mail-url">
		<a target="_blank" href="<?php echo $mail_url; ?>" title="<?php echo esc_attr(__("mail", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-envelope"></i>
		</a>
	</div>
	<?php } ?>
	<?php if (!empty($download_url)){ ?>
	<div class="<?php echo $social_item_class; ?> download-url">
		<a target="_blank" href="<?php echo $download_url; ?>" title="<?php echo esc_attr(__("download", CUSTOM_TEXT_DOMAIN)); ?>">
			<i class="fa fa-download"></i>
		</a>
	</div>
	<?php } ?>
</div>