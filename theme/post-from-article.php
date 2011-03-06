<?php
	/*
	Template Name: Post From Article
	*/
	require_once TEMPLATEPATH . '/phpdocx/classes/TransformDoc.inc';
	
	get_header(); 
	
	?><div id="content" role="main"><?php
	echo phpinfo();
	
	$document = new TransformDoc();
	$document->setStrFile('wp-content/uploads/2011/02/copyedited-green-giants.docx');
	echo "Loaded file";
	$document->generateXHTML();
	echo "Generated";
	$document->validatorXHTML();
	echo "Validated";
	echo $document->getStrXHTML();
	echo "Print";
	
?></div>