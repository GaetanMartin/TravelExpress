@if( ! empty($preference))

<span class="preference_inline">
	{{-- Smoker --}}
    <span class="fa-stack fa-lg">
      	<i class="fa fa-fire fa-stack-1x"></i>
      	@if(! $preference->smoker_accepted)
      		<i class="fa fa-ban fa-stack-2x text-danger"></i>
    	@endif
    </span>
    {{-- Pets --}}
    <span class="fa-stack fa-lg">
      	<i class="fa fa-paw fa-stack-1x"></i>
      	@if(! $preference->pet_accepted)
      		<i class="fa fa-ban fa-stack-2x text-danger"></i>
    	@endif
    </span>
    {{-- Radio --}}
    <span class="fa-stack fa-lg">
      	<i class="fa fa-music fa-stack-1x"></i>
      	@if(! $preference->radio_accepted)
      		<i class="fa fa-ban fa-stack-2x text-danger"></i>
    	@endif
    </span>
    {{-- Chat --}}
    <span class="fa-stack fa-lg">
      	<i class="fa fa-comments fa-stack-1x"></i>
      	@if(! $preference->chat_accepted)
      		<i class="fa fa-ban fa-stack-2x text-danger"></i>
    	@endif
    </span>
</span>

@endif