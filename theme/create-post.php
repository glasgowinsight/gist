<?php 
function find_style( $node){
	if($node->nodeName == 'w:pStyle'){
		return $node->attributes->getNamedItem('val')->nodeValue;
	}

	if($node->hasChildNodes()){
		foreach ($node->childNodes as $child){
			$style = find_style($child);
			if($style) return $style;
		}
	}

	return null;
}

function appendChild($out, $current, $nodeName){
	$e=$out->createElement($nodeName);
	$current->appendChild($e);
	return $e;
}

function appendAttribute($out, $current, $attrName, $attrValue){
	$e=$out->createAttribute($attrName);
	$e->value = $attrValue;
	$current->appendChild($e);
}

function visit( $node, &$out, $imgs, $current ){
	if ($node->nodeName == 'w:p'){
		if ($current->childNodes->length == 0){
			$current=appendChild($out, $current, 'h1');
		}
		else if ($current->childNodes->length == 1){
			$current=appendChild($out, $current, 'p');
			$current=appendChild($out, $current, 'strong');
		}
		else {
			$style = find_style($node);
			if($style == 'Subtitle'){
				$current=appendChild($out, $current, 'h4');
			}
			elseif($style == 'ListParagraph'){
				$ul = null;
				if($current->hasChildNodes()){
					$last=$current->childNodes->item($current->childNodes->length-1);
					if($last->nodeName == 'ul'){
						$ul = $last;
					}
				}
				if(!$ul){
					$ul=appendChild($out, $current, 'ul');
				}
				$current=appendChild($out, $ul, 'li');
			}
			else{
				$current=appendChild($out, $current, 'p');
			}
		}
	}

	if ($node->nodeName == 'w:t'){
		$e=$out->createTextNode($node->textContent);
		$current->appendChild($e);
		return;
	}
	
	if ($node->nodeName == 'a:blip'){
		$img_id=$node->attributes->getNamedItem('embed')->nodeValue;
		$current=appendChild($out, $current, 'a');
		appendAttribute($out, $current, 'href', wp_get_attachment_url($imgs[$img_id]));
		$current=appendChild($out, $current, 'img');
		appendAttribute($out, $current, 'src', wp_get_attachment_url($imgs[$img_id]));
		appendAttribute($out, $current, 'alt', '');
		appendAttribute($out, $current, 'width', '300');
		appendAttribute($out, $current, 'height', '300');
		appendAttribute($out, $current, 'class', 'alignleft size-full');
	}

	if($node->hasChildNodes()){
		foreach ($node->childNodes as $child){
			visit($child, $out, $imgs, $current);
		}
	}
}

function ends_with($file, $ext){
	return strlen($file) >= strlen($ext) && substr_compare($file, $ext, -strlen($ext), strlen($ext)) === 0;
}


function create_posts(){
	$folder = 'wp-content/uploads/articles';
	$handle = opendir($folder);
	while (false !== ($file = readdir($handle))) {
		if(ends_with($file, '.docx')){
			$docx = $folder . '/' . $file;
        	echo "Creating post for " . $docx;
			create_post_from_docx($docx);
        }
    }
    closedir($handle);
}

function create_post_from_docx($file){
	$schema = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument';
	$img_schema = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/image';
	
	$src = new ZipArchive();
	if (!$src->open($file)) {
		echo 'Unable to find the DOCX file';
		exit();
	}
	
	$r = $src->getFromName('word/_rels/document.xml.rels');
	if (!$r) {
		echo 'No data in word/_rels/document.xml.rels';
		exit();
	}
	
	$img_relations = simplexml_load_string($r);
	if(!$img_relations){
		echo 'No xml in word/_rels/document.xml.rels';
		exit();
	}
	
	$imgs = array();
	$tmp = 'tmp';
	$upload = wp_upload_dir();
	foreach ($img_relations->Relationship as $relImg) {
		if ($relImg["Type"] == $img_schema) {
			$target = 'word/' . $relImg["Target"];
			$dir=$tmp . '/' . dirname($target);
			if(!file_exists($dir)) mkdir($dir, 0777, true);
			$src->extractTo($tmp, $target);
			$img_file = $upload['path'] . '/' . basename($target);
			rename($tmp . '/' . $target, $img_file);
	
			$wp_filetype = wp_check_filetype(basename($img_file), null );
			$attachment = array(
			     'post_mime_type' => $wp_filetype['type'],
			     'post_title' => preg_replace('/\.[^.]+$/', '', basename($img_file)),
			     'post_content' => '',
			     'post_status' => 'inherit'
		     );
		     $attach_id = wp_insert_attachment( $attachment, $img_file, 37 );
		     // you must first include the image.php file
		     // for the function wp_generate_attachment_metadata() to work
		     require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		     $attach_data = wp_generate_attachment_metadata( $attach_id, $img_file );
		     wp_update_attachment_metadata( $attach_id,  $attach_data );
		     
		     $id = (string) $relImg["Id"];
		     $imgs[$id] = $attach_id;
		}
	}
	
	$r = $src->getFromName('_rels/.rels');
	if (!$r) {
		echo 'No data in _rels/.rels';
		exit();
	}
	
	$relations = simplexml_load_string($r);
	if(!$relations){
		echo 'No xml in _rels/.rels';
		exit();
	}
	
	foreach ($relations->Relationship as $rel) {
		if ($rel["Type"] == $schema) {
			$xml = $src->getFromName($rel['Target']);
	
			$xmlDOM = new DOMDocument();
			$htmlDOM = new DOMDocument();
			
			if(!$xmlDOM->loadXML($xml)){
				echo 'Could not create document';
				exit();
			}
			visit($xmlDOM, $htmlDOM, $imgs, $htmlDOM);
			
			$title = basename($file);
			foreach ($htmlDOM->childNodes as $child){
				if($child->nodeName == 'h1'){
					$title=$child->textContent;
					$htmlDOM->removeChild($child);
					break;
				}
			}
			
			$html=$htmlDOM->saveHTML();
			$my_post = array(
			     'post_title' => $title,
			     'post_content' => $html,
			     'post_status' => 'draft',
			);
			
			// Insert the post into the database
			wp_insert_post( $my_post );
		}
	}
}

?>