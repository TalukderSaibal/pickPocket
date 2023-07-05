<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="container">
    <h4>Add Stock</h4>
    <div id="successDiv"></div>
    <div class="forms">
        <form action="" method="POST" id="stockForm">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Products</label>
                <select class="form-control" name="productName">
                    <option disabled selected>Select Product</option>
                    <?php
                    
                    foreach($products as $product){ ?>
                        <option value="<?= $product['id'] ?>"><?= $product['product_name'] ?></option>
                    <?php }
                    
                    ?>
                </select>
                <span style="color:red;" id="nameErr"></span>
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
                url: "<?= base_url('stock-create') ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                beforeSend: function(){
                    $('#loadingImage').show();
                },
                success: function(resposne){
                    if(resposne.status && resposne.status == 'error'){
                        if(resposne.errors.productName){
                            $('#nameErr').text(resposne.errors.productName);
                        }
                    }

                    if(resposne.status && resposne.status == 'success'){
                        $('#successDiv').text(response.message).show();
                        $('#stockForm')[0].reset();
                    }

                    if(resposne.status && resposne.status == 'failed'){
                        $('#successDiv').text(response.message).show();
                        $('#stockForm')[0].reset();
                    }
                    $('#loadingImage').hide();
                }
            })
        });
    });
</script>

<?= $this->endSection('content') ?>