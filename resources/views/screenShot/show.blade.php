@extends('layouts.app')

@section('content')
    <div class="container main">
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
                background: #f9f9f9;
                min-height: 100vh;
            }
            .thumbnails{
                width: 100%;
                height: 216px;
                overflow: hidden;
            }
        </style>

        <div class="panel panel-info">

            <div class="panel-heading">
                <h4>{{ $id }}</h4>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="row">
                            <ul class="content-slider" itemscope itemtype="http://schema.org/ImageGallery">
                            <?php
                            $limit = 0;
                            $history = 'http://api.screenshots.com/v1/'. $id .'/history/';
                            $content = @file_get_contents($history);
                            $json    = json_decode($content, true);

                            foreach($json['historical'] as $item) {
                                if($limit == 6) {
                                    break;
                                }
                                else{

                                list($width, $height, $type, $attr) = getimagesize( $item['large'] );
                            ?>
                                <li>
                                    <div class="thumbnails">
                                        <img src="<?= $item['small']; ?>" itemprop="thumbnail" >
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
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="panel panel-info">

            <div class="panel-heading">
                <h4>Now Viewing Screenshot Taken</h4>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="picture" itemscope itemtype="http://schema.org/ImageGallery">
                        <?php
                            list($width, $height, $type, $attr) = getimagesize( $item['large'] );
                        ?>
                            <div>
                                <a href="<?= $json['historical'][0]['large']; ?>" itemprop="contentUrl" data-size="<?=$width;?>x<?=$height;?>">
                                    <img src="<?= $json['historical'][0]['large']; ?>" itemprop="thumbnail">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        @include('partials._photoswipe')
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

                $pic.on('click', 'a', function(event) {
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




