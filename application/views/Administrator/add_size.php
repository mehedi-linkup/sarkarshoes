<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="form-horizontal">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Size Name </label>
				<label class="col-sm-1 control-label no-padding-right">:</label>
				<div class="col-sm-8">
					<input type="text" id="name" name="name" placeholder="Size Name" value="<?php echo set_value('name'); ?>" class="col-xs-10 col-sm-4" />
					<span id="msg"></span>
					<?php echo form_error('name'); ?>
					<span style="color:red;font-size:15px;">
				</div>
			</div>

			<div class="form-group" style="margin-top: 5px;;">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
				<label class="col-sm-1 control-label no-padding-right"></label>
				<div class="col-sm-8">
					<button type="button" class="btn btn-sm btn-success" onclick="submit()" name="btnSubmit">
						Submit
						<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
					</button>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="clearfix">
			<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header">
			Size Information
		</div>
		<!-- div.table-responsive -->

		<!-- div.dataTables_borderWrap -->
		<div id="saveResult">
			<table id="dynamic-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center" style="display:none;">
							<label class="pos-rel">
								<input type="checkbox" class="ace" />
								<span class="lbl"></span>
							</label>
						</th>
						<th>SL No</th>
						<th>Size Name</th>
						<th class="hidden-480">Description</th>

						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					<?php
						$sizes = $this->db->query("select * from tbl_size where status='a' order by name asc")->result();
					?>
					<?php 
					foreach ($sizes as $i => $size) { ?>
						<tr>
							<td class="center" style="display:none;">
								<label class="pos-rel">
									<input type="checkbox" class="ace" />
									<span class="lbl"></span>
								</label>
							</td>

							<td><?php echo ++$i; ?></td>
							<td><a href="#"><?php echo $size->name; ?></a></td>
							<td class="hidden-480"><?php echo $size->name; ?></td>
							<td>
								<div class="hidden-sm hidden-xs action-buttons">
									<a class="green" href="<?php echo base_url() ?>sizeedit/<?php echo $size->id; ?>" title="Eidt" onclick="return confirm('Are you sure you want to Edit this item?');">
										<i class="ace-icon fa fa-pencil bigger-130"></i>
									</a>

									<a class="red" href="#" onclick="deleted(<?php echo $size->id; ?>)">
										<i class="ace-icon fa fa-trash-o bigger-130"></i>
									</a>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	function submit() {
		var name = $("#name").val();
		if (name == "") {
			$("#name").css("border-color", "red");
			return false;
		}
		var inputdata = 'name=' + name;
		var urldata = "<?php echo base_url(); ?>insertsize";
		$.ajax({
			type: "POST",
			url: urldata,
			data: inputdata,
			success: function(data) {
				if (data == "false") {
					alert("This Name Allready Exists");
				} else {
					alert("Save Success");
					location.reload();
					document.getElementById("name").value = '';
				}
			}
		});
	}
</script>

<script type="text/javascript">
	function deleted(id) {
		var deletedd = id;
		var inputdata = 'deleted=' + deletedd;
		var confirmation = confirm("are you sure you want to delete this ?");
		var urldata = "<?php echo base_url() ?>sizedelete";
		if (confirmation) {
			$.ajax({
				type: "POST",
				url: urldata,
				data: inputdata,
				success: function(data) {
					alert("Delete Success");
					window.location.href = '<?php echo base_url(); ?>size';
				}
			});
		};
	}
</script>