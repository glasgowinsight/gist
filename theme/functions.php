<?php

function id_by_slug($slug){
        return get_category_by_slug($slug)->term_id;
}
        
function get_category_link_by_slug($cat_name){
        $id = id_by_slug($cat_name);
        return get_category_link($id);
}

?>