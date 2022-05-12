@extends('layouts.app')
@section('title_for_layout', 'Danh sách phòng')
@section('css')
    <style>
        #datatableListEmployee_wrapper .row {
            margin-top: 30px
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> --}}
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table" id="datatableListEmployee">
                        <thead>
                            <tr>
                                <th style="text-align: center">Thời gian</th>
                                <th style="text-align: center">Mã số nhân viên trực</th>
                                <th style="text-align: center">Nhân viên trực</th>
                                <th style="text-align: center">SĐT</th>
                            </tr>
                        </thead>
                        {{-- <tbody class="table-border-bottom-0">
                            @foreach ($bills as $index => $bill)
                                <tr>
                                    <td style="text-align: center">{{$bill->MaHoaDon}}</td>
                             
                                    <td style="text-align: center">
                                        <div class="price-room">{{$bill->TienDien}}</div>
                                    </td>
                                    <td style="text-align: center">
                                        <div class="price-room">{{$bill->TienNuoc}}</div>
                                    </td>
                                    <td style="text-align: center">
                                        <div class="price-room">{{$bill->TienPhatSinh}}</div>
                                    </td>
                                    <td style="text-align: center">
                                        <div class="">{{$bill->GhiChu}}</div>
                                    </td>
                                    <td style="text-align: center">
                                        @php
                                            $timestamp = strtotime($bill->ThoiGian);
                                            $new_date = date("m-Y", $timestamp);
                                            echo "<div>$new_date</div>";
                                        @endphp
                                    </td>
                                    <td style="text-align: center">
                                        @php
                                            $total = $bill->TienDien + $bill->TienNuoc + $bill->TienPhatSinh;
                                            echo "<div class='price-room'>$total</div>";
                                        @endphp
                                    </td>
                                    <td style="text-align: center">
                                        @if ($bill->DaThanhToan) 
                                            <span class="badge bg-label-success me-1">Đã thanh toán</span>
                                        @else
                                            <span class="badge bg-label-danger me-1">Chưa thanh toán</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center"> --}}
                                        {{-- <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href=""><i
                                                    class="bx bx-edit-alt me-1"></i></a>
                                            </div>
                                        </div> --}}
                                        {{-- <button type="button" class="btn btn-success" aria-expanded="false">Thanh toán</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                   
                    </table>
                </div>
            </div>

            <!--/ Responsive Table -->
        </div>
        <!-- / Content -->
    </div>
@endsection
@push('after-scripts')
    <script src="https://unpkg.com/currency.js@~2.0.0/dist/currency.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script src="{{ asset('assets/js/dt.js') }}"></script>
    
    <script>
        const listPrice = document.querySelectorAll('.price-room')

        listPrice.forEach(price => {
            price.textContent = currency(Number(price.textContent), { precision: 0, separator: '.', symbol: '' }).format() + " VNĐ";
        })

        $(document).ready(function() {
            var table = $('#datatableListEmployee').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: true,
                order: [
                    // [0, 'desc']
                ],
                ajax: {
                    url: '{{ route('employee.schedule_work_dt') }}',
                    data: function(d) {
                        // d.search = $('#filter-name').val()
                    }
                },
                columns: [
                    {
                        data: 'ThoiGian',
                        name: 'ThoiGian',
                        className:'text-center align-middle'
                    },
                    {
                        data: 'MaNV',
                        name: 'MaNV',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'HoTen',
                        name: 'HoTen',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'DienThoai',
                        name: 'DienThoai',
                        className: 'text-center align-middle'
                    },
                ]
            })

            // $('body').on('click', '.btn-change-time', function(e) {
            //     e.preventDefault();
            //     var me = $(this),
            //         url = me.attr('href'),
            //         id = me.attr('data-id'),
            //         masv = me.attr('aria-colindex'),
            //         csrf_token = $('meta[name="csrf-token"]').attr('content');
            //     const inputValue = $(`#${masv}`).val()
            //     swal({
            //         title: 'Bạn có chắc ?',
            //         text: 'thay đổi giờ làm việc của nhân viên này ?',
            //         icon: "warning",
            //         buttons: true,
            //         dangerMode: true,
            //     }).then((result) => {
            //         if (result) {
            //             $.ajax({
            //                 url: url,
            //                 type: 'POST',
            //                 data: {
            //                     'id': id,
            //                     'ca_lam': inputValue,
            //                     '_method': 'POST',
            //                     '_token': csrf_token,
            //                 },
            //                 success: function(data) {
            //                     if (data.success == true) {
            //                         // drawDatatable();
            //                         table.draw();
            //                         // $(".table").load(location.href + " .table");
            //                         toastr.success(data.message);
            //                     }
            //                 },
            //                 error: function(xhr) {
            //                     //     Swal.fire({
            //                     //         type: 'info',
            //                     //         title: '',
            //                     //         text: 'Delete Fail',
            //                     //         showConfirmButton: false,
            //                     //         timer: 1500
            //                     //     });
            //                 }
            //             });
            //         }
            //     });
            // })
        });
    </script>
@endpush
