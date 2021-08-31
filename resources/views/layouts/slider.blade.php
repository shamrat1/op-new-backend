
<style type="text/css">
    div#myCarousel {
    @if(Auth::check())
        padding-top: 130px;
    @else
        padding-top: 160px;
    @endif
}
.carousel-indicators {
    bottom: 0;
}
.carousel-inner > .item > img {
        display: block;
    max-width: 100%;
    width: 100%;
    height: 250px;
}
 /*responsive*/
 @media(max-width: 320px){.carousel-inner {margin-top: 52px; height: 150px;}}
 @media(min-width: 320px) and (max-width: 480px){.carousel-inner {margin-top: 46px; height: 147px;}}
 @media (min-width: 480px) and (max-width: 580px){.carousel-inner {margin-top: 50px;width: 100%;height: 180px;}}
 @media (min-width: 580px) and (max-width: 768px){.carousel-inner {height: 200px;margin-top: 50px;}}
 @media (min-width: 768px) and (max-width: 940px){.carousel-inner {    height: 200px;
    margin-top: 15px;}}
 @media (min-width: 940px) and (max-width: 1030px){.carousel-inner {height: 200px;
    margin-top: 0px;}}
 @media (min-width: 1031px) and (max-width: 1199px){.carousel-inner {    margin-top: 0px;
    height: 200px;}}
 @media(min-width: 1199px) and (max-width: 1330px){.carousel-inner {height: 200px;
    margin-top: 0;}}

</style>


<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
   <ol class="carousel-indicators">
     @foreach ($banner as $item)
        <li data-target="#myCarousel" data-slide-to="{{ $loop->iteration - 1 }}" class="{{ $loop->first ? 'active' : null }}"></li>
     @endforeach
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    {{-- @dd($banner) --}}
    @foreach ($banner as $item)

        <div class="item @if($loop->first) active @endif">
          <img src="{{ asset('uploads/banner/'.$item->image) }}" alt="{{ $item->image }}">
        </div>
    @endforeach
  </div>

</div>
