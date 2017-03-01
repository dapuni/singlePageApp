<section>
	 <div class="table-responsive" id="dataTable">
      	<table class="table table-striped jambo_table bulk_action">
        <thead>
          <tr class="headings">
            <th>No ID</th>
            <th class="column-title">Modules Name</th>
            <th class="column-title">Parent ID</th>
            <th class="column-title" style="text-align:center">Action</th>
          </tr>
        </thead>

        <tbody>
        	<?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr ">
              <td><?php echo e($module->id); ?></td>
              <td><?php echo e($module->module); ?></td>
              <td><?php echo e($module->parent); ?></td>
              <td style="text-align:center">
                <a href="/modules/<?php echo e($module->id); ?>" class="btn btn-success btn-sm update">View</a>
                <a href="/modules/<?php echo e($module->id); ?>" class="btn btn-danger btn-sm delete">Delete</a>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
      <?php echo e($modules->links()); ?>

  </div>
    <div>
    	<a class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="newdata">Add New</a>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Module</h4>
      </div>
      <div class="modal-body">
        <form action="/modules" id="form" class="form-horizontal" onsubmit="event.preventDefault();">
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Module Name<span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" name="module" id="module" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Parent</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" name="parent" id="parent">
                  <option value="0" selected>No Parent</option>
                  <?php $__currentLoopData = $allModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($module->id); ?>"><?php echo e($module->module); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
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
      $('#module').val('');
      $('#parent').val(0);
    });

    $('#submitForm').on('click',function(e){
      var url = $('#form').attr('action');
      axios.post(url, {
        _token : '<?php echo e(csrf_token()); ?>',
        id : $('#id').val(),
        module : $('#module').val(),
        parent : $('#parent').val() 
      })
      .then(function (response) {
        console.log(response);
        if (response.data.code == 422) {
          alert(response.data.errors.module);
        } else {
          $('#myModal').modal('toggle');
        }
        setTimeout(function(){ refreshPage(); }, 500);
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
          $('#module').val(response.data.module);
          $('#parent').val(response.data.parent);
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
      var url = '/modules';
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