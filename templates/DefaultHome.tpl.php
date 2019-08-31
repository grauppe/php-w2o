<?php
	$this->assign('title','W2O | Home');
	$this->assign('nav','home');

	$this->display('_Header.tpl.php');
?>

	<div class="container">

		<!-- Main hero unit for a primary marketing message or call to action -->
		<div class="hero-unit">
			<h1>Feito! <i class="icon-thumbs-up"></i></h1>
			<p>Aplicação teste feito para nivelamento de conhecimentos, utilizando as seguintes ferramentas abaixo.</p>
			<p>Christian Raphael Grauppe.</p>
		</div>

		<!-- Example row of columns -->
		<div class="row">
			<div class="span3">
				<h2><i class="icon-cogs"></i> Phreeze</h2>
				 <p>Phreeze is a MVC+ORM framework for PHP that provides
				 URL routing, object-oriented DB access and
				 RESTful JSON services which are consumed by the view layer.</p>
				<p><a class="btn" href="https://github.com/jasonhinkle/phreeze">About Phreeze &raquo;</a></p>
			</div>
			<div class="span3">
				<h2><i class="icon-th"></i> Backbone</h2>
				 <p>Backbone.js is a Javascript framework that is utilized to provide
				 client-side templates, model binding and persistance using AJAX
				 calls to the back-end RESTful services.</p>
				<p><a class="btn" href="http://documentcloud.github.com/backbone/">About Backbone &raquo;</a></p>
		 	</div>
			<div class="span3">
				<h2><i class="icon-twitter-sign"></i> Bootstrap</h2>
				<p>Bootstrap by Twitter provides a clean, cross-browser layout
				and user interface components.  Bootstrap is a complete front-end toolkit with
				ready-to-use functional components.</p>
				<p><a class="btn" href="http://twitter.github.com/bootstrap/">About Bootstrap &raquo;</a></p>
			</div>
			<div class="span3">
				<h2><i class="icon-signin"></i> Libraries</h2>
				<p>The following open-source libraries are used in this application:
				<a href="https://github.com/eternicode/bootstrap-datepicker">datepicker</a>,
				<a href="https://github.com/danielfarrell/bootstrap-combobox">combobox</a>,
				<a href="http://fortawesome.github.com/Font-Awesome/">FontAwesome</a>,
				<a href="http://jquery.com/">jQuery</a>,
				<a href="http://labjs.com/">LABjs</a>,
				<a href="http://documentcloud.github.com/underscore/">Underscore</a>,
				<a href="http://phpsavant.com/">Savant</a>,
				<a href="https://github.com/jdewit/bootstrap-timepicker">timepicker</a>,
				<a href="http://docs.jquery.com/Qunit">QUnit</a>.
				All libraries and plugins have a permissive license for personal and commercial use.
				</p>
			</div>
		</div>

	</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>