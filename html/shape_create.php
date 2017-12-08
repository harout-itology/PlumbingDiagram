<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 10:24 AM
 */
include ('../loader.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $shape = new Shape();
    $input = $shape->set($conn, $_POST);
    if($input)
         $msg = 'Shape Successfully Added';
}

$header='';

$body = '
<div class="container">
        <div class="row">
            <div class="col-md-12">';

            if(isset($msg))
                $body .= '<div class="alert alert-success">'.$msg.'</div>';

$body .= '    <form class="form-horizontal" method="post" action=""> 
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Note</label>
                        <div class="col-md-10">
                            <input id="name" type="text" class="form-control" name="note" placeholder="Shape Note" value="" required autofocus>
                        </div>
                    </div>                 
                    <div class="form-group">
                        <label for="type" class="col-md-2 control-label">Type</label>
                        <div class="col-md-10">
                            <select id="type" class="form-control" name="type" required>
                                <option  value="Rectangle">Rectangle</option>
                                <option  value="Diamond">Diamond</option>
                                <option  value="Triangle">Triangle</option>
                                <option  value="Circle">Circle</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="width" class="col-md-2 control-label">Width</label>
                        <div class="col-md-10">
                            <input id="width" type="text" class="form-control" placeholder="Integral" name="width" value="" required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="height" class="col-md-2 control-label">Height</label>
                        <div class="col-md-10">
                            <input id="height" type="text" class="form-control" placeholder="Integral" name="height" value="" required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="background" class="col-md-2 control-label">Background</label>
                        <div class="col-md-10">
                            <input id="background" type="text" class="form-control" placeholder="Background Color" name="background" value="" required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="col-md-2 control-label">Color</label>
                        <div class="col-md-10">
                            <input id="color" type="text" class="form-control" placeholder="Text Color" name="color" value="" required >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>            
        </div>
</div>
';

$footer='';

include ('master.php');

?>


