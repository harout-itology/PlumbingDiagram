<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 10:24 AM
 */
include ('../loader.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ports = new Port();
    $ports->edit($conn,$_POST);
    $msg = 'Ports Successfully Edited';
}

$shape = new Shape();
$input = $shape->view($conn, $_GET['id']);
$ports = new Port();
$input_port = $ports->get($conn,$_GET['id']);

$header='';

$body = '
<div class="container">
        <div class="row">
            <div class="col-md-12">';

            if(isset($msg))
                $body .= '<div class="alert alert-success">'.$msg.'</div>';

$body .= ' <form class="form-horizontal" method="post" action="">
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Note</label>
                        <div class="col-md-10">
                            <input id="name" type="text" class="form-control"  placeholder="Shape Note" value="'.$input['note'].'"  disabled>
                        </div>
                    </div>               
                    <div class="form-group">
                        <label for="background" class="col-md-2 control-label">Background</label>
                        <div class="col-md-10">
                            <input id="background" type="text" class="form-control" placeholder="Background Color" name="background" value="'.$input['background'].'" disabled >
                        </div>
                    </div>   
                    <hr>    
                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-2">
                            <label>Port Name</label>
                        </div>
                        <div class="col-md-3">
                            <label>Port Type</label>
                        </div>
                        <div class="col-md-3">
                            <label>Port Color</label>
                        </div>
                        <div class="col-md-1">
                            <button type="button" id="add" class="btn btn-primary"> &nbsp; Add &nbsp; </button>
                        </div>
                    </div>        
';


$body .= '<div id="ports">';

foreach ($input_port as $items){
    $body .= ' <div class="form-group" id="'.$items['id'].'">
                    <div class="col-md-3 col-md-offset-2">
                        <input type="text" class="form-control" name="name[]" placeholder="Port Name" value="'.$items['name'].'" required  >
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="type[]" required>
                                                                                    <option '; if($items['type']=='Top')$body .='selected'; $body .= 'value="Top">Top</option>
                                                                                    <option '; if($items['type']=='Right')$body .='selected'; $body .= ' value="Right">Right</option>
                                                                                    <option '; if($items['type']=='Bottom')$body .='selected'; $body .= ' value="Bottom">Bottom</option>
                                                                                    <option '; if($items['type']=='Left')$body .='selected'; $body .= ' value="Left">Left</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                                    <input type="text" class="form-control" name="color[]" placeholder="Port Color" value="'.$items['color'].'"  required>
                    </div>
                    <div class="col-md-1">
                                    <button type="button" onclick="hid('.$items['id'].')" class="btn btn-danger">Delete</button>
                                    <input type="hidden" class="form-control" name="id[]" id="hid'.$items['id'].'" value="'.$items['id'].'"  >
                    </div>
              </div>';
}

$body .= '
        </div>
         <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                         <input type="hidden" value="'.$_GET['id'].'" name="shape_id"> 
         </div>   
         </form>         
        </div>
    </div>
</div>';


$footer='<script>

    function hid(id){
        $("#"+id).hide();
        $("#hid"+id).val(id*-1);
    }    
    
    $(\'#add\').on(\'click\', function(){
    var id= new Date().getTime();
    var new_port =
    \'<div class="form-group" id="\'+id+\'">\'+
        \'<div class="col-md-3 col-md-offset-2">\'+
            \'<input type="text" class="form-control" name="name[]" placeholder="Port Name" value="" required>\'+
            \'</div>\'+
        \'<div class="col-md-3">\'+
            \'<select class="form-control" name="type[]" required>\'+
                \'<option value="Top">Top</option>\'+
                \'<option value="Right">Right</option>\'+
                \'<option value="Bottom">Bottom</option>\'+
                \'<option value="Left">Left</option>\'+
                \'</select>\'+
            \'</div>\'+
        \'<div class="col-md-3">\'+
            \'<input type="text" class="form-control" name="color[]" placeholder="Port Color" value="" required>\'+
            \'</div>\'+
        \'<div class="col-md-1">\'+
            \'<button onclick="del(\'+id+\')"  type="button" class="btn btn-danger">Delete</button>\'+
            \'<input type="hidden" class="form-control" name="id[]" value="0"  >\'+
            \'</div>\'+
        \'</div> \';
    $(\'#ports\').append(new_port);
    });
    
    function del(id){
            $("#"+id).remove();
        }

</script>';

include ('master.php');

?>


