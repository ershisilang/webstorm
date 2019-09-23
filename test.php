<?php



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Document</title>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?24878ba02373ef0bb0a828acf30bb257";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <script  src="https://code.jquery.com/jquery-3.3.1.js"            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">



    <style type="text/css">
        .nav{font-size:20px;
            color: #0084ff;
        }

        .container{

            padding-top:2em;
            padding-left:3em;

        }




        #time{
            width:25em;
        }



    </style>

</head>
<body>


<br /><br />
<div class="container">
    <div class="table-responsitive">
        <table class="table table-bordered">
            <table id="employee_data" class="table table-striped table-bordered">

                <thead>
                <tr>
                    <th>股票名称</th>
                    <th>提醒内容</th>
                    <th>操作</th>
                </tr>
                </thead>
            </table>
    </div>
</div>

<div>
    <div id="setstock" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-title">
                    <h4 class="text-center">编辑预警</h4>
                </div>

                <div class="modal-body">
                    <form id="form-group" >

                        <div class="div1">
                            <input  type="text" id="keyword" name="keyword" placeholder="请输入股票名称" />
                            <div id="searchBox" style="display: none"></div>
                        </div>


                        <div class="form-group" ">
                        <input type="checkbox" name="upstock"  checked="checked" />
                        <label for="reg_tel">上涨到</label>
                        <input class="form-control" type="text" id="reg_tel" name="reg_tel" placeholder="单位元">
                </div>
                <div class="form-group">
                    <input type="checkbox" name="downstock"  checked="checked" />
                    <label for="reg_pas1">下跌到</label>
                    <input class="form-control" type="password"   id="reg_pas1" name="reg_pas1" placeholder="单位元">
                </div>

                <div style="color:#F00" id="tip"></div>
                <div class="text-right">
                    <button class="btn btn-primary"  id="sign_button"  name="sign_button" type="button">提交</button>
                    <button class="btn btn-danger" data-dismiss="modal" >取消</button>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>


<div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="deleteModalLabel">确认框</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label  class="control-label">确定要删除吗？</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                    <button type="button" class="btn btn-primary">确认</button>
                </div>
            </div>
        </div>
    </div>

</div>




<script>
    $(document).ready(function() {
        $('#employee_data').DataTable({
            ajax: {

                url: 'datatablephp.php',
                dataSrc: ""


            },
            columns: [
                { data: 'stocknames' },
                { data: 'stocode' },
                { data: null },
            ],
            "columnDefs": [
                {
                    "data": null,
                    render: function(data, type, row) {
                        var html ='<button class="btn btn-xs jfedit btn-primary"  data-toggle="modal" data-target="#setstock" value="'+row.tcId+'">编辑</button>&nbsp;&nbsp;&nbsp;&nbsp;'
                            +'<button class="btn btn-xs btn-primary jfdelete"  data-toggle="modal" data-target="#deleteModal"  value="'+row.tcId+'">删除</button>';
                        return html;
                    }
        ,
                    "targets": -1
                }
            ]
        });

        function editstock(){
            document.getElementById("demo").innerHTML="Hello World";
        }


    } );

</script>




</body>
</html>




