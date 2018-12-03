<script type="text/javascript">
	//==================== Merge Cells ====================
	function MergeCommonRows(table)
	{
		var firstColumnBrakes = [];
		$.each(table.find('th'), function (i)
		{
			var previous = null, cellToExtend = null, rowspan = 1;
			table.find("td:nth-child(" + i + ")").each(function (index, e)
			{
				var jthis = $(this), content = jthis.text();
				if (previous == content && content !== "" && $.inArray(index, firstColumnBrakes) === -1)
				{
					jthis.addClass('hidden');
					cellToExtend.attr("rowspan", (rowspan = rowspan+1));
				} else  {
					if (i === 1) firstColumnBrakes.push(index);
					rowspan = 1 ;
					previous = content;
					cellToExtend = jthis;
				}
			});
		});
		$('td.hidden').remove();
	}
	//==================== showClassInfo ====================
	function showClassInfo()
	{
		var data = $('#frm-view-class').serialize();
		$.get("{{ route('showClassInformation') }}", data, function(data) {
			$('#add-class-info').empty().append(data);
			$('td#hidden').addClass('hidden');
			$('th#hidden').addClass('hidden');
			MergeCommonRows($('#table-class-info'));
		});
	}
	//==================== showClassInfo ====================
	$('#academic_id, #level_id, #shift_id, #time_id, #batch_id, #group_id').on('change', function () {
        showClassInfo();
	});
	//==================== Levels ====================
	$("#frm-view-class #program_id").on('change', function (e)
	{
		e.preventDefault();
		var program_id = $(this).val();
		var level      = $('#level_id');
		$(level).empty();
		$.get("{{ route('showLevel') }}", {program_id:program_id}, function (data) {
			$.each(data, function (i, l) {
				$(level).append($("<option/>", {
					value : l.level_id,
					text  : l.level
				}))
			});
			showClassInfo();
		});
	});
	//==================== Show Info ====================
	$('#show-class-info').on('click', function (e) {
		e.preventDefault();
		showClassInfo();
		$('#choose-academic').modal('show');
	});
</script>