<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />
    <style>
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
    </style>
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="http://utt.edu.vn/home/images/stories/logo-utt-border.png" style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Chào Mừng KTX Đại Học Công Nghệ Giao Thông Vận Tải</h4>
                                    </div>
                                    <form method="POST" action="{{ route('auth.login')}}">
                                        @csrf
                                        <p>Hãy đăng nhập bằng tài khoản của bạn</p>

                                        <div class="form-outline ">
                                            <input type="text" id="form2Example11" name="account" class="form-control"  value="{{ old('account') }}" />
                                            <label class="form-label" for="form2Example11">Tài Khoản</label>
                                        </div>
                                       
                                        <div class="mb-2 mt-1">
                                            @if($errors->has('account'))
                                                <span class="error_account" style="color: red">{{ $errors->first('account') }}</span>
                                            @endif 
                                        </div>

                                        <div class="form-outline mb-2">
                                            <input type="password" name="password" value="{{ old('password') }}" id="form2Example22" class="form-control" />
                                            <label class="form-label" for="form2Example22">Mật Khẩu</label>
                                        </div>

                                        <div class="mb-2 mt-1">
                                            @if($errors->has('password'))
                                                <span class="error_password" style="color: red">{{ $errors->first('password') }}</span>
                                            @endif 
                                        </div>

                                        <div style="height: 16px; margin: 10px">
                                            @if($errors->has('authenticate'))
                                                <span class="error_auth" style="color: red">{{ $errors->first('authenticate') }}</span>
                                            @endif 
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example22">Đăng nhập với quyền</label>
                                            <select name="role" class="form-select" aria-label="Default select example">
                                                <option value="1">Sinh Viên</option>
                                                <option value="2">Nhân Viên</option>
                                                <option value="3">Quản lý</option>
                                            </select>
                                        </div>
                                        <div style="margin: 10px">
                                            @if($errors->has('role'))
                                                <span class="error_role" style="color: red">{{ $errors->first('role') }}</span>
                                            @endif 
                                        </div>
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Đăng Nhập</button>
                                            <a class="text-muted" href="#!">Quên Mật Khẩu?</a>
                                        </div>

                                            <!-- <div class="d-flex align-items-center justify-content-center pb-4">
                                                <p class="mb-0 me-2">Bạn chưa có tài khoản?</p>
                                                <button type="button" class="btn btn-outline-danger">Đăng ký</button>
                                            </div> -->

                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <!-- <h4 class="mb-4">We are more than just a company</h4>
                                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MDB -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
    <script type="text/javascript"   src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $('input[name="account"]').on('input', function() {
            if ($('.error_account').text()) {
                $('.error_account').text("")
            }

            if ($('.error_auth').length) {
                $('.error_auth').text("")
            }
        })

        $('input[name="password"]').on('input', function() {
            if ($('.error_password').text()) {
                $('.error_password').text("")
            }

            if ($('.error_auth').length) {
                $('.error_auth').text("")
            }
        })

        $('select').on('change', function() {
            if ($('.error_role').length) {
                $('.error_role').text("")
            }
        })
    </script>
</body>

</html>