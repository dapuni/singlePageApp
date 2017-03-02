<section>
	<div class="table-responsive">
      	<table class="table table-striped jambo_table bulk_action">
        <thead>
          <tr class="headings">
            <th>No ID</th>
            <th class="column-title">Roles Name</th>
            <th class="column-title">Permission</th>
            <th class="column-title" style="text-align:center">View</th>
          </tr>
        </thead>
        <tbody>
        	@foreach($roles as $role)
            <tr>
              <td>{{$role->id}}</td>
              <td>{{$role->role}}</td>
              <td>{{$role->module}}</td>
              <td style="text-align:center">
                <a href="/roles/{{ $role->id }}" class="btn btn-success btn-sm update">View</a>
                <a href="/roles/{{ $role->id }}" class="btn btn-danger btn-sm delete">Delete</a>
              </td>
            </tr>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $roles->links() }}
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
        <h4 class="modal-title" id="myModalLabel">Add New Role</h4>
      </div>
      <div class="modal-body">
        <form action="/roles" method="POST" id="form" onsubmit="event.preventDefault();">
            <p style="color:red" id="alert"> </p>
            <input type="hidden" name="id" id="id">
            <input type="text" class="form-control"  placeholder="Roles" name="role" id="role">
            <br>
            <label>Permission</label>
            </br>
            @foreach($modules as $module)
              @if($module->parent == 0)
                <input type="checkbox" name="module" class="module" value="{{ $module->id }}">{{ $module->module }}
                </br>
                @foreach($modules as $child)
                  @if($child->parent == $module->id)
                  &nbsp&nbsp
                    <input type="checkbox" name="module" class="module" value="{{ $child->id }}">{{ $child->module }}
                    </br>
                  @endif
                @endforeach
              @endif
            @endforeach
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
      $('#role').val('');
      $('.module').attr("checked",false);
      $('#alert').text('');
    });

    $('#submitForm').on('click',function(e){
      var url = $('#form').attr('action');
      var module = [];
      $.each($("input[name='module']:checked"), function(){            
          module.push($(this).val());
      });
      axios.post(url, {
        _token : '{{ csrf_token() }}',
        id : $('#id').val(),
        role : $('#role').val(),
        module : module,
      })
      .then(function (response) {
        console.log(response);
        if (response.data.code == 422) {
          $('#alert').text(response.data.errors.module);
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
          $('#role').val(response.data.role);
          //string to array
          var check = response.data.module.split(',');
          $('.module').each(function(){
            for (i = 0; i <= check.length; i++) { 
              if (check[i] == $(this).val()) {
                $(this).attr("checked",true);
              }
            }
          });
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
      var url = '/roles';
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