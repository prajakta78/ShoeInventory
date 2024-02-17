	<?php
					include('include/conn.php');
					$id=$_GET['id'];
					$sql="SELECT * FROM role WHERE id='$id'";
					$row=mysqli_query($con,$sql);
					while($result=mysqli_fetch_array($row))
					{
					?>

				<div class="page-wrapper" >
						
					
<!-- <style>
	input{
		height: 20px;
		width: 20px;
	}

	tr{
		height: 150px;

	}
	td{
		width: 500px;
	}
	label{
		margin-left: 6px;
	}
</style> -->
<?php include('include/sidebar.php');?>

					<form action="update_role.php" method="POST">
						<table class="table table-responsive  " style="display: flex; margin-top: 50px;">
							
							<input type="hidden" name="role" id="role" value="<?php echo $result['role']; ?>">
							<label>Permission For Role : &nbsp; </label><i class="fa fa-user-circle " style="font-size: 26px;color:blue;"></i>&nbsp;<label class="h3 text-primary "> <?php echo $result['role']; ?> </label>
							

							<tr>
								
									<?php $permission= explode(",",$result['permission']); ?>
									<td>
										<?php
										if(in_array(" Reports", $permission))
										{ ?>
										<div class="">
											<input type="checkbox"  name="permission[]" value=" Reports"<?php if(in_array(" Reports", $permission))echo "checked"; ?> >
											
											<label>Reports</label>
										</div>
										<?php
										}
										else
										{?>
										<div class="">
											<input type="checkbox" name="permission[]" value=" Reports" >
											
											<label>Reports</label>
										</div>
										<?php }
										?>
									</td>
									<!-- 1st colom -->
									<td>
										<?php
										if(in_array(" Role", $permission))
										{ ?>
										<div class="">
											<input type="checkbox" name="permission[]" value=" Role"<?php if(in_array(" Role", $permission))echo "checked"; ?> >
											
											<label>Role</label>
											
										</div>
										<?php
										}
										else
										{?>
										<div class="">
											<input type="checkbox" name="permission[]" value=" Role" >
											
											<label>Role</label>
										</div>
											<?php }
											?>
									</td>
										<!-- 2 colom -->

										<td>
											<?php
											if(in_array(" Customer form", $permission))
											{ ?>
											<div class="">
												<input type="checkbox" name="permission[]" value=" Customer form"<?php if(in_array(" Customer form", $permission))echo "checked"; ?> >
												
												<label>Customer form</label>
												
											</div>
											<?php
											}
											else
											{?>
											<div class="">
												<input type="checkbox" name="permission[]" value=" Customer form" >
												
												<label>Customer Form</label>
											</div>
												<?php }?>
											</td>
											<td>
												<?php
												if(in_array(" View customer form", $permission))
												{ ?>
												<div class="">
													<input type="checkbox" name="permission[]" value=" View customer form"<?php if(in_array(" View customer form", $permission))echo "checked"; ?>>
													
													<label>View Customer form</label>
													
												</div>
												<?php
												}
												else
												{?>
												<div class="">
													<input type="checkbox" name="permission[]" value=" View customer form">
													
													<label>View Customer Form</label></div>
													<?php }?>
												</td>
												<td>
													<?php
													if(in_array(" Add services", $permission))
													{ ?>
													<div class="">
														<input type="checkbox" name="permission[]" value=" Add services"<?php if(in_array(" Add services", $permission))echo "checked"; ?> >
														
														<label>Add services</label>
														
													</div>
													<?php
													}
													else
													{?>
													<div class="">
														<input type="checkbox" name="permission[]" value=" Add services" >
													
														<label>Add services</label>
													</div>
														<?php }?>
													</td>
												</tr>
												<!-- 1 row closed -->
												<tr>
													<td>
														<?php
														if(in_array(" Add news", $permission))
														{ ?>
														<div class="">
															<input type="checkbox" name="permission[]" value=" Add news"<?php if(in_array(" Add news", $permission))echo "checked"; ?> >
															
															<label>Add services</label>
															
														</div>
														<?php
														}
														else
														{?>
														<div class="">
															<input type="checkbox" name="permission[]" value=" Add news">
														
															<label>Add news</label>
														</div>
															<?php }?>
													</td>
													
													<td>
															<?php
															if(in_array(" User management", $permission))
															{ ?>
															<div class="">
																<input type="checkbox" name="permission[]" value=" User management"<?php if(in_array(" User management", $permission))echo "checked"; ?> >
																
																<label>User management</label>	
															</div>
																<?php
																}
																else
																{?>
																<div class="">
																	<input type="checkbox" name="permission[]" value=" User management" >
																
																	<label> User management</label>
																</div>
																	<?php }?>
													</td>
													
													<td>
																	<?php
																	if(in_array(" Advance report", $permission))
																	{ ?>
																	<div class="">
																		<input type="checkbox" name="permission[]" value=" Advance report"<?php if(in_array(" Advance report", $permission))echo "checked"; ?>>
																		
																		<label> Advance report</label>
																		
																	</div>
																	<?php
																	}
																	else
																	{?>
																	<div class="">
																		<input type="checkbox" name="permission[]" value=" Advance report" >
																	
																		<label> Advance report</label></div>
																		<?php }?>
																	</td>
																	<td>
																		<?php
																		if(in_array(" Admin Dashboard", $permission))
																		{ ?>
																		<div class=" ">
																			<input type="checkbox" name="permission[]" value=" Admin Dashboard"<?php if(in_array(" Admin Dashboard", $permission))echo "checked"; ?> >
																			
																			<label> Admin Dashboard</label>
																			
																		</div>
																		<?php
																		}
																		else
																		{?>
																		<div class="">
																			<input type="checkbox" name="permission[]" value=" Admin Dashboard" >
																			
																			<label> Admin Dashboard</label></div>
																			<?php }?>
																		</td>
																		<td>
																			<?php
																			if(in_array(" User Dashboard", $permission))
																			{ ?>
																			<div class="">
																				<input type="checkbox" name="permission[]" value=" User Dashboard"<?php if(in_array(" User Dashboard", $permission))echo "checked"; ?> >
																				
																				<label> User Dashboard</label>
																				
																			</div>
																			<?php
																			}
																			else
																			{?>
																			<div class="">
																				<input type="checkbox" name="permission[]" value=" User Dashboard" >
																			
																				<label> User Dashboard</label></div>
																				<?php }?>
																		</td>
																	</tr>
									
										<!-- row div ended-->
						</table>
		<input type="submit" name="change" class="btn btn-primary" style="width:100px;height: 40px;">
	</form>
	<?php }?>
</div>
</div>
</body>
</html>