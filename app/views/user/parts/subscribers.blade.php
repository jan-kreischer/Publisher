Subscribers | <span class="subscriber-count">{{$subscribers_count}}</span> 
<div class="row-fluid" id="subscribers_section">
	@for($i=0; $i<9; $i++)
		<div class="col-xs-4 subscription-box">
			<div class="subscription square">
				@if($subscribers->has($i))
				<img src="/uploads/userimages/user.svg" class="subscription-img">
				<div class="subscription-name">
						{{$subscribers[$i]->a();}}
				</div>
				@endif
			</div>
		</div>
	@endfor
</div>