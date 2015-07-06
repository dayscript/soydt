<?php
foreach($data as $key=>$row){
    echo "<div style='padding:20px;border-bottom:1px solid black;'>";
    echo "<pre>";
    print_r($key);
    print_r($row);
    echo "</pre>";
    echo "</div>";
}
