<div>
  <div class="w-full" wire:ignore>
		<select class="form-control" id="select2-dropdown">
			<option value="">Select Option</option>
			@foreach($items as $item)
				<option value="{{ $item->id }}">{{ $item->name }}</option>
			@endforeach
		</select>
	</div>
</div>
@push('scripts')
<script>
	$(document).ready(function () {
			$('#select2-dropdown').select2();
			$('#select2-dropdown').on('change', function (e) {
				var data = $('#select2-dropdown').select2("val");
					@this.set('ottPlatform', data);
				});
			});
		</script>
@endpush