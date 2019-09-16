<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js zero-margin"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(' | '); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta name="google-site-verification" content="fGFeahrLzP681BcmcxKaNhXhLg8ZSQueY2vC1cOKu4w" />

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#000000">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
		<meta name="theme-color" content="#000000">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<script src="https://use.fontawesome.com/5ecbfa525f.js"></script>
		
		<script src="https://use.typekit.net/vwq3pfx.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>
		
		<script>
		  (function(d) {
			var config = {
			  kitId: 'ckh6kbl',
			  scriptTimeout: 3000,
			  async: true
			},
			h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
		  })(document);
		</script>
		
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-98404573-1', 'auto');
			ga('send', 'pageview');
		</script>
		
		<?php wp_head(); ?>
		<?php $options = get_option('rh_settings'); ?>
	</head>

	<body itemscope itemtype="http://schema.org/WebPage" data-layout="<?php echo get_post_meta(get_the_ID(), 'new_project', true); ?>">

		<div id="container">

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

                <nav role="navigation" class="side-menu" itemscope itemtype="http://schema.org/SiteNavigationElement">
                    <ul>
                        <li><a href="#intro">intro</a></li>
                        <li><a href="#mini-meal">mini meal</a></li>
                        <li><a href="#mindful">mindful</a></li>
                        <li><a href="#sensory">sensory</a></li>
                        <li><a href="#responsibilities">responsibilities</a></li>
                        <li><a href="#adventure">adventure</a></li>
                        <li><a href="#hungry">hungry</a></li>
                    </ul>
                </nav>

			</header>
