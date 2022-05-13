@extends('layouts.app')
@section('title_for_layout', 'Dashboard')
@section('content')
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    {{-- <div class="row">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                <p class="mb-4">
                  You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                  your profile.
                </p>

                <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  src="../assets/img/illustrations/man-with-laptop-light.png"
                  height="140"
                  alt="View Badge User"
                  data-app-dark-img="illustrations/man-with-laptop-dark.png"
                  data-app-light-img="illustrations/man-with-laptop-light.png"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="../assets/img/icons/unicons/chart-success.png"
                      alt="chart success"
                      class="rounded"
                    />
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt3"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Profit</span>
                <h3 class="card-title mb-2">$12,628</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="../assets/img/icons/unicons/wallet-info.png"
                      alt="Credit Card"
                      class="rounded"
                    />
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt6"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span>Sales</span>
                <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Total Revenue -->
      <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
          <div class="row row-bordered g-0">
            <div class="col-md-8">
              <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
              <div id="totalRevenueChart" class="px-2"></div>
            </div>
            <div class="col-md-4">
              <div class="card-body">
                <div class="text-center">
                  <div class="dropdown">
                    <button
                      class="btn btn-sm btn-outline-primary dropdown-toggle"
                      type="button"
                      id="growthReportId"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      2022
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                      <a class="dropdown-item" href="javascript:void(0);">2021</a>
                      <a class="dropdown-item" href="javascript:void(0);">2020</a>
                      <a class="dropdown-item" href="javascript:void(0);">2019</a>
                    </div>
                  </div>
                </div>
              </div>
              <div id="growthChart"></div>
              <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

              <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                <div class="d-flex">
                  <div class="me-2">
                    <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                  </div>
                  <div class="d-flex flex-column">
                    <small>2022</small>
                    <h6 class="mb-0">$32.5k</h6>
                  </div>
                </div>
                <div class="d-flex">
                  <div class="me-2">
                    <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                  </div>
                  <div class="d-flex flex-column">
                    <small>2021</small>
                    <h6 class="mb-0">$41.2k</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Total Revenue -->
      <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="row">
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt4"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="d-block mb-1">Payments</span>
                <h3 class="card-title text-nowrap mb-2">$2,456</h3>
                <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt1"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Transactions</span>
                <h3 class="card-title mb-2">$14,857</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
              </div>
            </div>
          </div>
          <!-- </div>
<div class="row"> -->
          <div class="col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                  <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                    <div class="card-title">
                      <h5 class="text-nowrap mb-2">Profile Report</h5>
                      <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                    </div>
                    <div class="mt-sm-auto">
                      <small class="text-success text-nowrap fw-semibold"
                        ><i class="bx bx-chevron-up"></i> 68.2%</small
                      >
                      <h3 class="mb-0">$84,686k</h3>
                    </div>
                  </div>
                  <div id="profileReportChart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- Order Statistics -->
      <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <div class="card-title mb-0">
              <h5 class="m-0 me-2">Order Statistics</h5>
              <small class="text-muted">42.82k Total Sales</small>
            </div>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="orederStatistics"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="d-flex flex-column align-items-center gap-1">
                <h2 class="mb-2">8,258</h2>
                <span>Total Orders</span>
              </div>
              <div id="orderStatisticsChart"></div>
            </div>
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-primary"
                    ><i class="bx bx-mobile-alt"></i
                  ></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Electronic</h6>
                    <small class="text-muted">Mobile, Earbuds, TV</small>
                  </div>
                  <div class="user-progress">
                    <small class="fw-semibold">82.5k</small>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Fashion</h6>
                    <small class="text-muted">T-shirt, Jeans, Shoes</small>
                  </div>
                  <div class="user-progress">
                    <small class="fw-semibold">23.8k</small>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Decor</h6>
                    <small class="text-muted">Fine Art, Dining</small>
                  </div>
                  <div class="user-progress">
                    <small class="fw-semibold">849k</small>
                  </div>
                </div>
              </li>
              <li class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-secondary"
                    ><i class="bx bx-football"></i
                  ></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Sports</h6>
                    <small class="text-muted">Football, Cricket Kit</small>
                  </div>
                  <div class="user-progress">
                    <small class="fw-semibold">99</small>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Order Statistics -->

      <!-- Expense Overview -->
      <div class="col-md-6 col-lg-4 order-1 mb-4">
        <div class="card h-100">
          <div class="card-header">
            <ul class="nav nav-pills" role="tablist">
              <li class="nav-item">
                <button
                  type="button"
                  class="nav-link active"
                  role="tab"
                  data-bs-toggle="tab"
                  data-bs-target="#navs-tabs-line-card-income"
                  aria-controls="navs-tabs-line-card-income"
                  aria-selected="true"
                >
                  Income
                </button>
              </li>
              <li class="nav-item">
                <button type="button" class="nav-link" role="tab">Expenses</button>
              </li>
              <li class="nav-item">
                <button type="button" class="nav-link" role="tab">Profit</button>
              </li>
            </ul>
          </div>
          <div class="card-body px-0">
            <div class="tab-content p-0">
              <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                <div class="d-flex p-4 pt-3">
                  <div class="avatar flex-shrink-0 me-3">
                    <img src="../assets/img/icons/unicons/wallet.png" alt="User" />
                  </div>
                  <div>
                    <small class="text-muted d-block">Total Balance</small>
                    <div class="d-flex align-items-center">
                      <h6 class="mb-0 me-1">$459.10</h6>
                      <small class="text-success fw-semibold">
                        <i class="bx bx-chevron-up"></i>
                        42.9%
                      </small>
                    </div>
                  </div>
                </div>
                <div id="incomeChart"></div>
                <div class="d-flex justify-content-center pt-4 gap-2">
                  <div class="flex-shrink-0">
                    <div id="expensesOfWeek"></div>
                  </div>
                  <div>
                    <p class="mb-n1 mt-1">Expenses This Week</p>
                    <small class="text-muted">$39 less than last week</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Expense Overview -->

      <!-- Transactions -->
      <div class="col-md-6 col-lg-4 order-2 mb-4">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2">Transactions</h5>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="transactionID"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="text-muted d-block mb-1">Paypal</small>
                    <h6 class="mb-0">Send money</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">+82.6</h6>
                    <span class="text-muted">USD</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="text-muted d-block mb-1">Wallet</small>
                    <h6 class="mb-0">Mac'D</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">+270.69</h6>
                    <span class="text-muted">USD</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="../assets/img/icons/unicons/chart.png" alt="User" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="text-muted d-block mb-1">Transfer</small>
                    <h6 class="mb-0">Refund</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">+637.91</h6>
                    <span class="text-muted">USD</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="../assets/img/icons/unicons/cc-success.png" alt="User" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="text-muted d-block mb-1">Credit Card</small>
                    <h6 class="mb-0">Ordered Food</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">-838.71</h6>
                    <span class="text-muted">USD</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="text-muted d-block mb-1">Wallet</small>
                    <h6 class="mb-0">Starbucks</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">+203.33</h6>
                    <span class="text-muted">USD</span>
                  </div>
                </div>
              </li>
              <li class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="../assets/img/icons/unicons/cc-warning.png" alt="User" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="text-muted d-block mb-1">Mastercard</small>
                    <h6 class="mb-0">Ordered Food</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">-92.45</h6>
                    <span class="text-muted">USD</span>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Transactions -->
    </div> --}}
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
                <div style="text-align: center; font-size: 20px; font-weight: 700">Thống kê tiền đã thu phòng</div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="m-r-10"><span class="text-orange display-5"><i class="mdi mdi-wallet"></i></span></div>
                        <div><span>Tổng số tiền đã thu</span>
                            <h3 class="price_value font-medium m-b-0 totalRecharge">{{$totalMoney}}</h3>
                        </div>
                    </div>
                </div>
                <!-- col -->
                <!-- col -->
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="m-r-10"><span class="text-cyan display-5"><i class="mdi mdi-star-circle"></i></span></div>
                        <div><span>Tổng số tiền chưa thu</span>
                            <h3 class="price_value font-medium m-b-0 totalBought">{{$totalMoneyOwe}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <div class="col-lg-12 ct-charts card">
        <div style="display: flex; justify-content: flex-end">
        
          <select class="custom-select-2 form-select" style="width: 100px; margin-top: 10px">
            <option value="0" selected>Tuần</option>
            <option value="1">Tháng</option>
            <option value="2">Năm</option>
        </select>
        </div>
      
        <div class="campaign ct-charts" style="height: 300px">
         
            <canvas style="width: 100%; height: 100%" id="myChart2"></canvas>
        </div>
        <div class="card-body statis-box border-top">
          <div class="row m-b-0" style="display: flex; justify-content: space-around">
              <!-- col -->
              <div style="text-align: center; font-size: 20px; font-weight: 700">Thống kê đã thu tiền phòng của sinh viên</div>
              <div class="col-lg-3 col-md-6">
                  <div class="d-flex align-items-center">
                      <div class="m-r-10"><span class="text-orange display-5"><i class="mdi mdi-wallet"></i></span></div>
                      <div><span>Tổng số tiền phòng của sinh viên đã thu</span>
                          <h3 class="price_value font-medium m-b-0 totalRecharge">{{$totalMoneyRoom}}</h3>
                      </div>
                  </div>
              </div>
              <!-- col -->
              <!-- col -->
              <div class="col-lg-3 col-md-6">
                  <div class="d-flex align-items-center">
                      <div class="m-r-10"><span class="text-cyan display-5"><i class="mdi mdi-star-circle"></i></span></div>
                      <div><span>Tổng số tiền phòng của sinh viên chưa thu</span>
                          <h3 class="price_value font-medium m-b-0 totalBought">{{$totalMoneyOweRoom}}</h3>
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
                    url: "{{ route('dashboard') }}",
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

            //2
            let myChart2 = document.getElementById('myChart2').getContext('2d');
            var massPopChart2 = new Chart(myChart2, {
                type:'bar', 
                data:{
                    labels: [],
                    datasets:[{
                        label:'Tiền phòng sinh viên',
                        data: [],
                        backgroundColor:'#4af32c',
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

            const statisticalRoomMoney = function() {
                $.ajax({
                    url: "{{ route('dashboard.student') }}",
                    type: 'GET',
                    data: {
                        time: $('.custom-select-2 option:selected').attr('value'),
                    },
                    success: function(data) {
                        console.log(data)
                        if ( data.type === 'Week' ) {
                            labels = ['Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy', 'Chủ nhật']
                            $('.card-subtitle').text('Overview of Latest Week')
                            addData(massPopChart2, labels, data.users)
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
                            addData(massPopChart2, labels, data.users)
                        } else if ( data.type === 'Year' ) {
                            labels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 
                                    'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 
                                    'Tháng 10', 'Tháng 11', 'Tháng 12'
                                    ]
                            $('.card-subtitle').text('Overview of Latest Year')
                            addData(massPopChart2, labels, data.users)
                        }
                    },
                    erro: function(error) {
                        console.log('err')
                    }
                })            
            }

            statisticalRoomMoney()
            $( ".custom-select-2" ).change(function() {
                statisticalRoomMoney() 
            });
     })
  </script>
@endpush