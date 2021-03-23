@extends('admin.layouts.master')
@section("title") Add Service - Dashboard @endsection
@section('content')
<div class="page-header">
  <div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
      <h4><i class="icon-circle-right2 mr-2"></i>
        <span class="font-weight-bold mr-2">Add New Service</span>
        <!-- <span class="badge badge-primary badge-pill animated flipInX">"Plumbing"</span> -->
      </h4>
      <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>
  </div>
</div>
<div class="content">
	<div class="row">
		<div class="col-md-7">
			<div class="card">
				<div class="card-body">
					<form class="jquery-validation-form" action="{{ route('user.add') }}" id="create_user" method="POST">
						@csrf
						<div class="form-group row">
							<label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Product service Name:</label>
							<div class="col-lg-9">
								<input value="{{ old('name') }}" type="text" class="form-control form-control-lg" name="product-service-name"
								placeholder="enter product/service name" >
							</div>
						</div>
             
						<div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Product /Service Plan</label>
            <div class="col-lg-9">
          <select class="form-control form-control-lg mb-3" aria-label=".form-select-lg example">
            <option selected>Monthly</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
          </div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Product /Service Charge</label>
							<div class="col-lg-9">
								<input value="{{ old('product-service-charge') }}" type="text" class="form-control form-control-lg" name="product-service-charge"
								placeholder="Enter product/service charge" >
								@error('aadhar')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Description:</label>
							<div class="col-lg-9">
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="3">Decription</textarea>
								@error('description')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
							</div>
						</div>
						<div class="text-left">
							<button type="submit" class="btn btn-primary">
								submit

							</button>
							<button type="submit" class="btn btn-primary">
								cancel

							</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      let reader = new FileReader();
      reader.onload = function (e) {
        $('.slider-preview-image')
        .removeClass('hidden')
        .attr('src', e.target.result)
        .width(120)
        .height(120)
        .css('borderRadius', '0.275rem');
        $('.filename').html(input.files[0].name);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  function readSliderURL(input) {
    if (input.files && input.files[0]) {
      let reader = new FileReader();
      reader.onload = function (e) {
        $('.slider-preview-slider_image')
        .removeClass('hidden')
        .attr('src', e.target.result)
        .width(120)
        .height(120)
        .css('borderRadius', '0.275rem');
        $('.filename').html(input.files[0].name);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  $(document).ready(function() {
    $('#create_service').validate({
      rules: {
        name: "required",
        description: "required",
        charges: "required",
        image: {
          required: {
            depends: function(element) {
              return $("#parent_id option:selected").val() == "0"
            }
          }
        }
      },
      messages: {
        name: "Please enter service name",
        description: "Please enter description",
        image: "Please select icon image",
        charges: "Please enter service charge"
      }
    });
  });
</script>
@endsection