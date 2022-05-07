@extends('layouts.app')
@section('title_for_layout', 'Danh sách phòng')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> --}}

            <!-- Basic Bootstrap Table -->
            <div class="card">
                {{-- <h5 class="card-header">Table Basic</h5> --}}
                <div class="table-responsive text-nowrap">
                {{-- <div class="text-nowrap"> --}}
                    <table class="table">
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
                        <tbody class="table-border-bottom-0">
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
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-edit-alt me-1"></i>Xem</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="bx bx-edit-alt me-1"></i>Sửa</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="bx bx-trash me-1"></i>Xóa</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script>
        const listPrice = document.querySelectorAll('.price-room')

        listPrice.forEach(price => {
            price.textContent = currency(Number(price.textContent), { precision: 0, separator: '.', symbol: '' }).format() + " VNĐ";
        })
    </script>
@endpush
