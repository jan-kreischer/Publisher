<!-- If not empty collection -->
@if(!$articleimages->isEmpty())
<div class="carousel slide" id="article_images_slider" data-ride="carousel">
	<!-- Indicators -->

    <ol class="carousel-indicators">
      @for($i = 0; $i<$articleimages->count(); $i++)
	  	<li data-target="#article_images_slider" data-slide-to="{{$i}}"></li>
	  @endfor
	</ol>

	<!-- Wrapper for Slides -->
	<div class="carousel-inner">
		@for($i = 0; $i<$articleimages->count(); $i++)
		    <div class="item {{($i==0)?'active':'';}}" id="slide{{$i}}">
		      {{$articleimages[$i]->output();}}
		      <div class="carousel-caption">
		      	<h3>h3</h3>
		        <p>praragraph</p>
		      </div><!-- END .carousel-caption -->
		    </div><!-- END .item -->
	    @endfor
    </div><!-- END .carousel-inner -->
    
	<!-- Left and right controls -->
	  <a class="left carousel-control" href="#article_images_slider" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#article_images_slider" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
</div><!-- END .carousel slide -->

<script>

</script>
@endif