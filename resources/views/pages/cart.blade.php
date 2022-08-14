@extends('layouts.app')

@section('title')
    Store Cart Page
@endsection

@section('content')
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
            <div class="col-12">
                <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Cart</li>
                </ol>
                </nav>
            </div>
            </div>
        </div>
        </section>

        <section class="store-cart">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 table-responsive">
                <table class="table table-borderless table-cart">
                <th>
                    <tr>
                    <td><u><strong>Image</strong></u></td>
                    <td><u><strong>Product Name</strong></u></td>
                    <td><u><strong>Price</strong></u></td>
                    <td><u><strong>Menu</strong></u></td>
                    </tr>
                </th>
                <tbody>
                    {{-- @php $totalPrice = 0 @endphp --}}
                  @foreach ($carts as $cart)
                    <tr>
                      <td style="width: 20%;">
                        @if($cart->product->galleries)
                          <img
                            src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                            alt=""
                            class="cart-image"
                          />
                        @endif
                      </td>
                      <td style="width: 35%;">
                        <div class="product-title">{{ $cart->product->name }}</div>
                      </td>
                      <td style="width: 35%;">
                        <input type="hidden" class="product-title product_price[]" name="product_price[]" id="product_price[]" value="{{number_format ($cart->product->price)}}">
                        <div class="product-title price[]" id="price[]" name="price[]" value="{{number_format ($cart->product->price)}}">Rp. {{ number_format($cart->product->price) }}</div>
                        <div class="product-subtitle">Rupiah</div>
                      </td>
                      
                      <td style="width: 20%;">
                        <form action="{{ route('cart-delete', $cart->products_id) }}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button class="btn btn-remove-cart" type="submit">
                            Remove
                          </button>
                        </form>
                      </td>
                    </tr>
                    
                    {{-- @php $totalPrice += $cart->product->price @endphp --}}
                  @endforeach
                  <tr class="text-right">
                    <td colspan="2" class="text-right" >Total Price</td>
                    <td class="text-center total-price"> <input class="form-control total-price" id="total-price" name="total-price" type="number" value="" readonly></td>
                </tr> 
                </tbody>
              </table>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr />
            </div>
            <div class="col-12">
              <h2 class="mb-4">Shipping Details</h2>
            </div>
          </div>
          <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="total_price" value="">
            <div class="row mb-2" data-aos="fade-up" data-aos-delay="200" id="locations">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address_one">Address 1</label>
                  <input
                    type="text"
                    class="form-control"
                    id="address_one"
                    name="address_one"
                    value="Setra Duta Cemara"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address_two">Address 2</label>
                  <input
                    type="text"
                    class="form-control"
                    id="address_two"
                    name="address_two"
                    value="Blok B2 No. 34"
                  />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="province_id">Province</label>
                  <select name="province_id" id="province_id" class="form-control" data-live-search="true">
                    @foreach ($provinces as $province)
                    <option value="{{$province['province_id']}}">{{$province['province']}}</option>
                    @endforeach
                  </select>
                 
                </div>
              </div>
              <div class="col-md-4">
                
                  <label for="regencies_id">City</label>
                  <select name="regencies_id" id="regencies_id" class="form-control" data-live-search="true">
                   
                  </select>
                 
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="courier_code">Kurir</label>
                  <select name="courier_code" id="courier_code" class="form-control" data-live-search="true">
                    @foreach ($types as $type)
                    <option value="{{$type['code']}}">{{$type['name'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="ongkir">Ongkir</label>
                  <select name="ongkir" id="ongkir" class="form-control" data-live-search="true">
                   
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="zip_code">Postal Code</label>
                  <input
                    type="text"
                    class="form-control"
                    id="zip_code"
                    name="zip_code"
                    value="40512"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Country</label>
                  <input
                    type="text"
                    class="form-control"
                    id="country"
                    name="country"
                    value="Indonesia"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone_number">Phone Number</label>
                  <input
                    type="text"
                    class="form-control"
                    id="phone_number"
                    name="phone_number"
                    value="+628 2020 11111"
                  />
                </div>
              </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="150">
              <div class="col-12">
                <hr />
              </div>
              <div class="col-12">
                <h2 class="mb-1">Payment Informations</h2>
              </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="200">
              {{-- <div class="col-4 col-md-3">
                <div class="product-title">$0</div>
                <div class="product-subtitle">Product Insurance</div>
              </div> --}}
              <div class="col-4 col-md-3" id="ship_all" name="ship_all">
                {{-- <div class="product-title" id="cost_ship" name="cost_ship">$0</div> --}}
                {{-- <div class="product-subtitle" id="ship" name="ship">Ship to Jakarta</div> --}}
              </div>
              <div class="col-4 col-md-3">
                <div class="product-title text-success total_priced" id="total_priced" name="total_priced" value=""></div>
                <div class="product-subtitle">Total</div>
              </div>
              <div class="col-8 col-md-3">
                <button
                  type="submit"
                  class="btn btn-success mt-4 px-4 btn-block"
                >
                  Checkout Now
                </button>
              </div>
            </div>
          </form>
        </div>
      </section>
    </div>
@endsection

@push('addon-script')
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script type="text/javascript">
$("#regencies_id").html('<option value="">Pilih Provinsi Dahulu</option>');
$("#ongkir").html('<option value="">Pilih Kota Dahulu</option>');
 $(document).ready(function() {
    $('#province_id').on('change', function() {
            var province_id = this.value;
             $("#regencies_id").html('');
            $.ajax({
                url:'/api/get-cities/' + province_id,
                type: "GET",
                dataType : 'json',
                success: function(result){
                    $.each(result.city,function(key,value){
                    $("#regencies_id").append('<option value="'+value.city_id+'">'+value.city_name+'</option>');
                    });
                }
            });
            $('#courier_code').on('change', function() {
            var courier_code = this.value;
            var regenci_id =  $("#regencies_id").val();
            $("#ongkir").html('');
            $.ajax({
                url:'/api/check-ongkir',
                type: "POST",
                data:{
                  destination:regenci_id,
                  courier:courier_code
                },
                dataType : 'json',
                success: function(result){
                
                    $.each(result,function(key,value){
                      
                    $.each(value.costs,function(k,v){
                      $("#ongkir").append('<option value="'+v.service+'-'+v.cost[0].value+'">'+v.description+'-'+'Harga:'+v.cost[0].value+'--'+'Estimasi(hari):'+v.cost[0].etd+'</option>');
                     
                    });
                    });
                }
            });
          });
       
          $('#ongkir').on('change', function() {
            var cost =  $("#ongkir").val();
            var split = cost.toString().split("-");
            $("#ship_all").html('');
            $("#ship_all").append('<div class="product-title" id="cost_ship" name="cost_ship" value="'+split[1]+'">Rp.'+split[1]+'</div>');
            $("#ship_all").append('<div class="product-subtitle" id="ship" name="ship">Ship Cost</div>');
          });

          $('#ongkir').on('change', function() {
            $("table").on("change", function() {
            var sum = 0;
            var cost = this.value;
            var split = cost.toString().split("-");
            var ship = split[1]
            var sum = 0;
            var grandTotal = document.getElementById("total_priced");
            var row = $("table").closest("tr");
            var price = parseFloat(row.find(".price").val());
            console.log('ini tableprice',price)
            console.log('ini tableprice',price)
            $('.price').each(function() {
                sum += Number($(this).val());
                console.log('ini sum',sum)
                console.log('ini price',this.value)
            });
            $(".total_priced").val(sum);
          
              grandTotal.value = sum;
          });
        });
        });
       

      
      });
  
</script>
 
@endpush