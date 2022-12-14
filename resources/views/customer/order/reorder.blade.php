@extends('customer.layout.layout')
@section('title','Đơn hoàn trả')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop
@section('content')
<h2 class="text-center">Đơn hoàn trả</h2>
<br>
<div class="ordercus">
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Sản phẩm</th>
            <th>Ghi chú</th>
            <th>Trạng thái</th>
            <th>Cập nhật</th>
            <th colspan="2">Thao tác</th>
        </tr>
        @foreach ($reorder as $val)
        <tr>
                 <td>{{$val->id}}</td>
                 <td>{{$val->product->name}}</td>
                <td>{{$val->des}}</td>
                <td>
                    @if ($val->status == 1)
                    <h6 href="#" class="link-warning">Đợi xác nhận</h6>
                    @endif
                    @if ($val->status == 2)
                    <h6 href="#" class="link-secondary">Đã xác nhận</h6>
                    @endif
                    @if ($val->status == 3)
                    <h6 href="#" class="link-secondary">Shipper đã nhận hàng</h6>
                    @endif
                    @if ($val->status == 4)
                    <h6 href="#" class="link-success">Hoàn trả thành công</h6>
                    @endif
                </td>
                <td>
                    <a href="{{route('reorder.status',$val->id)}}" class="btn btn-primary">Cập nhật</a>
                </td>
                <td>
                    {{-- <a href="{{route('order.detail',$val->id)}}" class="btn btn-secondary">Chi tiết</a> --}}
                    <button class="btn btn-info reorder_detail" data-id="{{$val->order_id}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Chi tiết</button>
                </td>
        </tr>
        @endforeach
    </table>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-center" id="staticBackdropLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="order_detail"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    $('.reorder_detail').click(function(){
        // window.location.reload();
        var id = $(this).attr('data-id');
            $.ajax({
               type :'GET',
               url  : '/customer/reorderdetail/'+id,
            //    data : {
            //    },
               success:function(data){
                   console.log(data);
                //    window.stop();
                //    window.location.reload();
                   if(data){ 
                    let htm = '';
                    $('#staticBackdropLabel').text('Thông tin đơn hàng số:'+ data[0].order_id);
                    // htm += '<h2 class="text-center">Thông tin đơn hàng</h2>'
                    htm += '<div class="text-center">';
                    htm += data[0].receiver['name'] + '<br>';
                    htm += data[0].receiver['email'] + '<br>';
                    htm += data[0].receiver['phone'] + '<br>';
                    htm += data[0].receiver['address'] + '<br>';
                    data.forEach(element => {
                        htm += '<img src="' + 'http://127.0.0.1:8000/' + element.product['image'] + '" alt="error" style="width:100px">'; 
                        htm += '<p> ' + element.product['name'] + ' </p>';
                        // htm += '<p> ' + number_format("+element.product['price']+", 0, ',', '.') + ' </p>';
                        htm += '<p> ' + moneyfomart(element.product['price']) + ' VND</p>';
                        htm += '<p>Số lượng: ' + element.single_quantity + '</p>';


                    });
                    htm += '<p>Vận chuyển: ' + data[0].ship['name'] + '-' + moneyfomart(data[0].ship['price']) + ' VND<br>';
                    htm += '<p>Phương thức thanh toán: ' + data[0].payment['method'] + '<br>';
                    htm += '<p>Tổng số lượng: ' + data[0].order['quantity'] + '<br>';
                    htm += '<p>Tổng giá tiền: ' + moneyfomart(data[0].total) + ' VND<br>';
                    htm += '</div>';
                       $('#order_detail').html(htm);
                   }else{
                        alert("Đơn hàng trống");
                        window.stop();
                   }
               }
            });
            
        }
        );
        function moneyfomart(value) {
            var number = new Intl.NumberFormat('vi-VN').format(value);
    return number;
   }
</script>
@stop