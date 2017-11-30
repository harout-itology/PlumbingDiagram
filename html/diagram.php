<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 10:24 AM
 */
include ('../loader.php');
$diagram = new Diagram();
$output = $diagram->get($conn);

$header='';

$body = '
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="/html/diagram_form.php" class="btn btn-primary pull-right btn-sm">Create New</a><br><br>
            </div>';
            foreach ($output as $item) {
                $body .= '
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a href="/html/diagram_form.php?id='.$item['id'].'"><div class="img btn">'.
                                $item['image']
                            .'</div></a>
                            <div class="caption">
                                <h3>'.$item['name'].'</h3>                                
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
$body .=  '
        </div>
</div>
';

$footer='';

include ('master.php');

?>


