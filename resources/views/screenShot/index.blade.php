@extends('layouts.app')

@section('content')

<h1 style="text-align: center">Results</h1>
<div class="container main">
<br>


    <div class="panel panel-info">
        <div class="panel-heading">
            <p><h4><input type="checkbox" id="select_all"/> Select all / None</h4></p>
        </div>

        <div id="main-panel-body" class="panel-body">
            <ul>
            {!! Form::open(array('url' => '/downloadTxt', 'id'=>'export', 'data-length' => $count)) !!}
                @foreach($historical as $url)
                    @if($option == 'current')
                        <div class="panel panel-info">
                            <div class="panel-body domainList">
                                <li>
                                    <h4>
                                        <input type="checkbox" name="url[]" id="checkbox-1" value="{{ $url }}" class = "checkboxes"/>screenshots.com/{{ $url }}
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
                                    <a target="_blank" href="http://screenshots.com/{{ $url }}" class="btn btn-default See-more-button" role="button">See more</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <?php $limit = 0; ?>
                        <div class="panel panel-info">
                            <div class="panel-body domainList">
                                <li>
                                    <h4>
                                        <input type="checkbox" name="url[]" id="checkbox-1" value="<?= $url['domain']; ?>" class = "checkboxes"/>screenshots.com/<?= $url['domain']; ?>
                                    </h4>
                                </li>
                                <div class="col-md-12">
                                    <div class="row">
                                        <ul class="content-slider picture" itemscope itemtype="http://schema.org/ImageGallery">
                                            @foreach($url['historical'] as $item)
                                                @if($limit == 4)
                                                    <?php break; ?>
                                                @else
                                                    <li class="photoItem">
                                                        <div class="thumbnails">
                                                            <?php list($width, $height, $type, $attr) = getimagesize( $item['large'] ); ?>
                                                            <a href="<?= $item['large']; ?>" itemprop="contentUrl" data-size="<?=$width;?>x<?=$height;?>">
                                                                <img src="<?= $item['small']; ?>" itemprop="thumbnail" >
                                                            </a>
                                                        </div>
                                                        <hr>
                                                        <p style="text-align: center"><?= $item['date']; ?></p>
                                                    </li>
                                                    <?php $limit++; ?>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-2 col-md-offset-5">
                                    <a target="_blank" href="http://screenshots.com/<?= $item['date']; ?>" class="btn btn-default see-more-button" role="button">See more</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                {{ Form::close() }}
            </ul>
            <button type="submit" class="btn btn-primary" id="export-text" disabled>Export Selected Domains to TXT</button>
        </div>
    </div>

    @include('partials._photoswipe')
</div>
@stop


@section('scripts')
    <script>
         $(document).ready(function() {

            // $(".photoItem").each(function(){
            //     $('.thumbnails').html('<img class="loading" src="/img/loading.gif">');
            //     // alert("imagePaginate/" + $('.photoItem').attr('id'));
            //     $.ajax({
            //             url: 'screenShot/' + $('.picture').attr('id'),
            //             type: 'get',
            //             // data:{index: $('.photoItem').attr('id')},
            //             dataType: 'json',
            //             success: function (data) {
            //                     // $('.thumbnails').html('<img src="' + data.large_current + '"><br>');
            //                     // alert( data.status );
            //                     console.log( data );
            //             }
            //        });
            // });

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

            $("#export-text").click(function(){
                $("#export").submit();
            });

            $(".checkboxes").change(function(){
                if ($('.checkboxes:checked').length == 0) {
                    $('#export-text').prop('disabled', true);
                }else{
                    $('#export-text').prop('disabled', false);
                }

                if ($('.checkboxes:checked').length == $('#export').data("length")) {
                   $("#select_all").prop('checked', true);
               }else{
                    $("#select_all").prop('checked', false);
               }
            });


            $(".content-slider").lightSlider({
                item:5,
                loop:false,
                slideMargin: 20,
                slideMove:1,
                easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
                speed:600
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




