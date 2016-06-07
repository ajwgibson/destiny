
<div>
    {{ link_to_route(
        'admin.faq.create', 
        'Add FAQ', 
        $parameters = array( ), 
        $attributes = array( 'class' => 'btn btn-primary')) }}
</div>

<div class="row">
    <div class="col-sm-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="70px;"></th>
                    <th>Position</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $faq)
                <tr>
                    <td>
                        <a href="{{ route('admin.faq.up', $faq->id) }}"
                           class="btn btn-default btn-xs"><span class="glyphicon glyphicon-arrow-up"></span></a>

                        <a href="{{ route('admin.faq.down', $faq->id) }}"
                           class="btn btn-default btn-xs"><span class="glyphicon glyphicon-arrow-down"></span></a>
                    </td>
                    <td>{{{ $faq->position }}}</td>
                    <td>{{{ $faq->question }}}</td>
                    <td>{{{ $faq->answer }}}</td>
                    <td>
                        {{ link_to_route(
                            'admin.faq.show', 
                            'Details', 
                            $parameters = array( 'id' => $faq->id), 
                            $attributes = array( 'class' => '')) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
