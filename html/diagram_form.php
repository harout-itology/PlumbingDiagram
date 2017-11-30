<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 10:24 AM
 */
include ('../loader.php');

if(isset($_GET['id'])){
    $diagram = new Diagram();
    $diagram_output = $diagram->view($conn,$_GET['id'] );
}

$shapes = new Shape();
$shapes_output = $shapes->get($conn);

$ports = new Port();
$ports_output = $ports->get_list($conn);

$header='';

$body = '
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="mp_menu">
                    <input id="name" value="'.@$diagram_output['name'].'" placeholder="Name" class="form-control " >
                    <button class="btn btn-default" id="SaveButton" onclick="save()"> Save</button>
                    <button class="btn btn-default" onclick="load()">Load</button>
                    <button class="btn btn-default" onclick="erase()">Erase</button>
                    <button class="btn btn-default" onclick="print()">Print</button>
            </div>
            <div id="myDiagramDiv" ></div>
            <div id="myPaletteDiv" ></div>                
        </div>
    </div>
</div>
<textarea id="mySavedModel" style="display:none" rows="10" cols="100">';

if(isset($_GET['id'])){
    $body .= $diagram_output['content'];
}
else{
    $body .='{ "class": "go.GraphLinksModel",
          "copiesArrays": true,
          "copiesArrayObjects": true,
          "linkFromPortIdProperty": "fromPort",
          "linkToPortIdProperty": "toPort",
          "nodeDataArray": [],
          "linkDataArray": []
        }';
}



$body .='</textarea>';


$footer='<!--   GoJS v1.8.2 JavaScript Library for HTML Diagrams -->
    <script src="/js/gojs.net/go.js"></script>
    <script>';
        if(isset($_GET['id'])) {
            $footer .= '
            // Show the diagrams model in JSON format that the user may edit
            function save() {
                // convert to svg
                var svg = myDiagram.makeSvg({scale: 0.5});
                // save diagram
                var temp = myDiagram.model.toJson();
                document.getElementById("mySavedModel").value = temp;
                myDiagram.isModified = false;
                window.localStorage.setItem("diagram", temp);
                // db ajax save
                xhr = new XMLHttpRequest();
                xhr.open("POST", "/html/diagram_func.php");
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    if (xhr.status === 200)
                        console.log(xhr.responseText);
                    else if (xhr.status !== 200)
                        console.log(xhr.status);
                };
                xhr.send("id='.$_GET['id'].'&name="+document.getElementById("name").value+"&content="+temp+"&image="+new XMLSerializer().serializeToString(svg));
            }';
        }
        else {
            $footer .= '
            // Show the diagrams model in JSON format that the user may edit
            function save() {
                // convert to svg
                var svg = myDiagram.makeSvg({scale: 0.5});
                // save diagram
                var temp = myDiagram.model.toJson();
                document.getElementById("mySavedModel").value = temp;
                myDiagram.isModified = false;
                window.localStorage.setItem("diagram", temp);
                // db ajax save
                xhr = new XMLHttpRequest();
                xhr.open("POST", "/html/diagram_func.php");
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");            
                xhr.onload = function() {
                    if (xhr.status === 200)                       
                        location.href= "/html/diagram_form.php?id="+xhr.responseText;
                    else if (xhr.status !== 200)
                        console.log(xhr.status);
                };
                xhr.send("name="+document.getElementById("name").value+"&content="+temp+"&image="+new XMLSerializer().serializeToString(svg));
            }
            ';
        }


        $footer .= '
        function load() {
            myDiagram.model = go.Model.fromJson(go.Model.fromJson(document.getElementById("mySavedModel").value));
        }
        function erase() {
            window.localStorage.removeItem("diagram");
            var erase  = \'{ "class": "go.GraphLinksModel",                "copiesArrays": true,                "copiesArrayObjects": true,                "linkFromPortIdProperty": "fromPort",                "linkToPortIdProperty": "toPort",                "nodeDataArray": [],                "linkDataArray": []            }\';
            document.getElementById("mySavedModel").value = erase;
            myDiagram.model = go.Model.fromJson(go.Model.fromJson(erase));
        }
        function print(){
            var newWindow = window.open("", "newWindow");
            if (!newWindow) return;
            var newDocument = newWindow.document;
            var svg = myDiagram.makeSvg({
                document: newDocument,
                scale: 2
            });
            newDocument.body.appendChild(svg);
        }
        // init()
        var myDiagram;
        var CellSize = new go.Size(10, 10);
        if (window.goSamples) goSamples();  // init for these samples -- you don\'t need to call this
        var $ = go.GraphObject.make;  // for conciseness in defining templates
        myDiagram =
                $(go.Diagram, "myDiagramDiv",
                        {
                            grid: $(go.Panel, "Grid",
                                    { gridCellSize: CellSize },
                                    $(go.Shape, "LineH", { stroke: "lightgray" }),
                                    $(go.Shape, "LineV", { stroke: "lightgray" })
                            ),
                            // support grid snapping when dragging and when resizing
                            "draggingTool.isGridSnapEnabled": true,
                            initialContentAlignment: go.Spot.Center,
                            allowDrop: true  // handle drag-and-drop from the Palette
                });
        // when the document is modified, add a "*" to the title and enable the "Save" button
        myDiagram.addDiagramListener("Modified", function(e) {
            var button = document.getElementById("SaveButton");
            if (button) button.disabled = !myDiagram.isModified;
            var idx = document.title.indexOf("*");
            if (myDiagram.isModified) {
                if (idx < 0) document.title += "*";
            } else {
                if (idx >= 0) document.title = document.title.substr(0, idx);
            }
        });
        // replace the default Link template in the linkTemplateMap
        myDiagram.linkTemplate =
                $(go.Link,  // defined below
                        {
                            routing: go.Link.Orthogonal,
                            corner: 3,
                            reshapable: true,
                            resegmentable: true
                        },
                        new go.Binding("points").makeTwoWay(),
                        $(go.Shape,
                                { stroke: "#2F4F4F", strokeWidth: 2 },
                                new go.Binding("stroke", "link")
                        )
                );';
         
        foreach($shapes_output as $item):
            $footer .= '
            myDiagram.nodeTemplateMap.add("connect'.$item['id'].'",
                $(go.Node, "Table",
                        { locationObjectName: "BODY",
                            locationSpot: go.Spot.Left,
                            selectionObjectName: "BODY"
                        },
                        new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
                        $(go.Panel, "Auto",
                        { row: 1, column: 1, name: "BODY" },
                        $(go.Shape, "'.$item['type'].'",
                        { width: "'.$item['width'].'", height: "'.$item['height'].'", fill: "'.$item['background'].'", stroke: "#888888" }),
                        $(go.TextBlock, {margin: 10, textAlign: "center", text: "'.$item['name'].'" ,  stroke: "'.$item['color'].'" })
                    ),
                    // four named ports, one on each side:
                        $(go.Panel, "Horizontal", new go.Binding("itemArray", "Top"),
                            { row: 0, column: 1, itemTemplate:
                                $(go.Panel, {
                                        _side: "top",
                                        fromSpot: go.Spot.Top, toSpot: go.Spot.Top,
                                        alignment: go.Spot.Top, alignmentFocus: go.Spot.Top,
                                        fromLinkable: true, toLinkable: true, cursor: "pointer"
                                    },
                                    new go.Binding("portId", "portId"),
                                    $(go.Shape, "Rectangle", {
                                            stroke: null, strokeWidth: 0,
                                            desiredSize: new go.Size(5, 5),
                                            margin: new go.Margin(0, 1, 0, 1 ) },
                                        new go.Binding("fill", "portColor"))
                                )
                            }
                        ),
                        $(go.Panel, "Vertical", new go.Binding("itemArray", "Right"),
                                { row: 1, column: 2, itemTemplate:
                                        $(go.Panel, {
                                                    _side: "right",
                                                    fromSpot: go.Spot.Right, toSpot: go.Spot.Right,
                                                    alignment: go.Spot.Right, alignmentFocus: go.Spot.Right,
                                                    fromLinkable: true, toLinkable: true, cursor: "pointer"
                                                },
                                                new go.Binding("portId", "portId"),
                                                $(go.Shape, "Rectangle", {
                                                            stroke: null, strokeWidth: 0,
                                                            desiredSize: new go.Size(5, 5),
                                                            margin: new go.Margin(1, 0, 1, 0 ) },
                                                        new go.Binding("fill", "portColor"))
                                        )
                                }
                        ),
                        $(go.Panel, "Horizontal", new go.Binding("itemArray", "Bottom"),
                                { row: 2, column: 1, itemTemplate:
                                        $(go.Panel, {
                                                    _side: "bottom",
                                                    fromSpot: go.Spot.Bottom, toSpot: go.Spot.Bottom,
                                                    alignment: go.Spot.Bottom, alignmentFocus: go.Spot.Bottom,
                                                    fromLinkable: true, toLinkable: true, cursor: "pointer"
                                                },
                                                new go.Binding("portId", "portId"),
                                                $(go.Shape, "Rectangle", {
                                                            stroke: null, strokeWidth: 0,
                                                            desiredSize: new go.Size(5, 5),
                                                            margin: new go.Margin(0, 1, 0, 1 ) },
                                                        new go.Binding("fill", "portColor"))
                                        )
                                }
                        ),
                        $(go.Panel, "Vertical", new go.Binding("itemArray", "Left"),
                                { row: 1, column: 0, itemTemplate:
                                        $(go.Panel, {
                                                    _side: "left",
                                                    fromSpot: go.Spot.Left, toSpot: go.Spot.Left,
                                                    alignment: go.Spot.Left, alignmentFocus: go.Spot.Left,
                                                    fromLinkable: true, toLinkable: true, cursor: "pointer"
                                                },
                                                new go.Binding("portId", "portId"),
                                                $(go.Shape, "Rectangle", {
                                                            stroke: null, strokeWidth: 0,
                                                            desiredSize: new go.Size(5, 5),
                                                            margin: new go.Margin(1, 0, 1, 0 ) },
                                                        new go.Binding("fill", "portColor"))
                                        )
                                }
                        )
                ));';

        endforeach;

        $footer .= '
        // initialize the Palette that is on the left side of the page
        myPalette =
            $(go.Palette, "myPaletteDiv",  // must name or refer to the DIV HTML element
                {
                    nodeTemplateMap: myDiagram.nodeTemplateMap,  
                    model: new go.GraphLinksModel([  ';
                            foreach($shapes_output as $item):
                                $footer .= '{ category: "connect'.$item['id'].'",
                                        Top : [';
                                                if(isset($ports_output['Top'])):
                                                    foreach($ports_output['Top'] as $p):
                                                        if($p['shape_id']==$item['id']):
                                                            $footer .= ' {"portColor":"'.$p['color'].'", "portId":"'.$p['id'].'"},';
                                                        endif;
                                                    endforeach;
                                                endif;
                                        $footer .= '],
                                        Right : [';
                                                if(isset($ports_output['Right'])):
                                                    foreach($ports_output['Right'] as $p):
                                                        if($p['shape_id']==$item['id']):
                                                            $footer .= ' {"portColor":"'.$p['color'].'", "portId":"'.$p['id'].'"},';
                                                        endif;
                                                    endforeach;
                                                endif;
                                        $footer .= '],
                                        Bottom : [';
                                                if(isset($ports_output['Bottom'])):
                                                    foreach($ports_output['Bottom'] as $p):
                                                        if($p['shape_id']==$item['id']):
                                                            $footer .= ' {"portColor":"'.$p['color'].'", "portId":"'.$p['id'].'"},';
                                                        endif;
                                                    endforeach;
                                                endif;
                                        $footer .= '],
                                        Left : [';
                                                if(isset($ports_output['Left'])):
                                                    foreach($ports_output['Left'] as $p):
                                                        if($p['shape_id']==$item['id']):
                                                            $footer .= ' {"portColor":"'.$p['color'].'", "portId":"'.$p['id'].'"},';
                                                        endif;
                                                    endforeach;
                                                endif;
                                        $footer .= ']
                                },';
                        endforeach;
                $footer .= '])
                });
        load();  // load an initial diagram from some JSON text
    </script>';

include ('master.php');

?>


