<div class="panel"> 
<div class="panel-body"> 
<h4>
 <div class=" pull-left"> Order Detail Bill NO : <?php echo $billOrder->id; ?>
  </div>
   <div class=" pull-right"> 
   <?php if ($billOrder->status == "pay"): ?>
   <span class="label label-success"> 
   <i class="glyphicon glyphicon-ok"></i>
    <?php echo $billOrder->status; ?>
     </span> <?php else: ?>
      <span class="label label-danger">
       <i class="glyphicon glyphicon-hourglass"></i> 
       <?php echo $billOrder->status; ?>
        </span> <?php endif; ?>
        </div> <div class="clearfix"></div>
         </h4>
          <hr>
          <table class="table table-striped table-bordered">
           <thead> <tr>
            <th width="50px" style="text-align: right">No</th>
             <th width="100px" style="text-align: center">Code</th>
              <th>name</th> 
              <th width="80px" style="text-align: right">Price</th>
               <th width="80px" style="text-align: right">Qty</th>
               <th width="100px" style="text-align: right">Total</th>
                </tr>
                 </thead> <tbody> <?php foreach($billOrderDetails as $billOrderDetail): ?>
                  <?php $total = ($billOrderDetail->price * $billOrderDetail->quantity); ?>
                  <tr>
                   <td style="text-align: right"><?php echo $n++; ?></td>
                    <td style="text-align: center"> <?php echo $billOrderDetail->product->code; ?> </td>
                     <td><?php echo $billOrderDetail->product->name; ?>
                     	
                     </td>
                      <td style="text-align: right">
                       <?php echo number_format ($billOrderDetail->price); ?> </td>
                       <td style="text-align: right">
                        <?php echo number_format ($billOrderDetail->quantity); ?> </td> <td style="text-align: right">
<?php echo number_format($total); ?>
 </td>
  </tr>
   <?php endforeach; ?>
    </tbody> </table>

<div style="text-align: center">
 <a href="index.php?r=order/index" class="btn btn-primary"> 
 <i class="glyphicon glyphicon-chevron–left"></i> Back </a> 
 <a href="index.php?r=order/pay&id=<?php echo $billOrder->id; ?>" class="btn btn-success"> 
 <i class="glyphicon glyphicon-ok"></i> Pay </a> <a href="index.php?r=order/send&id=<?php echo $billOrder->id; ?>" 
 class="btn btn-warning"> 
 <i class="glyphicon glyphicon-envelope"></i> Send </a> <a href="index.php?r=order/cancel&id=<?php echo $billOrder->id; ?>" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"></i> Cancel </a> </div> </div> </div>