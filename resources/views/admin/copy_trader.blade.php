@include('admin.header')

<!-- End Sidebar -->
<div class="main-panel">
			<div class="content bg-dark">
				<div class="page-inner">
					<div class="mt-2 mb-4">
						<h1 class="title1 text-light">Expert traders</h1>
					</div>
					<div>
    </div>					<div>
    </div>					<div class="mb-5 row">
						<div class="mt-2 mb-3 col-lg-12">
							<a class="btn btn-primary" href="{{url('add-trader')}}"><i class="fa fa-plus"></i> New plan</a>
						</div>
						@foreach($traders as $trader)
									<div class="col-lg-4">
									
							<div class="pricing-table purple border p-4 card bg-dark shadow">
							<div class="price-tag">
										<img src="{{asset('uploads/trader/'.$trader->picture)}}" class="card-img-top" alt="Image"><br>
											<center><i>Expert Trader</i></center>
											<h2 class="text-light">{{$trader->trader_name}}</h2>
								</div>
								<!-- Features -->
								<div class="pricing-features">
								<!--	<div class="feature text-light">Minimum trading amount:<span class="text-light">$100</span></div>
									<div class="feature text-light">Maximum trading amount:<span  class="text-light">$900,000</span></div>-->
									<div class="feature text-light">years of Exprience:<span class="text-light">{{$trader->trader_year_of_experience}}</span></div>
									<div class="feature text-light">active traders:<span class="text-light">{{$trader->active_traders}}</span></div>
									<div class="feature text-light">total copied traders:<span class="text-light">{{$trader->total_copied_trade}}</span></div>
									<div class="feature text-light">coppiers ROI:<span class="text-light">{{$trader->copier_roi}}</span></div>
									<div class="feature text-light">Risk Index:<span class="text-light">{{$trader->risk_index}}</span></div>
									<div class="feature text-light">Performance:<span class="text-light">{{$trader->performance}}</span></div>
									<div class="feature text-light">country:<span class="text-light">{{$trader->trader_country}}</span></div>
									<div class="feature text-light">Duration:<span class="text-light">{{$trader->investment_duration}}</span></div>
									<div class="feature text-light">About Trader:<br>{{$trader->about_trader}}</div>
								</div> <br>
								
								<!-- Button -->
								<div class="text-center">
									<a href="{{url('edit_trader/'.$trader->id)}}" class="btn btn-primary"><i class="text-white flaticon-pencil"></i>
									</a> &nbsp; 
									<a href="" class="btn btn-danger"><i class="text-white fa fa-times"></i>
									</a>
								</div>
							</div>
						
						</div>	
						@endforeach	
						</div>	
												
					</div>
				</div>
			</div>
				


@include('admin.footer')
				