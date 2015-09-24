<?php

return array(
	'revoke_main' => array(
		'name' => 'Слайдер',
		'term' => 'slide',
		'term_plural' => 'slides',
		'order' => 'ASC',
		'options' => array(
			'description' => array(
				'type' => 'text',
				'description' => 'Enter description of the slide',
				'title' => 'Description',
			),
			'image' => array(
				'type' => 'image',
				'description' => 'Image of the slide',
				'title' => 'Image',
				'default' => 'holder.js/960x407/auto'
			),
			'url' => array(
				'type' => 'line',
				'description' => '(Optional) URL applied to the title',
				'title' => 'URL',
				'default' => ''
			)
		),
		'output_default' => 'main',
		'output' => array(
			'main' => array(
				'shortcode' => 'tesla_main_slider',
				'view' => 'views/main_slider_view',
				'shortcode_defaults' => array(
		            'style' => '',
		            'speed' => 4,
		            'pause' => 8,
		            'toggle_caption' => true
				)
			)
		),
		'icon' => '../images/favicon.ico'
	),
	'revoke_clients' => array(
		'name' => 'Приятели Slider',
		'term' => 'slide',
		'term_plural' => 'slides',
		'order' => 'ASC',
		'options' => array(
			'image' => array(
				'type' => 'image',
				'description' => 'Снимки/лога',
				'title' => 'Image',
				'default' => 'holder.js/144x65/auto'
			),
			'url' => array(
				'type' => 'line',
				'description' => '(Optional) URL for the image',
				'title' => 'URL',
				'default' => ''
			),
			'url' => array(
				'type' => 'line',
				'description' => '(Optional) URL for the image',
				'title' => 'URL',
				'default' => ''
			)
		),
		'output_default' => 'main',
		'output' => array(
			'main' => array(
				'shortcode' => 'tesla_clients_slider',
				'view' => 'views/clients_slider_view',
				'shortcode_defaults' => array(
					'title' => __('АЙляк Приятели','revoke'),
					'style' => 'style',
					'target' => ''
				)
			)
		),
		'icon' => '../images/favicon.ico'
	),
	'revoke_secondary' => array(
		'name' => 'Secondary Slider',
		'term' => 'slide',
		'term_plural' => 'slides',
		'order' => 'ASC',
		'options' => array(
			'image' => array(
				'type' => 'image',
				'description' => 'Image of the slide',
				'title' => 'Image',
				'default' => 'holder.js/682x330/auto'
			)
		),
		'output_default' => 'main',
		'output' => array(
			'main' => array(
				'shortcode' => 'tesla_secondary_slider',
				'view' => 'views/secondary_slider_view',
				'shortcode_defaults' => array(
		            'style' => '',
		            'speed' => 4,
		            'pause' => 8
				)
			)
		),
		'icon' => '../images/favicon.ico'
	),
	'revoke_portfolio' => array(
		'name' => 'Галерия',
		'term' => 'portfolio item',
		'term_plural' => 'portfolio items',
		'has_single' => true,
		'order' => 'DESC',
		'url' => _go('portfolio_url'),
		'options' => array(
			'small_description' => array(
				'type' => 'text',
				'description' => 'Enter the small description of the portfolio item',
				'title' => 'Small Description (shown in the Grid View)',
			),
			'big_description' => array(
				'type' => 'text',
				'description' => 'Enter the big description of the portfolio item',
				'title' => 'Big Description (shown in the List View)',
			),
			'related_description' => array(
				'type' => 'text',
				'description' => 'Enter the description shown in the related slider',
				'title' => 'Related Slider Description (shown on a related Single Project Page in the Related Slider)',
			),
			'small_image' => array(
				'type' => 'image',
				'description' => 'Small image of the portoflio item',
				'title' => 'Small Image (shown in the Grid View)',
				'default' => 'holder.js/240x240/auto'
			),
			'big_image' => array(
				'type' => 'image',
				'description' => 'Big image of the portfolio item',
				'title' => 'Big Image (shown in the List View)',
				'default' => 'holder.js/445x215/auto'
			),
			'video' => array(
				'type' => 'line',
				'description' => 'Paste the embedded video code here. This video will be displayed in the portfolio shortcode. Settings this option will disable "Small Description", "Small Image" and "Big Image" optons.',
				'title' => 'Embedded Video (optional)'
			),
			'related_image' => array(
				'type' => 'image',
				'description' => 'Image for related slider',
				'title' => 'Related Slider Image (shown on a related Single Project Page in the Related Slider)',
				'default' => 'holder.js/193x132/auto'
			),
			'slider' => array(
				'type' => array(
					'image' => array(
						'type' => 'image',
						'description' => 'Select an image.',
						'title' => 'Image',
						'default' => 'holder.js/627x330/auto',
					),
					'video' => array(
						'type' => 'line',
						'description' => 'Paste the embedded video code here.',
						'title' => 'Video'
					)
				),
				'description' => 'Set either an image or a video for each slider.',
				'title' => 'Project Slider (shown on the Single Project Page)',
				'multiple' => true,
				'group' => false
			),
			'slider_speed' => array(
				'type' => 'line',
				'description' => 'Set the nr of seconds until the next slide is shown. Default is 4.',
				'title' => 'Slider speed interval (optional)',
				'default' => '4'
			),
			'slider_resume' => array(
				'type' => 'line',
				'description' => 'Set the nr of second after the slider will resume autoplay. The autoplay is paused when the user hovers the cursor over the slider. Default is 8.',
				'title' => 'Slider resume interval (optional)',
				'default' => '8'
			),
			'info' => array(
				'title' => 'Project Description (shown on the Single Project Page)',
				'description' => '',
				'type' => array(
					'title' => array(
						'title' => 'Заглавие',
						'description' => '',
						'type' => 'line'
					),
					'content' => array(
						'title' => 'Съдържание',
						'description' => '',
						'type' => array(
							'text' => array(
								'title' => 'Text',
								'description' => '',
								'type' => 'text'
							),
							'fields' => array(
								'title' => 'Fields',
								'description' => '',
								'type' => array(
									'name' => array(
										'title' => 'Field name',
										'description' => '',
										'type' => 'line'
									),
									'value' => array(
										'title' => 'Field value',
										'description' => '',
										'type' => 'line'
									)
								),
								'multiple' => true
							)
						),
						'group' => false
					),
				),
				'multiple' => true
			),
			'more' => array(
				'type' => 'line',
				'description' => '(Optional) Enter a custom URL instead of the default link to single project page',
				'title' => 'Read More URL',
				'default' => ''
			)
		),
		'output_default' => 'main',
		'output' => array(
			'main' => array(
				'shortcode' => 'tesla_portfolio',
				'view' => 'views/portfolio_view',
				'shortcode_defaults' => array(
					'no_more' => false,
					'default_view' => 'default',
					'nr' => 0,
					'title' => __('Галерия:', 'revoke'),
					'categories_filter' => ''
				)
			),
			'single' => array(
				'view' => 'views/portfolio_single_view'
			)
		),
		'icon' => '../images/favicon.ico'
	),
	'revoke_testimonial' => array(
		'name' => 'Отзиви',
		'term' => 'testimonial',
		'term_plural' => 'testimonials',
		'order' => 'ASC',
		'options' => array(
			'testimonial' => array(
				'type' => 'text',
				'description' => 'Enter text of the testimonial',
				'title' => 'Testimonial',
			),
			'image' => array(
				'type' => 'image',
				'description' => 'Author\'s image',
				'title' => 'Author\' Image',
				'default' => 'holder.js/126x126/auto'
			),
			'author' => array(
				'type' => 'line',
				'description' => 'Author of the testimonial (Ex. John Doe)',
				'title' => 'Author\'s Name',
				'default' => ''
			),
			'url' => array(
				'type' => 'line',
				'description' => '(Optional) url to the author\'s page',
				'title' => 'Author\'s Url',
				'default' => ''
			)
		),
		'output_default' => 'main',
		'output' => array(
			'main' => array(
				'shortcode' => 'tesla_testimonial',
				'view' => 'views/testimonial_view',
				'shortcode_defaults' => array(
		            'wide' => true,
		            'class' => '',
		            'speed' => 4,
					'pause' => 8
				)
			),
			'alt' => array(
				'shortcode' => 'tesla_testimonials',
				'view' => 'views/testimonial_view',
				'shortcode_defaults' => array(
		            'wide' => true,
		            'class' => '',
		            'speed' => 4,
					'pause' => 8
				)
			)
		),
		'icon' => '../images/favicon.ico'
	)
);