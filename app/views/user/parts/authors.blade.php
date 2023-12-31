Subscriptions | {{$authors_count}}
<div class="row-fluid" id="authors_section">
	@for($i=0; $i<9; $i++)
		<div class="col-xs-4 subscription-box">
			<div class="subscription square">
				@if($authors->has($i))
				<div class="subscription-img">
					<img src="/uploads/userimages/user.svg">
				</div>
				
				<div class="subscription-name">
					{{$authors[$i]->a()}}
				</div>
				@endif
			</div>
		</div>
	@endfor
</div>