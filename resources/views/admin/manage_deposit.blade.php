@include('admin.header')
<div class="main-panel">
	<div class="content bg-dark ">
		<div class="page-inner">
			@if(session('message'))
			<div class="alert alert-success mb-2">{{session('message')}}</div>
			@endif
			<div class="mt-2 mb-4">
				<h1 class="title1 text-light">Manage clients deposits</h1>
			</div>
			<div>
			</div>
			<div>
			</div>
			<div class="mb-5 row">
				<div class="col-12">
					<small class="text-light">if you can't see the image, try switching your uploaded location to
						another option from your admin settings page.</small>
				</div>
				<div class="col-12 card shadow p-4 bg-dark">
					<div class="table-responsive" data-example-id="hoverable-table">
						<table id="ShipTable" class="table table-hover text-light">
							<thead>
								<tr>
									<th>ID</th>
									<th>Client name</th>
									<th>Client email</th>
									<th>Amount</th>
									<th>Payment Method</th>
									<th>Status</th>
									<th>Date created</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>


								@foreach($deposits as $dep)
								<th scope="row">{{$dep->id}}</th>
								<td> {{$dep->name}}</td>
								<td>{{$dep->email}}</td>
								<td>${{number_format($dep->amount, 2, '.', ',')}}</td>
								<td>{{$dep->deposit_type}}</td>

								<td> 
									@if($dep->status==='0')
									<span class="badge badge-danger">Pending</span>
									@elseif($dep->status==='1')
									<span class="badge badge-success">Processed</span>
									@endif
								</td>
								<td>{{ \Carbon\Carbon::parse($dep->created_at)->format('D, M j, Y g:i A') }}</td>
								<td>
									<a href="{{url('admin/view-deposit/'.$dep->id)}}" class="btn btn-light btn-sm m-1"
										title="View payment screenshot">
										<i class="fa fa-eye"></i>
									</a>
									<a href="{{url('admin/delete-deposit/'.$dep->id)}}"
										class="m-1 btn btn-danger btn-sm">Delete</a>
									@if($dep->status==='0')
									<a class="btn btn-primary btn-sm"
										href="{{url('admin/process-deposit/'.$dep->id)}}">Process</a>
									@endif
								</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


	@include('admin.footer')