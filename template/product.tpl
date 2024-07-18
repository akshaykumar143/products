</div>
<div class="container">
  <div class="row">
    <div class="col-9" style="margin-top: 15vh;"><span class="movie-title h-2 font-weight-bold">Products</span></div>
    <div class="col-3" style="margin-top: 15vh;">
      <button class="btn btn-primary addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight">add new product
      </button>

    </div>
  </div>
  <div class="row" style="margin-top:5vh;">
    <div class="table-responsive table-bordered movie-table">
      <table class="table movie-table">
        <thead>
          <tr class="movie-table-head">
            <th>#</th>
            <th> Name</th>
            <th>prize</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php   if( !empty( $product=  $product->getAll() )){   
            foreach($product as $key => $value){
              
            ?>

          <tr class="light-row"  data-id="<?=$value['id'] ?>">
            <td><?=$key+1 ?></td>
            <td><?=$value['name'] ?></td>
            <td> <span style="color:green;"> <?=$value['prize'] ?></span> </td>
            <td><button class="edit ">edit</button><button class="delete">delete</button></td> 
          </tr>
          <?php    } }   ?>
        </tbody>
      </table>
    </div>
  </div>


  <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasRightLabel">Create Product</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <form action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">name</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="Name *" value="" required />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="prize">prize</label>
              <input type="text" id="prize" name="prize" class="form-control" placeholder="prize *" value="" required />
            </div>
          </div>
          <div class="col-md-6 mx-5 mt-2">
           
            
            <input type="submit" class="btnRegister" value="Save" />
          </div>
        </div>
      </form>
    </div>
  </div>


  <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="offcanvasRightupdate" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasRightLabel">Update product</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <form action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">name</label>
              <input type="text" id="nameedit" name="name" class="form-control" placeholder="Name *" value="" required />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="prize">prize</label>
              <input type="text" id="prizeedit" name="prize" class="form-control" placeholder="prize *" value="" required />
            </div>
          </div>
          <div class="col-md-6 mx-5 mt-2">
           
            
            <input type="submit" class="btnRegister" value="Save" />
            <input type="hidden" id="id" name="id" />
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
</style>

<script>
  
  $(document).on("click", ".delete", function() {
     if(confirm("Are you sure?")) {
      $(this).closest('tr').remove();

       $.ajax({
         url: '/api.php/?page=product-delete',
         type: 'POST',
         data: {
           id: $(this).closest('tr').data('id')
         },
         success: function(res) {
          alert('deleted successfully');
         }
       });
     }
     
 

  })

  
  $(document).on("click", ".edit", function() {
    $("#id").val("");

    $.ajax({
      url: '/api.php/?page=product-view',
      type: 'POST',
      data: {
        id: $(this).closest('tr').data('id')
      },
      success: function(res) {
        response = JSON.parse(res); // parse res.

        console.log( response.name );
        $("#nameedit").val(response.name);
        $("#prizeedit").val(response.prize);
        $("#id").val(response.id);
        $("#offcanvasRightupdate").offcanvas('show');
        $("#offcanvasRightupdate").data('id', response.id);
      }
    });
  })

</script>