<div class="container">
	<div class="">
		<div class="row">
			<div class="col-md-1">&nbsp;</div>
			<div class="col-md-10 text-center">
				<hr>
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mt-15">
						@if( request()->segment(2) != 'productstep1' )
						@php 
						$lastval = substr(request()->segment(2), -1);
						$t = $lastval - 1;
						$go = substr(request()->segment(2), 0, -1);
						if( $lastval == 0 ) { $t = 9; $go = substr(request()->segment(2), 0, -2); }
						$tmp = 'supplier'.$go.$t @endphp
						<a href="{{ route($tmp) }}" class="prev" id="prevBtn">
							<i class="ti-arrow-left"></i> &nbsp;PREVIOUS
						</a>
						@endif
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
						<ul class="pagination pagination-split">
							<li class="page-item {{ request()->is('supplier/productstep1') ? 'active' : '' }}"><span class="page-link">1</span></li>
							<li class="page-item {{ request()->is('supplier/productstep2') ? 'active' : '' }}"><span class="page-link">2</span></li>
							<li class="page-item {{ request()->is('supplier/productstep3') ? 'active' : '' }}"><span class="page-link">3</span></li>
							<li class="page-item {{ request()->is('supplier/productstep4') ? 'active' : '' }}"><span class="page-link">4</span></li>
							<li class="page-item {{ request()->is('supplier/productstep5') ? 'active' : '' }}"><span class="page-link">5</span></li>
							<li class="page-item {{ request()->is('supplier/productstep6') ? 'active' : '' }}"><span class="page-link">6</span></li>
							<li class="page-item {{ request()->is('supplier/productstep7') ? 'active' : '' }}"><span class="page-link">7</span></li>
							<li class="page-item {{ request()->is('supplier/productstep8') ? 'active' : '' }}"><span class="page-link">8</span></li>
							<li class="page-item {{ request()->is('supplier/productstep9') ? 'active' : '' }}"><span class="page-link">9</span></li>
							<li class="page-item {{ request()->is('supplier/productstep10') ? 'active' : '' }}"><span class="page-link">10</span></li>
						</ul>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  mt-15 text-right">
						<a onclick="javascript:$('#first').submit();" class="next" id="nextBtn">
							NEXT &nbsp;<i class="ti-arrow-right"></i>
						</a>
					</div>
				</div>
				<hr>
			</div>
			<div class="col-md-1">&nbsp;</div>
		</div>
	</div>
</div>
<style type="text/css">
.pagination > li > a,
.pagination > li > span {
	width: 35px;
	height: 35px;
	line-height: 1.4;
	padding: 7px 8px;
}
</style>