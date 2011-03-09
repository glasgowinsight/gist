<?php
/*
 Template Name: Post From Article
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);
get_header();
include TEMPLATEPATH . '/create-post.php';
?>
<div id="content" role="main"><?php create_posts() ?></div>
