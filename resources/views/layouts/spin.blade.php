
<style type="text/css">

  @-webkit-keyframes spincube {
    from,to  { -webkit-transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg); }
    16%      { -webkit-transform: rotateY(-90deg);                           }
    33%      { -webkit-transform: rotateY(-90deg) rotateZ(90deg);            }
    50%      { -webkit-transform: rotateY(-180deg) rotateZ(90deg);           }
    66%      { -webkit-transform: rotateY(90deg) rotateX(90deg);             }
    83%      { -webkit-transform: rotateX(90deg);                            }
  }

  #spinner {
    -webkit-animation-name: spincube;
    -webkit-animation-timing-function: ease-in-out;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-duration: 12s;
    -webkit-transform-style: preserve-3d;
    -webkit-transform-origin: 60px 60px 0;
  }

</style>

<div class="stage" style="width: 120px; height: 120px;">
<div class="cubespinner">
<div class="face1">1</div>
<div class="face2">2</div>
<div class="face3">3</div>
<div class="face4">4</div>
<div class="face5">5</div>
<div class="face6">6</div>
</div>
</div>

