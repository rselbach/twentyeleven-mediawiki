<?php
/**
 * Wordpress TwentyEleven theme adapted for MediaWiki.
 *
 * @link http://github.com/samwilson/mediawiki_twentyeleven
 * @ingroup Skins
 */
if( !defined( 'MEDIAWIKI' ) ) die( -1 );

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @ingroup Skins
 */
class SkinTwentyEleven extends SkinTemplate {

	var $skinname = 'twentyeleven', $stylename = 'twentyeleven',
		$template = 'TwentyElevenTemplate', $useHeadElement = true;

	function setupSkinUserCss( OutputPage $out ) {
		global $wgHandheldStyle;

		parent::setupSkinUserCss( $out );
$out->addMeta('teste', 'teste');
		$out->addStyle( 'twentyeleven/twentyeleven.css', 'screen' );
		$out->addStyle( 'twentyeleven/rtl.css',       'screen', '', 'rtl' );
		$out->addStyle( 'twentyeleven/main.css',      'screen' );
	$out->addHeadItem( 'teste', '<link rel="openid2.provider" href="http://robteix.com/blog/index.php/openid/server" /> 
			<link rel="openid2.local_id" href="http://robteix.com/blog/author/robteix/" /> 
			<link rel="openid.server" href="http://robteix.com/blog/index.php/openid/server" /> 
			<link rel="openid.delegate" href="http://robteix.com/blog/author/robteix/" />
<link href=\'http://fonts.googleapis.com/css?family=Permanent+Marker\' rel=\'stylesheet\' type=\'text/css\'>
<link href=\'http://fonts.googleapis.com/css?family=Lato:regular,regularitalic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\'/>' ); 
	}
}

/**
 * @todo document
 * @ingroup Skins
 */
class TwentyElevenTemplate extends QuickTemplate {
	var $skin;
	/**
	 * Template filter callback for TwentyEleven skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */
	function execute() {
		global $wgRequest, $wgSitename, $wgTwentyElevenHeader, $wgStylePath, $wgUser;

		$this->skin = $skin = $this->data['skin'];
		$action = $wgRequest->getText( 'action' );
		
		$this->set( 'sitename', $wgSitename );
		
		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

		$this->html( 'headelement' );
?>
<div id="page" class="hfeed">
<div id="wrapper">
	<header id="branding" role="banner">
			<hgroup>
				<h1 id="site-title">
				<a href="/" rel="home">
                                                <?php echo $this->text('sitename') ?>
                                        </a></h1>

				<h2 id="site-description"><?php $this->msg('tagline'); ?></h2>
			</hgroup>

			 <?php $headerSrc = (isset($wgTwentyElevenHeader)) ? $wgTwentyElevenHeader : "$wgStylePath/twentyeleven/headers/path.jpg" ?>
			<?php if (isset($wgTwentyElevenHeader)) { ?>
			 <img src="<?php echo $wgTwentyElevenHeader ?>" alt="Header image" />
			<?php } ?>
			<!-- ?php et_search_form(); ?> -->
<!--<form method="get" id="searchform" action="https://robteix.com/"> 
		<label for="s" class="assistive-text">Search</label> 
		<input type="text" class="field" name="s" id="s" placeholder="Search"/> 
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="Search"/> 
	</form> -->



        <form method="get" id="searchform" action="http://robteix.com/search">

<input type="hidden" name="cx" value="partner-pub-1810195308266767:4009721379">
<input type="hidden" name="cof" value="FORID:10">
<input type="hidden" name="ie" value="UTF-8">

                <input type="text" class="field" name="q" id="s" placeholder="Search" />
                <input type="submit" class="submit" name="sa" id="searchsubmit" value="Search" />
                <input name="siteurl" type="hidden" value="robteix.com">
        </form>




			<nav id="access" role="navigation">
                                <div class="menu">
                                        <ul>
                                                <?php foreach ($this->data['sidebar']['MENUBAR'] as $menuitem): ?>
                                                <li class="page_item">
                                                        <a href="<?php echo $menuitem['href'] ?>"><?php echo $menuitem['text'] ?></a>
                                                </li>
                                                <?php endforeach ?>
                                        </ul>
                                </div>
			</nav><!-- #access -->
	</header><!-- #branding -->


	<div id="main">




     <div id="primary">
			<div id="content" role="main">			
				<div class="post type-post status-publish format-standard hentry category-tips tag-emacs tag-windows">
					<h2 class="entry-title"><?php $this->html('title') ?></h2>
					<div class="entry-meta">
						<?php $this->html('subtitle') ?>
					</div><!-- .entry-meta -->
					
					<div class="entry-content">
						<?php $this->html('bodytext') ?>
						<!--<?php if($this->data['catlinks']) { $this->html('catlinks'); } ?>-->
						<!--<?php if($this->data['dataAfterContent']) { $this->html ('dataAfterContent'); } ?>-->
					</div>
				</div>
			
			</div><!-- #content -->
		</div><!-- #primary -->
		
	</div><!-- #main -->



		<div id="colophon">

<?php if ($wgUser->isLoggedIn()) { ?>
			<div id="footer-widget-area" >
			
				<div id="first" class="widget-area">
					<ul class="xoxo">
			<?php
				foreach($this->data['content_actions'] as $key => $tab) {
					echo '
				 <li id="' . Sanitizer::escapeId( "ca-$key" ) . '"';
					if( $tab['class'] ) {
						echo ' class="'.htmlspecialchars($tab['class']).'"';
					}
					echo '><a href="'.htmlspecialchars($tab['href']).'"';
					# We don't want to give the watch tab an accesskey if the
					# page is being edited, because that conflicts with the
					# accesskey on the watch checkbox.  We also don't want to
					# give the edit tab an accesskey, because that's fairly su-
					# perfluous and conflicts with an accesskey (Ctrl-E) often
					# used for editing in Safari.
				 	if( in_array( $action, array( 'edit', 'submit' ) )
				 	&& in_array( $key, array( 'edit', 'watch', 'unwatch' ))) {
				 		echo $skin->tooltip( "ca-$key" );
				 	} else {
				 		echo $skin->tooltipAndAccesskeyAttribs( "ca-$key" );
				 	}
				 	echo '>'.htmlspecialchars($tab['text']).'</a></li>';
				} ?>
					</ul>
				</div><!-- #first .widget-area -->
			
				<div id="second" class="widget-area">
					<ul class="xoxo">
					<?php $this->toolbox() ?>
					</ul>
				</div><!-- #second .widget-area -->
				
				<div id="third" class="widget-area">
					<ul class="xoxo" <?php $this->html('userlangattributes') ?>>
					<?php foreach($this->data['personal_urls'] as $key => $item) { ?>
						<li id="<?php echo Sanitizer::escapeId( "pt-$key" ) ?>"<?php
						if ($item['active']) { ?> class="active"<?php } ?>><a href="<?php
						echo htmlspecialchars($item['href']) ?>"<?php echo $skin->tooltipAndAccesskeyAttribs('pt-'.$key) ?><?php
						if(!empty($item['class'])) { ?> class="<?php
						echo htmlspecialchars($item['class']) ?>"<?php } ?>><?php
						echo htmlspecialchars($item['text']) ?></a></li>
					<?php } ?>
					</ul>
				</div><!-- #third .widget-area -->

				<div id="fourth" class="widget-area">
					<ul class="xoxo">
					<?php if($this->data['copyrightico']) echo '<li>'.$this->html('copyrightico').'</li>';
					// Generate additional footer links
					$footerlinks = array('lastmod', 'viewcount', 'numberofwatchingusers', 'credits', 'copyright', 'privacy', 'about', 'disclaimer', 'tagline');
					$validFooterLinks = array();
					foreach( $footerlinks as $aLink ) {
						if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) $validFooterLinks[] = $aLink;
					}
					foreach( $validFooterLinks as $aLink ):
						if( isset( $this->data[$aLink] ) && $this->data[$aLink] ): ?>
					<li id="<?php echo $aLink ?>"><?php $this->html($aLink) ?></li>
						<?php endif ?>
					<?php endforeach ?>
					</ul>
				</div><!-- #fourth .widget-area -->				
				
			</div><!-- #footer-widget-area -->

<?php } ?>

		<div style="background: #F9F9F9;border-top: 1px solid #DDD;color: #666;font-size: 12px;line-height: 2.2em;padding: 2.2em 0.5em;text-align: center;">
Copyright &copy; 2007-2011, Roberto Teixeira. All rights reserved.
		</div>

		</div><!-- #colophon -->
</div><!-- #wrapper -->
</div><!-- page -->
<?php $this->html('bottomscripts'); /* JS call to runBodyOnloadHook */ ?>
</body>
</html>



	<?php
	wfRestoreWarnings();
	} // end of execute() method

	/*************************************************************************************************/
	function searchBox() {
		global $wgUseTwoButtonsSearchForm;
?>
	<li class="widget-container">
		<h3 class="widget-title"><label for="searchInput"><?php $this->msg('search') ?></label></h3>
			<form action="<?php $this->text('wgScript') ?>" id="searchform">
				<input type='hidden' name="title" value="<?php $this->text('searchtitle') ?>"/>
				<?php
		echo Html::input( 'search',
			isset( $this->data['search'] ) ? $this->data['search'] : '', 'search',
			array(
				'id' => 'searchInput',
				'title' => $this->skin->titleAttrib( 'search' ),
				'accesskey' => $this->skin->accesskey( 'search' )
			) ); ?>

				<input type='submit' name="go" class="searchButton" id="searchGoButton"
				value="<?php $this->msg('searcharticle') ?>"<?php echo $this->skin->tooltipAndAccesskeyAttribs( 'search-go' ); ?> />

			</form>
	</li>
<?php
	}

	function logo() {
		?>
		<li class="widget-container logo">
			<a href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href'])?>"<?php
			echo $this->skin->tooltipAndAccesskeyAttribs('p-logo') ?>>
				<img src="<?php $this->text('logopath') ?>" alt="Site Logo" />
			</a>
		</li>
		<?php
	}

	/*************************************************************************************************/
	function toolbox() {
		if($this->data['notspecialpage']) { ?>
				<li id="t-whatlinkshere"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['whatlinkshere']['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-whatlinkshere') ?>><?php $this->msg('whatlinkshere') ?></a></li>
<?php
			if( $this->data['nav_urls']['recentchangeslinked'] ) { ?>
				<li id="t-recentchangeslinked"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['recentchangeslinked']['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-recentchangeslinked') ?>><?php $this->msg('recentchangeslinked-toolbox') ?></a></li>
<?php 		}
		}
		if( isset( $this->data['nav_urls']['trackbacklink'] ) && $this->data['nav_urls']['trackbacklink'] ) { ?>
			<li id="t-trackbacklink"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['trackbacklink']['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-trackbacklink') ?>><?php $this->msg('trackbacklink') ?></a></li>
<?php 	}
		if($this->data['feeds']) { ?>
			<li id="feedlinks"><?php foreach($this->data['feeds'] as $key => $feed) {
					?><a id="<?php echo Sanitizer::escapeId( "feed-$key" ) ?>" href="<?php
					echo htmlspecialchars($feed['href']) ?>" rel="alternate" type="application/<?php echo $key ?>+xml" class="feedlink"<?php echo $this->skin->tooltipAndAccesskeyAttribs('feed-'.$key) ?>><?php echo htmlspecialchars($feed['text'])?></a>&nbsp;
					<?php } ?></li><?php
		}

		foreach( array('contributions', 'log', 'blockip', 'emailuser', 'upload', 'specialpages') as $special ) {

			if($this->data['nav_urls'][$special]) {
				?><li id="t-<?php echo $special ?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-'.$special) ?>><?php $this->msg($special) ?></a></li>
<?php		}
		}

		if(!empty($this->data['nav_urls']['print']['href'])) { ?>
				<li id="t-print"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['print']['href'])
				?>" rel="alternate"<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-print') ?>><?php $this->msg('printableversion') ?></a></li><?php
		}

		if(!empty($this->data['nav_urls']['permalink']['href'])) { ?>
				<li id="t-permalink"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['permalink']['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskeyAttribs('t-permalink') ?>><?php $this->msg('permalink') ?></a></li><?php
		} elseif ($this->data['nav_urls']['permalink']['href'] === '') { ?>
				<li id="t-ispermalink"<?php echo $this->skin->tooltip('t-ispermalink') ?>><?php $this->msg('permalink') ?></li><?php
		}

		wfRunHooks( 'TwentyElevenTemplateToolboxEnd', array( &$this ) );
		wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );
	}

	/*************************************************************************************************/
	function languageBox() {
		if( $this->data['language_urls'] ) {
?>
	<li class="widget-container">
		<h3 class="widget-title" <?php $this->html('userlangattributes') ?>><?php $this->msg('otherlanguages') ?></h3>
			<ul>
<?php		foreach($this->data['language_urls'] as $langlink) { ?>
				<li class="<?php echo htmlspecialchars($langlink['class'])?>"><?php
				?><a href="<?php echo htmlspecialchars($langlink['href']) ?>"><?php echo $langlink['text'] ?></a></li>
<?php		} ?>
			</ul>
	</li>
<?php
		}
	}

	/*************************************************************************************************/
	function customBox( $bar, $cont ) { ?>

		<li class='widget-container' id='<?php echo Sanitizer::escapeId( "p-$bar" ) ?>'<?php echo $this->skin->tooltip('p-'.$bar) ?>>
		<h3 class="widget-title">
			<?php $out = wfMsg( $bar );
			if (wfEmptyMsg($bar, $out)) echo htmlspecialchars($bar);
			else echo htmlspecialchars($out); ?>
		</h3>
<?php   if ( is_array( $cont ) ) { ?>
			<ul>
<?php 			foreach($cont as $key => $val) { ?>
				<li id="<?php echo Sanitizer::escapeId($val['id']) ?>"<?php if ( $val['active'] ) { ?> class="active" <?php }
				?>><a href="<?php echo htmlspecialchars($val['href']) ?>"<?php echo $this->skin->tooltipAndAccesskeyAttribs($val['id']) ?>>
					<?php echo htmlspecialchars($val['text']) ?></a>
				</li>
<?php			} ?>
			</ul>
<?php   } else {
			# allow raw HTML block to be defined by extensions
			print $cont;
		}
		echo '</li>';

	} // customBox()
	
} // end of class


