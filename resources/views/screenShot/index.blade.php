@extends('layouts.app')

@section('content')
<div class="container main">
<h1>Results:</h1>
<br>
<br>

    <style>
        ul{
            list-style: none outside none;
            padding-left: 0;
            margin: 0;
        }

        img{
            width: 100%;
            height: auto;
        }
        .main{
            background: #f8f8f8;
            min-height: 100vh;
        }
        .thumbnails{
            width: 100%;
            height: 262px;
            overflow: hidden;
        }
    </style>

    <div class="panel panel-default">
        <div class="panel-heading">
            <p><h4><input style="margin-right: 10px;" type="checkbox" id="select_all"/> Select all</h4></p>
        </div>
    </div>

    <ul>
        @foreach($pieces as $url)
            <?php
                if(empty($url)) { continue; }
                $limit = 0;
                $history = 'http://api.screenshots.com/v1/'. $url .'/history/';
                $content = @file_get_contents($history);
                $json    = json_decode($content, true);

                if($content === FALSE) { continue; }
                else{
            ?>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <li><h4><input style="margin-right: 10px;" type="checkbox" name="checkbox-1" id="checkbox-1"/>{{ $url }}</h4></li>
                </div>

                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="row">
                                <ul class="content-slider picture" itemscope itemtype="http://schema.org/ImageGallery">
                                <?php
                                foreach($json['historical'] as $item) {
                                    if($limit == 3) {
                                        break;
                                    }
                                    else{

                                    list($width, $height, $type, $attr) = getimagesize( $item['large'] );
                                ?>
                                    <li>
                                        <div class="thumbnails">
                                            <a href="<?= $item['large']; ?>" itemprop="contentUrl" data-size="<?=$width;?>x<?=$height;?>">
                                                <img src="<?= $item['large']; ?>" itemprop="thumbnail" >
                                            </a>
                                        </div>
                                        <hr>
                                        <p style="text-align: center"><?= $item['date']; ?></p>
                                    </li>
                                <?php
                                        $limit++;
                                    }
                                }
                                ?>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </ul>

    <button type="submit" class="btn btn-default">Export Selected Domains to TXT</button>



    <!-- Root element of PhotoSwipe. Must have class pswp. -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe.
             It's a separate element as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">

            <!-- Container that holds slides.
                PhotoSwipe keeps only 3 of them in the DOM to save memory.
                Don't modify these 3 pswp__item elements, data is added later on. -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">

                    <!--  Controls are self-explanatory. Order can be changed. -->

                    <div class="pswp__counter"></div>

                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                    <button class="pswp__button pswp__button--share" title="Share"></button>

                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                    <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                    <!-- element will get class pswp__preloader--active when preloader is running -->
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                          <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>

                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>

                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>

            </div>

        </div>

    </div>
</div>
@stop


@section('scripts')
    <script>
         $(document).ready(function() {
            $(".content-slider").lightSlider({
                item:4,
                loop:false,
                slideMargin: 20,
                slideMove:1,
                easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
                speed:600
            });

            $('#select_all').click(function(event) {
                if(this.checked) {
                    // Iterate each checkbox
                    $(':checkbox').each(function() {
                        this.checked = true;
                    });
                }
                else {
                    $(':checkbox').each(function() {
                        this.checked = false;
                    });
                }
            });


            var $pswp = $('.pswp')[0];
            var image = [];

            $('.picture').each( function() {
                var $pic     = $(this),
                    getItems = function() {
                        var items = [];
                        $pic.find('a').each(function() {
                            var $href   = $(this).attr('href'),
                                $size   = $(this).data('size').split('x'),
                                $width  = $size[0],
                                $height = $size[1];

                            var item = {
                                src : $href,
                                w   : $width,
                                h   : $height
                            }

                            items.push(item);
                        });
                        return items;
                    }

                var items = getItems();

                $.each(items, function(index, value) {
                    image[index]     = new Image();
                    image[index].src = value['src'];
                });

                $pic.on('click', 'li', function(event) {
                    event.preventDefault();

                    var $index = $(this).index();
                    var options = {
                        index: $index,
                        bgOpacity: 0.7,
                        showHideOpacity: true
                    }

                    var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
                    lightBox.init();
                });
            });


        });
    </script>
@stop




