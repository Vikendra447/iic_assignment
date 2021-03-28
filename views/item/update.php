<?php
use yii\helpers\Url
?>
<!DOCTYPE html>
<html>
<head></head>
<body>
    <div>
        <form id="editItems" type="post">
            <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $data->name ?>" placeholder="Enter Name">
            </div>
            <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="2" placeholder="Description"><?php echo $data->description ?></textarea>
            </div>
            <div class="form-group">
            <label for="unit_cost">Unit Cost</label>
            <input type="number" class="form-control" id="unit_cost" name="unit_cost" value="<?php echo $data->unit_cost ?>" placeholder="Unit Cost">
            </div>
            <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $data->quantity ?>" placeholder="Quantity">
            </div>
        </form>
        <div>
            <button type="button" class="btn btn-primary" onclick="submitForm()">Save</button>
            <button type="button" id="cancleButton" class="btn btn-primary">Cancel</button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script type="text/javascript">

    $('#editItems').validate({
        rules:{
            'name':'checkblank',
        },

        submitHandler: function(form) {
            submitForm();
        }
    });
    function submitForm(){

        var data = $('#editItems').serializeArray();
        data.push({
            "name": "id",
            "value": "<?php echo $data->id ?>"
        });
  
        $.ajax({
            type:"POST",
            url: "<?= Url::to('save')?>",
            data: data,

            success:function(data){
            if(data){        
                window.location.href = "<?= Url::to('index')?>";
            }
            },
            error:function(){
                
            }
        });
    }

    $('#cancleButton').click(function(){
        console.log("fgfdgdf")
        window.location.href = "<?= Url::to('index')?>";
    });
    </script>
</body>
</html>