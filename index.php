<?php
    // include_once('csvimporter.php');
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    set_time_limit(0);
    ignore_user_abort(true);
    include_once('hquery.php');
    
    $url = "https://www.reddit.com";
    $html = hQuery::fromUrl($url, ['Accept' => 'text/html,application/xhtml+xml;q=0.9,*/*;q=0.8']);
    $score = 'title';
    $rel = 'rel';
    $json_array = array();
    if($html) {
        $table = $html->find('#siteTable', 0);
        $things = $table->find('.thing', 0);
        
        foreach($things as $thing) {
            $titles = $thing->find('.title', 0)->find('a',0);
            $users = $thing->find('.midcol', 0)->find('.unvoted',0);
            $obj->title=strip_tags($titles[0]);
            $obj->score = $users[0]->$score;
            array_push($json_array, array("title" => "$titles[0]", "value" => $users[0]->$score));

        }
        echo json_encode($json_array);
    }
?>