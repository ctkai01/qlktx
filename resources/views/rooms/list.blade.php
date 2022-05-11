@extends('layouts.app')
@section('title_for_layout', 'Danh sách phòng')
@section('css')
    <style>
        #datatableListRoom_wrapper .row {
            margin-top: 30px
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> --}}
            <a href="{{route('rooms.create')}}" style="display: flex; justify-content: flex-end; margin-bottom: 20px"> 
                <button type="button" class="btn btn-success">Tạo phòng</button>
            </a>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                
                <div class="table-responsive text-nowrap">
                    <table class="table" id="datatableListRoom">
                        <thead>
                            <tr>
                                <th style="text-align: center">Số thứ tự</th>
                                <th style="text-align: center">Mã phòng</th>
                                <th style="text-align: center">Tình trạng</th>
                                <th style="text-align: center">Loại Phòng</th>
                                <th style="text-align: center">Danh sách người thuê</th>
                                <th style="text-align: center">Giá phòng</th>
                                <th style="text-align: center">Hành động</th>
                            </tr>
                        </thead>
                        {{-- <tbody class="table-border-bottom-0">
                            @foreach ($rooms as $index => $room)
                                <tr>
                                    <td style="text-align: center"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$index + 1}}</strong></td>
                                          
                                    <td style="text-align: center">{{$room->MaPhong}}</td>
                                    <td  style="text-align: center">
                                        @if ($room->TinhTrang)
                                            <span class="badge bg-label-success me-1">Còn trống</span>
                                        @else
                                            <span class="badge bg-label-danger me-1">Hết chỗ</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        @if ($room->LoaiPhong)
                                            <img width="30px" src="{{ asset('/vip-card.png') }}"/>
                                        @else
                                            Thường
                                        @endif      
                                    </td>
                                    <td style="text-align: center">
                                       <ul style="display: flex; justify-content: center" class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                            @foreach($room->students as $student)
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                    class="avatar avatar-xs pull-up" title="{{$student->HoTen}}">
                                                    <img src="{{$student->Anh}}" alt="Avatar" class="rounded-circle" />
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td style="text-align: center">
                                        <div class="price-room">{{$room->GiaPhong}}</div>
                                    </td>
                                    <td style="text-align: center">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('rooms.show', $room->MaPhong)}}"><i
                                                    class="bx bx-edit-alt me-1"></i>Xem</a>
                                                <a class="dropdown-item" href="{{route('rooms.edit', $room->MaPhong)}}"><i
                                                        class="bx bx-edit-alt me-1"></i>Sửa</a>
                                                <a class="dropdown-item" href="{{route('rooms.add_bill', $room->MaPhong)}}"><i
                                                    class="bx bx-edit-alt me-1"></i>Tạo hóa đơn </a>
                                                    <a class="dropdown-item" href="{{route('rooms.list_bill', $room->MaPhong)}}"><i
                                                        class="bx bx-edit-alt me-1"></i>Danh sách hóa đơn </a>
                                                <a class="dropdown-item delete-btn" href="{{route('rooms.destroy', $room->MaPhong)}}"><i
                                                        class="bx bx-trash me-1"></i>Xóa</a>
                                            </div>
                                        </div>
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
            var table = $('#datatableListRoom').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: true,
                order: [
                    [0, 'desc']
                ],
                ajax: {
                    url: '{{ route('rooms.list_dt') }}',
                    data: function(d) {
                        // d.search = $('#filter-name').val()
                    }
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className:'text-center align-middle'
                    },
                    {
                        data: 'MaPhong',
                        name: 'MaPhong',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'TinhTrang',
                        name: 'TinhTrang',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'LoaiPhong',
                        name: 'LoaiPhong',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'DanhSachNguoiThue',
                        name: 'DanhSachNguoiThue',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'GiaPhong',
                        name: 'GiaPhong',
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

            $('body').on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var me = $(this),
                    url = me.attr('href'),
                    id = me.attr('data-id'),
                    csrf_token = $('meta[name="csrf-token"]').attr('content');
                swal({
                    title: 'Bạn có chắc ?',
                    text: 'Bạn có chắc muốn xóa phòng này  ?',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                'id': id,
                                '_method': 'DELETE',
                                '_token': csrf_token,
                            },
                            success: function(data) {
                                if (data.success == true) {
                                    $(".table").load(location.href + " .table");
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
