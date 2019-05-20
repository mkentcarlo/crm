@extends('layouts.admin.app')

@section('content')
	<!-- Title -->	
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		  <h5 class="txt-dark">Enquiries</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		  <ol class="breadcrumb">
			<li><a href="index.html">Dashboard</a></li>
			<li class="active"><span>Enquiries</span></li>
		  </ol>
		</div>
		<!-- /Breadcrumb -->
	</div>
	<!-- /Title -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">
					<div class="panel-body row pt-0 pb-0">
						<div class="mail-option pl-15 pr-15">
												<div class="chk-all">
													<div class="checkbox checkbox-default inline-block">
														<input type="checkbox" id="check-all">
														<label for="checkbox051"></label>
													</div>
													<div class="btn-group">
														<a data-toggle="dropdown" href="#" class="btn  all" aria-expanded="false">
														All
														<i class="fa fa-angle-down "></i>
														</a>
														<ul class="dropdown-menu">
															<li><a href="{{ url('/inquiries') }}"> All</a></li>
															<li><a href="{{ request()->get('page') ? '?page='. request()->get('page').'&inquiry=read': '?inquiry=read'}}"> Read</a></li>
															<li><a href="{{ request()->get('page') ? '?page='. request()->get('page').'&inquiry=unread' : '?inquiry=unread'}}"> Unread</a></li>
														</ul>
													</div>
													<div class="btn-group">
														<a data-toggle="dropdown" href="#" class="btn blue" aria-expanded="false">
														Action
														<i class="fa fa-angle-down "></i>
														</a>
														<ul class="dropdown-menu">
															<li><a href="#" class="marks" id="delete"> Delete</a></li>
															<li><a href="#" class="marks" id="read"> Mark Read</a></li>
															<li><a href="#" class="marks" id="unread"> Mark Unread</a></li>
														</ul>
													</div>
												</div>
												@include('pagination.custom', ['paginator' => $inquiries, 'link_limit' => 5])
											</div>
						<div class="table-responsive mb-0">
							<table class="table table-inbox table-hover mb-0">
									<tbody>
										<!-- <tr class="unread" onclick="window.location.href='queries-single.php'">
											<td class="inbox-small-cells">
												<div class="checkbox checkbox-default inline-block">
													<input type="checkbox" id="checkbox012">
													<label for="checkbox012"></label>
												</div>
											</td>
											<td class="view-message dont-show">Evie Ono</td>
											<td class="view-message ">Enquiry for "Grey Theme [AUDEMARS PIGUET]"</td>
											<td class="view-message  text-right">
												<span class="time-chat-history inline-block">9:27 AM</span>
											</td>
										</tr>
										<tr class="read" onclick="window.location.href='queries-single.php'">
											<td class="inbox-small-cells">
												<div class="checkbox checkbox-default inline-block">
													<input type="checkbox" id="checkbox012">
													<label for="checkbox012"></label>
												</div>
											</td>
											<td class="view-message dont-show">Madalyn Rascon</td>
											<td class="view-message ">Enquiry for "GMT Master II Black in Stainless Steel [ROLEX]"</td>
											<td class="view-message  text-right">
												<span class="time-chat-history inline-block">12:27 AM</span>
											</td>
										</tr> -->

										@if(count($inquiries) < 1)
										<tr>
											<td colspan="4">No inquiries available.</td>
										</tr>
										@else
										@foreach($inquiries as $inquiry)
											<tr class="{{ $inquiry->status }}">
												<td class="inbox-small-cells">
													<div class="checkbox checkbox-default inline-block">
														<input type="checkbox" class="inquire-data" value="{{ $inquiry->id }}">
														<label for="checkbox012"></label>
													</div>
												</td>
												<td class="view-message dont-show view-by-message" ino="{{ $inquiry->id }}">{{ $inquiry->name }}</td>
												<td class="view-message ">{{ $inquiry->inquiry }}</td>
												<td class="view-message  text-right">
													<span class="time-chat-history inline-block">{{ date('h:i A', strtotime($inquiry->created_at)) }}</span>
												</td>
											</tr>
										@endforeach
										@endif
									</tbody>
							</table>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('admin.inquiries._script')
@endsection
