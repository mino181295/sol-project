<?php
    $materia = $_GET['materia'];

    $files_directory = "../files/".$materia;
    $absolute_path = "./files/".$materia."/";
    if (!file_exists($files_directory)) {
        mkdir($files_directory, 0777, true);
    }
    $files = array_diff(scandir($files_directory), array('.', '..'));

?>

    <div class="row">
        <div class="col-xs-1 col-md-1 back-to-service">
            <button type="button" class="btn btn-labeled" id="back-to-service"> <span class="btn-label"><i class="glyphicon glyphicon-arrow-left"></i> </span> </button>
        </div>
        <div class="col-xs-10 col-md-10 text-center">
            <h1 id="materia-title"><?php echo ucfirst($materia);?></h1>
        </div>
    </div>

    <div class="row text-center">

        <div class="container-fluid">
            <br/>
            <div class="row">
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Upload files</strong> <small> </small></div>
                        <div class="panel-body">
                            <!-- Drop Zone -->
                            <script type="text/javascript">
                                var nomeMateria = $('#materia-title').text();
                                
                                $('#drop-zone').dropzone({
                                    addRemoveLinks: true,
                                    paramName: "file",
                                    dictDefaultMessage: "Trascina o clicca per caricare",
                                    maxFilesize: 10000,
                                    maxThumbnailFilesize: 3,
                                    init: function () {
                                        this.on('complete', function (file) {});
                                        this.on('success', function (file, json) {
                                            $.ajax({
                                                type: "POST",
                                                url: "php/insert_notification.php",
                                                data: {'materia' : nomeMateria},
                                                async: false,
                                                success: function (text) {
                                                    console.log(nomeMateria);
                                                }
                                            });
                                        });
                                        this.on('addedfile', function (file) {});
                                        this.on("dragenter", function () {});
                                        this.on("dragleave", function () {});
                                    }
                                });
                            </script>

                            <form action="php/upload.php?path=<?php echo $materia;?>" class="dropzone dz-clickable upload-drop-zone" drop-zone="" id="drop-zone">
                            </form>
                            <!-- Upload Finished -->

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Download files</strong> <small> </small></div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th data-sortable="true" class="column-01">File </th>
                                        <th data-sortable="true" class="column-02">Download</th>
                                    </tr>
                                </thead>
                                <tbody id="downloads-panel">
                                    <?php
                                        foreach($files as $name){
                                           echo '<tr>'; 
                                           echo '<td class="column-01"><a data-toggle="tooltip" title="'.$name.'" href="#">'.substr($name, 0, strpos($name, ".")).'</a></td>';
                                           echo '<td class="column-02">
                                                    
                                                        <a class="btn btn-labeled btn-primary" href="'.$absolute_path.$name.'" download> <span class="btn-label"><i class="glyphicon glyphicon-download"></i> </span> </button>
                                                 
                                                 </td>';    
                                           echo '</tr>'; 
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>