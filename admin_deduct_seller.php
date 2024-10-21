<?php 
include('admin_head.php'); 
?>
<?php



$sn=$_GET["sn"];
$id=$_GET["id"];
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
                    <h3 class="tile-title">Subscribe</h3>
                    <div class="tile-body">
                        <form class="row"  name="aspnetForm" method="get" action="admin_deduct_seller_credit.php" id="aspnetForm">
                            <div class="form-group col-md-3">
                                <label class="control-label">Panel Id</label>
                                <input class="form-control" type="text" name="uid" readonly="readonly" value="<?php echo "$id"; ?>" >
                                <input  name="sn" readonly="readonly" value="<?php echo "$sn"; ?>" type="hidden">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Enter Credits</label>
                                <input class="form-control" name="num" id="uidu" >
                            </div>
                            <div class="form-group col-md-4 align-self-end">
                                <input class="btn btn-primary" name="submit" value="Submit" class="button" type="submit">
                              </div>
                        </form>
          
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <form  class="row" action="id_add.php" method="post">
                        <div class="form-group col-md-3">
                            <label class="control-label">Name</label>
                            <input class="form-control" type="text" name="userName" required placeholder="CLIENT NAME">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Email</label>
                            <input class="form-control" type="text" name="userid" required placeholder="KEY">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">Type</label>
                                <select class="form-control"  name="UserType" id="UserType"  class="usertype">
                                <option value="1">Full Version</option>
                                </select>
                            
                        </div>
                        <div class="form-group col-md-4 align-self-end">
                           <input class="btn btn-primary" type="submit" value="ADD ID" >
                        </div>
                    </form>
                  
                </div>
            </div>
        </div> -->
    </main>


<?php 
include('footer.php'); 
?>

     