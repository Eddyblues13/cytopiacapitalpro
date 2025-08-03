@include('admin.header')
<div class="main-panel">
	<div class="content bg-dark">
		<div class="page-inner">
			<div class="mt-2 mb-4">
				<h1 class="title1 text-light">Manage clients withdrawals</h1>
			</div>
			<div>
			</div>
			<div>
			</div>
			<div class="mb-5 row">
				<div class="col card p-3 shadow bg-dark">
					<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
						<span style="margin:3px;">
							<table id="ShipTable" class="table table-hover text-light">
								<thead>
									<tr>
										<th>ID</th>
										<th>Client name</th>
										<th>Amount requested</th>
										<th>Payment Method</th>
										<th>details</th>
										<th>Date created</th>
									</tr>
								</thead>
								<tbody>
									@foreach($withdrawals as $with) <tr>
										<th scope="row">{{$with->id}}</th>
										<td>{{$with->name}}</td>
										<td>${{number_format($with->amount, 2, '.', ',')}}</td>
										<td>{{$with->method}}</td>
										<td>{{$with->details}}</td>

										<td>{{ \Carbon\Carbon::parse($with->created_at)->format('D, M j, Y g:i A') }}
										</td>
										{{-- <td>
											<a href="{{ url('admin/view-withdrawal/'.$with->user_id.'/'.$with->id) }}"
												class="m-1 btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a>
										</td> --}}
										@endforeach
									</tr>

								</tbody>
							</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('admin.footer')