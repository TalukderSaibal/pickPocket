<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="container">
<div id="successDiv"></div>
    <div class="form_div">
        <form action="" method="POST" id="unitEditForm">
            <?php
            
            foreach($res as $key => $val){

            }
            
            ?>
            <div class="form-group">
                <input type="hidden" class="form-control" name="unitId" value="<?= $val->unit_id ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Language</label>
                <select class="form-control" name="languageSelect" id="languageSelect">
                    <?php
                    
                    foreach($languges as $language){ ?>
                        <option value="<?= $language['id'] ?>" <?php if($val->language_id == $language['id']) echo 'selected';?> ><?= $language['language_name'] ?></option>
                    <?php }

                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Unit Name <span style="color:red;">*</span></label>
                <input type="text" class="form-control" placeholder="Enter name" name="unitName" value="<?= $val->unit_name ?>">
                <span style="color:red;" id="nameErr"></span>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <img id="loadingImage" style="width: 140px; height:40px; display:none;" src="https://f4n3x6c5.stackpathcdn.com/article/adding-a-loading-page-to-website/Images/chromecapture.gif" alt="loading gif">
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
    $(document).ready(function(){
        $('#unitEditForm').submit(function(event){
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "<?= base_url('unit_update') ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                beforeSend : function(){
                    $('#loadingImage').show();
                },
                success: function(response){
                    if(response.unitName && response.unitName.status == 'error'){
                        $('#nameErr').text(response.unitName.message);
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