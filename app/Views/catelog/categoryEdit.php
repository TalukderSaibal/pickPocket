<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="container">
<div id="successDiv"></div>
    <div class="form_div">
    <form action="" method="POST" id="categoryForm">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Language</label>
                            <select class="form-control" name="languageSelect" id="languageSelect">
                                
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Name <span style="color: red;">*</span> </label>
                            <input type="text" class="form-control" name="categoryName" placeholder="Enter name">
                            <span style="color:red;" id="nameErr"></span>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Parent Category</label>
                            <select class="form-control" name="parentCategory">
                                <option value="0">Choose</option>
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Slug <span style="color: red;">*</span> </label>
                            <input type="text" class="form-control" name="categorySlug" placeholder="Enter slug">
                            <span style="color:red;" id="slugErr"></span>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload Category Media</label>
                            <input type="file" class="form-control-file" name="categoryImage">
                            <span style="color:red;" id="imageErr"></span>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload Category Icon</label>
                            <input type="file" class="form-control-file" name="categoryIcon">
                            <span style="color:red;" id="iconErr"></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <img id="loadingImage" style="width: 140px; height:40px; display:none;" src="https://f4n3x6c5.stackpathcdn.com/article/adding-a-loading-page-to-website/Images/chromecapture.gif" alt="loading gif">
                    </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
    $(document).ready(function(){
        $('#attributeEditForm').submit(function(event){
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "<?= base_url('attribute_update') ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                beforeSend : function(){
                    $('#loadingImage').show();
                },
                success: function(response){
                    if(response.attributeName && response.attributeName.status == 'error'){
                        $('#nameErr').text(response.attributeName.message);
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