<?php
	/*
	Template Name: Post From Article
	*/
	get_header(); 
	
	?><div id="content" role="main"><?php
	
	$file = 'wp-content/uploads/2011/02/copyedited-green-giants.docx';
	$schema = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument';
	$src = new ZipArchive();
        if (!$src->open($file)) {
            echo 'Unable to find the DOCX file';
            exit();
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
                $xml = $src->getFromName(
                    $this->absoluteZipPath(
                        dirname($rel['Target']) . '/' .
                        basename($rel['Target'])
                    )
                );

                print_r(htmlentities($xml));
                
//                $xmlDOM = new DOMDocument();
//                $xml = str_replace('</w:wordDocument>', '', $xml);
//                $xml = preg_replace(
//                    '/(<w:wordDocument)+(.)*(><w:body>)/', '<w:body>', $xml
//                );
//                @$xmlDOM->loadXML($xml);
//                $xsl = new DOMDocument();
//                $xsl->load(dirname(__FILE__) . '/../xsl/docx2html.xsl');
//
//                echo "Loaded XSLT";
//                $xsltProc = new XSLTProcessor();
//                echo "Build processor";
//                
//                $xsltProc->importStylesheet($xsl);
//                $this->_xhtml = $xsltProc->transformToXML($xmlDOM);
            }
        }

//        $pattern = "'src\s*=\s*([\"\'])?(?(1) (.*?)\\1 | ([^\s\>]+))'isx";
//        preg_match_all($pattern, $this->_xhtml, $domImgs);
//
//        $idImgs = array();
//        foreach ($domImgs[0] as $dats) {
//            $datsFiltered = explode('"', $dats);
//            if (preg_match('/^\?image=rId/', $datsFiltered[1])) {
//                $datFiltered = explode('?image=', $dats);
//                $idImgs[] = substr($datFiltered[1], 0, -1);
//            }
//        }
//        $relationsImgs = simplexml_load_string(
//            $src->getFromName('word/_rels/document.xml.rels')
//        );
//        $pathImgs = array();
//        foreach ($relationsImgs->relationship as $relImg) {
//            if ($relImg["Type"] == cTransformDoc::SCHEMA_IMAGEDOCUMENT) {
//                $pathImgs[(string) $relImg["Id"]] =
//                    (string) $relImg["Target"];
//                $pathZip[] = 'word/' . (string) $relImg["Target"];
//            }
//        }
//
//        foreach ($idImgs as $datsIdImgs) {
//            $this->_xhtml = str_replace(
//                "src=\"?image=$datsIdImgs\"",
//                "src=\"files/files_" .
//                "$this->strFile/media/word/$pathImgs[$datsIdImgs]\"",
//                $this->_xhtml
//            );
//        }
//
//        if (!empty($pathZip)) {
//            $src->extractTo(
//                "files/files_$this->strFile/media", $pathZip
//            );
//            $src->close();
//        }
	
?></div>