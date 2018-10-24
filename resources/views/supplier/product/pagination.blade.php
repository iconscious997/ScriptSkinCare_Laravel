<div class="container">
	<div class="supplier-pagination">
		<div class="row">
			<div class="col-md-2">&nbsp;</div>
			<div class="col-md-8 text-center">
				<hr>
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mt-15">
						<a href="{{ route('supplierstep1') }}" class="prev" id="prevBtn">
							<i class="ti-arrow-left"></i> &nbsp;PREVIOUS
						</a>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
						<ul class="pagination pagination-split">
							<li class="page-item active"><span class="page-link">1</span></li>
							<li class="page-item "><span class="page-link">2</span></li>
							<li class="page-item"><span class="page-link">3</span></li>
							<li class="page-item"><span class="page-link">4</span></li>
							<li class="page-item"><span class="page-link">5</span></li>
							<li class="page-item"><span class="page-link">6</span></li>
							<li class="page-item"><span class="page-link">7</span></li>
							<li class="page-item"><span class="page-link">8</span></li>
							<li class="page-item"><span class="page-link">9</span></li>
							<li class="page-item"><span class="page-link">10</span></li>
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
			<div class="col-md-2">&nbsp;</div>
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