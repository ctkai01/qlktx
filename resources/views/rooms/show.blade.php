@extends('layouts.app')
@section('title_for_layout', 'Xem phòng')
@section('css')
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <style>
        .info-room {
            /* color: aqua; */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .wrapper {
            width: 100%;
            padding-top: 20px;
            text-align: center;
        }

        h2 {
            font-family: sans-serif;
            color: #fff;
        }

        .carousel {
            width: 90%;
            margin: 0px auto;
        }

        .slick-slide {
            margin: 10px;
        }

        .slick-slide img {
            width: 100%;
            border: 2px solid #fff;
        }

        .wrapper .slick-dots li button:before {
            font-size: 20px;
            color: white;
        }

        .slick-prev:before {
            color: #000;
        }

        .slick-next:before {
            color: #000;
        }

        .slick-dots li.slick-active button:before,
        .slick-dots li button:before {
            color: orange !important;
        }

        #datatableListStudentRoom_wrapper .row {
            margin-top: 30px
        }
    </style>

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="">
                    <h3 class="mt-4" style="margin-left: 20px">Thông tin phòng</h3>
                    <div class="info-room">
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center mb-3">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <strong>Mã phòng: </strong> {{ $room->MaPhong }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Số người quy định: </strong> {{ $room->SoNguoi }}
                                    </div>
                                    <div class="mb-2"
                                        style="display: flex; align-items: center; justify-content: center">
                                        <strong>Tình trạng: </strong>
                                        @if ($room->TinhTrang)
                                            <div
                                                style="margin: 0 4px; width: 10px; height: 10px; border-radius: 50%; background-color: rgb(57, 225, 111)">
                                            </div>
                                            <div class="state" style="line-height: 15px;">Còn chỗ</div>
                                        @else
                                            <div
                                                style="margin: 0 4px; width: 10px; height: 10px; border-radius: 50%; background-color: red">
                                            </div>
                                            <div class="state" style="line-height: 15px;">Hết chỗ</div>
                                        @endif
                                    </div>
                                    <div class="mb-2"
                                        style="display: flex; align-items: center; justify-content: center">
                                        <strong>Loại Phòng: </strong>
                                        @if ($room->LoaiPhong)
                                            <img width="30px" src="{{ asset('/vip-card.png') }}" />
                                        @else
                                            Thường
                                        @endif
                                    </div>
                                    <div class="mb-2">
                                        <strong>Giá phòng: </strong> <span
                                            class="price-room">{{ $room->GiaPhong }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="">
                    <h3 class="mt-4" style="margin-left: 20px">Hình ảnh</h3>
                    {{-- <div class="wrapper">
                        <div class="carousel">
                            @foreach ($room->media as $image)
                                <div><img width="300" height="300" src="{{ $image->Ten }}"></div>
                            @endforeach
                            <div><img width="300" height="300" src="https://picsum.photos/300/200?random=2">
                            <div><img width="300" height="300" src="https://picsum.photos/300/200?random=1">
                        </div>
                    </div> --}}
                    <div class="wrapper">
                        <div class="carousel">
                            @foreach ($room->media as $image)
                                <div><img width="300" height="300" src="{{ $image->Ten }}"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <div style="display: flex; justify-content: space-between">
                        <h3 class="mt-4" style="margin-left: 20px">Danh sách sinh viên ở</h3>
                        <button style="height: 50px; margin-right: 10px" type="button" class="btn btn-success"
                            data-bs-target="#basicModal" data-bs-toggle="modal">Thêm sinh viên</button>
                    </div>
                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Thêm sinh viên</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col mb-3">
                                            <select class="input-select-name " placeholder="Chọn sinh viên"
                                                name="student_msv">
                                                <option value="">Chọn sinh viên</option>
                                            </select>
                                            <span class="error_student_msv" style="color: red"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary btn-close-modal"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary btn-add-student-room">Thêm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="datatableListStudentRoom">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Số thứ tự</th>
                                    <th style="text-align: center">Mã sinh viên</th>
                                    <th style="text-align: center">Ảnh</th>
                                    <th style="text-align: center">Họ tên</th>
                                    <th style="text-align: center">Ngày sinh</th>
                                    <th style="text-align: center">Lớp</th>
                                    <th style="text-align: center">Khoa</th>
                                    <th style="text-align: center">Hành động</th>
                                </tr>
                            </thead>
                            {{-- <tbody class="table-border-bottom-0">
                                @foreach ($room->students as $index => $student)
                                    <tr>
                                        <td style="text-align: center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $index + 1 }}</strong>
                                        </td>
                                        <td style="text-align: center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $student->MaSV }}</strong>
                                        </td>
                                        <td style="text-align: center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <img width="200" src="{{ $student->Anh }}" />
                                        </td>
                                        <td style="text-align: center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $student->HoTen }}</strong>
                                        </td>
                                        <td style="text-align: center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $student->NgaySinh }}</strong>
                                        </td>
                                        <td style="text-align: center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $student->Lop }}</strong>
                                        </td>
                                        <td style="text-align: center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $student->Khoa }}</strong>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('students.show', $student->MaSV) }}"><i
                                                            class="bx bx-edit-alt me-1"></i>Xem</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('student.list_room_owe', $student->MaSV) }}"><i
                                                            class="bx bx-edit-alt me-1"></i>Danh sách nợ phòng</a>
                                                    <a class="dropdown-item kick-btn"
                                                        href="{{ route('rooms.kick_student', [$room->MaPhong, $student->MaSV]) }}"><i
                                                            class="bx bx-edit-alt me-1"></i>Đuổi</a>
                                                    {{-- <div class="dropdown-item "><i
                                                            class="bx bx-edit-alt me-1"></i></div> --}}
                                                {{-- </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody> --}}
                        </table>
                    </div>
                </div>
            </div>
            <!-- Basic Bootstrap Table -->
            <!--/ Responsive Table -->
        </div>
        <!-- / Content -->
    </div>
@endsection
@push('after-scripts')
    <script src="https://unpkg.com/currency.js@~2.0.0/dist/currency.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/dt.js') }}"></script>
    <script>
        const price = document.querySelector('.price-room')
        price.textContent = currency(Number(price.textContent), {
            precision: 0,
            separator: '.',
            symbol: ''
        }).format() + " VNĐ";

        const studentNotRoom =
            JSON.parse(JSON.stringify(<?php
            echo json_encode($studentNotRoom);
            ?>));
        console.log(studentNotRoom)
        studentNotRoom.forEach(student => {
            $('.input-select-name').append(`
            <option value="${student.MaSV}">${student.HoTen} - ${student.MaSV}</option>
                                      
        `)
        });

        $(document).ready(function() {
            var table = $('#datatableListStudentRoom').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: true,
                order: [
                    [0, 'desc']
                ],
                ajax: {
                    url: '{{ route('rooms.show_student_dt', $room->MaPhong) }}',
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
                        data: 'MaSV',
                        name: 'MaSV',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'Anh',
                        name: 'Anh',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'HoTen',
                        name: 'HoTen',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'NgaySinh',
                        name: 'NgaySinh',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'Lop',
                        name: 'Lop',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'Khoa',
                        name: 'Khoa',
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


            $('.carousel').slick({
                // slidesToShow: 1,
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                // centerMode: true,
                infinite: false,
            });
            $('select').selectize({
                sortField: 'text'
            });
            $('body').on('click', '.btn-add-student-room', function(e) {
                const csrf_token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('rooms.add_student', $room->MaPhong) }}",
                    type: 'POST',
                    data: {
                        'masv': $('select').val(),
                        '_method': 'POST',
                        '_token': csrf_token,
                    },
                    success: function(data) {
                        if (data.success == true) {
                            // drawDatatable();
                            // table.draw();
                            $('.btn-close-modal').click()
                            $(".table").load(location.href + " .table");
                            toastr.success(data.message);
                        }
                    },
                    error: function(xhr) {
                        $('.error_student_msv').text(xhr.responseJSON.errors['masv'])
                    }
                });
            })

            $('body').on('click', '.kick-btn', function(e) {
                e.preventDefault();
                var me = $(this),
                    url = me.attr('href'),
                    id = me.attr('data-id'),
                    csrf_token = $('meta[name="csrf-token"]').attr('content');
                swal({
                    title: 'Bạn có chắc ?',
                    text: 'Bạn có chắc muốn đuổi sinh viên này ?',
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
                                '_method': 'POST',
                                '_token': csrf_token,
                            },
                            success: function(data) {
                                if (data.success == true) {
                                    // drawDatatable();
                                    // table.draw();
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
