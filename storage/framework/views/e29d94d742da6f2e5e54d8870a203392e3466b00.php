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
        	<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($role->id); ?></td>
              <td><?php echo e($role->role); ?></td>
              <td><?php echo e($role->module); ?></td>
              <td style="text-align:center">
                <a href="/roles/<?php echo e($role->id); ?>" class="btn btn-success btn-sm update">View</a>
                <a href="/roles/<?php echo e($role->id); ?>" class="btn btn-danger btn-sm delete">Delete</a>
              </td>
            </tr>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
      <?php echo e($roles->links()); ?>

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
            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($module->parent == 0): ?>
                <input type="checkbox" name="module" class="module" value="<?php echo e($module->id); ?>"><?php echo e($module->module); ?>

                </br>
                <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($child->parent == $module->id): ?>
                  &nbsp&nbsp
                    <input type="checkbox" name="module" class="module" value="<?php echo e($child->id); ?>"><?php echo e($child->module); ?>

                    </br>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        _token : '<?php echo e(csrf_token()); ?>',
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