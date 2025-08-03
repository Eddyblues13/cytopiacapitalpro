@include('admin.header')
<div class="main-panel">
	<div class="content bg-dark">
		<div class="page-inner">
			@if(session('message'))
			<div class="alert alert-success mb-2">{{session('message')}}</div>
			@endif
			<div class="mt-2 mb-4">
				<h1 class="title1 text-light">Total users lists</h1>
			</div>

			<div>
			</div>
			<div>
			</div>
			<div class="row">
				<div class="col-12">
					<a href="#" data-toggle="modal" data-target="#sendmailModal" class="btn btn-primary btn-lg"
						style="margin:10px;">Message all</a>
					<a href="" class="btn btn-warning btn-lg">KYC</a>

					<a href="{{route('add.user')}}" data-toggle="modal" data-target="#adduser"
						class="float-right btn btn-primary"> <i class='fas fa-plus-circle'></i> Open an Account</a>
					<!-- Modal -->
					<div class="modal fade" id="adduser" tabindex="-1" aria-h6ledby="exampleModalh6" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header bg-dark">
									<h3 class="mb-2 d-inline text-light">Manually Add Users</h3>
									<button type="button" class="close text-light" data-dismiss="modal" aria-h6="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body bg-dark">
									<div>
										<form role="form" method="post" action="{{ route('add.user') }}">
											@csrf
											<div class="form-row">
												<div class="form-group col-md-12">
													<h6 class="text-light">First Name</h6>
													<input type="text" id="input1"
														class="form-control bg-dark text-light" name="first_name"
														required>
												</div>
												<div class="form-group col-md-12">
													<h6 class="text-light">Last Name</h6>
													<input type="text" class="form-control bg-dark text-light"
														name="last_name" required>
												</div>
												<div class="form-group col-md-12">
													<h6 class="text-light">Email</h6>
													<input type="email" class="form-control bg-dark text-light"
														name="email" required>
												</div>
												<div class="form-group col-md-12">
													<h6 class="text-light">Password</h6>
													<input type="password" class="form-control bg-dark text-light"
														name="password" required>
												</div>
												<div class="form-group col-md-12">
													<h6 class="text-light">Confirm Password</h6>
													<input type="password" class="form-control bg-dark text-light"
														name="password_confirmation" required>
												</div>
											</div>
											<button type="submit" class="px-4 btn btn-primary">Add User</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mb-5 row">
				<div class="col-md-12 shadow card p-4 bg-dark">
					<div class="row">
						<div class="col-12">
							<form class="form-inline">
								<div class="form-group mr-2">
									<select class="form-control bg-dark text-light" id="numofrecord">
										<option value="5">5</option>
										<option value="10" selected>10</option>
										<option value="20">20</option>
										<option value="30">30</option>
										<option value="50">50</option>
										<option value="100">100</option>
									</select>
								</div>
								<div class="form-group mr-2">
									<select class="form-control bg-dark text-light" id="order">
										<option value="desc">Descending</option>
										<option value="asc">Ascending</option>
									</select>
								</div>
								<div class="form-group">
									<input type="text" id="searchInput" placeholder="Search by name or email"
										class="form-control bg-dark text-light">
									<small id="errorsearch"></small>
								</div>
							</form>
						</div>
					</div>

					<div class="table-responsive" data-example-id="hoverable-table">
						<table class="table table-hover text-light" id="userTable">
							<thead>
								<tr>
									<th>SN</th>
									<th>Client Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="userslisttbl">
								@foreach($users as $user)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td style="display: flex; align-items: center;">
										<div
											style="width: 40px; height: 40px; border-radius: 50%; background: #007bff; color: white; display: flex; justify-content: center; align-items: center; font-weight: bold; margin-right: 10px;">
											{{ strtoupper(substr($user->first_name, 0, 1)) }}{{
											strtoupper(substr($user->last_name, 0, 1)) }}
										</div>
										<div>
											{{ $user->first_name }} {{ $user->last_name }}<br>
											<small>{{ strtolower($user->email) }}</small>
										</div>
									</td>
									<td>
										<a class="btn btn-secondary btn-sm"
											href="{{ route('admin.user.view', $user->id) }}" role="button">
											Manage
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>

					<!-- Pagination Controls -->
					<div id="pagination" class="mt-3"></div>

					<script>
		document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const numOfRecord = document.getElementById("numofrecord");
        const orderSelect = document.getElementById("order");
        const tbody = document.getElementById("userslisttbl");
        const paginationDiv = document.getElementById("pagination");
        
        let currentPage = 1;
        let rowsPerPage = parseInt(numOfRecord.value);
        let filteredRows = [];

        // Function to get FRESH rows from DOM
        function getAllRows() {
            return Array.from(tbody.getElementsByTagName("tr"));
        }

        // Function to display rows for the current page
        function displayTablePage(page) {
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            
            // Hide all rows first
            getAllRows().forEach(row => row.style.display = "none");
            
            // Show only filtered/paginated rows
            filteredRows.slice(start, end).forEach(row => {
                row.style.display = "table-row";
            });

            generatePagination(filteredRows.length, page);
        }

        // Function to generate pagination buttons
        function generatePagination(totalRows, currentPage) {
            paginationDiv.innerHTML = "";
            const pageCount = Math.ceil(totalRows / rowsPerPage);

            if (pageCount <= 1) return;

            // Previous button
            if (currentPage > 1) {
                const prevBtn = document.createElement("button");
                prevBtn.innerHTML = "&laquo;";
                prevBtn.className = "btn btn-sm btn-outline-primary";
                prevBtn.style.margin = "2px";
                prevBtn.addEventListener("click", () => {
                    currentPage--;
                    displayTablePage(currentPage);
                });
                paginationDiv.appendChild(prevBtn);
            }

            // Page buttons
            for (let i = 1; i <= pageCount; i++) {
                const btn = document.createElement("button");
                btn.innerText = i;
                btn.className = `btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-outline-primary'}`;
                btn.style.margin = "2px";
                btn.addEventListener("click", () => {
                    currentPage = i;
                    displayTablePage(currentPage);
                });
                paginationDiv.appendChild(btn);
            }

            // Next button
            if (currentPage < pageCount) {
                const nextBtn = document.createElement("button");
                nextBtn.innerHTML = "&raquo;";
                nextBtn.className = "btn btn-sm btn-outline-primary";
                nextBtn.style.margin = "2px";
                nextBtn.addEventListener("click", () => {
                    currentPage++;
                    displayTablePage(currentPage);
                });
                paginationDiv.appendChild(nextBtn);
            }
        }

        // Function to filter and sort rows
        function filterTable() {
            rowsPerPage = parseInt(numOfRecord.value);
            const filter = searchInput.value.toLowerCase();
            const order = orderSelect.value;
            
            filteredRows = getAllRows().filter(row => {
                const text = row.innerText.toLowerCase();
                return text.includes(filter);
            });

            // Sort rows
            if (order === "asc") {
                filteredRows.sort((a, b) => a.cells[1].innerText.localeCompare(b.cells[1].innerText));
            } else {
                filteredRows.sort((a, b) => b.cells[1].innerText.localeCompare(a.cells[1].innerText));
            }

            currentPage = 1;
            displayTablePage(currentPage);
        }

        // Event listeners
        searchInput.addEventListener("input", filterTable);
        numOfRecord.addEventListener("change", filterTable);
        orderSelect.addEventListener("change", filterTable);

        // Initial setup
        filteredRows = getAllRows();
        displayTablePage(currentPage);
    });
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#input1').on('keypress', function(e) {
		return e.which !== 32;
	});
</script>

<!-- send all users email -->
<div id="sendmailModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h4 class="modal-title text-light">This message will be sent to all your users.</h4>
				<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body bg-dark">
				<form method="post" action="">
					@csrf
					<div class="form-group">
						<input type="text" name="subject" class="form-control bg-dark text-light" placeholder="Subject"
							required>
					</div>
					<div class="form-group">
						<textarea placeholder="Type your message here" class="form-control bg-dark text-light"
							name="message" row="8" placeholder="Type your message here" required></textarea>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-light" value="Send">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /send all users email Modal -->

@include('admin.footer')