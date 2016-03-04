@extends('layouts.app')

@section('content')
<h1 style="text-align: center">Results</h1>
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
            background: #f8f8f8;
            min-height: 100vh;
        }
        .thumbnails{
            width:  205.6px;
            height: 173px;
            overflow: hidden;
        }
        .domainList{
            background: #e4e4e4;
        }
        .panel-info{
            border-color: #e4e4e4;
        }
        .panel-heading{
            color: white !important;
            background-color: #286090 !important;
            border-color: #286090 !important;
        }
    </style>

    <div class="panel panel-info">
        <div class="panel-heading">
            <p><h4><input style="margin-right: 10px; padding-left: 15px;" type="checkbox" id="select_all"/> Select all / None</h4></p>
        </div>

        <div class="panel-body" style="padding: 0px;">
            <ul>
            {!! Form::open(array('url' => '/downloadTxt', 'id'=>'export', 'data-length' => $count)) !!}
                @foreach($pieces as $url)
                    @if(empty($url))
                        <?php continue; ?>
                    @endif

                    <?php
                    $limit = 0;
                    $history = 'http://api.screenshots.com/v1/'. $url .'/history/';
                    $content = @file_get_contents($history);
                    $json    = json_decode($content, true);
                    ?>

                    @if($content === FALSE)
                        <?php continue; ?>
                    @else
                        @if($option == 'current')
                            <div class="panel panel-info">
                                <div class="panel-body domainList">
                                    <li>
                                        <h4>
                                            <input style="margin-right: 10px;" type="checkbox" name="url[]" id="checkbox-1" value="{{ $url }}" class = "checkboxes"/>screenshots.com/{{ $url }}
                                        </h4>
                                    </li>
                                    <div class="panel-body domainList">
                                        <div class="row">
                                            <div class="picture" itemscope itemtype="http://schema.org/ImageGallery">
                                                <?php list($width, $height, $type, $attr) = getimagesize( $json['large_current'] ); ?>
                                                <div class="photoItem">
                                                    <div class="thumbnails">
                                                        <a href="<?= $json['large_current']; ?>" itemprop="contentUrl" data-size="<?=$width;?>x<?=$height;?>">
                                                            <img width="262" height="216" src="<?= $json['small_current']; ?>" itemprop="thumbnail" >
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-md-offset-5">
                                        <a style="margin-left: 35px;" target="_blank" href="http://screenshots.com/{{ $url }}" class="btn btn-default" role="button">See more</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="panel panel-info">
                                <div class="panel-body domainList">
                                    <li>
                                        <h4>
                                            <input style="margin-right: 10px;" type="checkbox" name="url[]" id="checkbox-1" value="{{ $url }}" class = "checkboxes"/>screenshots.com/{{ $url }}
                                        </h4>
                                    </li>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <ul class="content-slider picture" itemscope itemtype="http://schema.org/ImageGallery">
                                                @foreach($json['historical'] as $item)
                                                    @if($limit == 8)
                                                        <?php break; ?>
                                                    @else
                                                        <?php
                                                        list($width, $height, $type, $attr) = getimagesize( $item['large'] );
                                                        ?>
                                                        <li class="photoItem">
                                                            <div class="thumbnails">
                                                                <a href="<?= $item['large']; ?>" itemprop="contentUrl" data-size="<?=$width;?>x<?=$height;?>">
                                                                    <img src="<?= $item['small']; ?>" itemprop="thumbnail" >
                                                                </a>
                                                            </div>
                                                            <hr>
                                                            <p style="text-align: center"><?= $item['date']; ?></p>
                                                        </li>
                                                        <?php
                                                        $limit++;
                                                        ?>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-md-offset-5">
                                        <a style="margin-left: 35px;" target="_blank" href="http://screenshots.com/{{ $url }}" class="btn btn-default" role="button">See more</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
                {{ Form::close() }}<!-- //add -->
            </ul>
            <button type="submit" class="btn btn-primary" id="export-text" style="margin: 15px;" disabled>Export Selected Domains to TXT</button>
        </div>
    </div>



    @include('partials._photoswipe')
</div>
@stop


@section('scripts')
    <script>
         $(document).ready(function() {
            $(".content-slider").lightSlider({
                item:5,
                loop:false,
                slideMargin: 20,
                slideMove:1,
                easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
                speed:600
            });

            $('#select_all').click(function(event) {
                $('#export-text').prop('disabled', false);
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

            $("#export-text").click(function(){//add
                $("#export").submit();//add
            });

            $(".checkboxes").change(function(){//add
                if ($('.checkboxes:checked').length == 0) {
                    $('#export-text').prop('disabled', true);
                }else{
                    $('#export-text').prop('disabled', false);
                }
                if ($('.checkboxes:checked').length == $('#export').data("length")) {//add
                   $("#select_all").prop('checked', true);//add
               }else{//add
                    $("#select_all").prop('checked', false);//add
               }//add
            });//add


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

                $pic.on('click', '.photoItem', function(event) {
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




