<style>
.table td {
	width: 20%;
}
</style>
<div class="alert  ">
<button class="close" data-dismiss="alert"></button>
Question: Advanced Input Field</div>

<p>
1. Make the Description, Quantity, Unit price field as text at first. When user clicks the text, it changes to input field for use to edit. Refer to the following video.

</p>


<p>
2. When user clicks the add button at left top of table, it wil auto insert a new row into the table with empty value. Pay attention to the input field name. For example the quantity field

<?php echo htmlentities('<input name="data[1][quantity]" class="">')?> ,  you have to change the data[1][quantity] to other name such as data[2][quantity] or data["any other not used number"][quantity]

</p>



<div class="alert alert-success">
<button class="close" data-dismiss="alert"></button>
The table you start with</div>

<table class="table table-striped table-bordered table-hover">
<thead>
<th><span id="add_item_button" class="btn mini green addbutton" onclick="addToObj=false">
											<i class="icon-plus"></i></span></th>
<th>Description</th>
<th>Quantity</th>
<th>Unit Price</th>
</thead>

<tbody>
	<tr style="height: 50px;">
		<td></td>
		<td class="edit">
			<span class="display t-description"></span>
			<textarea name="data[1][description]" class="input input-description" rows="2" style="display: none;"></textarea>
		</td>
		<td class="edit">
			<span class="display t-quantity"></span>
			<input name="data[1][quantity]" class="input input-quantity" style="display: none;">
		</td>
		<td class="edit">
			<span class="display t-unit-price"></span>
			<input name="data[1][unit_price]" class="input input-unit-price" style="display: none;">
		</td>
	</tr>

</tbody>

</table>


<p></p>
<div class="alert alert-info ">
<button class="close" data-dismiss="alert"></button>
Video Instruction</div>

<p style="text-align:left;">
<video width="78%"   controls>
  <source src="/video/q3_2.mov">
Your browser does not support the video tag.
</video>
</p>





<?php $this->start('script_own');?>
<script>
$(document).ready(function(){

	var editClick = function() {
		if ($(this).hasClass('on')) {
			var val = $(this).children('.input').val();
			$(this).children('.input').hide();
			$(this).children('.display').text(val).show();
			$(this).removeClass('on');
		} else {
			var val = $(this).children('.display').html();
			$(this).addClass('on');
			$(this).children('.display').hide();
			$(this).children('.input').show().focus().val(val);
		}

	}

	$(".edit").click(editClick);
	$("body").click(function(e) {
		if ($(e.target).hasClass('edit')) {
			return;
		}

		$(this).find('.edit.on').each(function(i, v) {
			var val = $(this).children('.input').val();
			$(this).children('.input').hide();
			$(this).children('.display').text(val).show();
			$(this).removeClass('on');
		});
	});

	$("#add_item_button").click(function() {
		var rowId = $(".table").find("tr").length + 1;
		$('.table').append('\
			<tr style="height: 50px;"> \
				<td></td> \
				<td class="edit"> \
					<span class="display t-description"></span> \
					<textarea name="data[' + rowId + '][description]" class="input input-description" rows="2" style="display: none;"></textarea> \
				</td> \
				<td class="edit"> \
					<span class="display t-quantity"></span> \
					<input name="data[' + rowId + '][quantity]" class="input input-quantity" style="display: none;"> \
				</td> \
				<td class="edit"> \
					<span class="display t-unit-price"></span> \
					<input name="data[' + rowId + '][unit_price]" class="input input-unit-price" style="display: none;"> \
				</td> \
			</tr> \
		');

		$(".edit").click(editClick);
	});


});
</script>
<?php $this->end();?>

