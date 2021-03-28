<?php
use yii\helpers\Url
?>
<div>
<button style="float:right;" type="button">
<a href="<?= Url::to('add')?>">Add Items</a>
</button>
<button type="button">
<a href="<?= Url::to('download-invoice')?>">Print Invoice</a>
</button>
<button type="button">
<a href="<?= Url::to('send-invoice')?>">Send Invoice</a>
</button>
</div>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Item</th>
      <th scope="col">Description</th>
      <th scope="col">Unit Cost</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody> 
  <?php if(count($data) > 0): ?>
    <?php foreach($data as $item): ?>
        <tr class="table-active">
        <td scope="row"><?php echo $item->name; ?></td>
        <td scope="row"><?php echo $item->description; ?></td>
        <td scope="row"><?php echo $item->unit_cost; ?></td>
        <td scope="row"><?php echo $item->quantity; ?></td>
        <td scope="row"><?php echo $item->price; ?></td>
        <td>
        <a href="<?= Url::to(['update','id' => $item->id])?>" id="<?php echo $item->id; ?>">Update</a> |
        <a href="<?= Url::to(['dalete','id' => $item->id])?>" id="<?php echo $item->id; ?>">Delete</a>
        </td>
        </tr>
    <?php endforeach; ?>
    <?php else: ?>
     <tr scope="row"> No Records Available </tr>
     <?php endif; ?>
  </tbody>
</table>