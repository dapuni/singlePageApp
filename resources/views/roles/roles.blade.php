<section>
	<div class="table-responsive">
      	<table class="table table-striped jambo_table bulk_action">
        <thead>
          <tr class="headings">
            <th>No </th>
            <th class="column-title">Roles Name</th>
            <th class="column-title">Permission</th>
            <th class="column-title">View</th>
          </tr>
        </thead>

        <tbody>
        	
        </tbody>
      </table>
    </div>
    <div>
    	<a href="" class="btn btn-primary"  data-toggle="modal" data-target="#myModal">Add New</a>
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
        <form action="/roles" method="POST" id="form">
        	{{ csrf_field() }}
            <input type="text" class="form-control " placeholder="First Name">
            <br>
            <label>Permission</label>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>