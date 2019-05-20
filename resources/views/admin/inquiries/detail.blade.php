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
		<li class="active"><span>Enquiry Detail</span></li>
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
					<div class="panel-wrapper collapse in">
						<div class="panel-body inbox-body pa-0">
							<div class="heading-inbox">
								<div class="container-fluid">
									<div class="pull-left">
										<div class="compose-btn">
											<a class="btn btn-sm mr-10" href="{{ url('/inquiries') }}" data-toggle="modal" title="Compose"><i class="zmdi zmdi-chevron-left"></i></a>
										</div>
									</div>
									<div class="pull-right text-right">
										<!-- <button class="btn btn-sm mr-10" title="" type="button"><i class="zmdi zmdi-print"></i> </button> -->
										<button class="btn btn-sm mr-10" title="" id="delete-inquiry" ino="{{ $inquiry->id }}"><i class="zmdi zmdi-delete"></i></button>
										<div class="inline-block dropdown">
											<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more"></i></a>
											<ul class="dropdown-menu bullet dropdown-menu-right" role="menu">
												<li role="presentation"><a href="javascript:void(0)" role="menuitem" class="status" id="unread" ino="{{ $inquiry->id }}"><i class="icon wb-reply" aria-hidden="true"></i>Mark as Unread</a></li>
												<li role="presentation"><a href="javascript:void(0)" role="menuitem" class="status" id="read" ino="{{ $inquiry->id }}"><i class="icon wb-share" aria-hidden="true"></i>Mark as Read</a></li>
											</ul>
										</div>
		
									</div>
								</div>
								<hr class="light-grey-hr mt-10 mb-15">
								<div class="container-fluid mb-20">	
									<h4 class="weight-500">{{ $inquiry->product_name }}</h4>
								</div>	
							</div>
							<div class="sender-info">
								<div class="container-fluid">
									<div class="sender-img-wrap pull-left mr-20">
										<i class="fa fa-user fa-3x"></i>
									</div>
									<div class="sender-details   pull-left">
										<span class="capitalize-font pr-5 txt-dark block font-15 weight-500 head-font">{{ $inquiry->name }}</span>
										<span class="block">
											to
											<span>Luxe Montre</span>
										</span>	
									</div>	
									<div class="pull-right">
										<div class="inline-block mr-5">
											<span class="inbox-detail-time-1 font-12">{{ date('h:i A', strtotime($inquiry->created_at)) }}</span>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="container-fluid view-mail mt-20 mb-20">
								{{ $inquiry->inquiry }}
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
	@include('admin.inquiries._script')
@endsection

