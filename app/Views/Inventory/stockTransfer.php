<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="container">
    <h4>Stock Transfer</h4>
    <div id="successDiv"></div>
    <div class="forms">
        <form action="" method="POST" id="stockForm">

            <div class="form-group">
                <label for="exampleFormControlSelect1">Warehouse From</label>
                <select class="form-control" name="warehouseFrom">
                    <option disabled selected>Select warehouse from</option>
                    <?php
                    
                    foreach($warehouses as $warehouse){ ?>
                        <option value="<?= $warehouse->id ?>"><?= $warehouse->warehouse_title ?></option>
                    <?php }

                    ?>
                </select>
                <span style="color: red;" id="wareFromErr"></span>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Warehouse To</label>
                <select class="form-control" name="warehouseTo">
                <option disabled selected>Select warehouse to</option>
                    <?php
                    
                    foreach($warehouses as $warehouse){ ?>
                        <option value="<?= $warehouse->id ?>"><?= $warehouse->warehouse_title ?></option>
                    <?php }

                    ?>
                </select>
                <span style="color: red;" id="wareToErr"></span>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Refrence No</label>
                <input type="text" class="form-control" name="referenceNo" placeholder="Enter reference">
                <span style="color: red;" id="refErr"></span>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Stock Transfer Date</label>
                <input type="date" class="form-control" name="stockTransfer">
                <span style="color: red;" id="transferErr"></span>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Products</label>
                <select class="form-control" name="productId">
                    <option value="" disabled selected>Select Product</option>
                    <?php
                    
                    foreach($products as $product){ ?>
                            <option value="<?= $product['id'] ?>"><?= $product['product_name'] ?></option>
                    <?php } ?>
                </select>
                <span style="color: red;" id="productErr"></span>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Note</label>
                <textarea class="form-control" rows="3" name="stockNote"></textarea>
                <span style="color: red;" id="noteErr"></span>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <img id="loadingImage" style="width: 140px; height:40px; display:none;" src="https://cdn.dribbble.com/users/2973561/screenshots/5757826/loading__.gif" alt="loading gif">
        </form>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
    $(document).ready(function(){
        $('#stockForm').submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "<?= base_url('stock-transfer-add') ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                beforeSend: function(){
                    $('#loadingImage').show();
                },
                success: function(response){
                    if(response.status && response.status == 'error'){
                        if(response.errors.warehouseFrom){
                            $('#wareFromErr').text(response.errors.warehouseFrom);
                        }

                        if(response.errors.warehouseTo){
                            $('#wareToErr').text(response.errors.warehouseTo);
                        }

                        if(response.errors.referenceNo){
                            $('#refErr').text(response.errors.referenceNo);
                        }

                        if(response.errors.stockTransfer){
                            $('#transferErr').text(response.errors.stockTransfer);
                        }

                        if(response.errors.productId){
                            $('#productErr').text(response.errors.productId);
                        }

                        if(response.errors.stockNote){
                            $('#noteErr').text(response.errors.stockNote);
                        }
                    }else if(response.status && response.status == 'success'){
                        $('#successDiv').text(response.message).show();
                        $('#stockForm')[0].reset();
                    }else if(response.status && response.status == 'failed'){
                        $('#successDiv').text(response.message).show();
                        $('#stockForm')[0].reset();
                    }
                    $('#loadingImage').hide();
                }
            })
        })
    });
</script>
<?= $this->endSection('content') ?>