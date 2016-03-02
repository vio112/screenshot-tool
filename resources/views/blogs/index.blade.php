@extends('layouts.app')

@section('content')
<h1>My Blogs</h1>

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
    </style>

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
            <li>{{ $url }}</li>


<!--            <div class="row">
                <div class="col-md-3">
                    <img width="100%" height="auto" src="http://images.screenshots.com/<?= $url; ?>/<?= str_replace(".", "-", $url); ?>-small.jpg">

                </div>
            </div> -->


            <div class="row">
                <ul  class="content-slider">
                <?php
                foreach($json['historical'] as $item) {
                    if($limit == 6) {
                        break;
                    }
                    else{
                ?>
                        <li>
                            <img src="<?= $item['small']; ?>">
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
            <?php } ?>
        @endforeach
    </ul>
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
        });
    </script>
@stop