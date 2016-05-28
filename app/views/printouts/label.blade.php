<p>Printing a label with the following information:</p>
<dl class="dl-horizontal">
    <dt>Name</dt>
    <dd>{{{ $child->name() }}}</dd>
    <dt>Group</dt>
    <dd>{{{ $child->group_name }}}</dd>
</dl>
<p>If a printing error occurs, use one of the following buttons to retry or skip printing.</p>
<p>
    <a href="{{ rawurldecode($return_url) }}" class="btn btn-default">Skip printing</a>
    <a class="btn btn-primary" id="retry">Retry printing</a>
</p>


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
    
    $(function() {
        printLabel();
    });

    $("#retry").click(function() {
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
                url:      "{{ asset('DestinyIsland.label') }}",
                dataType: "text",

                success: function(data) {

                    var label = dymo.label.framework.openLabelXml(data);

                    label.setObjectText("NAME", "{{{ $child->name() }}}");
                    label.setObjectText("GROUP", "{{{ $child->group_name }}}");
                    label.setObjectText("ACTIVITIES", "TODO");

                    var options = dymo.label.framework.createLabelWriterPrintParamsXml({copies: 2});

                    label.print(printers[0].name, options);

                    window.location.replace('{{ rawurldecode($return_url) }}');
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