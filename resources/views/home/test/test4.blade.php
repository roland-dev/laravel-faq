@foreach($data as $key => $value)
	{{ $value -> name}}的年龄是{{ $value->age }}<br/>
@endforeach