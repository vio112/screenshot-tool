<div class="col-md-12">
    <div class="row">
        <ul class="content-slider picture" itemscope itemtype="http://schema.org/ImageGallery">
            @foreach($json['historical'] as $item)
                @if($limit == 8)
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

<div class="col-md-12">
    <div class="row">
        <ul class="content-slider picture" itemscope itemtype="http://schema.org/ImageGallery">
            @foreach($url->historical as $item)
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
    <a target="_blank" href="http://screenshots.com/{{ $url }}" class="btn btn-default see-more-button" role="button">See more</a>
</div>