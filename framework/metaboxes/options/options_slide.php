<div class='pyre_metabox'>

	<?php

	$this->select(
		'type',
		__( 'Background Type', 'Aione' ),
		array(
			'image'             => __( 'Image', 'Aione' ),
			'self-hosted-video' => __( 'Self-Hosted Video', 'Aione' ),
			'youtube'           => __( 'Youtube', 'Aione' ),
			'vimeo'             => __( 'Vimeo', 'Aione' )
		),
		__( 'Select an image or video slide. If using an image, please select the image in the "Featured Image" box on the right hand side.', 'Aione' )
	);
	?>

	<div class="video_settings" style="display: none;">

		<h2><?php _e( 'Video Options:', 'Aione' ); ?></h2>

		<?php
		$this->text(
			'youtube_id',
			__( 'Youtube Video ID', 'Aione' ),
			__( 'For example the Video ID for http://www.youtube.com/<strong>LOfeCR7KqUs</strong> is <strong>LOfeCR7KqUs</strong>', 'Aione' )
		);	
		$this->text(
			'vimeo_id',
			__( 'Vimeo Video ID', 'Aione' ),
			__( 'For example the Video ID for http://vimeo.com/<strong>75230326</strong> is <strong>75230326</strong>', 'Aione' )
		);
		$this->upload(
			'webm',
			__( 'Video WebM Upload', 'Aione' ),
			__( 'Video must be in a 16:9 aspect ratio. Add your WebM video file. WebM and MP4 format must be included to render your video with cross browser compatibility. OGV is optional.', 'Aione' )
		);
		$this->upload(
			'mp4',
			__( 'Video MP4 Upload', 'Aione' ),
			__( 'Video must be in a 16:9 aspect ratio. Add your MP4 video file. MP4 and WebM format must be included to render your video with cross browser compatibility. OGV is optional.', 'Aione' )
		);
		$this->upload(
			'ogv',
			__( 'Video OGV Upload', 'Aione' ),
			__( 'Add your OGV video file. This is optional.', 'Aione' )
		);
		$this->upload(
			'preview_image',
			__( 'Video Preview Image', 'Aione' ),
			__( 'IMPORTANT: This field must be used for self hosted videos. Self hosted videos do not work correctly on mobile devices. The preview image will be seen in place of your video on older browsers or mobile devices.', 'Aione' )
		);
		$this->text(
			'aspect_ratio',
			__( 'Video Aspect Ratio', 'Aione' ),
			__( 'The video will be resized to maintain this aspect ratio, this is to prevent the video from showing any black bars. Enter an aspect ratio here such as: "16:9", "4:3" or "16:10". The default is "16:9"', 'Aione' )
		);			
		$this->text(
			'video_bg_color',
			__( 'Video Color Overlay', 'Aione' ),
			__( 'Select a color to show over the video as an overlay. Hex color code, <strong>ex: #fff</strong>', 'Aione' )
		);
		$this->select(
			'mute_video',
			__( 'Mute Video', 'Aione' ),
			array( 'yes' => __( 'Yes', 'Aione' ), 'no' => __( 'No', 'Aione' ) ),
			''
		);
		$this->select(
			'autoplay_video',
			__( 'Autoplay Video', 'Aione' ),
			array( 'yes' => __( 'Yes', 'Aione' ), 'no' => __( 'No', 'Aione' ) ),
			''
		);
		$this->select(
			'loop_video',
			__( 'Loop Video', 'Aione' ),
			array( 'yes' => __( 'Yes', 'Aione' ), 'no' => __( 'No', 'Aione' ) ),
			''
		);
		$this->select(
			'hide_video_controls',
			__( 'Hide Video Controls', 'Aione' ),
			array( 'yes' => __( 'Yes', 'Aione' ), 'no' => __( 'No', 'Aione' ) ),
			__( 'If this is set to yes, then autoplay must be enabled for the video to work.', 'Aione' )
		);
		?>

	</div>

	<h2><?php _e( 'Slider Content Settings:', 'Aione' ); ?></h2>

	<?php

	$this->select(
		'content_alignment',
		__( 'Content Alignment', 'Aione' ),
		array( 'left' => __( 'Left', 'Aione' ), 'center' => __( 'Center', 'Aione' ), 'right' => __( 'Right', 'Aione' ) ),
		__( 'Select how the heading, caption and buttons will be aligned.', 'Aione' )
	);
	$this->textarea(
		'heading',
		__( 'Heading Area', 'Aione' ),
		__( 'Enter the heading for your slide. This field can take HTML markup and Oxo Shortcodes.', 'Aione' )
	);
	$this->select(
		'heading_separator',
		__( 'Heading Separator', 'Aione' ),
		array(	'none'				=> __( 'None', 'Aione' ),
				'single solid'		=> __( 'Single Solid', 'Aione' ),
				'single dashed'		=> __( 'Single Dashed', 'Aione' ),
				'single dotted'		=> __( 'Single Dotted', 'Aione' ),
				'double solid'	 	=> __( 'Double Solid', 'Aione' ),
				'double dashed'		=> __( 'Double Dashed', 'Aione' ),
				'double dotted'		=> __( 'Double Dotted', 'Aione' ),
				'underline solid'	=> __( 'Underline Solid', 'Aione' ),
				'underline dashed'	=> __( 'Underline Dashed', 'Aione' ),
				'underline dotted'	=> __( 'Underline Dotted', 'Aione' ),
				
		),
		__( 'Choose the heading separator you want to use.', 'Aione' )
	);	
	$this->text(
		'heading_font_size',
		__( 'Heading Font Size', 'Aione' ),
		__( 'Enter heading font size without px unit. In pixels, ex: 50 instead of 50px. <strong>Default: 60</strong>', 'Aione' )
	);
	$this->text(
		'heading_color',
		__( 'Heading Color', 'Aione' ),
		__( 'Select a color for the heading font. Hex color code, ex: #fff. <strong>Default: #fff</strong>', 'Aione' )
	);
	$this->select(
		'heading_bg',
		__( 'Heading Background', 'Aione' ),
		array( 'yes' => __( 'Yes', 'Aione' ), 'no' => __( 'No', 'Aione' ) ),
		__( 'Select this option if you would like a semi-transparent background behind your heading.', 'Aione' )
	);
	$this->text(
		'heading_bg_color',
		__( 'Heading Background Color', 'Aione' ),
		__( 'Select a color for the heading background. Hex color code, ex: #000. <strong>Default: #000</strong>', 'Aione' )
	);
	$this->textarea(
		'caption',
		__( 'Caption Area', 'Aione' ),
		__( 'Enter the caption for your slide. This field can take HTML markup and Oxo Shortcodes.', 'Aione' )
	);
	$this->select(
		'caption_separator',
		__( 'Caption Separator', 'Aione' ),
		array(	'none'				=> __( 'None', 'Aione' ),
				'single solid'		=> __( 'Single Solid', 'Aione' ),
				'single dashed'		=> __( 'Single Dashed', 'Aione' ),
				'single dotted'		=> __( 'Single Dotted', 'Aione' ),
				'double solid'	 	=> __( 'Double Solid', 'Aione' ),
				'double dashed'		=> __( 'Double Dashed', 'Aione' ),
				'double dotted'		=> __( 'Double Dotted', 'Aione' ),
				'underline solid'	=> __( 'Underline Solid', 'Aione' ),
				'underline dashed'	=> __( 'Underline Dashed', 'Aione' ),
				'underline dotted'	=> __( 'Underline Dotted', 'Aione' ),
				
		),
		__( 'Choose the caption separator you want to use.', 'Aione' )
	);	
	$this->text(
		'caption_font_size',
		__( 'Caption Font Size', 'Aione' ),
		__( 'Enter caption font size without px unit. In pixels, ex: 24 instead of 24px. <strong>Default: 24</strong>', 'Aione' )
	);
	$this->text(
		'caption_color',
		__( 'Caption Color', 'Aione' ),
		__( 'Select a color for the caption font. Hex color code, ex: #fff. <strong>Default: #fff</strong>', 'Aione' )
	);
	$this->select(
		'caption_bg',
		__( 'Caption Background', 'Aione' ),
		array( 'yes' => __( 'Yes', 'Aione' ), 'no' => __( 'No', 'Aione' ) ),
		__( 'Select this option if you would like a semi-transparent background behind your caption.', 'Aione' )
	);
	$this->text(
		'caption_bg_color',
		__( 'Caption Background Color', 'Aione' ),
		__( 'Select a color for the caption background. Hex color code, ex: #000. <strong>Default: #000</strong>', 'Aione' )
	);
	?>

	<h2><?php _e( 'Slide Link Settings:', 'Aione' ); ?></h2>

	<?php

	$this->select(
		'link_type',
		__( 'Slide Link Type', 'Aione' ),
		array( 'button' => __( 'Button', 'Aione' ), 'full' => __( 'Full Slide', 'Aione' ) ),
		__( 'Select how the slide will link.', 'Aione' )
	);
	$this->text(
		'slide_link',
		__( 'Slide Link', 'Aione' ),
		__( 'Please enter your URL that will be used to link the full slide.', 'Aione' )
	);
	$this->select(
		'slide_target',
		__( 'Open Slide Link In New Window', 'Aione' ),
		array( 'yes' => __( 'Yes', 'Aione' ), 'no' => __( 'No', 'Aione' ) )
	);
	$this->textarea(
		'button_1',
		__( 'Button #1', 'Aione' ) . '<br/><a href="http://oxosolutions.com/knowledgebase/aione-shortcode-list/#buttons" target="_blank">' . __( 'Click here to view button option descriptions.', 'Aione' ) . '</a>',
		__( 'Adjust the button shortcode parameters for the first button.', 'Aione' ),
		'[button link="" color="default" size="" type="" shape="" target="_self" title="" gradient_colors="|" gradient_hover_colors="|" accent_color="" accent_hover_color="" bevel_color="" border_width="1px" shadow="" icon="" icon_divider="yes" icon_position="left" modal="" animation_type="0" animation_direction="down" animation_speed="0.1" class="" id=""]Button Text[/button]'
	);
	$this->textarea(
		'button_2',
		__( 'Button #2', 'Aione' ) . '<br/><a href="http://oxosolutions.com/knowledgebase/aione-shortcode-list/#buttons" target="_blank">' . __( 'Click here to view button option descriptions.', 'Aione' ) . '</a>',
		__( 'Adjust the button shortcode parameters for the second button.', 'Aione' ),
		'[button link="" color="default" size="" type="" shape="" target="_self" title="" gradient_colors="|" gradient_hover_colors="|" accent_color="" accent_hover_color="" bevel_color="" border_width="1px" shadow="" icon="" icon_divider="yes" icon_position="left" modal="" animation_type="0" animation_direction="down" animation_speed="0.1" class="" id=""]Button Text[/button]'
	);
	?>

</div>
<div class="clear"></div>
