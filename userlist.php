<?php include('include/sidebar.php');?>
					<style>
					.navbar {
            background-color: #fff;
            color: black;
            padding: 10px;
            /*width: 1200px;*/
            margin-left: 20px;
            margin-top: 10px;
            justify-content: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }

        .navbar a {
            color: black;
            text-decoration: none;

        }

       
    </style>				





				<div class="page-wrapper">
					<div class="navbar">
        <div class="navbar-header">
           <h3>Users List</h3>
        </div>
    </div>
						<div class="content">
							<div class="page-header">
								<div class="page-title">
									<h4>User List</h4>
									<h6>Manage your User</h6>
								</div>
								<div class="page-btn">
									<a href="newuser.php" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-2">Add User</a>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<!-- <div class="table-top">
										<div class="search-set">
											<div class="search-path">
												<a class="btn btn-filter" id="filter_search">
													<img src="assets/img/icons/filter.svg" alt="img">
													<span><img src="assets/img/icons/closes.svg" alt="img"></span>
												</a>
											</div>
											<div class="search-input">
												<a class="btn btn-searchset">
													<img src="assets/img/icons/search-white.svg" alt="img">
												</a>
											</div>
										</div>
										<div class="wordset">
											<ul>
												<li>
													<a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
												</li>
												<li>
													<a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
												</li>
												<li>
													<a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
												</li>
											</ul>
										</div>
									</div> -->
									<!-- <div class="card" id="filter_inputs">
										<div class="card-body pb-0">
											<div class="row">
												<div class="col-lg-2 col-sm-6 col-12">
													<div class="form-group">
														<input type="text" placeholder="Enter User Name">
													</div>
												</div>
												<div class="col-lg-2 col-sm-6 col-12">
													<div class="form-group">
														<input type="text" placeholder="Enter Phone">
													</div>
												</div>
												<div class="col-lg-2 col-sm-6 col-12">
													<div class="form-group">
														<input type="text" placeholder="Enter Email">
													</div>
												</div>
												<div class="col-lg-2 col-sm-6 col-12">
													<div class="form-group">
														<select class="select">
															<option>Disable</option>
															<option>Enable</option>
														</select>
													</div>
												</div>
												<div class="col-lg-1 col-sm-6 col-12 ms-auto">
													<div class="form-group">
														<a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></a>
													</div>
												</div>
											</div>
										</div>
									</div> -->
									<div class="table-responsive">
										<table class="table ">
											<thead>
												<tr>
													<!-- <th>
														<label class="checkboxs">
															<input type="checkbox">
															<span class="checkmarks"></span>
														</label>
													</th> -->
													<th>Profile</th>
													<th>First name </th>
													<!-- <th>Last name </th> -->
													<th>User name </th>
													<th>Phone</th>
													<th>email</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php include('include/conn.php');
													$sql =   "SELECT * FROM `users`";
                                                    $rew = mysqli_query($con,$sql);
                                                    

												while($res = mysqli_fetch_array($rew)){	?>
												<tr>

													<!-- <td>
														<label class="checkboxs">
															<input type="checkbox">
															<span class="checkmarks"></span>
														</label>
													</td> -->
													<td class="productimgname">
														<a href="javascript:void(0);" class="product-img">
															<img src="users/<?php echo $res['myfile'];?>" alt="product">
														</a>
													</td>
													<td><?php echo $res['name'];?></td>
													<td><?php echo $res['username'];?> </td>
													<td><?php echo $res['mobile_no'];?> </td>
													<td><?php echo $res['email']?> </td>
													
													<td>
														<div class="status-toggle d-flex justify-content-between align-items-center">
															<?php if($res['status']=='on') { ?>
													<a href="change_status_active.php<?php echo '?id='.$res['id']; ?>"><span class="badge badge-success light border-0">Active</span></a>
													<?php  } else { ?>
													<a href="change_status_deactive.php?id=<?php echo $res['id']; ?>"><span class="badge badge-danger light border-0">De-active</span></a>
													<?php  } ?>
														</div>
													</td>
													<td>
														<a class="me-3" href="edituser.php?id=<?php echo $res['id'];?>">
															<img src="assets/img/icons/edit.svg" alt="img">
														</a>
														<a class="me-3" href="deleteuser.php?id=<?php echo $res['id'];?>" onclick="return confirm('Are you sure?')">
															<img src="assets/img/icons/delete.svg" alt="img">
														</a>
													</td>
												</tr>
											<?php } ?>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="showpayment" tabindex="-1" aria-labelledby="showpayment" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Show Payments</h5>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							</div>
							<div class="modal-body">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Date</th>
												<th>Reference</th>
												<th>Amount	</th>
												<th>Paid By	</th>
												<th>Paid By	</th>
											</tr>
										</thead>
										<tbody>
											<tr class="bor-b1">
												<td>2022-03-07	</td>
												<td>INV/SL0101</td>
												<td>$ 1500.00	</td>
												<td>Cash</td>
												<td>
													<a class="me-2" href="javascript:void(0);">
														<img src="assets/img/icons/printer.svg" alt="img">
													</a>
													<a class="me-2" href="javascript:void(0);" data-bs-target="#editpayment" data-bs-toggle="modal" data-bs-dismiss="modal">
														<img src="assets/img/icons/edit.svg" alt="img">
													</a>
													<a class="me-2 confirm-text" href="javascript:void(0);">
														<img src="assets/img/icons/delete.svg" alt="img">
													</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="createpayment" tabindex="-1" aria-labelledby="createpayment" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Create Payment</h5>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-lg-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Customer</label>
											<div class="input-group">
												<input type="text" value="2022-03-07" class="datetimepicker">
												<a class="scanner-set input-group-text">
													<img src="assets/img/icons/datepicker.svg" alt="img">
												</a>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Reference</label>
											<input type="text" value="INV/SL0101">
										</div>
									</div>
									<div class="col-lg-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Received Amount</label>
											<input type="text" value="1500.00">
										</div>
									</div>
									<div class="col-lg-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Paying Amount</label>
											<input type="text" value="1500.00">
										</div>
									</div>
									<div class="col-lg-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Payment type</label>
											<select class="select">
												<option>Cash</option>
												<option>Online</option>
												<option>Inprogress</option>
											</select>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Note</label>
											<textarea class="form-control"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-submit">Submit</button>
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="editpayment" tabindex="-1" aria-labelledby="editpayment" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Payment</h5>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-lg-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Customer</label>
											<div class="input-group">
												<input type="text" value="2022-03-07" class="datetimepicker">
												<a class="scanner-set input-group-text">
													<img src="assets/img/icons/datepicker.svg" alt="img">
												</a>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Reference</label>
											<input type="text" value="INV/SL0101">
										</div>
									</div>
									<div class="col-lg-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Received Amount</label>
											<input type="text" value="1500.00">
										</div>
									</div>
									<div class="col-lg-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Paying Amount</label>
											<input type="text" value="1500.00">
										</div>
									</div>
									<div class="col-lg-6 col-sm-12 col-12">
										<div class="form-group">
											<label>Payment type</label>
											<select class="select">
												<option>Cash</option>
												<option>Online</option>
												<option>Inprogress</option>
											</select>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Note</label>
											<textarea class="form-control"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-submit">Submit</button>
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-3.6.0.min.js"></script>
				<script src="assets/js/feather.min.js"></script>
				<script src="assets/js/jquery.slimscroll.min.js"></script>
				<script src="assets/js/jquery.dataTables.min.js"></script>
				<script src="assets/js/dataTables.bootstrap4.min.js"></script>
				<script src="assets/js/bootstrap.bundle.min.js"></script>
				<script src="assets/plugins/select2/js/select2.min.js"></script>
				<script src="assets/js/moment.min.js"></script>
				<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
				<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
				<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
				<script src="assets/js/script.js"></script>
			</body>
		</html>