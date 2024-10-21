<?php 
include('seller_head.php'); 

$sn=$_GET["sn"];
$id=$_GET["id"];
$agentid=$_GET["agentid"];
?>


<main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i>Keys</h1>
                <p>Seller Keys</p>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active"><a href="#">Data Table</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Add IP</h3>
                    <div class="tile-body">
                          <form class="row"  name="aspnetForm" method="post" action="add_user_ip.php" id="aspnetForm">

                          <div>
                        <!-- <div>
                          <strong>User</strong>
                        </div> -->
                        <div>
                        <input class="form-control" name="selectUser" id="selectUser" value=<?php echo $id;?>>
                        <input name="LogSuperID" id="LogSuperID" style="display:none;" value=<?php echo $agentid ?>  class="pendek" type="text">
                        </div>
                      </div>
                      <div>
                        <!-- <div>
                          <strong>Enter IP Address</strong>
                        </div> -->
                        <div>
                        <input class="form-control" name="IPaddress" id="IPaddress" >
                        <small id="UserName" class="form-text text-warning">Please Input Data Format (000.00.00.00:0000:abcd:abcd123)</small>
                        </div>
                      </div>
                     

                     
                    <div  style="padding-left:-10px; ">
                    <input  class="btn btn-primary" name="addnew_ip" value="Add IP" class="button" type="submit">
                              </div> </form>


                    </div>
                </div>
            </div>
      </content>
    </content>


  </body>
</html>
