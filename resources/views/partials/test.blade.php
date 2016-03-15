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
            @foreach($url['historical'] as $item)
                @if($limit == 8)
                    <?php break; ?>
                @else
                    <li id="<?= $url['domain']; ?>" class="photoItem">
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
    <div class="wrapper">
        <a target="_blank" href="http://screenshots.com/<?= $url['domain']; ?>" class="btn btn-default See-more-button" role="button">See more</a>
    </div>
</div>


<div class="panel-body domainList">
    <div class="row">
        <div class="picture" itemscope itemtype="http://schema.org/ImageGallery">
            <?php list($width, $height, $type, $attr) = getimagesize( $url['large_current'] ); ?>
            <div class="photoItem">
                <div class="thumbnails">
                    <a href="<?= $url['large_current']; ?>" itemprop="contentUrl" data-size="<?=$width;?>x<?=$height;?>">
                        <img width="262" height="216" src="<?= $url['small_current']; ?>" itemprop="thumbnail" >
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>