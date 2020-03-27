<link rel="stylesheet" href="{{asset('/source/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('/source/css/detail-content.css')}}">
<div class="container"></div>
<div class="row" style="background-color: aliceblue;">
	<div class="col-12 title-content">
		<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<h4>
						@if(strtotime($content->end_date) > time())
							{{'learning'}}
						@else
							{{"Done"}}
						@endif
					</h4>
					<img class="d-block w-100" src="{{asset('/source/img/content/marsh-banner.jpg')}}">
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 header-content">
		<h3 class="title"><i class="fas fa-edit"></i> {{$content->title}}</h3>
		<ul>
			<li>Start: {{$content->start_date}}</li>
			<li>End: {{$content->end_date}}</li>
			<li>Tags: Default</li>
			<li>Level:
				@if($content->level == 0)
					{{"Beginer"}}
				@elseif($content->level == 1)
					{{'Intermediate'}}
				@else
					{{'Expert'}}
				@endif
			</li>
		</ul>
		<div class="creator-content">
			<i class="fas fa-user-check"></i>
			<span>{{$content->creator->name}}</span>
		</div>
	</div>
	<div class="description-content col-12" style="max-width: 1000px;margin-left: 17%">
		<p>{!! $content->content !!}</p>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
