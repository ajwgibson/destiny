
<div class="form-group">
    <label for="name" class="control-label">Leader's name</label>
    <div class="row">
        <div class="col-sm-6">
            <input type="text" id="name" class="form-control" autocomplete="off"/>
        </div>
    </div>
</div>
<div class="form-group">
    <a class="btn btn-primary" id="print"><span class="glyphicon glyphicon-print"></span> Print label</a>
</div>


<div id="modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p class="text-danger" style="font-size: 2em;">
            <span class="glyphicon glyphicon-exclamation-sign"></span> Error
        </p>
        <p id="error-message">Label printing failed.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>


@section('extra_js')

<script type="text/javascript" src="{{ asset('packages/dymo.label.framework.js') }}"></script>

<script type="text/javascript">
    
    $("#print").click(function() {
    	printLabel();
    });

    function printLabel() {

    	var printers = dymo.label.framework.getLabelWriterPrinters();
    	printers = jQuery.grep(printers, function(item, index) { return item.isConnected === true; });

		if (printers.length == 0) {
		    showError("No DYMO printers are installed/connected.");
	    } else {

	    	$.ajax({
				type:     "GET",
				url:      "{{ asset('labels/DestinyIslandLeader.label') }}",
				dataType: "text",

				success: function(data) {

					var label = dymo.label.framework.openLabelXml(data);

					label.setObjectText("NAME", $("#name").val().split(" ").join("\n"));

			    	var options = dymo.label.framework.createLabelWriterPrintParamsXml({copies: 2});

			    	label.print(printers[0].name, options);
				},

				error: function(jqXHR, exception) {
					
					if (jqXHR.status === 0) {
		                showError('Failed to print label, no network connection.');
		            } else if (jqXHR.status == 404) {
		                showError('Failed to print label, requested page not found. [404]');
		            } else if (jqXHR.status == 500) {
		                showError('Failed to print label, internal Server Error [500].');
		            } else if (exception === 'parsererror') {
		                showError('Failed to print label, requested JSON parse failed.');
		            } else if (exception === 'timeout') {
		                showError('Failed to print label, time out error.');
		            } else if (exception === 'abort') {
		                showError('Failed to print label, Ajax request aborted.');
		            } else {
		                showError('Failed to print label, uncaught Error.' + jqXHR.responseText);
		            }

				}
			});
	    }
    }

    function showError(message) {
    	$("#error-message").text(message);
    	$("#modal").modal();
    }
    
</script>

@endsection