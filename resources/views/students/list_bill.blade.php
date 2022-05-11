@extends('layouts.app')
@section('title_for_layout', 'Danh sách phòng')
@section('css')
    <style>
        #datatableListBill_wrapper .row {
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
                    <table class="table" id="datatableListBill">
                        <thead>
                            <tr>
                                {{-- <th style="text-align: center">Số thứ tự</th> --}}
                                <th style="text-align: center">Tiền điện</th>
                                <th style="text-align: center">Tiền nước</th>
                                <th style="text-align: center">Tiền phát sinh</th>
                                <th style="text-align: center">Ghi chú</th>
                                <th style="text-align: center">Hóa đơn cho</th>
                                <th style="text-align: center">Tổng tiền</th>
                                <th style="text-align: center">Tình trạng thanh toán</th>
                                <th style="text-align: center">Hành động</th>
                            </tr>
                        </thead>
                        {{-- <tbody class="table-border-bottom-0">
                            @foreach ($billOwe as $index => $bill)
                                <tr>
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
                                    <td style="text-align: center">
                                        <a class="btn-payment" href="{{ route('bill_payment', $bill->MaHoaDon) }}"><button type="button" class="btn btn-success" aria-expanded="false">Thanh toán</button></a>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script src="{{ asset('assets/js/dt.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#datatableListBill').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: true,
                order: [
                    [0, 'desc']
                ],
                ajax: {
                    url: '{{ route('student.bill_owe_dt') }}',
                    data: function(d) {
                        // d.search = $('#filter-name').val()
                    }
                },
                columns: [{
                        data: 'TienDien',
                        name: 'TienDien',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'TienNuoc',
                        name: 'TienNuoc',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'TienPhatSinh',
                        name: 'TienPhatSinh',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'GhiChu',
                        name: 'GhiChu',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'HoaDonCho',
                        name: 'HoaDonCho',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'TongTien',
                        name: 'TongTien',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'TinhTrangThanhToan',
                        name: 'TinhTrangThanhToan',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center align-middle'
                    }
                ]
            })
            const listPrice = document.querySelectorAll('.price-room')

            listPrice.forEach(price => {
                price.textContent = currency(Number(price.textContent), {
                    precision: 0,
                    separator: '.',
                    symbol: ''
                }).format() + " VNĐ";
            })

            $('body').on('click', '.btn-payment', function(e) {
                e.preventDefault();
                var me = $(this),
                    url = me.attr('href'),
                    id = me.attr('data-id'),
                    csrf_token = $('meta[name="csrf-token"]').attr('content');
                console.log(url)

                swal({
                    title: 'Bạn có chắc ?',
                    text: 'Bạn có chắc muốn thanh toán hóa đơn này ?',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                // 'id': id,
                                // '_method': 'POST',
                                '_token': csrf_token,
                            },
                            success: function(data) {
                                if (data.success == true) {
                                    table.draw();
                                    // $(".table").load(location.href + " .table");
                                    toastr.success(data.message);
                                }
                            },
                            error: function(xhr) {
                                //     Swal.fire({
                                //         type: 'info',
                                //         title: '',
                                //         text: 'Delete Fail',
                                //         showConfirmButton: false,
                                //         timer: 1500
                                //     });
                            }
                        });
                    }
                });
            })
        });
    </script>
@endpush
