@extends('admin.layouts.master')
@section("title") Add Invoice - Dashboard @endsection
@section('content')
<div class="page-header">
  <div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
      <h4><i class="icon-circle-right2 mr-2"></i>
        <span class="font-weight-bold mr-2">Add New Invoice</span>
        <!-- <span class="badge badge-primary badge-pill animated flipInX">"Plumbing"</span> -->
      </h4>
      <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>
  </div>
</div>
<div class="content">
  <div class="card">
    <div class="card-body">
      
      <form class="row g-3">
        <div class="col-md-6">
          <label for="Invoice Number" class="form-label">Invoice Number</label>
          <input type="text" class="form-control" id="invoiceNumber" name="invoiceNumber" placeholder="invoice number">
        </div>
        <div class="col-md-6">
          <label for="Invoice Date" class="form-label">Invoice Date</label>
          <input type="text" class="form-control" id="inputPassword4" name="invoiceDate">
        </div>
        <div class="col-10">
          <label for="First client Name" class="form-label">First client Name</label>
          <input type="text" class="form-control" id="inputAddress" placeholder="">
        </div>
        <div class="col-md-6">
          <label for="Contact number" class="form-label">Contact number</label>
          <input type="text" class="form-control" id="inputAddress2" placeholder=>
        </div>
        <div class="col-md-6">
          <label for="Client Address" class="form-label">Client Address</label>
          <input type="text" class="form-control" id="inputCity">
        </div>
        <div class="col-12">
          <label for="Select name" class="form-label">Select Name</label>
          <select class="form-control form-control-lg mb-3" aria-label=".form-select-lg example" name="select-name">
            <option selected>Select Product Services Name</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div class="col-12">
          <label for="Service amount" class="form-label">Service amount</label>
          <input type="text" class="form-control" id="" placeholder=""  name="service-amount">
          <div class="btn-group-vertical">
            <button class="btn btn-danger mx-3 mt-2">Remove</button>
            <button class="btn btn-danger mx-3 mt-2">Add field</button>
          </div>
        </div>
        <div class="col-md-6 mt-2">
          <label for="Gross Amount" class="form-label">Gross Amount</label>
          <input type="text" class="form-control" id="" name="gross-amount" >
        </div>
        <div class="col-md-6 mt-2">
          <label for="Discount" class="form-label">Discount</label>
          <input type="text" class="form-control" id="" name="discount">
        </div>
        <div class="col-12">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label" for="inlineRadio1">Percentage</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">round Figure(rupee)</label>
          </div>
          
        </div>
        <div class="col-md-6">
          <label for="GST Tax Slab" class="form-label">GST Tax Slab</label>
          <select class="form-control form-control-lg mb-3" aria-label=".form-select-lg example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="Grand Total" class="form-label">Grand Total</label>
          <input type="text" class="form-control" id="" name="grand-total">
        </div>
        <div class="col-md-6">
          <label for="Connection Date" class="form-label">Connection Date</label>
          <input type="text" class="form-control" id="Connection Date" name="connection-date">
        </div>
        <div class="col-md-6">
          <label for="Service Time" class="form-label">Service Time</label>
          <select class="form-control form-control-lg mb-3" aria-label=".form-select-lg example">
            <option selected>Select Service Time</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div class="col-12 mb-3">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
            <label class="form-check-label" for="inlineCheckbox1">Unpaid</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
            <label class="form-check-label" for="inlineCheckbox2">Paid</label>
          </div>
        </div>
        <div class="col-md-6 ">
          <label for="From Date" class="form-label">From Date</label>
          <input type="text" class="form-control" id="inputCity">
        </div>
        <div class="col-md-6">
          <label for="To Date" class="form-label">To Date</label>
          <input type="text" class="form-control" id="inputCity">
        </div>
        <div class="col-12">
          <label for="Remarks" class="form-label">Remarks</label>
          <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
        </div>
        <div class="col-12 mt-2">
          <button type="submit" class="btn btn-primary">Sign in</button>
          <button type="submit" class="btn btn-primary">Cancel</button>
        </div>
      </form>
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