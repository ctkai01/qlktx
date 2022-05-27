@extends('layouts.app')
@section('title_for_layout', 'Dashboard')
@section('content')
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row" style="height: 500px">
      <!-- column -->
      <!-- column -->
      <div class="col-lg-12 ct-charts card">
          <div style="display: flex; justify-content: flex-end">
          
            <select class="custom-select form-select" style="width: 100px; margin-top: 10px">
              <option value="0" selected>Tuần</option>
              <option value="1">Tháng</option>
              <option value="2">Năm</option>
          </select>
          </div>
        
          <div class="campaign ct-charts" style="height: 300px">
           
              <canvas style="width: 100%; height: 100%" id="myChart"></canvas>
          </div>
          <div class="card-body statis-box border-top">
            <div class="row m-b-0" style="display: flex; justify-content: space-around">
                <!-- col -->
                <div style="text-align: center; font-size: 20px; font-weight: 700">Thống kê tiền đã nộp</div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="m-r-10"><span class="text-orange display-5"><i class="mdi mdi-wallet"></i></span></div>
                        <div><span>Tổng số tiền đã thu</span>
                            <h3 class="price_value font-medium m-b-0 totalRecharge">{{$totalMoneyRoomPay}}</h3>
                        </div>
                    </div>
                </div>
                <!-- col -->
                <!-- col -->
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="m-r-10"><span class="text-cyan display-5"><i class="mdi mdi-star-circle"></i></span></div>
                        <div><span>Tổng số tiền còn nợ</span>
                            <h3 class="price_value font-medium m-b-0 totalBought">{{$totalMoneyOweRoom}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
      <!-- column -->
  </div>
  </div>
  <!-- / Content -->

  <!-- Footer -->

</div>
@endsection
@push('after-scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/currency.js@~2.0.0/dist/currency.min.js"></script>
  <script>
     $(document).ready(function(){
      let myChart = document.getElementById('myChart').getContext('2d');
            var massPopChart = new Chart(myChart, {
                type:'bar', 
                data:{
                    labels: [],
                    datasets:[{
                        label:'Tiền phòng',
                        data: [],
                        backgroundColor:'rgb(0,191,255)',
                        borderWidth:1,
                        borderColor:'#777',
                        hoverBorderWidth:3,
                        hoverBorderColor:'#000'
                    }]
                },
                options:{
                    title:{
                        display:true,
                        fontSize:25
                    },
                    legend:{
                        display:true,
                        position:'right',
                        labels:{
                            fontColor:'#000',
                            fontSize: '50px'
                        }
                    },
                    layout:{
                        padding:{
                            left:50,
                            right:0,
                            bottom:0,
                            top:0
                        }
                    },
                    tooltips:{
                        enabled: true
                    }
                }
            });

            function addData(chart, label, data) {
                chart.data.labels = label;
                chart.data.datasets[0].data = data
                chart.update();
            }

            const statisticalUser = function() {
                $.ajax({
                    url: "{{ route('dashboard.own_student') }}",
                    type: 'GET',
                    data: {
                        time: $('.custom-select option:selected').attr('value'),
                    },
                    success: function(data) {
                        console.log(data)
                        if ( data.type === 'Week' ) {
                            labels = ['Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy', 'Chủ nhật']
                            $('.card-subtitle').text('Overview of Latest Week')
                            addData(massPopChart, labels, data.users)
                        } else if ( data.type === 'Month' ) {
                            var dt = new Date();
                            var month = dt.getMonth() + 1;
                            var year = dt.getFullYear();
                            var daysInMonth = new Date(year, month, 0).getDate();
                            labels = []
                            for ( i = 1; i <= daysInMonth; i++ ) {
                                labels.push(i)
                            }
                            $('.card-subtitle').text('Overview of Latest Month')
                            addData(massPopChart, labels, data.users)
                        } else if ( data.type === 'Year' ) {
                            labels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 
                                    'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 
                                    'Tháng 10', 'Tháng 11', 'Tháng 12'
                                    ]
                            $('.card-subtitle').text('Overview of Latest Year')
                            addData(massPopChart, labels, data.users)
                        }
                    },
                    erro: function(error) {
                        console.log('err')
                    }
                })            
            }

            statisticalUser()
            $( ".custom-select" ).change(function() {
                statisticalUser() 
            });

            const listPrice = document.querySelectorAll('.price_value')

            listPrice.forEach(price => {
                price.textContent = currency(Number(price.textContent), { precision: 0, separator: '.', symbol: '' }).format() + "VNĐ";
            })

     })
  </script>
@endpush