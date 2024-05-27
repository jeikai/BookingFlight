<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form_product">
    <div class="col-md-4"style="width: 33.333%;float: left;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" ><?php echo $sp['brand'];?></h4>
                <input type="hidden" class="card-text" name="flightId" value="<?php echo $sp['flightId'];?> ">
                <p class="card-text" >Start city: <?php echo $sp['startCity'];?></p>
                <p class="card-text" >End city: <?php echo $sp['endCity'];?></p>
                <p class="card-text">Start time: <?php echo $sp['startTime']?></p>
                <p class="card-text">End time: <?php echo $sp['endTime'];?></p>
                <p class="card-text" >Total customers: <?php echo $sp['totalCustomer'];?></p>
                <p class="card-text" >Remaining customers: <?php echo $sp['remainingCustomer'];?></p>
                <p class="card-text" >Round trip: <?php echo $sp['isRoundTrip'] == 1 ? 'yes' : 'no';?></p>
                <input type="hidden" class="card-text" name="price" value="<?php echo $sp['standardPrice'];?> ">
                <p class="card-text">Price: <?php echo $sp['standardPrice'];?>$</p>
                <input type="submit" class="btn btn-outline-secondary" value="add to cart" name="add_to_cart">
            </div>
        </div>
    </div>
</form>		
