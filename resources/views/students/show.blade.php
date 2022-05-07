@extends('layouts.app')
@section('title_for_layout', 'Danh sách phòng')
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="card" style="padding-bottom: 20px">
            <div class="mt-4" style="display: flex; justify-content: center">
                <img width="300" src="{{$student->Anh}}"/>
            </div>
            <div class="row mt-4">
                <div class="col-6" style="display: flex; flex-direction: column; align-items: center; font-size: 18px">
                    <div><strong>Mã sinh viên: </strong><span>{{$student->MaSV}}</span></div>
                    <div><strong>Họ và tên: </strong><span>{{$student->HoTen}}</span></div>
                    <div><strong>Ngày sinh: </strong><span>{{$student->NgaySinh}}</span></div>
                    <div><strong>Giới tính: </strong><span>{{$student->GioiTinh}}</span></div>
                </div>
                <div class="col-6" style="display: flex; flex-direction: column; align-items: center">
                    <div><strong>Quê quán: </strong><span>{{$student->QueQuan}}</span></div>
                    <div><strong>Điện thoại: </strong><span>{{$student->DienThoai}}</span></div>
                    <div><strong>Lớp: </strong><span>{{$student->Lop}}</span></div>
                    <div><strong>Phòng: </strong><span>{{$student->room ? $student->room->MaPhong : 'Chưa có phòng'}}</span></div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
@endsection
@push('after-scripts')
    <script src="https://unpkg.com/currency.js@~2.0.0/dist/currency.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script>
        
    </script>
@endpush
