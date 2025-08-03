@include('admin.header')
<div class="main-panel">
			<div class="content bg-dark">
				<div class="page-inner">
                @if(session('message'))
<div class="alert alert-success mb-2">{{session('message')}}</div>
@endif
					<div class="mt-2 mb-4">
						<h1 class="title1 text-light">Update stock</h1>
					</div>
					<div>
    </div>                    <div>
    </div>					<div class="mb-5 row">
						<div class="col-lg-12 ">
                            <div class="p-3 card bg-dark">
                            <form action="{{url('update-stock/'.$stock->id)}}" method ="POST" enctype="multipart/form-data">
											{{ csrf_field()}}     
                                             <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <h5 class="text-light">stock Name</h5>
                                            <input  class="form-control text-light bg-dark" value="{{$stock->stock_name}}" placeholder="Enter Plan name" type="text" name="stock_name" required>
                                        </div>
                                     <!--   <div class="form-group col-md-6">
                                            <h5 class="text-light">Plan price($)</h5> 
                                            <input class="form-control text-light bg-dark" value="300" placeholder="Enter Plan price" type="text" name="price" required>   
                                            <small class="text-light">This is the maximum amount a user can pay to invest in this plan</small>
                                       </div>	
                                       
                                       <div class="form-group col-md-6">
                                            <h5 class="text-light">Active traders</h5> 
                                           <input class="form-control text-light bg-dark" value=""  type="text" name="activet" required>   
                                          
                                       </div>
                                        <div class="form-group col-md-6">
                                            <h5 class="text-light">Total coppied traders</h5>
                                            <input  class="form-control text-light bg-dark" value=""  type="text" name="investors" required>
                                        </div>
                                        
                                         <div class="form-group col-md-6">
                                            <h5 class="text-light">Risk Index</h5>
                                            <input  class="form-control text-light bg-dark" value=""  type="text" name="risk_Index" required>
                                        </div>
                                          <div class="form-group col-md-6">
                                            <h5 class="text-light">country</h5>
                                            <input  class="form-control text-light bg-dark" value=""  type="text" name="country" required>
                                        </div>
                                       
                                       -->
                                       <div class="form-group col-md-6">
                                            <h5 class="text-light">Minimum amount ($)</h5> 			 
                                             <input placeholder="Enter Plan minimum price" value="{{$stock->stock_min_amount}}" class="form-control text-light bg-dark" type="text" name="stock_min_amount" required>  
                                         
                                       </div>
                                       <div class="form-group col-md-6">
                                             <h5 class="text-light"> Maximum amount ($)</h5> 			 
                                             <input class="form-control text-light bg-dark" value="{{$stock->stock_max_amount}}"  type="text" name="stock_max_amount" required> 
                                           
                                       </div>
                                       
                                     
                                      <div class="form-group col-md-6">
                                            <h5 class="text-light">status</h5>
                                            current status::  {{$stock->top_up_status}}
                                             <select class="form-control text-light bg-dark" name="top_up_status" required>
                                               <option value="{{$stock->top_up_status}}">{{$stock->top_up_status}}</option>
                                               <option value="closed">closed </option>
                                                 <option value="Open">Open </option>
                                           </select>  
                                           
                                        </div>
                                          <div class="form-group col-md-6">
                                            <h5 class="text-light">Share</h5>
                                            <input  class="form-control text-light bg-dark" value="{{$stock->performance}}"  type="text" name="performance" required>
                                        </div>
                                          <div class="form-group col-md-6">
                                            <h5 class="text-light">volumn</h5>
                                            <input  class="form-control text-light bg-dark" value="{{$stock->copier_roi}}"  type="text" name="copier_roi" required>
                                        </div>
                                         
                                         <div class="form-group col-md-6">
                                            <h5 class="text-light">About stock</h5>
                                          <!--  <input  class="form-control text-light bg-dark" value="Amazon" type="text" name="about" required>
                                       -->
                                       
                                       
                                       <textarea   rows="4" cols="40" class="form-control text-light bg-dark" value="{{$stock->years_of_experience}}" name="years_of_experience	" required>
Amazon
</textarea>
                                       
                                        </div>
                                        
                                        
                                        
                                       <div class="form-group col-md-6">
                                           <h5 class="text-light">Top up Interval</h5> 	
                                           <select class="form-control text-light bg-dark" name="top_up_interval">
                                            <option value="{{$stock->top_up_interval}}">{{$stock->top_up_interval}}</option>
                                               <option value="Monthly">Monthly</option>
                                               <option value="Weekly">Weekly</option>
                                               <option value="Daily">Daily</option>
                                               <option value="Hourly">Hourly</option>
                                               <option value="30 Minutes">Every 30 Minutes</option>
                                           </select>  
                                           <small class="text-light">This specifies how often the system should add profit(ROI) to user account.</small>    
                                       </div>
                                       <div class="form-group col-md-6">
                                           <h5 class="text-light">Top up Type</h5> 
                                           <select class="form-control text-light bg-dark" name="top_up_type">
                                            <option value="{{$stock->top_up_type}}">{{$stock->top_up_type}}</option>
                                               <option value = "Percentage">Percentage</option>
                                               <option value = "Fixed">Fixed</option>
                                           </select>  
                                           <small class="text-light">This specifies if the system should add profit in percentage(%) or a fixed amount.</small>   
                                       </div>
                                       <div class="form-group col-md-6">
                                           <h5 class="text-light">Top up Amount (in % or $ as specified above)</h5> 
                                           <input class="form-control text-light bg-dark" value="{{$stock->top_up_amount}}" placeholder="top up amount" type="text" name="top_up_amount" required> 
                                           <small class="text-light">This is the amount the system will add to users account as profit, based on what you selected in topup type and topup interval above. </small>   
                                       </div>
                                       <div class="form-group col-md-6">
                                           <h5 class="text-light">Investment Duration</h5> 
                                           <input class="form-control text-light bg-dark"value="{{$stock->investment_duration}}" placeholder="eg 1 Day, 2 Weeks, 1 Month" type="text" name="investment_duration" required> 
                                           <small class="text-light">This specifies how long the stock will run. Please strictly follow the guide on <a href="" data-toggle="modal" data-target="#durationModal">how to setup investment duration</a> else it may not work. </small> 
                                              
                                       </div>
                                       <div class="form-group col-md-12">

                                           <input type="submit" class="btn btn-primary" value="Update Plan">   
                                       </div>
                                    </div>
                               </form>
                            </div>
						</div>
					</div>
				</div>
			</div>
            
            <div id="durationModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                      
                    </div>
                </div>
            </div>
            <div id="topupModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body bg-dark">
                            
                        </div>
                    </div>
                </div>
            </div>
@include('admin.footer')
				