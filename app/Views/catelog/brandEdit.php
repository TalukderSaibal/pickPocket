<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="container">
<div id="successDiv"></div>
    <div class="form_div">
        <form action="" method="POST" id="brandEditForm">
            <?php
            
            foreach($res as $key => $val){

            }
            
            ?>
            <div class="form-group">
                <input type="hidden" class="form-control" name="productBrandId" value="<?= $val->productBrandId ?>">
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Language</label>
                <select class="form-control" name="languageSelect" id="languageSelect">
                    <?php
                    
                    foreach($languges as $language){ ?>
                        <option value="<?= $language['id'] ?>" <?php if($val->languageId == $language['id']) echo 'selected';?> ><?= $language['language_name'] ?></option>
                    <?php }

                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Brand Name <span style="color:red;">*</span></label>
                <input type="text" class="form-control" placeholder="Enter name" name="brandName" value="<?= $val->brandName ?>">
                <span style="color:red;" id="nameErr"></span>
            </div>

            <div class="form-group">
                <img src="<?= base_url('BrandImage/'. $val->brandImage) ?>" alt="no image" width="50px" height="50px">
                <label for="exampleFormControlFile1">Brand Image</label>
                <input type="file" class="form-control-file" name="brandImage">
                <span style="color:red;" id="imageErr"></span>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <img id="loadingImage" style="width: 140px; height:40px; display:none;" src="https://f4n3x6c5.stackpathcdn.com/article/adding-a-loading-page-to-website/Images/chromecapture.gif" alt="loading gif">
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
    $(document).ready(function(){
        $('#brandEditForm').submit(function(event){
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "<?= base_url('brand_update') ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend : function(){
                    $('#loadingImage').show();
                },
                success: function(response){
                    if(response.brandName && response.brandName.status == 'error'){
                        $('#nameErr').text(response.brandName.message);
                    }

                    if(response.status && response.status == 'success'){
                        $('#successDiv').text(response.message).show();
                    }
                    $('#loadingImage').hide();
                }
            })
        });
    });
</script>

<?= $this->endSection('content') ?>