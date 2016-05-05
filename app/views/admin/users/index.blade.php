
<div class="row">
    <div class="col-sm-6">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Admin user?</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{{ $user->username }}}</td>
                    <td>{{{ $user->admin ? "Yes" : "No" }}}</td>
                    <td>{{ link_to_route(
                            'admin.user.editPassword', 
                            'Change password', 
                            $parameters = array( 'id' => $user->id), 
                            $attributes = array( 'class' => '')) }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
