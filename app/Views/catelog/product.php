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

        <div class="all_form" id="advance_form">
            <h4>Advanced Information</h4>
            <form action="" method="POST" enctype="multipart/form-data" id="advanceForm">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" placeholder="Enter name">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="all_form" id="seo_form">
            <h4>SEO Information</h4>
            <form action="" method="POST" enctype="multipart/form-data" id="seoForm">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" placeholder="Enter name">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
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

<?= $this->endSection('content') ?>