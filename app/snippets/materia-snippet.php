<?php
    $materia = strtolower($_GET['materia']);
?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip({
                placement: 'top'
            });
            /* end dot nav */
        });
    </script>

    <style type="text/css">
        /*table layout - last column*/
        
        table tr td:last-child {
            white-space: nowrap;
            width: 1px;
            text-align: right;
        }
        /* layout.css Style */
        
        .upload-drop-zone {
            height: 200px;
            border-width: 2px;
            margin-bottom: 20px;
        }
        /* skin.css Style*/
        
        .upload-drop-zone {
            color: #ccc;
            border-style: dashed;
            border-color: #ccc;
            line-height: 200px;
            text-align: center
        }
        
        .upload-drop-zone.drop {
            color: #222;
            border-color: #222;
        }
        
        .image-preview-input {
            position: relative;
            overflow: hidden;
            margin: 0px;
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }
        
        .image-preview-input input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        
        .image-preview-input-title {
            margin-left: 2px;
        }
    </style>
    <div class="row text-center">
        <h1><?php echo ucfirst($materia); ?></h1>

        <div class="container-fluid">
            <br />
            <div class="row">
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Upload files</strong> <small> </small></div>
                        <div class="panel-body">
                            <div class="input-group image-preview">
                                <input placeholder="" type="text" class="form-control image-preview-filename" disabled="disabled">
                                <!-- don't give a name === doesn't send on POST/GET -->
                                <span class="input-group-btn"> 
						<!-- image-preview-clear button -->
						<button type="button" class="btn btn-default image-preview-clear" style="display:none;"> <span class="glyphicon glyphicon-remove"></span> Clear </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input"> <span class="glyphicon glyphicon-folder-open"></span> <span class="image-preview-input-title">Browse</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview" />
                                    <!-- rename it -->
                                </div>
                                <button type="button" class="btn btn-labeled btn-default"> <span class="btn-label"><i class="glyphicon glyphicon-upload"></i> </span>Upload</button>
                                </span>
                            </div>
                            <!-- /input-group image-preview [TO HERE]-->

                            <br />

                            <!-- Drop Zone -->
                            <div class="upload-drop-zone" id="drop-zone"> Or drag and drop files here </div>

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
                                <tbody>
                                    <tr>
                                        <td class="column-01"><a data-toggle="tooltip" title="Download <FileName>" href="#">Catalogue</a></td>
                                        <td class="column-02">
                                            <button type="button" class="btn btn-labeled btn-primary" data-toggle="tooltip" title="Download <FileName>"> <span class="btn-label"><i class="glyphicon glyphicon-download"></i> </span> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="column-01"><a data-toggle="tooltip" title="Download <FileName>" href="#">Delta</a></td>
                                        <td class="column-02">
                                            <button type="button" class="btn btn-labeled btn-primary" data-toggle="tooltip" title="Download <FileName>"> <span class="btn-label"><i class="glyphicon glyphicon-download"></i> </span> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="column-01"><a data-toggle="tooltip" title="Download <FileName>" href="#">Another file</a></td>
                                        <td class="column-02">
                                            <button type="button" class="btn btn-labeled btn-primary" data-toggle="tooltip" title="Download <FileName>"> <span class="btn-label"><i class="glyphicon glyphicon-download"></i> </span> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="column-01"><a data-toggle="tooltip" title="Download <FileName>" href="#">Another file</a></td>
                                        <td class="column-02">
                                            <button type="button" class="btn btn-labeled btn-primary" data-toggle="tooltip" title="Download <FileName>"> <span class="btn-label"><i class="glyphicon glyphicon-download"></i> </span> </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Campus File</strong> <small> </small></div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th data-sortable="true" class="column-01">File </th>
                                        <th data-sortable="true" class="column-02">Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="column-01"><a data-toggle="tooltip" title="Download <FileName>" href="#">Catalogue</a></td>
                                        <td class="column-02">
                                            <button type="button" class="btn btn-labeled btn-primary" data-toggle="tooltip" title="Download <FileName>"> <span class="btn-label"><i class="glyphicon glyphicon-download"></i> </span> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="column-01"><a data-toggle="tooltip" title="Download <FileName>" href="#">Delta</a></td>
                                        <td class="column-02">
                                            <button type="button" class="btn btn-labeled btn-primary" data-toggle="tooltip" title="Download <FileName>"> <span class="btn-label"><i class="glyphicon glyphicon-download"></i> </span> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="column-01"><a data-toggle="tooltip" title="Download <FileName>" href="#">Another file</a></td>
                                        <td class="column-02">
                                            <button type="button" class="btn btn-labeled btn-primary" data-toggle="tooltip" title="Download <FileName>"> <span class="btn-label"><i class="glyphicon glyphicon-download"></i> </span> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="column-01"><a data-toggle="tooltip" title="Download <FileName>" href="#">Another file</a></td>
                                        <td class="column-02">
                                            <button type="button" class="btn btn-labeled btn-primary" data-toggle="tooltip" title="Download <FileName>"> <span class="btn-label"><i class="glyphicon glyphicon-download"></i> </span> </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>