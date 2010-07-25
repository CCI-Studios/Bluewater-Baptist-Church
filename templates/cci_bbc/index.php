<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
    $testing = true;

    $menu = JSite::getMenu();
    if ($menu)
        $menu = $menu->getActive();
    if ($menu)
        $menu = $menu->alias;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<jdoc:include type="head" />
	
	<link rel="stylesheet" type="text/css" href="/templates/cci_bbc/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="/templates/cci_bbc/css/template.css" />
	<script type="text/javascript" src="/templates/cci_bbc/scripts/scripts.js"></script>
    <link rel="shortcut icon" href="/templates/cci_bbc/images/favicon.ico" />
</head>

<body class="<?php echo $menu; ?>">
	<div id="wrapper">
		<?php if ($this->countModules('top')): ?>
		<div id="top">
			<jdoc:include type="modules" name="top" style="xhtml" />
		</div>
		<?php endif; // top ?>
		
		<?php if ($this->countModules('menu')): ?>
		<div id="menu">
			<jdoc:include type="modules" name="menu" style="xhtml" />
		</div>
		<?php endif; // menu ?>
		
		<?php if (($menu == 'home' && $this->countModules('mastheadHome')) || ($menu != 'home' && $this->countModules('masthead'))): ?>
		<div id="masthead">
			<jdoc:include type="modules" name="mastheadHome" style="xhtml" />
			<jdoc:include type="modules" name="masthead" style="xhtml" />
		</div>
		<?php endif; // masthead ?>
		
		<div id="body">
			<div id="component" class="<?php if (($menu == 'home' && $this->countModules('sidebarHome')) || ($menu != 'home' && $this->countModules('sidebar'))) { echo 'narrow'; } ?>">
				<jdoc:include type="component" />
			</div>
			
			<?php if (($menu == 'home' && $this->countModules('sidebarHome')) || ($menu != 'home' && $this->countModules('sidebar'))): ?>
			<div id="sidebar">
				<jdoc:include type="modules" name="sidebarHome" style="xhtml" />
				<jdoc:include type="modules" name="sidebar" style="xhtml" />
			</div>
			<?php endif; // sidebar ?>
			<div class="clear"></div>
		</div><!-- /body -->
		
		<div id="footer">
			<div class="left">
				Site By <a href="http://www.ccistudios.com" target="_blank">CCI Studios</a>
			</div>
			
			<div class="right">
				&copy;<?php echo date('Y'); ?> Bluewater Baptist Church
			</div>
			
			<div class="clear"></div>
		</div>
	</div><!-- /wrapper -->
	
	<div class="hidden">
		<jdoc:include type="modules" name="hidden" style="raw" />
	</div>
</body>
</html>