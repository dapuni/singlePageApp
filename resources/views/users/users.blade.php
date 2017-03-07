<section>
	<div class="table-responsive">
      	<table class="table table-striped jambo_table bulk_action">
        <thead>
          <tr class="headings">
            <th>No ID</th>
            <th class="column-title">User Name</th>
            <th class="column-title">Role</th>
            <th class="column-title" style="text-align:center">View</th>
          </tr>
        </thead>
        <tbody>
        	@foreach($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->role_id}}</td>
              <td style="text-align:center">
                <a href="/users/{{ $user->id }}" class="btn btn-success btn-sm update">View</a>
                <a href="/users/{{ $user->id }}" class="btn btn-danger btn-sm delete">Delete</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $users->links() }}
    </div>
    <div>
    	<a href="" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" id="newdata">Add New</a>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New User</h4>
      </div>
      <div class="modal-body">
        <form action="/users" method="POST" id="form" onsubmit="event.preventDefault();">
            <p style="color:red" id="alert"> </p>
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <input type="text" class="form-control"  placeholder="Username" name="name" id="name">
            </div>
            <div class="form-group">
              <input type="email" class="form-control"  placeholder="Email" name="email" id="email">
            </div>
            <div class="form-group">
              <input type="password" class="form-control"  placeholder="Password" name="password" id="password">
            </div>
            <div class="form-group">
              <select class="form-control" id="role">
                @foreach($roles as $role)
                  <option value="{{ $role->id }}">{{ $role->role }}</option>
                @endforeach
              </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="submitForm">Save</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#newdata').on('click',function(e){
      e.preventDefault();
      $('#id').val('');
      $('#name').val('');
      $('#email').val('');
      $('#password').val('');
      $('#alert').text('');
    });

    $('#submitForm').on('click',function(e){
      var url = $('#form').attr('action');
      axios.post(url, {
        _token : '{{ csrf_token() }}',
        id : $('#id').val(),
        name : $('#name').val(),
        email : $('#email').val(),
        password : $('#password').val(),
        role : $('#role').val(),
      })
      .then(function (response) {
        console.log(response);
        if (response.data.code == 422) {
          $('#alert').text('Something Wrong');
        } else {
          $('#myModal').modal('toggle');
          setTimeout(function(){ refreshPage(); }, 500);
        }  
      })
      .catch(function (error) {
        console.log(error);
      });
    });

    $('.pagination a').on('click', function(e){
      e.preventDefault();
      var url = $(this).attr('href');
      axios.get(url)
        .then(function (response) {
          console.log(response);
          $('#content_section').html(response.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    });

    $('.update').on('click',function(e){
      e.preventDefault();
      var url = $(this).attr('href');
      axios.get(url)
        .then(function (response) {
          console.log(response);
          $('#id').val(response.data.id);
          $('#name').val(response.data.name);
          $('#email').val(response.data.email);
          $('#role').val(response.data.role_id);
        })
        .catch(function (error) {
          console.log(error);
        });
      $('#myModal').modal('show');
    });

    $('.delete').on('click',function(e){
      e.preventDefault();
      var confr = confirm('Are You Sure Delete This data');
      if (!confr) {
        return false;
      }
      var url = $(this).attr('href');
      axios.delete(url)
        .then(function (response) {
          console.log(response);
          setTimeout(function(){ refreshPage(); }, 500);
        })
        .catch(function (error) {
          console.log(error);
        });
    });

    function refreshPage(){
      var url = '/users';
      axios.get(url)
        .then(function (response) {
          console.log(response);
          $('#content_section').html(response.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  });
</script>