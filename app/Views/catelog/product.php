<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="container">
    <h4>Product Add</h4>
    <div class="form_button">
        <button id="basicBtn">Basic Info</button>
        <button id="advanceBtn">Advanced Info</button>
        <button id="seoBtn">SEO Info</button>
    </div>

    <div class="forms">
        <div id="successDiv"></div>
        <div class="all_form" id="basic_form">
            <h4>General Information</h4>

            <!-- General Information form -->
            <form action="" method="POST" enctype="multipart/form-data" id="basicForm">
                <div class="form-group">
                    <label for="exampleFormControlFile1">Add Product Media</label>
                    <input type="file" class="form-control-file" name="productImage">
                    <span style="color:red;" id="imageErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Categories</label>
                    <select class="form-control" name="categoryId">
                        <?php
                        
                        foreach($categories as $category){ ?>
                            <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
                        <?php }
                        
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Language</label>
                    <select class="form-control" name="languageId">
                        <?php
                        
                        foreach($languages as $language){ ?>
                            <option value="<?= $language->id ?>"><?= $language->language_name ?></option>
                        <?php }

                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" name="productName" placeholder="Enter name">
                    <span style="color:red;" id="nameErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" rows="3" name="description"></textarea>
                    <span style="color:red;" id="descriptionErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Video Embeded Code</label>
                    <input type="text" class="form-control" name="emebededCode" placeholder="Enter code">
                    <span id="codeErr" style="color:red;"></span>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <img id="loadingImage" style="width: 140px; height:40px; display:none;" src="https://cdn.dribbble.com/users/2973561/screenshots/5757826/loading__.gif" alt="loading gif">
            </form>
        </div>

        <!-- Advance Information form -->
        <div class="all_form" id="advance_form">
            <h4>Advanced Information</h4>
            <form action="" method="POST" enctype="multipart/form-data" id="advanceForm">

                <div class="form-group">
                    <label for="exampleInputEmail1">Product ID</label>
                    <input type="text" class="form-control" name="productId" value="" id="productId">
                    <span style="color:red;" id="weightErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Product Type</label>
                    <select class="form-control" name="productType">
                        <option value="" disabled selected>Select Product Type</option>
                        <option value="simple">Simple</option>
                        <option value="variable">Variable</option>
                    </select>
                    <span style="color:red;" id="typeErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Is Active ?</label>
                    <select class="form-control" name="isActive">
                        <option value="" disabled selected>Select Product Status</option>
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                    <span style="color:red;" id="activeErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Is Point ?</label>
                    <select class="form-control" name="isPoint">
                        <option value="" disabled selected>Select Product Point</option>
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                    <span style="color:red;" id="pointErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Is Feature ?</label>
                    <select class="form-control" name="isFeature">
                        <option value="" disabled selected>Select Product Feature</option>
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                    <span style="color:red;" id="featureErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Units</label>
                    <select class="form-control" name="unitName">
                        <option value="" disabled selected>Select Product Unit</option>
                        <?php
                        
                        foreach($units as $unit){ ?>
                            <option value="<?= $unit['unit_id'] ?>"><?= $unit['unit_name'] ?></option>
                        <?php }

                        ?>
                    </select>
                    <span style="color:red;" id="unitErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Brands</label>
                    <select class="form-control" name="brandName">
                        <option value="" disabled selected>Select Product Brand</option>
                        <?php
                        
                        foreach($brands as $brand){ ?>
                            <option value="<?= $brand['id'] ?>"><?= $brand['brand_name'] ?></option>
                        <?php }

                        ?>
                    </select>
                    <span style="color:red;" id="brandErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Product Weight</label>
                    <input type="text" class="form-control" name="productWeight" placeholder="Enter weight">
                    <span style="color:red;" id="weightErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Product Price</label>
                    <input type="number" class="form-control" name="productPrice" placeholder="Enter price">
                    <span style="color:red;" id="priceErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Discount Price</label>
                    <input type="number" class="form-control" name="discountPrice" placeholder="Enter price">
                    <span style="color:red;" id="discountErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Minimum Order</label>
                    <input type="text" class="form-control" name="minOrder" min="1" placeholder="1">
                    <span style="color:red;" id="minErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Maximum Order</label>
                    <input type="text" class="form-control" name="maxOrder" max="5" placeholder="5">
                    <span style="color:red;" id="maxErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">SKU</label>
                    <input type="text" class="form-control" name="sku" placeholder="Enter sku">
                    <span style="color:red;" id="skuErr"></span>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <img id="loadingImage1" style="width: 140px; height:40px; display:none;" src="https://cdn.dribbble.com/users/2973561/screenshots/5757826/loading__.gif" alt="loading gif">
            </form>
        </div>

        <!-- SEO information form -->
        <div class="all_form" id="seo_form">
            <h4>SEO Information</h4>
            <form action="" method="POST" enctype="multipart/form-data" id="seoForm">

                <div class="form-group">
                    <label for="exampleInputEmail1">Product ID</label>
                    <input type="text" class="form-control" name="seoProductId" value="" id="seoProductId">
                    <span style="color:red;" id="weightErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Seo Meta Tags</label>
                    <input type="text" class="form-control" name="metaTags" placeholder="Seo meta tags">
                    <span style="color:red;" id="tagsErr"></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Seo Description</label>
                    <input type="text" class="form-control" name="seoDescription" placeholder="Seo Description">
                    <span style="color:red;" id="seoDesErr"></span>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <img id="loadingImage2" style="width: 140px; height:40px; display:none;" src="https://cdn.dribbble.com/users/2973561/screenshots/5757826/loading__.gif" alt="loading gif">
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
    $(document).ready(function() {
        $('#basicBtn').click(function() {
            $('#basic_form').show();
            $('#advance_form').hide();
            $('#seo_form').hide();
        });

        $('#advanceBtn').click(function() {
            $('#advance_form').show();
            $('#basic_form').hide();
            $('#seo_form').hide();
        });
        $('#seoBtn').click(function() {
            $('#seo_form').show();
            $('#advance_form').hide();
            $('#basic_form').hide();
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#basicForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "<?= base_url('product-create') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType:false,
                dataType: "json",
                beforeSend: function(){
                    $('#loadingImage').show();
                },
                success: function(response) {
                    if(response.status && response.status == 'error'){
                        if(response.errors.productName){
                            $('#nameErr').text(response.errors.productName);
                        }

                        if(response.errors.productImage){
                            $('#imageErr').text(response.errors.productImage);
                        }

                        if(response.errors.description){
                            $('#descriptionErr').text(response.errors.description);
                        }

                        if(response.errors.emebededCode){
                            $('#codeErr').text(response.errors.emebededCode);
                        }
                    }

                    if(response.status && response.status == 'success'){
                        $('#successDiv').text(response.message).show();
                        $('#basicForm')[0].reset();
                        $('#productId').val(response.productId);
                        $('#seoProductId').val(response.productId);
                        // location.reload();
                    }else {
                        $('#successDiv').text(response.message).show();
                    }

                    $('#loadingImage').hide();
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#advanceForm').submit(function(e){
            e.preventDefault();

            var advanceFormData = $(this).serialize();

            $.ajax({
                url: "<?= base_url('product-advance-add') ?>",
                type: "POST",
                data: advanceFormData,
                dataType: "json",
                beforeSend: function(){
                    $('#loadingImage1').show();
                },
                success: function(response) {
                    if(response.status && response.status == 'error'){
                        if(response.errors.productType){
                            $('#typeErr').text(response.errors.productType);
                        }

                        if(response.errors.isActive){
                            $('#activeErr').text(response.errors.isActive);
                        }

                        if(response.errors.isPoint){
                            $('#pointErr').text(response.errors.isPoint);
                        }

                        if(response.errors.isFeature){
                            $('#featureErr').text(response.errors.isFeature);
                        }

                        if(response.errors.unitName){
                            $('#unitErr').text(response.errors.unitName);
                        }

                        if(response.errors.brandName){
                            $('#brandErr').text(response.errors.brandName);
                        }

                        if(response.errors.productWeight){
                            $('#weightErr').text(response.errors.productWeight);
                        }

                        if(response.errors.productPrice){
                            $('#priceErr').text(response.errors.productPrice);
                        }

                        if(response.errors.discountPrice){
                            $('#discountErr').text(response.errors.discountPrice);
                        }

                        if(response.errors.minOrder){
                            $('#minErr').text(response.errors.minOrder);
                        }

                        if(response.errors.maxOrder){
                            $('#maxErr').text(response.errors.maxOrder);
                        }

                        if(response.errors.sku){
                            $('#skuErr').text(response.errors.sku);
                        }
                    }else if(response.status && response.status == 'success'){
                        $('#successDiv').text(response.message).show();
                        $('#advanceForm')[0].reset();
                    }else if(response.status && response.status == 'failed'){
                        $('#successDiv').text(response.message).show();
                    }
                    $('#loadingImage1').hide();
                }
            })
        })
    });
</script>

<script>
    $(document).ready(function(){
        $('#seoForm').submit(function(e){
            e.preventDefault();

            var seoFormData = $('#seoForm').serialize();

            $.ajax({
                url: "<?= base_url('seo-product-add') ?>",
                type: "POST",
                data: seoFormData,
                dataType: "json",
                beforeSend: function(){
                    $('#loadingImage2').show();
                },
                success: function(response){
                    if(response.status && response.status == 'error'){
                        if(response.errors.metaTags){
                            $('#tagsErr').text(response.errors.metaTags);
                        }

                        if(response.errors.seoDescription){
                            $('#seoDesErr').text(response.errors.seoDescription);
                        }
                    }else if(response.status && response.status == 'success'){
                        $('#successDiv').text(response.message).show();
                        $('#seoForm')[0].reset();
                    }else if(response.status && response.status == 'failed'){
                        $('#successDiv').text(response.message).show();
                    }
                    $('#loadingImage2').hide();
                }
            })
        });
    });
</script>

<?= $this->endSection('content') ?>