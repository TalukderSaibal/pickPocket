<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

    <div class="container">
        <h4>Language Add</h4>
        
        <div id="successDiv"></div>

        <div class="form_div">
            <form action="" method="POST" id="myForm">
                <div class="form-group">
                    <label for="exampleInputEmail1">Language Name <span style="color:red;">*</span> </label>
                    <input type="text" class="form-control" name="languageName" placeholder="Enter name">
                    <span style="color: red;" id="nameErr"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Language Code <span style="color:red;">*</span> </label>
                    <input type="text" class="form-control" name="languageCode" placeholder="Enter code">
                    <span style="color: red;" id="codeErr"></span>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <img id="loadingImage" style="width: 140px; height:40px; display:none;" src="https://f4n3x6c5.stackpathcdn.com/article/adding-a-loading-page-to-website/Images/chromecapture.gif" alt="loading gif">
                </div>
            </form>
            
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
    $(document).ready(function(){
        $('#myForm').submit(function(event){
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: 'langauge_create',
                type: 'POST',
                dataType: 'json',
                data: formData,
                beforeSend: function(){
                    $('#loadingImage').show();
                },
                success: function(response){
                    if(response.languageName && response.languageName.status == 'failed'){
                        $('#nameErr').text(response.languageName.message);
                    }

                    if(response.languageCode && response.languageCode.status == 'failed'){
                        $('#codeErr').text(response.languageCode.message);
                    }

                    if(response.status && response.status == 'success'){
                        $('#successDiv').text(response.message).show();
                        $('#myForm')[0].reset();
                    }else{
                        $('#successDiv').text(response.message).show();
                    }
                    $('#loadingImage').hide();
                }
            })
        })
    });
</script>

<?= $this->endSection('content') ?>